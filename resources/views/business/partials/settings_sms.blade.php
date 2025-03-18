@php
    $sms_service = isset($sms_settings['sms_service']) ? $sms_settings['sms_service'] : 'other';
@endphp

<!-- Sección de configuración de SMS -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Selección de servicio SMS -->
        <div class="col-xs-3">
            <div class="form-group">
                <label for="sms_service">{{ __('lang_v1.sms_service') }}:</label>
                <select name="sms_settings[sms_service]" 
                        id="sms_service" 
                        class="form-control">
                    <option value="nexmo" {{ $sms_service == 'nexmo' ? 'selected' : '' }}>Nexmo</option>
                    <option value="twilio" {{ $sms_service == 'twilio' ? 'selected' : '' }}>Twilio</option>
                    <option value="other" {{ $sms_service == 'other' ? 'selected' : '' }}>{{ __('lang_v1.other') }}</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Configuración de Nexmo -->
    <div class="row sms_service_settings @if($sms_service != 'nexmo') hide @endif" data-service="nexmo">
        <div class="col-xs-3">
            <div class="form-group">
                <label for="nexmo_key">{{ __('lang_v1.nexmo_key') }}:</label>
                <input type="text" 
                       name="sms_settings[nexmo_key]" 
                       id="nexmo_key"
                       class="form-control"
                       placeholder="{{ __('lang_v1.nexmo_key') }}"
                       value="{{ !empty($sms_settings['nexmo_key']) ? $sms_settings['nexmo_key'] : null }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="nexmo_secret">{{ __('lang_v1.nexmo_secret') }}:</label>
                <input type="text" 
                       name="sms_settings[nexmo_secret]" 
                       id="nexmo_secret"
                       class="form-control"
                       placeholder="{{ __('lang_v1.nexmo_secret') }}"
                       value="{{ !empty($sms_settings['nexmo_secret']) ? $sms_settings['nexmo_secret'] : null }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="nexmo_from">{{ __('account.from') }}:</label>
                <input type="text" 
                       name="sms_settings[nexmo_from]" 
                       id="nexmo_from"
                       class="form-control"
                       placeholder="{{ __('account.from') }}"
                       value="{{ !empty($sms_settings['nexmo_from']) ? $sms_settings['nexmo_from'] : null }}">
            </div>
        </div>
    </div>

    <!-- Configuración de Twilio -->
    <div class="row sms_service_settings @if($sms_service != 'twilio') hide @endif" data-service="twilio">
        <div class="col-xs-3">
            <div class="form-group">
                <label for="twilio_sid">{{ __('lang_v1.twilio_sid') }}:</label>
                <input type="text" 
                       name="sms_settings[twilio_sid]" 
                       id="twilio_sid"
                       class="form-control"
                       placeholder="{{ __('lang_v1.twilio_sid') }}"
                       value="{{ !empty($sms_settings['twilio_sid']) ? $sms_settings['twilio_sid'] : null }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="twilio_token">{{ __('lang_v1.twilio_token') }}:</label>
                <input type="text" 
                       name="sms_settings[twilio_token]" 
                       id="twilio_token"
                       class="form-control"
                       placeholder="{{ __('lang_v1.twilio_token') }}"
                       value="{{ !empty($sms_settings['twilio_token']) ? $sms_settings['twilio_token'] : null }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="twilio_from">{{ __('account.from') }}:</label>
                <input type="text" 
                       name="sms_settings[twilio_from]" 
                       id="twilio_from"
                       class="form-control"
                       placeholder="{{ __('account.from') }}"
                       value="{{ !empty($sms_settings['twilio_from']) ? $sms_settings['twilio_from'] : null }}">
            </div>
        </div>
    </div>

    <!-- Configuración de servicio personalizado -->
    <div class="row sms_service_settings @if($sms_service != 'other') hide @endif" data-service="other">
        <!-- Configuración básica -->
        <div class="col-xs-3">
            <div class="form-group">
                <label for="sms_settings_url">URL:</label>
                <input type="text" 
                       name="sms_settings[url]" 
                       id="sms_settings_url"
                       class="form-control"
                       placeholder="URL"
                       value="{{ $sms_settings['url'] }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="send_to_param_name">{{ __('lang_v1.send_to_param_name') }}:</label>
                <input type="text" 
                       name="sms_settings[send_to_param_name]" 
                       id="send_to_param_name"
                       class="form-control"
                       placeholder="{{ __('lang_v1.send_to_param_name') }}"
                       value="{{ $sms_settings['send_to_param_name'] }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="msg_param_name">{{ __('lang_v1.msg_param_name') }}:</label>
                <input type="text" 
                       name="sms_settings[msg_param_name]" 
                       id="msg_param_name"
                       class="form-control"
                       placeholder="{{ __('lang_v1.msg_param_name') }}"
                       value="{{ $sms_settings['msg_param_name'] }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label for="request_method">{{ __('lang_v1.request_method') }}:</label>
                <select name="sms_settings[request_method]" 
                        id="request_method" 
                        class="form-control">
                    <option value="get" {{ $sms_settings['request_method'] == 'get' ? 'selected' : '' }}>GET</option>
                    <option value="post" {{ $sms_settings['request_method'] == 'post' ? 'selected' : '' }}>POST</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr>

        <!-- Encabezados HTTP -->
        @for($i = 1; $i <= 3; $i++)
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="sms_settings_header_key{{ $i }}">{{ __('lang_v1.sms_settings_header_key', ['number' => $i]) }}:</label>
                    <input type="text" 
                           name="sms_settings[header_{{ $i }}]" 
                           id="sms_settings_header_key{{ $i }}"
                           class="form-control"
                           placeholder="{{ __('lang_v1.sms_settings_header_key', ['number' => $i]) }}"
                           value="{{ $sms_settings['header_'.$i] ?? null }}">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="sms_settings_header_val{{ $i }}">{{ __('lang_v1.sms_settings_header_val', ['number' => $i]) }}:</label>
                    <input type="text" 
                           name="sms_settings[header_val_{{ $i }}]" 
                           id="sms_settings_header_val{{ $i }}"
                           class="form-control"
                           placeholder="{{ __('lang_v1.sms_settings_header_val', ['number' => $i]) }}"
                           value="{{ $sms_settings['header_val_'.$i] ?? null }}">
                </div>
            </div>
            <div class="clearfix"></div>
        @endfor

        <hr>

        <!-- Parámetros de la solicitud -->
        @for($i = 1; $i <= 10; $i++)
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="sms_settings_param_key{{ $i }}">{{ __('lang_v1.sms_settings_param_key', ['number' => $i]) }}:</label>
                    <input type="text" 
                           name="sms_settings[param_{{ $i }}]" 
                           id="sms_settings_param_key{{ $i }}"
                           class="form-control"
                           placeholder="{{ __('lang_v1.sms_settings_param_val', ['number' => $i]) }}"
                           value="{{ !empty($sms_settings['param_'.$i]) ? $sms_settings['param_'.$i] : null }}">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="sms_settings_param_val{{ $i }}">{{ __('lang_v1.sms_settings_param_val', ['number' => $i]) }}:</label>
                    <input type="text" 
                           name="sms_settings[param_val_{{ $i }}]" 
                           id="sms_settings_param_val{{ $i }}"
                           class="form-control"
                           placeholder="{{ __('lang_v1.sms_settings_param_val', ['number' => $i]) }}"
                           value="{{ !empty($sms_settings['param_val_'.$i]) ? $sms_settings['param_val_'.$i] : null }}">
                </div>
            </div>
            <div class="clearfix"></div>
        @endfor

        <hr>

        <!-- Prueba de configuración -->
        <div class="col-md-8 col-xs-12">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" 
                           name="test_number" 
                           id="test_number"
                           class="form-control"
                           placeholder="{{ __('lang_v1.test_number') }}">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success pull-right" id="test_sms_btn">
                            @lang('lang_v1.test_sms_configuration')
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>