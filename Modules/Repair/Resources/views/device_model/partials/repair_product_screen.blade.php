<!-- Campo oculto para indicar que hay datos del módulo -->
<input type="hidden" name="has_module_data" value="true">

<div class="col-sm-4">
    <div class="form-group">
        <!-- Etiqueta para la selección del modelo de dispositivo -->
        <label for="repair_model_id">@lang('repair::lang.device_model'):</label>

        <!-- Selección del modelo de dispositivo -->
        <select name="repair_model_id" id="repair_model_id" class="form-control select2">
            <option value="">{{ __('messages.please_select') }}</option>
            @foreach($view_data['device_models'] as $key => $model)
                <option value="{{ $key }}" {{ !empty($product->repair_model_id) && $product->repair_model_id == $key ? 'selected' : '' }}>
                    {{ $model }}
                </option>
            @endforeach
        </select>
    </div>
</div>
