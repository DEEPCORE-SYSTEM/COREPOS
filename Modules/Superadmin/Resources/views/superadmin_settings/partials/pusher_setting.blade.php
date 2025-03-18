<!-- Configuración de Pusher -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Campo para el ID de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_ID">{{ __('superadmin::lang.pusher_app_id') }}:</label>
                <input type="text" name="PUSHER_APP_ID" id="PUSHER_APP_ID" class="form-control" 
                    placeholder="{{ __('superadmin::lang.pusher_app_id') }}" 
                    value="{{ $default_values['PUSHER_APP_ID'] }}">
            </div>
        </div>

        <!-- Campo para la clave de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_KEY">{{ __('superadmin::lang.pusher_app_key') }}:</label>
                <input type="text" name="PUSHER_APP_KEY" id="PUSHER_APP_KEY" class="form-control" 
                    placeholder="{{ __('superadmin::lang.pusher_app_key') }}" 
                    value="{{ $default_values['PUSHER_APP_KEY'] }}">
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Campo para el secreto de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_SECRET">{{ __('superadmin::lang.pusher_app_secret') }}:</label>
                <input type="text" name="PUSHER_APP_SECRET" id="PUSHER_APP_SECRET" class="form-control" 
                    placeholder="{{ __('superadmin::lang.pusher_app_secret') }}" 
                    value="{{ $default_values['PUSHER_APP_SECRET'] }}">
            </div>
        </div>

        <!-- Campo para el clúster de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_CLUSTER">{{ __('superadmin::lang.pusher_app_cluster') }}:</label>
                <input type="text" name="PUSHER_APP_CLUSTER" id="PUSHER_APP_CLUSTER" class="form-control" 
                    placeholder="{{ __('superadmin::lang.pusher_app_cluster') }}" 
                    value="{{ $default_values['PUSHER_APP_CLUSTER'] }}">
            </div>
        </div>
    </div>
</div>
