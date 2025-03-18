<div class="pos-tab-content">
    <div class="row">
        {{-- Selector para el driver de correo --}}
        <div class="col-xs-4">
            <div class="form-group">
                <label for="MAIL_DRIVER">{{ __('superadmin::lang.mail_driver') }}:</label>
                <select name="MAIL_DRIVER" id="MAIL_DRIVER" class="form-control">
                    @foreach($mail_drivers as $key => $value)
                        <option value="{{ $key }}" {{ $default_values['MAIL_DRIVER'] == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Campos de configuración SMTP --}}
        @php
            $mail_fields = [
                'MAIL_HOST' => __('superadmin::lang.mail_host'),
                'MAIL_PORT' => __('superadmin::lang.mail_port'),
                'MAIL_USERNAME' => __('superadmin::lang.mail_username'),
                'MAIL_PASSWORD' => __('superadmin::lang.mail_password'),
                'MAIL_ENCRYPTION' => __('superadmin::lang.mail_encryption'),
                'MAIL_FROM_ADDRESS' => __('superadmin::lang.mail_from_address'),
                'MAIL_FROM_NAME' => __('superadmin::lang.mail_from_name')
            ];
        @endphp

        @foreach($mail_fields as $field => $label)
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}:</label>
                    <input type="{{ $field == 'MAIL_FROM_ADDRESS' ? 'email' : 'text' }}" 
                           name="{{ $field }}" 
                           id="{{ $field }}" 
                           value="{{ $default_values[$field] ?? '' }}" 
                           class="form-control" 
                           placeholder="{{ $label }}">
                </div>
            </div>
            @if ($loop->iteration % 3 == 0) {{-- Cada 3 columnas, limpiar la fila --}}
                <div class="clearfix"></div>
            @endif
        @endforeach

        <div class="clearfix"></div>

        {{-- Opciones de configuración con checkboxes --}}
        @php
            $checkbox_settings = [
                'allow_email_settings_to_businesses' => __('superadmin::lang.allow_email_settings_to_businesses'),
                'enable_new_business_registration_notification' => __('superadmin::lang.enable_new_business_registration_notification'),
                'enable_new_subscription_notification' => __('superadmin::lang.enable_new_subscription_notification'),
                'enable_welcome_email' => __('superadmin::lang.enable_welcome_email')
            ];
        @endphp

        @foreach($checkbox_settings as $name => $label)
            <div class="col-md-4">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="{{ $name }}" value="1" class="input-icheck"
                               {{ !empty($settings[$name]) ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                    @show_tooltip(__('superadmin::lang.' . Str::snake($name) . '_tooltip'))
                </div>
            </div>
            @if ($loop->iteration % 3 == 0) {{-- Cada 3 columnas, limpiar la fila --}}
                <div class="clearfix"></div>
            @endif
        @endforeach

        <div class="clearfix"></div>

        {{-- Configuración del correo de bienvenida --}}
        <div class="col-xs-12">
            <h4>@lang('superadmin::lang.welcome_email_template'):</h4>
            <strong>@lang('lang_v1.available_tags'):</strong> {business_name}, {owner_name} <br><br>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label for="welcome_email_subject">{{ __('superadmin::lang.welcome_email_subject') }}:</label>
                <input type="text" name="welcome_email_subject" id="welcome_email_subject" 
                       value="{{ $settings['welcome_email_subject'] ?? '' }}" 
                       class="form-control" 
                       placeholder="{{ __('superadmin::lang.welcome_email_subject') }}">
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label for="welcome_email_body">{{ __('superadmin::lang.welcome_email_body') }}:</label>
                <textarea name="welcome_email_body" id="welcome_email_body" 
                          class="form-control" 
                          placeholder="{{ __('superadmin::lang.welcome_email_body') }}">{{ $settings['welcome_email_body'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>
