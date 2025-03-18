@extends('layouts.app')

@section('title', __('repair::lang.add_repair'))

@section('content')
<style type="text/css">
	.krajee-default.file-preview-frame .kv-file-content {
		height: 65px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('repair::lang.add_repair')</h1>
</section>
<!-- Main content -->
<section class="content no-print">
@if(is_null($default_location))
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <div class="input-group">
                <!-- Icono de ubicación dentro del input -->
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>

                <!-- Select de ubicaciones -->
                <select class="form-control input-sm" 
                        id="select_location_id" 
                        name="select_location_id" 
                        required autofocus>
                    <option value="">{{ __('lang_v1.select_location') }}</option>
                    @foreach ($business_locations as $key => $location)
                        <option value="{{ $key }}" @selected(old('select_location_id') == $key)>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>

                <!-- Tooltip de ayuda -->
                <span class="input-group-addon">
                    @show_tooltip(__('tooltip.sale_location'))
                </span>
            </div>
        </div>
    </div>
</div>

@endif
<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">

@if(!empty($repair_settings['default_product']))
 	<input type="hidden" id="default_product" value="{{$repair_settings['default_product']}}">
@endif
@if(session('business.enable_rp') == 1)
    <input type="hidden" id="reward_point_enabled">
@endif

<!-- Formulario para almacenar ventas -->
<form action="{{ action('SellPosController@store') }}" 
      method="POST" 
      id="add_sell_form" 
      enctype="multipart/form-data">

    @csrf <!-- Token de seguridad para evitar ataques CSRF -->

    <!-- Campos ocultos para enviar información adicional -->
    <input type="hidden" name="status" value="final">
    <input type="hidden" name="sub_type" value="repair">
    <input type="hidden" name="has_module_data" value="true">

	<div class="row">
		<div class="col-md-12 col-sm-12">
			@component('components.widget')
			<input type="hidden" name="location_id" id="location_id" 
				value="{{ $default_location }}" 
				data-receipt_printer_type="{{ $bl_attributes[$default_location]['data-receipt_printer_type'] ?? 'browser' }}">

				<div class="clearfix"></div>

				<div class="col-sm-4">
					<div class="form-group">
						<!-- Etiqueta para seleccionar cliente -->
						<label for="contact_id">{{ __('contact.customer') }}:*</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>

							<!-- Campos ocultos para el cliente por defecto -->
							<input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id'] }}">
							<input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name'] }}">

							<!-- Select para elegir cliente -->
							<select name="contact_id" id="customer_id" class="form-control mousetrap" required>
								<option value="">{{ __('Enter Customer name / phone') }}</option>
							</select>

							<!-- Botón para agregar nuevo cliente -->
							<span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name="">
									<i class="fa fa-plus-circle text-primary fa-lg"></i>
								</button>
							</span>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<!-- Etiqueta para la fecha de transacción -->
						<label for="transaction_date">{{ __('repair::lang.repair_added_on') }}:*</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>

							<!-- Campo de texto para la fecha de transacción (solo lectura) -->
							<input type="text" name="transaction_date" id="transaction_date" class="form-control" value="{{ $default_datetime }}" readonly required>
						</div>
					</div>
				</div>


				<div class="col-sm-4">
    <div class="form-group">
        <!-- Etiqueta para la fecha de finalización de la reparación -->
        <label for="repair_completed_on">{{ __('repair::lang.repair_completed_on') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>

            <!-- Campo de texto para la fecha de finalización de la reparación (solo lectura) -->
            <input type="text" name="repair_completed_on" id="repair_completed_on" 
                   class="form-control" value="{{ $default_datetime }}" readonly required>
        </div>
    </div>
</div>


				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_status_id">{{__('repair::lang.repair_status') . ':*'}}</label>
						<select name="repair_status_id" class="form-control" id="repair_status_id" required></select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<!-- Etiqueta para seleccionar el fabricante -->
						<label for="repair_brand_id">{{ __('repair::lang.manufacturer') }}:</label>

						<!-- Select para elegir la marca del producto -->
						<select name="repair_brand_id" id="repair_brand_id" class="form-control select2">
							<option value="">{{ __('messages.please_select') }}</option>
							@foreach ($brands as $key => $brand)
								<option value="{{ $key }}" @selected(old('repair_brand_id') == $key)>
									{{ $brand }}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						<!-- Etiqueta para el modelo del producto -->
						<label for="repair_model">{{ __('repair::lang.model') }}:</label>

						<!-- Campo de texto para ingresar el modelo -->
						<input type="text" name="repair_model" id="repair_model" 
							class="form-control" placeholder="{{ __('repair::lang.model') }}">
					</div>
				</div>


				<div class="col-sm-4">
    <div class="form-group">
        <!-- Etiqueta para el número de serie del producto -->
        <label for="repair_serial_no">{{ __('repair::lang.serial_no') }}:</label>

        <!-- Campo de texto para ingresar el número de serie -->
        <input type="text" name="repair_serial_no" id="repair_serial_no" 
               class="form-control" placeholder="{{ __('repair::lang.serial_no') }}">
    </div>
</div>

				@if(in_array('service_staff' ,$enabled_modules))
				<div class="col-sm-4">
					<div class="form-group">
						<!-- Etiqueta para asignar la reparación a un técnico o empleado -->
						<label for="res_waiter_id">{{ __('repair::lang.assign_repair_to') }}:</label>

						<!-- Select para elegir a quién asignar la reparación -->
						<select name="res_waiter_id" id="res_waiter_id" class="form-control select2">
							<option value="">{{ __('messages.please_select') }}</option>
							@foreach ($service_staff as $key => $staff)
								<option value="{{ $key }}" @selected(old('res_waiter_id') == $key)>
									{{ $staff }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				@endif
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<br>
					<div class="checkbox">
					<label for="repair_updates_email">
						<!-- Checkbox para activar/desactivar notificaciones automáticas por correo -->
						<input type="checkbox" name="repair_updates_email" id="repair_updates_email" 
							class="input-icheck" value="1">
						{{ __('repair::lang.auto_send_notification') }} (Email)
					</label>

					<!-- Tooltip con información adicional -->
					{!! show_tooltip(__('repair::lang.auto_send_email_tooltip')) !!}
				</div>

				</div>
				<div class="col-sm-4">
					<br>
					<div class="checkbox">
						<label for="repair_updates_sms">
							<!-- Checkbox para activar/desactivar notificaciones automáticas por SMS -->
							<input type="checkbox" name="repair_updates_sms" id="repair_updates_sms" 
								class="input-icheck" value="1">
							{{ __('repair::lang.auto_send_notification') }} (SMS)
						</label>

						<!-- Tooltip con información adicional -->
						{!! show_tooltip(__('repair::lang.auto_send_sms_tooltip')) !!}
					</div>

				</div>
				<div class="clearfix"></div>
				<div class="col-sm-2">
					<div class="form-group">
					<br>
						<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#checklist_modal"><i class="fa fa-plus"></i> @lang('repair::lang.pre_repair_checklist')</button>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<br>
						<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#security_modal"><i class="fa fa-lock"></i> @lang('repair::lang.security')</button>
					</div>
				</div>
				<div class="clearfix"></div>
			    <div class="col-md-12">
				<div class="form-group">
					<!-- Etiqueta para la subida de documentos -->
					<label for="documents">{{ __('lang_v1.upload_documents') }}:</label>

					<!-- Input de tipo archivo para subir múltiples documentos -->
					<input type="file" name="documents[]" id="documents" multiple>
				</div>

			    </div>
				@include('repair::repair.partials.security_modal')
				@include('repair::repair.partials.checklist_modal')
			@endcomponent

			@component('components.widget')
			<div class="col-sm-6">
				<div class="form-group">
					<!-- Etiqueta para los defectos del equipo -->
					<label for="repair_defects">{{ __('repair::lang.defect') }}:</label>

					<!-- Área de texto para ingresar los defectos reportados -->
					<textarea name="repair_defects" id="repair_defects" class="form-control" rows="3"></textarea>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<!-- Etiqueta para notas del técnico -->
					<label for="staff_note">{{ __('repair::lang.noted_problems_n_technician_comments') }}:</label>

					<!-- Área de texto para comentarios del técnico sobre la reparación -->
					<textarea name="staff_note" id="staff_note" class="form-control" rows="3"></textarea>
				</div>
			</div>

			@endcomponent

			@component('components.widget')
			<div class="col-sm-10 col-sm-offset-1">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-barcode"></i>
						</span>

						<!-- Campo de búsqueda para agregar partes usadas en la reparación -->
						<input type="text" name="search_product" id="search_product" 
							class="form-control mousetrap"
							placeholder="{{ __('repair::lang.add_parts_used_in_repair') }}"
							{{ is_null($default_location) ? 'disabled' : '' }}
							{{ is_null($default_location) ? '' : 'autofocus' }}>
					</div>
				</div>
			</div>


				<div class="row col-sm-12 pos_product_div" style="min-height: 0">

					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{$business_details->sell_price_tax}}">

					<!-- Keeps count of product rows -->
					<input type="hidden" id="product_row_count" 
						value="0">
					@php
						$hide_tax = '';
						if( session()->get('business.enable_inline_tax') == 0){
							$hide_tax = 'hide';
						}
					@endphp
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
						<thead>
							<tr>
								<th class="text-center">	
									@lang('sale.product')
								</th>
								<th class="text-center">
									@lang('sale.qty')
								</th>
								@if(!empty($pos_settings['inline_service_staff']) && in_array('service_staff' ,$enabled_modules))
									<th class="text-center col-md-2">
										@lang('restaurant.service_staff')
									</th>
								@endif
								<th class="text-center {{$hide_tax}}">
									@lang('sale.price_inc_tax')
								</th>
								<th class="text-center">
									@lang('sale.subtotal')
								</th>
								<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					</div>
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped">
						<tr>
							<td>
								<div class="pull-right"><b>@lang('sale.total'): </b>
									<span class="price_total">0</span>
								</div>
							</td>
						</tr>
					</table>
					</div>
				</div>
			@endcomponent

			@component('components.widget')
			<div class="col-md-4">
				<div class="form-group">
					<!-- Etiqueta para seleccionar el tipo de descuento -->
					<label for="discount_type">{{ __('sale.discount_type') }}:*</label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>

						<!-- Selección del tipo de descuento (fijo o porcentaje) -->
						<select name="discount_type" id="discount_type" class="form-control" required data-default="percentage">
							<option value="">{{ __('messages.please_select') }}</option>
							<option value="fixed">{{ __('lang_v1.fixed') }}</option>
							<option value="percentage" selected>{{ __('lang_v1.percentage') }}</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<!-- Etiqueta para el monto del descuento -->
					<label for="discount_amount">{{ __('sale.discount_amount') }}:*</label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>

						<!-- Campo de entrada para el monto del descuento -->
						<input type="text" name="discount_amount" id="discount_amount" 
							class="form-control input_number" 
							value="{{ num_format($business_details->default_sales_discount) }}" 
							data-default="{{ $business_details->default_sales_discount }}">
					</div>
				</div>
			</div>

			    <div class="col-md-4"><br>
			    	<b>@lang( 'sale.discount_amount' ):</b>(-) 
					<span class="display_currency" id="total_discount">0</span>
			    </div>
			    <div class="clearfix"></div>

				<div class="col-md-12 well well-sm bg-light-gray @if(session('business.enable_rp') != 1) hide @endif">
					<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="0">
					<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="0">

					<div class="col-md-12">
						<h4>{{ session('business.rp_name') }}</h4>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="rp_redeemed_modal">{{ __('lang_v1.redeemed') }}:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-gift"></i>
								</span>
								<input type="number" name="rp_redeemed_modal" id="rp_redeemed_modal"
									class="form-control direct_sell_rp_input"
									data-amount_per_unit_point="{{ session('business.redeem_amount_per_unit_rp') }}"
									min="0" data-max_points="0"
									data-min_order_total="{{ session('business.min_order_total_for_redeem') }}"
									value="0">
								<input type="hidden" id="rp_name" value="{{ session('business.rp_name') }}">
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">0</span></p>
					</div>

					<div class="col-md-4">
						<p><strong>@lang('lang_v1.redeemed_amount'):</strong> (-)<span id="rp_redeemed_amount_text">0</span></p>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="tax_rate_id">{{ __('sale.order_tax') }}:*</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<select name="tax_rate_id" id="tax_rate_id" class="form-control" data-default="{{ $business_details->default_sales_tax }}">
								<option value="">{{ __('messages.please_select') }}</option>
								@foreach($taxes['tax_rates'] as $key => $value)
									<option value="{{ $key }}" {{ $key == $business_details->default_sales_tax ? 'selected' : '' }}>
										{{ $value }}
									</option>
								@endforeach
							</select>
						</div>
						<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount"
							value="{{ empty($edit) ? num_format($business_details->tax_calculation_amount) : num_format(optional($transaction->tax)->amount) }}"
							data-default="{{ $business_details->tax_calculation_amount }}">
					</div>
				</div>

				<div class="col-md-4 col-md-offset-4">
					<b>@lang('sale.order_tax'):</b> (+) <span class="display_currency" id="order_tax">0</span>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="shipping_details">{{ __('sale.shipping_details') }}</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<textarea name="shipping_details" id="shipping_details" class="form-control" rows="1" placeholder="{{ __('sale.shipping_details') }}"></textarea>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="shipping_charges">{{ __('sale.shipping_charges') }}</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							<input type="text" name="shipping_charges" id="shipping_charges"
								class="form-control input_number"
								value="{{ num_format(0.00) }}"
								placeholder="{{ __('sale.shipping_charges') }}">
						</div>
					</div>
				</div>

			    <div class="clearfix"></div>
			    <div class="col-md-4 col-md-offset-8">
			    	<div><b>@lang('sale.total_payable'): </b>
						<input type="hidden" name="final_total" id="final_total_input">
						<span id="total_payable">0</span>
					</div>
			    </div>
				<input type="hidden" name="is_direct_sale" value="1">
				<input type="hidden" id="print_label" name="print_label" value="0">
				<div class="clearfix"></div>
				<div class="col-md-12">
					<button type="button" id="submit-sell" class="btn btn-primary pull-right btn-flat">@lang('messages.submit')</button>
					<button type="button" id="submit-n-print-label" class="btn btn-danger pull-right btn-flat" style="margin-right: 10px;">@lang('repair::lang.submit_n_print_label')</button>
				</div>
			@endcomponent

		</div>
	</div>
	
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
		$(document).ready( function() {
			@include('repair::repair.partials.repair_status')

			if($('input#default_product').length) {
				pos_product_row($('input#default_product').val());
			}

			$('#submit-n-print-label').click( function() {
				$('input#print_label').val(1);
				$("#submit-sell").trigger('click');
			});
		});
	</script>
@endsection
