<!-- Modal para editar información del producto -->
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<!-- Encabezado del modal -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">{{$product->product_name}} - {{$product->sub_sku}}</h4>
		</div>
		<!-- Cuerpo del modal -->
		<div class="modal-body">
			<div class="row">
				<!-- Campo para editar el precio unitario del producto -->
				<div class="form-group col-xs-12 @if(!auth()->user()->can('edit_product_price_from_sale_screen')) hide @endif">
					@php
						$pos_unit_price = !empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price;
					@endphp
					<label>@lang('sale.unit_price')</label>
					<input type="text" name="products[{{$row_count}}][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="{{@num_format($pos_unit_price)}}" @if(!empty($pos_settings['enable_msp'])) data-rule-min-value="{{$pos_unit_price}}" data-msg-min-value="{{__('lang_v1.minimum_selling_price_error_msg', ['price' => @num_format($pos_unit_price)])}}" @endif>
				</div>
				<!-- Mostrar el precio unitario si no se puede editar -->
				@if(!auth()->user()->can('edit_product_price_from_sale_screen'))
					<div class="form-group col-xs-12">
						<strong>@lang('sale.unit_price'):</strong> {{@num_format($pos_unit_price)}}
					</div>
				@endif
				<!-- Selección del tipo de descuento -->
				<div class="form-group col-xs-12 col-sm-6 @if(!$edit_discount) hide @endif">
					<label>@lang('sale.discount_type')</label>
					<select name="products[{{$row_count}}][line_discount_type]" class="form-control row_discount_type">
						<option value="fixed" @if($discount_type == 'fixed') selected @endif>@lang('lang_v1.fixed')</option>
						<option value="percentage" @if($discount_type == 'percentage') selected @endif>@lang('lang_v1.percentage')</option>
					</select>
				</div>
				<!-- Campo para ingresar el monto del descuento -->
				<div class="form-group col-xs-12 col-sm-6 @if(!$edit_discount) hide @endif">
					<label>@lang('sale.discount_amount')</label>
					<input type="text" name="products[{{$row_count}}][line_discount_amount]" class="form-control input_number row_discount_amount" value="{{@num_format($discount_amount)}}">
				</div>
				<!-- Mensaje de descuento aplicado si existe -->
				@if(!empty($discount))
					<div class="form-group col-xs-12">
						<p class="help-block">{!! __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]) !!}</p>
					</div>
				@endif
				<!-- Selección de impuesto aplicado -->
				<div class="form-group col-xs-12 {{$hide_tax}}">
					<label>@lang('sale.tax')</label>
					<input type="hidden" name="products[{{$row_count}}][item_tax]" class="item_tax" value="{{@num_format($item_tax)}}">
					<select name="products[{{$row_count}}][tax_id]" class="form-control tax_id">
						<option value="">Select</option>
						@foreach($tax_dropdown['tax_rates'] as $key => $value)
							<option value="{{$key}}" @if($tax_id == $key) selected @endif>{{$value}}</option>
						@endforeach
					</select>
				</div>
				<!-- Selección de garantía si está disponible -->
				@if(!empty($warranties))
					<div class="form-group col-xs-12">
						<label>@lang('lang_v1.warranty')</label>
						<select name="products[{{$row_count}}][warranty_id]" class="form-control">
							<option value="">@lang('messages.please_select')</option>
							@foreach($warranties as $key => $value)
								<option value="{{$key}}" @if($warranty_id == $key) selected @endif>{{$value}}</option>
							@endforeach
						</select>
					</div>
				@endif
				<!-- Campo para agregar una descripción adicional -->
				<div class="form-group col-xs-12">
					<label>@lang('lang_v1.description')</label>
					<textarea class="form-control" name="products[{{$row_count}}][sell_line_note]" rows="3">{{$sell_line_note}}</textarea>
					<p class="help-block">@lang('lang_v1.sell_line_description_help')</p>
				</div>
			</div>
		</div>
		<!-- Pie del modal con botón de cierre -->
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	</div>
</div>
