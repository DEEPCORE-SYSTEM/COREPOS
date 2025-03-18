@extends('layouts.app')

@section('title', __('repair::lang.add_job_sheet'))

@section('content')
@include('repair::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>
    	@lang('repair::lang.job_sheet')
        <small>@lang('repair::lang.create')</small>
    </h1>
</section>
<section class="content">
    @if(!empty($repair_settings))
        @php
            $product_conf = isset($repair_settings['product_configuration']) ? explode(',', $repair_settings['product_configuration']) : [];

            $defects = isset($repair_settings['problem_reported_by_customer']) ? explode(',', $repair_settings['problem_reported_by_customer']) : [];

            $product_cond = isset($repair_settings['product_condition']) ? explode(',', $repair_settings['product_condition']) : [];
        @endphp
    @else
        @php
            $product_conf = [];
            $defects = [];
            $product_cond = [];
        @endphp
    @endif


<!-- Formulario para crear un nuevo Job Sheet -->
<form action="{{ url('repair/job-sheet/store') }}" method="POST" id="job_sheet_form" enctype="multipart/form-data">
    @csrf

    <!-- Inclusión del modal de seguridad si está disponible -->
    @includeIf('repair::job_sheet.partials.scurity_modal')

    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                @php
                    $default_location = count($business_locations) == 1 
                        ? array_key_first($business_locations->toArray()) 
                        : null;
                @endphp

                <!-- Selección de ubicación del negocio -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="location_id">@lang('business.business_location'):</label>
                        <select name="location_id" id="location_id" class="form-control" required style="width: 100%;">
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($business_locations as $key => $location)
                                <option value="{{ $key }}" {{ $default_location == $key ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Selección de cliente -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_id">@lang('role.customer'):</label>
                        <div class="input-group">
                            <input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id'] ?? '' }}">
                            <input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name'] ?? '' }}">
                            <input type="hidden" id="default_customer_balance" value="{{ $walk_in_customer['balance'] ?? '' }}">

                            <select name="contact_id" id="customer_id" class="form-control mousetrap" required style="width: 100%;">
                                <option value="">{{ __('Enter Customer name / phone') }}</option>
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_customer"
                                    data-name="" @if(!auth()->user()->can('customer.create')) disabled @endif>
                                    <i class="fa fa-plus-circle text-primary fa-lg"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Selección del tipo de servicio -->
                <div class="col-md-5">
                    <label>@lang('repair::lang.service_type'):</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="service_type" value="carry_in" class="input-icheck" required>
                        @lang('repair::lang.carry_in')
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="service_type" value="pick_up" class="input-icheck">
                        @lang('repair::lang.pick_up')
                    </label>
                    <label class="radio-inline radio_btns">
                        <input type="radio" name="service_type" value="on_site" class="input-icheck">
                        @lang('repair::lang.on_site')
                    </label>
                </div>
            </div>

            <!-- Dirección de recolección si aplica -->
            <div class="row pick_up_onsite_addr" style="display: none;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pick_up_on_site_addr">@lang('repair::lang.pick_up_on_site_addr'):</label>
                        <textarea name="pick_up_on_site_addr" id="pick_up_on_site_addr" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div class="box box-solid">
            <div class="box-body">

                    <div class="row">
                        <!-- Selección de marca -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="brand_id">@lang('product.brand'):</label>
                                <select name="brand_id" id="brand_id" class="form-control select2">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($brands as $key => $brand)
                                        <option value="{{ $key }}">{{ $brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Selección de tipo de dispositivo -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="device_id">@lang('repair::lang.device'):</label>
                                <select name="device_id" id="device_id" class="form-control select2">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($devices as $key => $device)
                                        <option value="{{ $key }}">{{ $device }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Selección del modelo del dispositivo -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="device_model_id">@lang('repair::lang.device_model'):</label>
                                <select name="device_model_id" id="device_model_id" class="form-control select2">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($device_models as $key => $model)
                                        <option value="{{ $key }}">{{ $model }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h5 class="box-title">
                                    @lang('repair::lang.pre_repair_checklist'):
                                    @show_tooltip(__('repair::lang.prechecklist_help_text'))
                                    <small>
                                        @lang('repair::lang.not_applicable_key') = @lang('repair::lang.not_applicable')
                                    </small>
                                </h5>
                            </div>
                            <div class="box-body">
                                <div class="append_checklists"></div>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <!-- Campo para el número de serie del dispositivo -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="serial_no">@lang('repair::lang.serial_no'):</label>
                                <input type="text" name="serial_no" id="serial_no" class="form-control" placeholder="@lang('repair::lang.serial_no')" required>
                            </div>
                        </div>

                        <!-- Campo para el código de seguridad del dispositivo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="security_pwd">@lang('repair::lang.repair_passcode'):</label>
                                <div class="input-group">
                                    <input type="text" name="security_pwd" id="security_pwd" class="form-control" placeholder="@lang('lang_v1.password')">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#security_pattern">
                                            <i class="fas fa-lock"></i> @lang('repair::lang.pattern_lock')
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                            <div class="row">
                                <!-- Configuración del producto -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_configuration">@lang('repair::lang.product_configuration'):</label>
                                        <textarea name="product_configuration" id="product_configuration" class="form-control tags-look" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Problema reportado por el cliente -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="defects">@lang('repair::lang.problem_reported_by_customer'):</label>
                                        <textarea name="defects" id="defects" class="form-control tags-look" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Condición del producto -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_condition">@lang('repair::lang.condition_of_product'):</label>
                                        <textarea name="product_condition" id="product_condition" class="form-control tags-look" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>



                                <div class="box box-solid">
                                    <div class="box-body">

                                        <div class="row">
                                        @if(in_array('service_staff', $enabled_modules))
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- Etiqueta para asignar un técnico de servicio -->
                                    <label for="service_staff">@lang('repair::lang.assign_service_staff'):</label>

                                    <!-- Selección del técnico de servicio -->
                                    <select name="service_staff" id="service_staff" class="form-control select2">
                                        <option value="">{{ __('restaurant.select_service_staff') }}</option>
                                        @foreach($technecians as $key => $technician)
                                            <option value="{{ $key }}">{{ $technician }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="form-group">
                                <!-- Comentario del técnico de servicio -->
                                <label for="comment_by_ss">@lang('repair::lang.comment_by_ss'):</label>
                                <textarea name="comment_by_ss" id="comment_by_ss" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <!-- Costo estimado de la reparación -->
                                <label for="estimated_cost">@lang('repair::lang.estimated_cost'):</label>
                                <input type="text" name="estimated_cost" id="estimated_cost" class="form-control input_number" placeholder="@lang('repair::lang.estimated_cost')">
                            </div>
                        </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="status_id">{{__('sale.status') . ':*'}}</label>
                            <select name="status_id" class="form-control status" id="status_id" required>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- Fecha de entrega esperada -->
                            <label for="delivery_date">@lang('repair::lang.expected_delivery_date'):</label>
                            @show_tooltip(__('repair::lang.delivery_date_tooltip'))
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="delivery_date" id="delivery_date" class="form-control" readonly>
                                <span class="input-group-addon">
                                    <i class="fas fa-times-circle cursor-pointer clear_delivery_date"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix">
                    </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <!-- Campo para subir documentos -->
                        <label for="upload_job_sheet_image">@lang('repair::lang.document'):</label>
                        <input type="file" name="images[]" id="upload_job_sheet_image" multiple
                            accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">

                        <small>
                            <p class="help-block">
                                @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                                @includeIf('components.document_help_text')
                            </p>
                        </small>
                    </div>
                </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('repair::lang.send_notification')</label><br>
                            <div class="checkbox-inline">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="send_notification[]" value="sms">
                                    @lang('repair::lang.sms')
                                </label>
                            </div>
                            <div class="checkbox-inline">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="send_notification[]" value="email">
                                    @lang('business.email')
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            @php
                                $custom_field_1_label = !empty($repair_settings['job_sheet_custom_field_1']) 
                                    ? $repair_settings['job_sheet_custom_field_1'] 
                                    : __('lang_v1.custom_field', ['number' => 1]);
                            @endphp
                            <!-- Campo personalizado 1 -->
                            <label for="custom_field_1">{{ $custom_field_1_label }}:</label>
                            <input type="text" name="custom_field_1" id="custom_field_1" class="form-control">
                        </div>
                    </div>


                    <div class="col-sm-4">
                        <div class="form-group">
                            @php
                                $custom_field_2_label = !empty($repair_settings['job_sheet_custom_field_2']) 
                                    ? $repair_settings['job_sheet_custom_field_2'] 
                                    : __('lang_v1.custom_field', ['number' => 2]);
                            @endphp
                            <!-- Campo personalizado 2 -->
                            <label for="custom_field_2">{{ $custom_field_2_label }}:</label>
                            <input type="text" name="custom_field_2" id="custom_field_2" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            @php
                                $custom_field_3_label = !empty($repair_settings['job_sheet_custom_field_3']) 
                                    ? $repair_settings['job_sheet_custom_field_3'] 
                                    : __('lang_v1.custom_field', ['number' => 3]);
                            @endphp
                            <!-- Campo personalizado 3 -->
                            <label for="custom_field_3">{{ $custom_field_3_label }}:</label>
                            <input type="text" name="custom_field_3" id="custom_field_3" class="form-control">
                        </div>
                    </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                            $custom_field_4_label = !empty($repair_settings['job_sheet_custom_field_4']) 
                                ? $repair_settings['job_sheet_custom_field_4'] 
                                : __('lang_v1.custom_field', ['number' => 4]);
                        @endphp
                        <!-- Campo personalizado 4 -->
                        <label for="custom_field_4">{{ $custom_field_4_label }}:</label>
                        <input type="text" name="custom_field_4" id="custom_field_4" class="form-control">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        @php
                            $custom_field_5_label = !empty($repair_settings['job_sheet_custom_field_5']) 
                                ? $repair_settings['job_sheet_custom_field_5'] 
                                : __('lang_v1.custom_field', ['number' => 5]);
                        @endphp
                        <!-- Campo personalizado 5 -->
                        <label for="custom_field_5">{{ $custom_field_5_label }}:</label>
                        <input type="text" name="custom_field_5" id="custom_field_5" class="form-control">
                    </div>
                </div>


                <div class="col-sm-12 text-right">
                    <input type="hidden" name="submit_type" id="submit_type">
                    <button type="submit" class="btn btn-success submit_button" value="save_and_add_parts">
                    @lang('repair::lang.save_and_add_parts')
                    </button>
                    <button type="submit" class="btn btn-primary submit_button" value="submit">
                        @lang('messages.save')
                    </button>
                    <button type="submit" class="btn btn-info submit_button" value="save_and_upload_docs">
                        @lang('repair::lang.save_and_upload_docs')
                    </button>
                </div>
                </div>
                
            </div>
        </div>
    
</form> <!-- /form close -->

    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        @include('contact.create', ['quick_add' => true])
    </div>
</section>
@stop
@section('css')
    @include('repair::job_sheet.tagify_css')
@stop
@section('javascript')
    <script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('.submit_button').click( function(){
                $('#submit_type').val($(this).attr('value'));
            });
            $('form#job_sheet_form').validate({
                errorPlacement: function(error, element) {
                    if (element.parent('.iradio_square-blue').length) {
                        error.insertAfter($(".radio_btns"));
                    } else if (element.hasClass('status')) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            var data = [{
              id: "",
              text: '@lang("messages.please_select")',
              html: '@lang("messages.please_select")',
            }, 
            @foreach($repair_statuses as $repair_status)
                {
                id: {{$repair_status->id}},
                @if(!empty($repair_status->color))
                    text: '<i class="fa fa-circle" aria-hidden="true" style="color: {{$repair_status->color}};"></i> {{$repair_status->name}}',
                    title: '{{$repair_status->name}}'
                @else
                    text: "{{$repair_status->name}}"
                @endif
                },
            @endforeach
            ];

            $("select#status_id").select2({
              data: data,
              escapeMarkup: function(markup) {
                return markup;
              }
            });

            @if(!empty($default_status))
                $("select#status_id").val({{$default_status}}).change();
            @endif

            $('#delivery_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $(document).on('click', '.clear_delivery_date', function() {
                $('#delivery_date').data("DateTimePicker").clear();
            });

            var lock = new PatternLock("#pattern_container", {
                onDraw:function(pattern){
                    $('input#security_pattern').val(pattern);
                },
                enableSetPattern: true
            });

            //filter device model id based on brand & device
            $(document).on('change', '#brand_id', function() {
                getModelForDevice();
                getModelRepairChecklists();
            });

            // get models for particular device
            $(document).on('change', '#device_id', function() {
                getModelForDevice();
            });
            
            $(document).on('change', '#device_model_id', function() {
                getModelRepairChecklists();
            });
            
            function getModelForDevice() {
                var data = {
                    device_id : $("#device_id").val(),
                    brand_id: $("#brand_id").val()
                };

                $.ajax({
                    method: 'GET',
                    url: '/repair/get-device-models',
                    dataType: 'html',
                    data: data,
                    success: function(result) {
                        $('select#device_model_id').html(result);
                    }
                });
            }

            function getModelRepairChecklists() {
                console.log('here');
                var data = {
                        model_id : $("#device_model_id").val(),
                    };
                $.ajax({
                    method: 'GET',
                    url: '/repair/models-repair-checklist',
                    dataType: 'html',
                    data: data,
                    success: function(result) {
                        $(".append_checklists").html(result);
                    }
                });
            }

            $('input[type=radio][name=service_type]').on('ifChecked', function(){
              if ($(this).val() == 'pick_up' || $(this).val() == 'on_site') {
                $("div.pick_up_onsite_addr").show();
              } else {
                $("div.pick_up_onsite_addr").hide();
              }
            });

            //initialize file input
            $('#upload_job_sheet_image').fileinput({
                showUpload: false,
                showPreview: false,
                browseLabel: LANG.file_browse_label,
                removeLabel: LANG.remove
            });

            //initialize tags input (tagify)
            var product_configuration = document.querySelector('textarea#product_configuration');
            tagify_pc = new Tagify(product_configuration, {
              whitelist: {!!json_encode($product_conf)!!},
              maxTags: 100,
              dropdown: {
                maxItems: 100,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
              }
            });

            var product_defects = document.querySelector('textarea#defects');
            tagify_pd = new Tagify(product_defects, {
              whitelist: {!!json_encode($defects)!!},
              maxTags: 100,
              dropdown: {
                maxItems: 100,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
              }
            });

            var product_condition = document.querySelector('textarea#product_condition');
            tagify_p_condition = new Tagify(product_condition, {
              whitelist: {!!json_encode($product_cond)!!},
              maxTags: 100,
              dropdown: {
                maxItems: 100,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
              }
            });
        });
    </script>
@endsection