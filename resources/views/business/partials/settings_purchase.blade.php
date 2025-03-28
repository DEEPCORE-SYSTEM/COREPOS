<!-- Configuración relacionada con compras -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Validar si la compra en otra moneda está permitida -->
        @if(!config('constants.disable_purchase_in_other_currency', true))

            <!-- Permitir compras en diferente moneda -->
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="purchase_in_diff_currency" value="1"
                                {{ $business->purchase_in_diff_currency ? 'checked' : '' }} 
                                class="input-icheck" id="purchase_in_diff_currency">
                            {{ __('purchase.allow_purchase_different_currency') }}
                        </label>
                        @show_tooltip(__('tooltip.purchase_different_currency'))
                    </div>
                </div>
            </div>

            <!-- Selección de la moneda de compra -->
            <div class="col-sm-4 {{ $business->purchase_in_diff_currency != 1 ? 'hide' : '' }}" id="settings_purchase_currency_div">
                <div class="form-group">
                    <label for="purchase_currency_id">{{ __('purchase.purchase_currency') }}:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fas fa-money-bill-alt"></i>
                        </span>
                        <select name="purchase_currency_id" id="purchase_currency_id" class="form-control select2"
                            required style="width:100% !important">
                            <option value="">{{ __('business.currency') }}</option>
                            @foreach($currencies as $key => $currency)
                                <option value="{{ $key }}" {{ $business->purchase_currency_id == $key ? 'selected' : '' }}>
                                    {{ $currency }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tasa de cambio para compras en moneda extranjera -->
            <div class="col-sm-4 {{ $business->purchase_in_diff_currency != 1 ? 'hide' : '' }}" id="settings_currency_exchange_div">
                <div class="form-group">
                    <label for="p_exchange_rate">{{ __('purchase.p_exchange_rate') }}:</label>
                    @show_tooltip(__('tooltip.currency_exchange_factor'))
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        <input type="number" name="p_exchange_rate" id="p_exchange_rate"
                            class="form-control" placeholder="{{ __('business.p_exchange_rate') }}"
                            value="{{ $business->p_exchange_rate }}" required step="0.001">
                    </div>
                </div>
            </div>

        @endif

        <div class="clearfix"></div>

        <!-- Habilitar edición de productos desde la compra -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_editing_product_from_purchase" value="1"
                            {{ $business->enable_editing_product_from_purchase ? 'checked' : '' }} 
                            class="input-icheck">
                        {{ __('lang_v1.enable_editing_product_from_purchase') }}
                    </label>
                    @show_tooltip(__('lang_v1.enable_updating_product_price_tooltip'))
                </div>
            </div>
        </div>

        <!-- Habilitar estado de compra -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_purchase_status" value="1"
                            {{ $business->enable_purchase_status ? 'checked' : '' }} 
                            class="input-icheck" id="enable_purchase_status">
                        {{ __('lang_v1.enable_purchase_status') }}
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_enable_purchase_status'))
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Habilitar números de lote en productos -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_lot_number" value="1"
                            {{ $business->enable_lot_number ? 'checked' : '' }} 
                            class="input-icheck" id="enable_lot_number">
                        {{ __('lang_v1.enable_lot_number') }}
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_enable_lot_number'))
                </div>
            </div>
        </div>

        <!-- Habilitar órdenes de compra -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="common_settings[enable_purchase_order]" value="1"
                            {{ !empty($common_settings['enable_purchase_order']) ? 'checked' : '' }} 
                            class="input-icheck" id="enable_purchase_order">
                        {{ __('lang_v1.enable_purchase_order') }}
                    </label>
                    @show_tooltip(__('lang_v1.purchase_order_help_text'))
                </div>
            </div>
        </div>

    </div>
</div>
