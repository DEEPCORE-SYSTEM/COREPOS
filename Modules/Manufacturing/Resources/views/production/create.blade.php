@extends('layouts.app')
@section('title', __('manufacturing::lang.production'))

@section('content')
@include('manufacturing::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('manufacturing::lang.production') </h1>
</section>

	<!-- Main content -->
	@section('content')
	<section class="content">
		<form action="{{ action('\Modules\Manufacturing\Http\Controllers\ProductionController@store') }}" method="POST" id="production_form" enctype="multipart/form-data">
			@csrf
			<div class="box box-solid">
				<div class="row">
					<!-- Número de referencia -->
					<div class="col-sm-3">
						<div class="form-group">
							<label for="ref_no">@lang('purchase.ref_no'):</label>
							<input type="text" name="ref_no" id="ref_no" class="form-control">
						</div>
					</div>

					<!-- Fecha de fabricación -->
					<div class="col-sm-3">
						<div class="form-group">
							<label for="transaction_date">@lang('manufacturing::lang.mfg_date'):</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" name="transaction_date" id="transaction_date" class="form-control" value="{{ now() }}" readonly required>
							</div>
						</div>
					</div>

					<!-- Ubicación del negocio -->
					<div class="col-sm-3">
						<div class="form-group">
							<label for="location_id">@lang('purchase.business_location'):</label>
							<select name="location_id" id="location_id" class="form-control select2" required>
								<option value="">@lang('messages.please_select')</option>
								@foreach ($business_locations as $key => $location)
									<option value="{{ $key }}" {{ count($business_locations) == 1 ? 'selected' : '' }}>
										{{ $location }}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<!-- Producto a fabricar -->
					<div class="col-sm-3">
						<div class="form-group">
							<label for="variation_id">@lang('sale.product'):</label>
							<select name="variation_id" id="variation_id" class="form-control select2" required>
								<option value="">@lang('messages.please_select')</option>
								@foreach ($recipe_dropdown as $key => $recipe)
									<option value="{{ $key }}">{{ $recipe }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<!-- Cantidad a producir -->
					<div class="col-sm-3">
						<div class="form-group">
							<label for="recipe_quantity">@lang('lang_v1.quantity'):</label>
							<div class="input-group">
								<input type="text" name="quantity" id="recipe_quantity" class="form-control input_number" value="1" required>
								<span class="input-group-addon" id="unit_html"></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Ingredientes -->
			<div class="box box-solid">
				<div class="row">
					<div class="col-md-12">
						<div id="enter_ingredients_table" class="text-center">
							<i>@lang('manufacturing::lang.add_ingredients_tooltip')</i>
						</div>
					</div>
				</div>
				<br>

				<div class="row">
					@if(session('business.enable_lot_number'))
						<div class="col-sm-3">
							<div class="form-group">
								<label for="lot_number">@lang('lang_v1.lot_number'):</label>
								<input type="text" name="lot_number" id="lot_number" class="form-control">
							</div>
						</div>
					@endif

					@if(session('business.enable_product_expiry'))
						<div class="col-sm-3">
							<div class="form-group">
								<label for="exp_date">@lang('product.exp_date'):</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="exp_date" id="exp_date" class="form-control" readonly>
								</div>
							</div>
						</div>
					@endif

					<!-- Unidades de desperdicio -->
					<div class="col-md-3">
						<div class="form-group">
							<label for="mfg_wasted_units">@lang('manufacturing::lang.waste_units'):</label>
							<div class="input-group">
								<input type="text" name="mfg_wasted_units" id="mfg_wasted_units" class="form-control input_number" value="0">
								<span class="input-group-addon" id="wasted_units_text"></span>
							</div>
						</div>
					</div>

					<!-- Coste de producción -->
					<div class="col-md-3">
						<div class="form-group">
							<label for="production_cost">@lang('manufacturing::lang.production_cost'):</label>
							<div class="input-group">
								<input type="text" name="production_cost" id="production_cost" class="form-control input_number" value="0">
								<span>
									<select name="mfg_production_cost_type" id="mfg_production_cost_type" class="form-control">
										<option value="fixed">@lang('lang_v1.fixed')</option>
										<option value="percentage">@lang('lang_v1.percentage')</option>
										<option value="per_unit">@lang('manufacturing::lang.per_unit')</option>
									</select>
								</span>
							</div>
							<p><strong>@lang('manufacturing::lang.total_production_cost'):</strong>
							<span id="total_production_cost" class="display_currency" data-currency_symbol="true">0</span></p>
						</div>
					</div>
				</div>

				<!-- Costo total -->
				<div class="row">
					<div class="col-md-3 col-md-offset-9">
						<input type="hidden" name="final_total" id="final_total" value="0">
						<strong>@lang('manufacturing::lang.total_cost'):</strong>
						<span id="final_total_text" class="display_currency" data-currency_symbol="true">0</span>
					</div>
				</div>

				<!-- Finalizar producción -->
				<div class="row">
					<div class="col-md-3 col-md-offset-9">
						<div class="form-group">
							<br>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="finalize" id="finalize" value="1">
									@lang('manufacturing::lang.finalize')
								</label>
							</div>
						</div>
					</div>
				</div>

				<!-- Botón de envío -->
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary pull-right">@lang('messages.submit')</button>
					</div>
				</div>
			</div>
		</form>
	</section>



@endsection

@section('javascript')
	@include('manufacturing::production.production_script')
@endsection
