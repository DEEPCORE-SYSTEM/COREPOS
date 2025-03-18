<form action="{{ action('\Modules\Repair\Http\Controllers\RepairSettingsController@store') }}" method="POST">
    @csrf

    <div class="row">
        <!-- <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('barcode_id', @trans( 'barcode.barcode_setting' ) . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-cog"></i>
                </span>
                {!! Form::select('barcode_id', $barcode_settings, !empty($repair_settings['barcode_id']) ? $repair_settings['barcode_id'] : null, ['class' => 'form-control select2']); !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        {!! Form::label('barcode_type', __('product.barcode_type') . ':') !!}
          {!! Form::select('barcode_type', $barcode_types, !empty($repair_settings['barcode_type']) ? $repair_settings['barcode_type'] : null, ['class' => 'form-control select2', 'required']); !!}
      </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('search_product', __('repair::lang.search_default_product') . ':') !!} @show_tooltip(__('repair::lang.default_product_tooltip'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="hidden" value="" id="variation_id">
                    {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder')]); !!} 
                    {!! Form::hidden('default_product', !empty($repair_settings['default_product']) ? $repair_settings['default_product'] : null, ['id' => 'default_product']); !!}
                </div>
                <p class="help-block">
                    <strong>@lang('repair::lang.selected_default_product'):</strong>
                    <span id="selected_default_product">{{$default_product_name}}</span>
                    <br>
                </p>
        </div>
    </div>-->
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="repair_status_id">
                    {{ __('repair::lang.default_job_sheet_status') }}:
                    @show_tooltip(__('repair::lang.default_job_sheet_status_tooltip'))
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <select name="default_status" class="form-control" id="repair_status_id"></select>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="job_sheet_prefix">{{ __('repair::lang.job_sheet_prefix') }}:</label>
                <input type="text" name="job_sheet_prefix" id="job_sheet_prefix" class="form-control"
                    placeholder="{{ __('repair::lang.job_sheet_prefix') }}"
                    value="{{ $repair_settings['job_sheet_prefix'] ?? '' }}">
            </div>
        </div>
    </div>

    <div class="row">
        @foreach([
        'product_configuration' => __('repair::lang.product_configuration'),
        'problem_reported_by_customer' => __('repair::lang.problem_reported_by_customer'),
        'product_condition' => __('repair::lang.condition_of_product')
        ] as $field => $label)
        <div class="col-md-4">
            <div class="form-group">
                <label for="{{ $field }}">{{ $label }}:</label>
                @show_tooltip(__("repair::lang.{$field}_tooltip"))
                <textarea name="{{ $field }}" id="{{ $field }}" class="form-control" rows="4">
                        {{ $repair_settings[$field] ?? '' }}
                    </textarea>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="repair_tc_condition">{{ __('repair::lang.repair_tc_conditions') }}:</label>
                <textarea name="repair_tc_condition" id="repair_tc_condition" class="form-control">
                    {{ $repair_settings['repair_tc_condition'] ?? '' }}
                </textarea>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        @foreach(range(1, 5) as $number)
        <div class="col-md-3">
            <div class="form-group">
                <label for="job_sheet_custom_field_{{ $number }}">
                    {{ __('repair::lang.label_for_job_sheet_custom_field', ['number' => $number]) }}:
                </label>
                <input type="text" name="job_sheet_custom_field_{{ $number }}" id="job_sheet_custom_field_{{ $number }}"
                    class="form-control" value="{{ $repair_settings["job_sheet_custom_field_{$number}"] ?? '' }}">
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-danger">Update</button>
            </div>
        </div>
    </div>
</form>