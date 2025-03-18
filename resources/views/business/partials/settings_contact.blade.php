<!-- Configuración relacionada con compras -->
<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <!-- Etiqueta para el límite de crédito predeterminado -->
                <label for="default_credit_limit">{{ __('lang_v1.default_credit_limit') }}:</label>
                
                <!-- Campo de entrada para el límite de crédito -->
                <input type="text" name="common_settings[default_credit_limit]" 
                    value="{{ $common_settings['default_credit_limit'] ?? '' }}" 
                    class="form-control input_number" 
                    placeholder="{{ __('lang_v1.default_credit_limit') }}" 
                    id="default_credit_limit">
            </div>
        </div>
    </div>
</div>
