<div class="pos-tab-content">
    <div class="row">
        <!-- Checkbox para usar la configuración de correo del superadmin -->
        @if(!empty($allow_superadmin_email_settings))
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="checkbox">
                        <br>
                        <label>
                            <input type="checkbox" name="email_settings[use_superadmin_settings]" 
                                   value="1" id="use_superadmin_settings"
                                   {{ !empty($email_settings['use_superadmin_settings']) ? 'checked' : '' }}>
                            {{ __('lang_v1.use_superadmin_email_settings') }}
                        </label>
                    </div>
                </div>
            </div>
        @endif

        <!-- Formulario de configuración de correo (se oculta si se usa la configuración del superadmin) -->
        <div id="toggle_visibility" 
             @if(!empty($email_settings['use_superadmin_settings'])) class="hide" @endif>
             
            <!-- Selección del controlador de correo -->
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_driver">{{ __('lang_v1.mail_driver') }}:</label>
                    <select name="email_settings[mail_driver]" id="mail_driver" class="form-control">
                        @foreach($mail_drivers as $driver)
                            <option value="{{ $driver }}" 
                                {{ (!empty($email_settings['mail_driver']) && $email_settings['mail_driver'] == $driver) ? 'selected' : '' }}>
                                {{ $driver }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Configuración del servidor SMTP -->
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_host">{{ __('lang_v1.mail_host') }}:</label>
                    <input type="text" name="email_settings[mail_host]" id="mail_host"
                           value="{{ $email_settings['mail_host'] }}" 
                           class="form-control" placeholder="{{ __('lang_v1.mail_host') }}">
                </div>
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_port">{{ __('lang_v1.mail_port') }}:</label>
                    <input type="text" name="email_settings[mail_port]" id="mail_port"
                           value="{{ $email_settings['mail_port'] }}" 
                           class="form-control" placeholder="{{ __('lang_v1.mail_port') }}">
                </div>
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_username">{{ __('lang_v1.mail_username') }}:</label>
                    <input type="text" name="email_settings[mail_username]" id="mail_username"
                           value="{{ $email_settings['mail_username'] }}" 
                           class="form-control" placeholder="{{ __('lang_v1.mail_username') }}">
                </div>
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_password">{{ __('lang_v1.mail_password') }}:</label>
                    <input type="password" name="email_settings[mail_password]" id="mail_password"
                           value="{{ $email_settings['mail_password'] }}" 
                           class="form-control" placeholder="{{ __('lang_v1.mail_password') }}">
                </div>
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_encryption">{{ __('lang_v1.mail_encryption') }}:</label>
                    <input type="text" name="email_settings[mail_encryption]" id="mail_encryption"
                           value="{{ $email_settings['mail_encryption'] }}" 
                           class="form-control" placeholder="{{ __('lang_v1.mail_encryption_place') }}">
                </div>
            </div>

            <!-- Configuración del remitente -->
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="mail_from_address">{{ __('lang_v1.mail_from_address') }}:</label>
                    <input type="email" name="email_settings[mail_from_address]" id="mail_from_address"
                           value="{{ $email_settings['mail_from_address'] }}" 
                           class="form-control" placeholder="{{ __('lang_v1.mail_from_address') }}">
                </div>
            </div>
        </div>

        <div class="col-xs-4">
            <div class="form-group">
                <label for="mail_from_name">{{ __('lang_v1.mail_from_name') }}:</label>
                <input type="text" name="email_settings[mail_from_name]" id="mail_from_name"
                       value="{{ $email_settings['mail_from_name'] }}" 
                       class="form-control" placeholder="{{ __('lang_v1.mail_from_name') }}">
            </div>
        </div>

        <!-- Botón para probar la configuración del correo -->
        <div class="clearfix"></div>
        <div class="col-xs-12 test_email_btn @if(!empty($email_settings['use_superadmin_settings'])) hide @endif">
            <button type="button" class="btn btn-success pull-right" id="test_email_btn">
                @lang('lang_v1.test_email_configuration')
            </button>
        </div>
    </div>
</div>
