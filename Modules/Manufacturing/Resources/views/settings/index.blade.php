@extends('layouts.app')
@section('title', __('messages.settings'))

@section('content')
@include('manufacturing::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('messages.settings')</h1>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ action('\Modules\Manufacturing\Http\Controllers\SettingsController@store') }}" method="POST" id="manufacturing_settings_form">
        @csrf
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 pos-tab-container">
                    <!-- Menú de pestañas -->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item text-center active">@lang('messages.settings')</a>
                        </div>
                    </div>

                    <!-- Contenido de la pestaña -->
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                        <div class="pos-tab-content active">
                            <div class="row">
                                <!-- Prefijo del número de referencia -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ref_no_prefix">@lang('manufacturing::lang.mfg_ref_no_prefix'):</label>
                                        <input type="text" name="ref_no_prefix" id="ref_no_prefix" class="form-control"
                                            placeholder="@lang('manufacturing::lang.mfg_ref_no_prefix')"
                                            value="{{ $manufacturing_settings['ref_no_prefix'] ?? '' }}">
                                    </div>
                                </div>

                                <!-- Deshabilitar edición de cantidad de ingredientes -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <br>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="disable_editing_ingredient_qty" id="disable_editing_ingredient_qty" class="input-icheck"
                                                    value="1" {{ !empty($manufacturing_settings['disable_editing_ingredient_qty']) ? 'checked' : '' }}>
                                                @lang('manufacturing::lang.disable_editing_ingredient_qty')
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Habilitar actualización del precio del producto -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <br>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="enable_updating_product_price" id="enable_updating_product_price" class="input-icheck"
                                                    value="1" {{ !empty($manufacturing_settings['enable_updating_product_price']) ? 'checked' : '' }}>
                                                @lang('manufacturing::lang.enable_editing_product_price_after_production')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de actualización -->
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
            </div>
        </div>

        <!-- Información de la versión -->
        <div class="col-xs-12">
            <p class="help-block">
                <i>{!! __('manufacturing::lang.version_info', ['version' => $version]) !!}</i>
            </p>
        </div>
    </form>
</section>

@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready( function () {
        $(".file-input").fileinput(fileinput_setting);
    });
</script>

@endsection