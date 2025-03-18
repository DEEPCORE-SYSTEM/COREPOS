@extends('layouts.app')

@section('title', __('repair::lang.edit_repair'))
@section('content')
<style type="text/css">
	.krajee-default.file-preview-frame .kv-file-content {
		height: 65px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>@lang('repair::lang.edit_repair') <small>(@lang('repair::lang.repair_no'): <span class="text-success">#{{$transaction->invoice_no}})</span></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
	@if(session('business.enable_rp') == 1)
	<input type="hidden" id="reward_point_enabled">
	@endif
	<form action="{{ action('SellPosController@update', ['id' => $transaction->id]) }}"
		method="POST"
		id="edit_sell_form"
		enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<input type="hidden" name="location_id" id="location_id" value="{{ $transaction->location_id }}"
			data-receipt_printer_type="{{ $location_printer_type ?? 'browser' }}">

		<input type="hidden" name="has_module_data" value="true">
		<input type="hidden" name="status" value="final">
		<input type="hidden" name="sub_type" value="repair">

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<!--SECCIÓN DE WIDGET-->
				@component('components.widget')

				<!--SECCIÓN: CLIENTE Y FECHA-->
				<div class="{{ !empty($commission_agent) ? 'col-sm-3' : 'col-sm-4' }}">
					<div class="form-group">
						<label for="contact_id">{{ __('contact.customer') }}:*</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="hidden" id="default_customer_id" value="{{ $transaction->contact->id }}">
							<input type="hidden" id="default_customer_name" value="{{ $transaction->contact->name }}">
							<select name="contact_id" id="customer_id" class="form-control mousetrap" required>
								<option value="">{{ __('messages.please_select') }}</option>
							</select>
							<span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat add_new_customer">
									<i class="fa fa-plus-circle text-primary fa-lg"></i>
								</button>
							</span>
						</div>
					</div>
				</div>

				<!-- Fecha de transacción -->
				<div class="{{ !empty($commission_agent) ? 'col-sm-3' : 'col-sm-4' }}">
					<div class="form-group">
						<label for="transaction_date">{{ __('repair::lang.repair_added_on') }}:*</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="text" name="transaction_date" value="{{ $transaction->transaction_date }}" class="form-control" readonly required>
						</div>
					</div>
				</div>

				<!-- Fecha de finalización de reparación -->
				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_completed_on">{{ __('repair::lang.repair_completed_on') }}:*</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="text" name="repair_completed_on" value="{{ $transaction->repair_completed_on }}" class="form-control" readonly required>
						</div>
					</div>
				</div>

				<!-- 
					|--------------------------------------------------------------------------
					| SECCIÓN: DATOS DEL REPARO
					|--------------------------------------------------------------------------
					-->
				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_status_id">{{ __('repair::lang.repair_status') }}:*</label>
						<select name="repair_status_id" class="form-control" id="repair_status_id"></select>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_brand_id">{{ __('repair::lang.manufacturer') }}:</label>
						<select name="repair_brand_id" class="form-control select2">
							<option value="">{{ __('messages.please_select') }}</option>
							@foreach ($brands as $id => $name)
							<option value="{{ $id }}" {{ $transaction->repair_brand_id == $id ? 'selected' : '' }}>
								{{ $name }}
							</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_model">{{ __('repair::lang.model') }}:</label>
						<input type="text" name="repair_model" value="{{ $transaction->repair_model }}" class="form-control" placeholder="{{ __('repair::lang.model') }}">
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_serial_no">{{ __('repair::lang.serial_no') }}:</label>
						<input type="text" name="repair_serial_no" value="{{ $transaction->repair_serial_no }}" class="form-control" placeholder="{{ __('repair::lang.serial_no') }}">
					</div>
				</div>

				<!-- 
					|--------------------------------------------------------------------------
					| SECCIÓN: ASIGNACIÓN Y NOTIFICACIONES
					|--------------------------------------------------------------------------
					-->
				@if(in_array('service_staff', $enabled_modules))
				<div class="col-sm-4">
					<div class="form-group">
						<label for="res_waiter_id">{{ __('repair::lang.assign_repair_to') }}:</label>
						<select name="res_waiter_id" class="form-control select2">
							<option value="">{{ __('messages.please_select') }}</option>
							@foreach ($waiters as $id => $name)
							<option value="{{ $id }}" {{ $transaction->res_waiter_id == $id ? 'selected' : '' }}>
								{{ $name }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				@endif

				<!-- Notificación por correo -->
				<div class="col-sm-4">
					<br>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="repair_updates_email" value="1" {{ !empty($transaction->repair_updates_email) ? 'checked' : '' }}>
							{{ __('repair::lang.auto_send_notification') }} (Email)
						</label>
					</div>
				</div>

				<!-- Notificación por SMS -->
				<div class="col-sm-4">
					<br>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="repair_updates_sms" value="1" {{ !empty($transaction->repair_updates_sms) ? 'checked' : '' }}>
							{{ __('repair::lang.auto_send_notification') }} (SMS)
						</label>
					</div>
				</div>

				<!-- 
					|--------------------------------------------------------------------------
					| SECCIÓN: BOTONES DE ACCIÓN
					|--------------------------------------------------------------------------
					-->
				<div class="clearfix"></div>

				<!-- Botón para checklist -->
				<div class="col-sm-2">
					<div class="form-group">
						<br>
						<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#checklist_modal">
							<i class="fa fa-plus"></i> {{ __('repair::lang.pre_repair_checklist') }}
						</button>
					</div>
				</div>

				<!-- Botón para seguridad -->
				<div class="col-sm-2">
					<div class="form-group">
						<br>
						<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#security_modal">
							<i class="fa fa-lock"></i> {{ __('repair::lang.security') }}
						</button>
					</div>
				</div>

				<div class="clearfix"></div>

				<!-- 
					|--------------------------------------------------------------------------
					| SECCIÓN: DOCUMENTOS ADJUNTOS
					|--------------------------------------------------------------------------
					-->
				<div class="col-md-12">
					<div class="form-group">
						<label for="documents">{{ __('lang_v1.upload_documents') }}:</label>
						<input type="file" name="documents[]" multiple id="documents">
					</div>
				</div>

				<!-- Modales -->
				@include('repair::repair.partials.security_modal')
				@include('repair::repair.partials.checklist_modal')

				@endcomponent


				@component('components.widget')
				<!-- Defectos reportados por el cliente -->
				<div class="col-sm-6">
					<div class="form-group">
						<label for="repair_defects">{{ __('repair::lang.defect') }}:</label>
						<textarea name="repair_defects" class="form-control" rows="3">{{ $transaction->repair_defects }}</textarea>
					</div>
				</div>

				<!-- Notas del técnico y problemas detectados -->
				<div class="col-sm-6">
					<div class="form-group">
						<label for="staff_note">{{ __('repair::lang.noted_problems_n_technician_comments') }}:</label>
						<textarea name="staff_note" class="form-control" rows="3">{{ $transaction->staff_note }}</textarea>
					</div>
				</div>

				@endcomponent

				@component('components.widget')
				<!-- Campo de búsqueda de productos -->
				<div class="col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-barcode"></i>
							</span>
							<input type="text" name="search_product" id="search_product" class="form-control mousetrap"
								placeholder="{{ __('lang_v1.search_product_placeholder') }}" autofocus>
						</div>
					</div>
				</div>

				<!-- Sección de productos en la venta -->
				<div class="row col-sm-12 pos_product_div" style="min-height: 0">

					<!-- Configuración de impuestos y contador de productos -->
					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{ $business_details->sell_price_tax }}">
					<input type="hidden" id="product_row_count" value="{{ count($sell_details) }}">

					@php
					$hide_tax = session()->get('business.enable_inline_tax') == 0 ? 'hide' : '';
					@endphp

					<!-- Tabla de productos agregados a la venta -->
					<div class="table-responsive">
						<table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
							<thead>
								<tr>
									<th class="text-center">@lang('sale.product')</th>
									<th class="text-center">@lang('sale.qty')</th>

									@if(!empty($pos_settings['inline_service_staff']) && in_array('service_staff', $enabled_modules))
									<th class="text-center col-md-2">@lang('restaurant.service_staff')</th>
									@endif

									<th class="text-center {{ $hide_tax }}">@lang('sale.price_inc_tax')</th>
									<th class="text-center">@lang('sale.subtotal')</th>
									<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach($sell_details as $sell_line)
								@include('sale_pos.product_row', [
								'product' => $sell_line,
								'row_count' => $loop->index,
								'tax_dropdown' => $taxes,
								'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : []
								])
								@endforeach
							</tbody>
						</table>
					</div>

					<!-- Total de la venta -->
					<div class="table-responsive">
						<table class="table table-condensed table-bordered table-striped table-responsive">
							<tr>
								<td>
									<div class="pull-right">
										<b>@lang('sale.total'): </b>
										<span class="price_total">0</span>
									</div>
								</td>
							</tr>
						</table>
					</div>

				</div>

				@endcomponent

				@component('components.widget')
				<!-- Selección del tipo de descuento -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="discount_type">@lang('sale.discount_type') *</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<select name="discount_type" id="discount_type" class="form-control" required data-default="percentage">
								<option value="fixed" {{ $transaction->discount_type == 'fixed' ? 'selected' : '' }}>@lang('lang_v1.fixed')</option>
								<option value="percentage" {{ $transaction->discount_type == 'percentage' ? 'selected' : '' }}>@lang('lang_v1.percentage')</option>
							</select>
						</div>
					</div>
				</div>

				<!-- Monto del descuento -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="discount_amount">@lang('sale.discount_amount') *</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<input type="text" name="discount_amount" id="discount_amount" class="form-control input_number"
								value="{{ num_format($transaction->discount_amount) }}"
								data-default="{{ $business_details->default_sales_discount }}">
						</div>
					</div>
				</div>

				<!-- Descuento aplicado -->
				<div class="col-md-4"><br>
					<b>@lang('sale.discount_amount'):</b> (-)
					<span class="display_currency" id="total_discount">0</span>
				</div>

				<div class="clearfix"></div>

				<!-- Puntos de recompensa -->
				<div class="col-md-12 well well-sm bg-light-gray @if(session('business.enable_rp') != 1) hide @endif">
					<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="{{ $transaction->rp_redeemed }}">
					<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="{{ $transaction->rp_redeemed_amount }}">

					<div class="col-md-12">
						<h4>{{ session('business.rp_name') }}</h4>
					</div>

					<!-- Ingreso de puntos a redimir -->
					<div class="col-md-4">
						<div class="form-group">
							<label for="rp_redeemed_modal">@lang('lang_v1.redeemed')</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-gift"></i>
								</span>
								<input type="number" name="rp_redeemed_modal" id="rp_redeemed_modal" class="form-control direct_sell_rp_input"
									value="{{ $transaction->rp_redeemed }}" min="0"
									data-amount_per_unit_point="{{ session('business.redeem_amount_per_unit_rp') }}"
									data-max_points="{{ $redeem_details['points'] ?? 0 }}"
									data-min_order_total="{{ session('business.min_order_total_for_redeem') }}">
								<input type="hidden" id="rp_name" value="{{ session('business.rp_name') }}">
							</div>
						</div>
					</div>

					<!-- Puntos disponibles -->
					<div class="col-md-4">
						<p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">{{ $redeem_details['points'] ?? 0 }}</span></p>
					</div>

					<!-- Monto redimido -->
					<div class="col-md-4">
						<p><strong>@lang('lang_v1.redeemed_amount'):</strong> (-)
							<span id="rp_redeemed_amount_text">{{ num_format($transaction->rp_redeemed_amount) }}</span>
						</p>
					</div>
				</div>

				<!-- Impuesto sobre la venta -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="tax_rate_id">@lang('sale.order_tax') *</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<select name="tax_rate_id" id="tax_rate_id" class="form-control" data-default="{{ $business_details->default_sales_tax }}">
								<option value="">@lang('messages.please_select')</option>
								@foreach($taxes['tax_rates'] as $id => $rate)
								<option value="{{ $id }}" {{ $transaction->tax_id == $id ? 'selected' : '' }}>
									{{ $rate }}
								</option>
								@endforeach
							</select>
							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount"
								value="{{ num_format(optional($transaction->tax)->amount) }}"
								data-default="{{ $business_details->tax_calculation_amount }}">
						</div>
					</div>
				</div>

				<!-- Monto de impuestos -->
				<div class="col-md-4 col-md-offset-4">
					<b>@lang('sale.order_tax'):</b> (+)
					<span class="display_currency" id="order_tax">{{ $transaction->tax_amount }}</span>
				</div>

				<div class="clearfix"></div>

				<!-- Detalles del envío -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="shipping_details">@lang('sale.shipping_details')</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<textarea name="shipping_details" id="shipping_details" class="form-control" rows="1"
								placeholder="@lang('sale.shipping_details')">{{ $transaction->shipping_details }}</textarea>
						</div>
					</div>
				</div>

				<!-- Cargos por envío -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="shipping_charges">@lang('sale.shipping_charges')</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<input type="text" name="shipping_charges" id="shipping_charges" class="form-control input_number"
								placeholder="@lang('sale.shipping_charges')" value="{{ num_format($transaction->shipping_charges) }}">
						</div>
					</div>
				</div>

				<!-- Total a pagar -->
				<div class="col-md-4 col-md-offset-8">
					<div>
						<b>@lang('sale.total_payable'):</b>
						<input type="hidden" name="final_total" id="final_total_input">
						<span id="total_payable">0</span>
					</div>
				</div>

				<!-- Nota de actualización -->
				<div class="col-md-12">
					<div class="form-group">
						<label for="update_note">@lang('repair::lang.update_note')</label>
						<textarea name="update_note" id="update_note" class="form-control" rows="3"></textarea>
					</div>
				</div>

				<!-- Botón de actualización -->
				<input type="hidden" name="is_direct_sale" value="1">
				<div class="col-md-12">
					<button type="button" class="btn btn-primary pull-right" id="submit-sell">@lang('messages.update')</button>
				</div>

				@endcomponent

			</div>
		</div>
		@if(in_array('subscription', $enabled_modules))
		@include('sale_pos.partials.recurring_invoice_modal')
		@endif
	</form>
</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog"
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog"
	aria-labelledby="gridSystemModalLabel">
</div>

@stop

@section('javascript')
<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
@include('repair::layouts.partials.javascripts')
<script type="text/javascript">
	$(document).ready(function() {
		// lock.setPattern('{{$transaction->repair_security_pattern}}');

		@include('repair::repair.partials.repair_status')

		$("select#repair_status_id").val({
			{
				$transaction - > repair_status_id
			}
		}).change();
	});
</script>
@endsection