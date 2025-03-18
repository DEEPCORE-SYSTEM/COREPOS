@extends('layouts.app')
@section('title', __( 'productcatalogue::lang.catalogue_qr' ))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'productcatalogue::lang.catalogue_qr' )</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-7">
            <!-- Formulario para generar el QR -->
            <div class="box box-solid">
                <div class="box-body">
                    <!-- Selección de ubicación -->
                    <div class="form-group">
                        <label for="location_id">@lang('purchase.business_location'):</label>
                        <select name="location_id" id="location_id" class="form-control">
                            <option value="">@lang('messages.please_select')</option>
                            @foreach($business_locations as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selección de color del QR -->
                    <div class="form-group">
                        <label for="color">@lang('productcatalogue::lang.qr_code_color'):</label>
                        <input type="text" name="color" id="color" class="form-control" value="#000000">
                    </div>

                    <!-- Título del QR -->
                    <div class="form-group">
                        <label for="title">@lang('productcatalogue::lang.title'):</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $business->name }}">
                    </div>

                    <!-- Subtítulo del QR -->
                    <div class="form-group">
                        <label for="subtitle">@lang('productcatalogue::lang.subtitle'):</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control" value="@lang('productcatalogue::lang.product_catalogue')">
                    </div>

                    <!-- Opción para mostrar el logo -->
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="add_logo" id="show_logo" class="input-icheck" checked>
                                @lang('productcatalogue::lang.show_business_logo_on_qrcode')
                            </label>
                        </div>
                    </div>

                    <!-- Botón para generar el QR -->
                    <button type="button" class="btn btn-primary" id="generate_qr">
                        @lang('productcatalogue::lang.generate_qr')
                    </button>
                </div>
            </div>

            <!-- Instrucciones de uso -->
            <div class="box box-solid">
                <div class="box-body">
                    <strong>@lang('lang_v1.instruction'):</strong>
                    <table class="table table-striped">
                        <tr>
                            <td>1</td>
                            <td>@lang('productcatalogue::lang.catalogue_instruction_1')</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>@lang('productcatalogue::lang.catalogue_instruction_2')</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>@lang('productcatalogue::lang.catalogue_instruction_3')</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección para mostrar el QR generado -->
        <div class="col-md-5">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <div id="qrcode"></div>
                    <span id="catalogue_link"></span>
                    <br>
                    <a href="#" class="btn btn-success hide" id="download_image" target="_blank" download="qrcode.png">
                        @lang('productcatalogue::lang.download_image')
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@section('javascript')
<script src="{{ asset('modules/productcatalogue/plugins/easy.qrcode.min.js') }}"></script>
<script type="text/javascript">
    (function($) {
        "use strict";

    $(document).ready( function(){
        $('#color').colorpicker();
    });
    
    $(document).on('click', '#generate_qr', function(e){
        $('#qrcode').html('');
        if ($('#location_id').val()) {
            var link = "{{url('catalogue/' . session('business.id'))}}/" + $('#location_id').val();
            var color = '#000000';
            if ($('#color').val().trim() != '') {
                color = $('#color').val();
            }
            var opts = {
                text: link,
                margin: 4,
                width: 256,
                height: 256,
                quietZone: 20,
                colorDark: color,
                colorLight: "#ffffffff", 
            }

            if ($('#title').val().trim() !== '') {
                opts.title = $('#title').val();
                opts.titleFont = "bold 18px Arial";
                opts.titleColor = "#004284";
                opts.titleBackgroundColor = "#ffffff";
                opts.titleHeight = 60;
                opts.titleTop = 20;
            }

            if ($('#subtitle').val().trim() !== '') {
                opts.subTitle = $('#title').val();
                opts.subTitleFont = "14px Arial";
                opts.subTitleColor = "#4F4F4F";
                opts.subTitleTop = 40;
            }

            if ($('#show_logo').is(':checked')) {
                opts.logo = "{{asset( 'uploads/business_logos/' . $business->logo)}}";
            }

            new QRCode(document.getElementById("qrcode"), opts);
            $('#catalogue_link').html('<a target="_blank" href="'+ link +'">Link</a>');
            $('#download_image').removeClass('hide');

            
        } else {
            alert("{{__('productcatalogue::lang.select_business_location')}}")
        }
    });
    })(jQuery);

    $('#download_image').click(function(e) {
        var src = $("#qrcode").find("img").attr("src");
        $('#download_image').attr("href", src);
    });
</script>
@endsection