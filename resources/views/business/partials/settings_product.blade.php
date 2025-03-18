<!-- Sección de configuración de productos -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Prefijo SKU -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="sku_prefix">{{ __('business.sku_prefix') }}:</label>
                <input type="text" name="sku_prefix" id="sku_prefix" class="form-control text-uppercase"
                    value="{{ $business->sku_prefix }}">
            </div>
        </div>

        <!-- Configuración de vencimiento de productos -->
        <div class="col-sm-4">
            <label for="enable_product_expiry">{{ __('product.enable_product_expiry') }}:</label>
            @show_tooltip(__('lang_v1.tooltip_enable_expiry'))

            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="enable_product_expiry" id="enable_product_expiry" value="1"
                        {{ $business->enable_product_expiry ? 'checked' : '' }}>
                </span>

                <select class="form-control" id="expiry_type" name="expiry_type"
                    {{ !$business->enable_product_expiry ? 'disabled' : '' }}>
                    <option value="add_expiry" {{ $business->expiry_type == 'add_expiry' ? 'selected' : '' }}>
                        {{ __('lang_v1.add_expiry') }}
                    </option>
                    <option value="add_manufacturing"
                        {{ $business->expiry_type == 'add_manufacturing' ? 'selected' : '' }}>
                        {{ __('lang_v1.add_manufacturing_auto_expiry') }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Configuración de acción al vencimiento -->
        <div class="col-sm-4 {{ !$business->enable_product_expiry ? 'hide' : '' }}" id="on_expiry_div">
            <div class="form-group">
                <div class="multi-input">
                    <label for="on_product_expiry">{{ __('lang_v1.on_product_expiry') }}:</label>
                    @show_tooltip(__('lang_v1.tooltip_on_product_expiry'))
                    <br>

                    <select name="on_product_expiry" id="on_product_expiry" class="form-control pull-left"
                        style="width:60%;">
                        <option value="keep_selling"
                            {{ $business->on_product_expiry == 'keep_selling' ? 'selected' : '' }}>
                            {{ __('lang_v1.keep_selling') }}
                        </option>
                        <option value="stop_selling"
                            {{ $business->on_product_expiry == 'stop_selling' ? 'selected' : '' }}>
                            {{ __('lang_v1.stop_selling') }}
                        </option>
                    </select>

                    @php
                    $disabled = $business->on_product_expiry == 'keep_selling' ? 'disabled' : '';
                    @endphp

                    <input type="number" name="stop_selling_before" id="stop_selling_before"
                        class="form-control pull-left" placeholder="stop n days before" style="width:40%;"
                        {{ $disabled }} required value="{{ $business->stop_selling_before }}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Configuración de marcas -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_brand" value="1" class="input-icheck"
                            {{ $business->enable_brand ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_brand') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Configuración de categorías -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_category" id="enable_category" value="1"
                            class="input-icheck" {{ $business->enable_category ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_category') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Configuración de subcategorías -->
        <div class="col-sm-4 enable_sub_category {{ $business->enable_category != 1 ? 'hide' : '' }}">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_sub_category" id="enable_sub_category" value="1"
                            class="input-icheck" {{ $business->enable_sub_category ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_sub_category') }}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Configuración de impuestos en precios -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_price_tax" value="1" class="input-icheck"
                            {{ $business->enable_price_tax ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_price_tax') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Unidad por defecto -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="default_unit">{{ __('lang_v1.default_unit') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-balance-scale"></i>
                    </span>
                    <select name="default_unit" id="default_unit" class="form-control select2" style="width: 100%;">
                        @foreach($units_dropdown as $key => $value)
                        <option value="{{ $key }}" {{ $business->default_unit == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Configuración de subunidades -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_sub_units" value="1" class="input-icheck"
                            {{ $business->enable_sub_units ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_sub_units') }}
                    </label>
                    @show_tooltip(__('lang_v1.sub_units_tooltip'))
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Configuración de estantes -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_racks" value="1" class="input-icheck"
                            {{ $business->enable_racks ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_racks') }}
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_enable_racks'))
                </div>
            </div>
        </div>

        <!-- Configuración de filas -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_row" value="1" class="input-icheck"
                            {{ $business->enable_row ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_row') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Configuración de posiciones -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_position" value="1" class="input-icheck"
                            {{ $business->enable_position ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_position') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Configuración de garantía de productos -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="common_settings[enable_product_warranty]" value="1"
                            class="input-icheck"
                            {{ !empty($common_settings['enable_product_warranty']) ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_product_warranty') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>