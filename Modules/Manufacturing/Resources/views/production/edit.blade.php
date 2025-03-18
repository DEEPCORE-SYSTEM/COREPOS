@extends('layouts.app')
@section('title', __('manufacturing::lang.production'))

@section('content')
@include('manufacturing::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('manufacturing::lang.production') </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Formulario para actualizar la producción -->
    <form action="{{ action('\Modules\Manufacturing\Http\Controllers\ProductionController@update', [$production_purchase->id]) }}" method="POST" id="production_form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @component('components.widget', ['class' => 'box-solid'])
            <div class="row">
                <!-- Campo de referencia de compra -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="ref_no">{{ __('purchase.ref_no') }}:</label>
                        <input type="text" name="ref_no" id="ref_no" class="form-control" value="{{ $production_purchase->ref_no }}">
                    </div>
                </div>

                <!-- Fecha de producción -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="transaction_date">{{ __('manufacturing::lang.mfg_date') }}:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" name="transaction_date" id="transaction_date" class="form-control" value="{{ @format_datetime($production_purchase->transaction_date) }}" readonly required>
                        </div>
                    </div>
                </div>

                <!-- Ubicación de la producción -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="location_id">{{ __('purchase.business_location') }}:*</label>
                        <select name="location_id" id="location_id" class="form-control select2" required>
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($business_locations as $key => $value)
                                <option value="{{ $key }}" {{ $key == $production_purchase->location_id ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Producto a fabricar -->
                @php
                    $purchase_line = $production_purchase->purchase_lines[0];
                @endphp
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>{{ __('sale.product') }}:*</label>
                        <select class="form-control" disabled>
                            @foreach($recipe_dropdown as $key => $value)
                                <option value="{{ $key }}" {{ $key == $purchase_line->variation_id ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="variation_id" value="{{ $purchase_line->variation_id }}">
                    </div>
                </div>

                <!-- Cantidad a producir -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="recipe_quantity">{{ __('lang_v1.quantity') }}:*</label>
                        <div class="input-group">
                            <input type="text" name="quantity" id="recipe_quantity" class="form-control input_number" value="{{ @num_format($quantity) }}" required>
                            <span class="input-group-addon">{{ $unit_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-solid', 'title' => __('manufacturing::lang.ingredients')])
            <div class="row">
                <div class="col-md-12">
                    <div id="enter_ingredients_table">
                        @include('manufacturing::recipe.ingredients_for_production')
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Número de lote -->
                @if(request()->session()->get('business.enable_lot_number') == 1)
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="lot_number">{{ __('lang_v1.lot_number') }}:</label>
                            <input type="text" name="lot_number" id="lot_number" class="form-control" value="{{ $purchase_line->lot_number }}">
                        </div>
                    </div>
                @endif

                <!-- Fecha de expiración -->
                @if(session('business.enable_product_expiry'))
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exp_date">{{ __('product.exp_date') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="exp_date" id="exp_date" class="form-control" value="{{ !empty($purchase_line->exp_date) ? @format_date($purchase_line->exp_date) : '' }}" readonly>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Unidades desperdiciadas -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mfg_wasted_units">{{ __('manufacturing::lang.waste_units') }}:</label>
                        <div class="input-group">
                            <input type="text" name="mfg_wasted_units" id="mfg_wasted_units" class="form-control input_number" value="{{ @num_format($production_purchase->mfg_wasted_units) }}">
                            <span class="input-group-addon">{{ $unit_name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Costo de producción -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="production_cost">{{ __('manufacturing::lang.production_cost') }}:</label>
                        <div class="input_inline">
                            <input type="text" name="production_cost" id="production_cost" class="form-control input_number" value="{{ @num_format($production_purchase->mfg_production_cost) }}">
                            <select name="mfg_production_cost_type" class="form-control">
                                <option value="fixed" {{ $production_purchase->mfg_production_cost_type == 'fixed' ? 'selected' : '' }}>{{ __('lang_v1.fixed') }}</option>
                                <option value="percentage" {{ $production_purchase->mfg_production_cost_type == 'percentage' ? 'selected' : '' }}>{{ __('lang_v1.percentage') }}</option>
                                <option value="per_unit" {{ $production_purchase->mfg_production_cost_type == 'per_unit' ? 'selected' : '' }}>{{ __('manufacturing::lang.per_unit') }}</option>
                            </select>
                        </div>
                        <p>
                            <strong>{{ __('manufacturing::lang.total_production_cost') }}:</strong>
                            <span id="total_production_cost" class="display_currency" data-currency_symbol="true">{{ $total_production_cost }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Costo total -->
            <div class="row">
                <div class="col-md-3 col-md-offset-9">
                    <input type="hidden" name="final_total" id="final_total" value="{{ @num_format($production_purchase->final_total) }}">
                    <strong>{{ __('manufacturing::lang.total_cost') }}:</strong>
                    <span id="final_total_text" class="display_currency" data-currency_symbol="true">{{ $production_purchase->final_total }}</span>
                </div>
            </div>

            <!-- Checkbox para finalizar la producción -->
            <div class="row">
                <div class="col-md-3 col-md-offset-9">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="finalize" id="finalize" value="1"> {{ __('manufacturing::lang.finalize') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">{{ __('messages.submit') }}</button>
                </div>
            </div>
        @endcomponent

    </form>
</section>

@endsection

@section('javascript')
	@include('manufacturing::production.production_script')

	<script type="text/javascript">
		$(document).ready( function () {
			calculateRecipeTotal();
		});
	</script>
@endsection
