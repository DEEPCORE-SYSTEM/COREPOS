@extends('layouts.app')
@section('title', __('barcode.edit_barcode_setting'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('barcode.edit_barcode_setting')</h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Formulario para actualizar configuración de códigos de barra -->
    <form action="{{ action('BarcodeController@update', [$barcode->id]) }}" method="POST"
        id="add_barcode_settings_form">
        @csrf
        @method('PUT')
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <!-- Nombre de la configuración -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">{{ __('barcode.setting_name') }}:*</label>
                            <input type="text" name="name" class="form-control" value="{{ $barcode->name }}" required
                                placeholder="{{ __('barcode.setting_name') }}">
                        </div>
                    </div>

                    <!-- Descripción de la configuración -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="description">{{ __('barcode.setting_description') }}</label>
                            <textarea name="description" class="form-control"
                                placeholder="{{ __('barcode.setting_description') }}"
                                rows="3">{{ $barcode->description }}</textarea>
                        </div>
                    </div>

                    <!-- Opción para formato continuo -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_continuous" value="1" id="is_continuous"
                                        {{ $barcode->is_continuous ? 'checked' : '' }}>
                                    {{ __('barcode.is_continuous') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Márgenes -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="top_margin">{{ __('barcode.top_margin') }} ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </span>
                                <input type="number" name="top_margin" class="form-control"
                                    value="{{ $barcode->top_margin }}" min="0" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="left_margin">{{ __('barcode.left_margin') }}
                                ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                </span>
                                <input type="number" name="left_margin" class="form-control"
                                    value="{{ $barcode->left_margin }}" min="0" step="0.01" required>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <!-- Dimensiones del código de barras -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="width">{{ __('barcode.width') }} ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                <input type="number" name="width" class="form-control" value="{{ $barcode->width }}"
                                    min="0.1" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="height">{{ __('barcode.height') }} ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="number" name="height" class="form-control" value="{{ $barcode->height }}"
                                    min="0.1" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- Dimensiones del papel -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="paper_width">{{ __('barcode.paper_width') }}
                                ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                <input type="number" name="paper_width" class="form-control"
                                    value="{{ $barcode->paper_width }}" min="0.1" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 paper_height_div {{ $barcode->is_continuous ? 'hide' : '' }}">
                        <div class="form-group">
                            <label for="paper_height">{{ __('barcode.paper_height') }}
                                ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="number" name="paper_height" class="form-control"
                                    value="{{ $barcode->paper_height }}" min="0.1" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <!-- Cantidad de etiquetas en una fila -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="stickers_in_one_row">{{ __('barcode.stickers_in_one_row') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-ellipsis-h"></i></span>
                                <input type="number" name="stickers_in_one_row" class="form-control"
                                    value="{{ $barcode->stickers_in_one_row }}" min="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Distancia entre filas y columnas -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="row_distance">{{ __('barcode.row_distance') }}
                                ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-resize-vertical"></span></span>
                                <input type="number" name="row_distance" class="form-control"
                                    value="{{ $barcode->row_distance }}" min="0" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="col_distance">{{ __('barcode.col_distance') }}
                                ({{ __('barcode.in_in') }}):*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-resize-horizontal"></span></span>
                                <input type="number" name="col_distance" class="form-control"
                                    value="{{ $barcode->col_distance }}" min="0" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- Cantidad de etiquetas por hoja -->
                    <div class="col-sm-6 stickers_per_sheet_div {{ $barcode->is_continuous ? 'hide' : '' }}">
                        <div class="form-group">
                            <label for="stickers_in_one_sheet">{{ __('barcode.stickers_in_one_sheet') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="number" name="stickers_in_one_sheet" class="form-control"
                                    value="{{ $barcode->stickers_in_one_sheet }}" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Botón para actualizar -->
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@endsection