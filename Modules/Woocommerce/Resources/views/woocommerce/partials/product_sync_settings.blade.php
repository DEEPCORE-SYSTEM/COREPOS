<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="default_tax_class">{{ __('woocommerce::lang.default_tax_class') }}:</label> 
                @show_tooltip(__('woocommerce::lang.default_tax_class_help'))
                <input type="text" name="default_tax_class" value="{{ $default_settings['default_tax_class'] }}" class="form-control">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="product_tax_type">{{ __('woocommerce::lang.sync_product_price') }}:</label>
                <select name="product_tax_type" class="form-control">
                    <option value="inc" {{ $default_settings['product_tax_type'] == 'inc' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.inc_tax') }}
                    </option>
                    <option value="exc" {{ $default_settings['product_tax_type'] == 'exc' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.exc_tax') }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="default_selling_price_group">{{ __('woocommerce::lang.default_selling_price_group') }}:</label>
                <select name="default_selling_price_group" class="form-control select2" style="width: 100%;">
                    @foreach($price_groups as $key => $group)
                        <option value="{{ $key }}" {{ $default_settings['default_selling_price_group'] == $key ? 'selected' : '' }}>
                            {{ $group }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="sync_description_as">{{ __('woocommerce::lang.sync_description_as') }}:</label>
                <select name="sync_description_as" class="form-control select2" style="width: 100%;">
                    <option value="short" {{ $default_settings['sync_description_as'] == 'short' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.short_description') }}
                    </option>
                    <option value="long" {{ $default_settings['sync_description_as'] == 'long' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.long_description') }}
                    </option>
                    <option value="both" {{ $default_settings['sync_description_as'] == 'both' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.both') }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-xs-12"><hr></div>
        <div class="col-xs-12">
            <label>@lang('woocommerce::lang.product_fields_to_be_synced_for_create'):</label><br>
            @php
                $fields = ['name', 'price', 'category', 'quantity', 'weight', 'image', 'description'];
            @endphp
            @foreach($fields as $field)
                <label class="checkbox-inline">
                    <input type="checkbox" name="product_fields_for_create[]" value="{{ $field }}" 
                        {{ in_array($field, $default_settings['product_fields_for_create']) ? 'checked' : '' }}>
                    @lang('product.' . $field)
                </label>
            @endforeach
        </div>
        <div class="clearfix"></div>

        <div class="col-xs-4 @if(in_array('quantity', $default_settings['product_fields_for_create'])) hide @endif create_stock_settings">
            <div class="form-group">
                <label for="manage_stock_for_create">{{ __('product.manage_stock') }}:</label>
                <select name="manage_stock_for_create" class="form-control">
                    <option value="true" {{ $default_settings['manage_stock_for_create'] == 'true' ? 'selected' : '' }}>true</option>
                    <option value="false" {{ $default_settings['manage_stock_for_create'] == 'false' ? 'selected' : '' }}>false</option>
                    <option value="none" {{ $default_settings['manage_stock_for_create'] == 'none' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.dont_update') }}
                    </option>
                </select>
            </div>
        </div>

        <div class="col-xs-4 @if(in_array('quantity', $default_settings['product_fields_for_create'])) hide @endif create_stock_settings">
            <div class="form-group">
                <label for="in_stock_for_create">{{ __('woocommerce::lang.in_stock') }}:</label>
                <select name="in_stock_for_create" class="form-control">
                    <option value="true" {{ $default_settings['in_stock_for_create'] == 'true' ? 'selected' : '' }}>true</option>
                    <option value="false" {{ $default_settings['in_stock_for_create'] == 'false' ? 'selected' : '' }}>false</option>
                    <option value="none" {{ $default_settings['in_stock_for_create'] == 'none' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.dont_update') }}
                    </option>
                </select>
            </div>
        </div>

        <div class="col-xs-12"><hr></div>

        <div class="col-xs-12">
            <label>@lang('woocommerce::lang.product_fields_to_be_synced_for_update'):</label><br>
            @foreach($fields as $field)
                <label class="checkbox-inline">
                    <input type="checkbox" name="product_fields_for_update[]" value="{{ $field }}" 
                        {{ in_array($field, $default_settings['product_fields_for_update']) ? 'checked' : '' }}>
                    @lang('product.' . $field)
                </label>
            @endforeach
        </div>

        <div class="clearfix"></div>

        <div class="col-xs-4 @if(in_array('quantity', $default_settings['product_fields_for_update'])) hide @endif update_stock_settings">
            <div class="form-group">
                <label for="manage_stock_for_update">{{ __('product.manage_stock') }}:</label>
                <select name="manage_stock_for_update" class="form-control">
                    <option value="true" {{ $default_settings['manage_stock_for_update'] == 'true' ? 'selected' : '' }}>true</option>
                    <option value="false" {{ $default_settings['manage_stock_for_update'] == 'false' ? 'selected' : '' }}>false</option>
                    <option value="none" {{ $default_settings['manage_stock_for_update'] == 'none' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.dont_update') }}
                    </option>
                </select>
            </div>
        </div>

        <div class="col-xs-4 @if(in_array('quantity', $default_settings['product_fields_for_update'])) hide @endif update_stock_settings">
            <div class="form-group">
                <label for="in_stock_for_update">{{ __('woocommerce::lang.in_stock') }}:</label>
                <select name="in_stock_for_update" class="form-control">
                    <option value="true" {{ $default_settings['in_stock_for_update'] == 'true' ? 'selected' : '' }}>true</option>
                    <option value="false" {{ $default_settings['in_stock_for_update'] == 'false' ? 'selected' : '' }}>false</option>
                    <option value="none" {{ $default_settings['in_stock_for_update'] == 'none' ? 'selected' : '' }}>
                        {{ __('woocommerce::lang.dont_update') }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
