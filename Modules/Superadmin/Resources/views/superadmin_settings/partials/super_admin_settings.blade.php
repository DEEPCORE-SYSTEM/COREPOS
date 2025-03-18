<!-- Contenido de la pestaña activa -->
<div class="pos-tab-content active">
    <div class="row">

        <!-- Nombre del negocio -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_name">{{ __('business.business_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-suitcase"></i>
                    </span>
                    <input type="text" name="invoice_business_name" id="invoice_business_name" 
                        class="form-control" placeholder="{{ __('business.business_name') }}" 
                        required value="{{ $settings['invoice_business_name'] }}">
                </div>
            </div>
        </div>

        <!-- Correo electrónico -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="email">{{ __('business.email') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" class="form-control" 
                        placeholder="{{ __('business.email') }}" value="{{ $settings['email'] }}">
                </div>
            </div>
        </div>

        <!-- Moneda -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="app_currency_id">{{ __('business.currency') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    <select name="app_currency_id" id="app_currency_id" 
                        class="form-control select2" required>
                        <option value="">{{ __('business.currency_placeholder') }}</option>
                        @foreach($currencies as $key => $currency)
                            <option value="{{ $key }}" {{ $settings['app_currency_id'] == $key ? 'selected' : '' }}>
                                {{ $currency }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Dirección del negocio -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_landmark">{{ __('business.landmark') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_landmark" id="invoice_business_landmark"
                        class="form-control" placeholder="{{ __('business.landmark') }}" 
                        required value="{{ $settings['invoice_business_landmark'] }}">
                </div>
            </div>
        </div>

        <!-- Código postal -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_zip">{{ __('business.zip_code') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_zip" id="invoice_business_zip"
                        class="form-control" placeholder="{{ __('business.zip_code') }}" 
                        required value="{{ $settings['invoice_business_zip'] }}">
                </div>
            </div>
        </div>

        <!-- Estado -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_state">{{ __('business.state') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_state" id="invoice_business_state"
                        class="form-control" placeholder="{{ __('business.state') }}" 
                        required value="{{ $settings['invoice_business_state'] }}">
                </div>
            </div>
        </div>

        <!-- Ciudad -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_city">{{ __('business.city') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_city" id="invoice_business_city"
                        class="form-control" placeholder="{{ __('business.city') }}" 
                        required value="{{ $settings['invoice_business_city'] }}">
                </div>
            </div>
        </div>

        <!-- País -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_country">{{ __('business.country') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </span>
                    <input type="text" name="invoice_business_country" id="invoice_business_country"
                        class="form-control" placeholder="{{ __('business.country') }}" 
                        required value="{{ $settings['invoice_business_country'] }}">
                </div>
            </div>
        </div>

        <!-- Días de alerta de vencimiento del paquete -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="package_expiry_alert_days">{{ __('superadmin::lang.package_expiry_alert_days') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-exclamation-triangle"></i>
                    </span>
                    <input type="number" name="package_expiry_alert_days" id="package_expiry_alert_days"
                        class="form-control" placeholder="{{ __('superadmin::lang.package_expiry_alert_days') }}" 
                        required value="{{ $settings['package_expiry_alert_days'] }}">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Activar nombres de usuario basados en el negocio -->
        <div class="col-xs-4">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="enable_business_based_username" value="1" 
                        class="input-icheck" {{ $settings['enable_business_based_username'] ? 'checked' : '' }}>
                    {{ __('superadmin::lang.enable_business_based_username') }}
                </label>
                <p class="help-block">{{ __('superadmin::lang.business_based_username_help') }}</p>
            </div>
        </div>

        <!-- Información de la versión -->
        <div class="col-xs-12">
            <p class="help-block">
                <i>{!! __('superadmin::lang.version_info', ['version' => $superadmin_version]) !!}</i>
            </p>
        </div>

    </div>
</div>
