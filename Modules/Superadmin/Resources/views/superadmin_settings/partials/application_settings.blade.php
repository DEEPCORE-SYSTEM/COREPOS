<div class="pos-tab-content">
    <div class="row">
        <!-- Campo para el nombre de la aplicación -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="APP_NAME">@lang('superadmin::lang.app_name'):</label>
                <input type="text" name="APP_NAME" value="{{ $default_values['APP_NAME'] }}" class="form-control" placeholder="@lang('superadmin::lang.app_name')">
            </div>
        </div>

        <!-- Campo para el título de la aplicación -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="APP_TITLE">@lang('superadmin::lang.app_title'):</label>
                <input type="text" name="APP_TITLE" value="{{ $default_values['APP_TITLE'] }}" class="form-control" placeholder="@lang('superadmin::lang.app_title')">
            </div>
        </div>

        <!-- Selección del idioma predeterminado -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="APP_LOCALE">@lang('superadmin::lang.app_default_language'):</label>
                <select name="APP_LOCALE" class="form-control">
                    @foreach($languages as $key => $language)
                        <option value="{{ $key }}" {{ $default_values['APP_LOCALE'] == $key ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Checkbox para permitir el registro de usuarios -->
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="ALLOW_REGISTRATION" value="1" class="input-icheck" {{ !empty($default_values["ALLOW_REGISTRATION"]) ? 'checked' : '' }}>
                    @lang('superadmin::lang.allow_registration')
                </label>
            </div>
        </div>

        <!-- Checkbox para habilitar términos y condiciones en el registro -->
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="superadmin_enable_register_tc" value="1" class="input-icheck" {{ !empty($settings["superadmin_enable_register_tc"]) ? 'checked' : '' }}>
                    @lang('superadmin::lang.enable_register_tc')
                </label>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Área de texto para los términos y condiciones del registro -->
        <div class="col-xs-12">
            <div class="form-group">
                <label for="superadmin_register_tc">@lang('superadmin::lang.register_tc'):</label>
                <textarea name="superadmin_register_tc" class="form-control">{{ !empty($settings['superadmin_register_tc']) ? $settings['superadmin_register_tc'] : '' }}</textarea>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Campo para la clave de API de Google Maps -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="GOOGLE_MAP_API_KEY">@lang('superadmin::lang.google_map_api_key'):</label>
                <input type="text" name="GOOGLE_MAP_API_KEY" value="{{ $default_values['GOOGLE_MAP_API_KEY'] }}" class="form-control" placeholder="@lang('superadmin::lang.google_map_api_key')">
            </div>
        </div>
    </div>
</div>
