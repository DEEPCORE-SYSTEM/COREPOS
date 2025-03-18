<!-- Sección de configuración de báscula de peso -->
<div class="row">
    <!-- Encabezado y descripción -->
    <div class="col-sm-12">
        <h4>@lang('lang_v1.weighing_scale_setting'):</h4>
        <p>@lang('lang_v1.weighing_scale_setting_help')</p>
        <br/>
    </div>

    <!-- Configuración de formato de código de barras -->
    <!-- 
        1. Prefijo: Cualquier prefijo puede ser ingresado, puede dejarse en blanco si la báscula no lo soporta
        2. Lista desplegable del 1 al 9 para el código de barras 0
        3. Lista desplegable del 1 al 5 para la cantidad
        4. Lista desplegable del 1 al 4 para decimales de cantidad
    -->

    <!-- Prefijo del código de barras -->
    <div class="col-sm-3">
        <div class="form-group">
            <label for="label_prefix">{{ __('lang_v1.weighing_barcode_prefix') }}:</label>
            <input type="text" 
                   name="weighing_scale_setting[label_prefix]" 
                   id="label_prefix"
                   class="form-control"
                   value="{{ isset($weighing_scale_setting['label_prefix']) ? $weighing_scale_setting['label_prefix'] : null }}">
        </div>
    </div>

    <!-- Longitud del SKU del producto -->
    <div class="col-sm-3">
        <div class="form-group">
            <label for="product_sku_length">{{ __('lang_v1.weighing_product_sku_length') }}:</label>
            <select name="weighing_scale_setting[product_sku_length]" 
                    id="product_sku_length"
                    class="form-control select2" 
                    style="width: 100%;">
                @for($i = 1; $i <= 9; $i++)
                    <option value="{{ $i }}" {{ (isset($weighing_scale_setting['product_sku_length']) ? $weighing_scale_setting['product_sku_length'] : 4) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Longitud de la parte entera de la cantidad -->
    <div class="col-sm-3">
        <div class="form-group">
            <label for="qty_length">{{ __('lang_v1.weighing_qty_integer_part_length') }}:</label>
            <select name="weighing_scale_setting[qty_length]" 
                    id="qty_length"
                    class="form-control select2" 
                    style="width: 100%;">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ (isset($weighing_scale_setting['qty_length']) ? $weighing_scale_setting['qty_length'] : 3) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Longitud de la parte decimal de la cantidad -->
    <div class="col-sm-3">
        <div class="form-group">
            <label for="qty_length_decimal">{{ __('lang_v1.weighing_qty_fractional_part_length') }}:</label>
            <select name="weighing_scale_setting[qty_length_decimal]" 
                    id="qty_length_decimal"
                    class="form-control select2" 
                    style="width: 100%;">
                @for($i = 1; $i <= 4; $i++)
                    <option value="{{ $i }}" {{ (isset($weighing_scale_setting['qty_length_decimal']) ? $weighing_scale_setting['qty_length_decimal'] : 2) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </div>
</div>