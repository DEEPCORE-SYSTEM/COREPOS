<div class="col-md-3">
    <div class="form-group">
        <!-- Etiqueta para el campo de selección -->
        <label for="repair_model_id">@lang('repair::lang.device_model'):</label>
        
        <!-- Selección del modelo de dispositivo -->
        <select name="repair_model_id" id="repair_model_id" class="form-control select2" style="width: 100%;">
            <option value="">{{ __('messages.all') }}</option>
            @foreach($view_data['device_models'] as $key => $model)
                <option value="{{ $key }}">{{ $model }}</option>
            @endforeach
        </select>
    </div>
</div>
