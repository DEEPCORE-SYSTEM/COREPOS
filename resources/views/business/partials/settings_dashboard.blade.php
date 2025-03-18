<!-- Contenedor de pestañas de configuración -->
<div class="pos-tab-content">
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <!-- Etiqueta para la alerta de vencimiento de stock -->
                <label for="stock_expiry_alert_days">{{ __('business.view_stock_expiry_alert_for') }}:*</label>

                <!-- Grupo de entrada con icono -->
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-calendar-times"></i>
                    </span>

                    <!-- Campo de entrada numérico para días de alerta de vencimiento -->
                    <input type="number" name="stock_expiry_alert_days" 
                        value="{{ $business->stock_expiry_alert_days }}" 
                        class="form-control" required>

                    <span class="input-group-addon">
                        {{ __('business.days') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
