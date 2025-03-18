<!-- Sección de configuración de ventas -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Descuento por defecto en ventas -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="default_sales_discount">{{ __('business.default_sales_discount') }}:*</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-percent"></i>
                    </span>
                    <input type="text" 
                           name="default_sales_discount" 
                           id="default_sales_discount" 
                           class="form-control input_number" 
                           value="{{ @num_format($business->default_sales_discount) }}">
                </div>
            </div>
        </div>

        <!-- Impuesto por defecto en ventas -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="default_sales_tax">{{ __('business.default_sales_tax') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <select name="default_sales_tax" 
                            id="default_sales_tax" 
                            class="form-control select2" 
                            style="width: 100%;"
                            placeholder="{{ __('business.default_sales_tax') }}">
                        @foreach($tax_rates as $key => $value)
                            <option value="{{ $key }}" {{ $business->default_sales_tax == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Agente de comisión de ventas -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="sales_cmsn_agnt">{{ __('lang_v1.sales_commission_agent') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <select name="sales_cmsn_agnt" 
                            id="sales_cmsn_agnt" 
                            class="form-control select2" 
                            style="width: 100%;">
                        @foreach($commission_agent_dropdown as $key => $value)
                            <option value="{{ $key }}" {{ $business->sales_cmsn_agnt == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Tipo de cálculo de comisión -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="cmmsn_calculation_type">{{ __('lang_v1.cmmsn_calculation_type') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <select name="pos_settings[cmmsn_calculation_type]" 
                            id="cmmsn_calculation_type" 
                            class="form-control select2" 
                            style="width: 100%;">
                        <option value="invoice_value" {{ !empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] == 'invoice_value' ? 'selected' : '' }}>
                            {{ __('lang_v1.invoice_value') }}
                        </option>
                        <option value="payment_received" {{ !empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] == 'payment_received' ? 'selected' : '' }}>
                            {{ __('lang_v1.payment_received') }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Método de adición de items -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="item_addition_method">{{ __('lang_v1.sales_item_addition_method') }}:</label>
                <select name="item_addition_method" 
                        id="item_addition_method" 
                        class="form-control select2" 
                        style="width: 100%;">
                    <option value="0" {{ $business->item_addition_method == 0 ? 'selected' : '' }}>
                        {{ __('lang_v1.add_item_in_new_row') }}
                    </option>
                    <option value="1" {{ $business->item_addition_method == 1 ? 'selected' : '' }}>
                        {{ __('lang_v1.increase_item_qty') }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Método de redondeo de montos -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="amount_rounding_method">{{ __('lang_v1.amount_rounding_method') }}:</label>
                @show_tooltip(__('lang_v1.amount_rounding_method_help'))
                <select name="pos_settings[amount_rounding_method]" 
                        id="amount_rounding_method" 
                        class="form-control select2" 
                        style="width: 100%;"
                        placeholder="{{ __('lang_v1.none') }}">
                    <option value="1" {{ !empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] == '1' ? 'selected' : '' }}>
                        {{ __('lang_v1.round_to_nearest_whole_number') }}
                    </option>
                    <option value="0.05" {{ !empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] == '0.05' ? 'selected' : '' }}>
                        {{ __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.05]) }}
                    </option>
                    <option value="0.1" {{ !empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] == '0.1' ? 'selected' : '' }}>
                        {{ __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.1]) }}
                    </option>
                    <option value="0.5" {{ !empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] == '0.5' ? 'selected' : '' }}>
                        {{ __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.5]) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Precio mínimo de venta -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[enable_msp]" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['enable_msp']) ? 'checked' : '' }}>
                        {{ __('lang_v1.sale_price_is_minimum_sale_price') }}
                    </label>
                    @show_tooltip(__('lang_v1.minimum_sale_price_help'))
                </div>
            </div>
        </div>

        <!-- Permitir sobreventa -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[allow_overselling]" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['allow_overselling']) ? 'checked' : '' }}>
                        {{ __('lang_v1.allow_overselling') }}
                    </label>
                    @show_tooltip(__('lang_v1.allow_overselling_help'))
                </div>
            </div>
        </div>

        <!-- Habilitar órdenes de venta -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[enable_sales_order]" 
                               id="enable_sales_order" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['enable_sales_order']) ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_sales_order') }}
                    </label>
                    @show_tooltip(__('lang_v1.sales_order_help_text'))
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Enlaces de pago -->
        <div class="col-md-12">
            <h4>@lang('lang_v1.payment_link') @show_tooltip(__('lang_v1.payment_link_help_text')):</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[enable_payment_link]" 
                               id="enable_payment_link" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['enable_payment_link']) ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_payment_link') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Configuración de Razorpay -->
        <div class="col-md-12">
            <h4>Razorpay: <small>(For INR India)</small></h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="razor_pay_key_id">Key ID:</label>
                <input type="text" 
                       name="pos_settings[razor_pay_key_id]" 
                       id="razor_pay_key_id" 
                       class="form-control" 
                       value="{{ $pos_settings['razor_pay_key_id'] ?? '' }}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="razor_pay_key_secret">Key Secret:</label>
                <input type="text" 
                       name="pos_settings[razor_pay_key_secret]" 
                       id="razor_pay_key_secret" 
                       class="form-control" 
                       value="{{ $pos_settings['razor_pay_key_secret'] ?? '' }}">
            </div>
        </div>

        <!-- Configuración de Stripe -->
        <div class="col-md-12">
            <h4>Stripe:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="stripe_public_key">{{ __('lang_v1.stripe_public_key') }}:</label>
                <input type="text" 
                       name="pos_settings[stripe_public_key]" 
                       id="stripe_public_key" 
                       class="form-control" 
                       value="{{ $pos_settings['stripe_public_key'] ?? '' }}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="stripe_secret_key">{{ __('lang_v1.stripe_secret_key') }}:</label>
                <input type="text" 
                       name="pos_settings[stripe_secret_key]" 
                       id="stripe_secret_key" 
                       class="form-control" 
                       value="{{ $pos_settings['stripe_secret_key'] ?? '' }}">
            </div>
        </div>
    </div>
</div>