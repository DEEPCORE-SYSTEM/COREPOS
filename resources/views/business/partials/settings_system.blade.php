<!-- Sección de configuración del sistema -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Selección de color del tema -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="theme_color">{{ __('lang_v1.theme_color') }}</label>
                <select name="theme_color" 
                        id="theme_color"
                        class="form-control select2" 
                        style="width: 100%;">
                    <option value="">{{ __('messages.please_select') }}</option>
                    @foreach($theme_colors as $key => $value)
                        <option value="{{ $key }}" {{ $business->theme_color == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Configuración de entradas por página en tablas -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $page_entries = [25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000, -1 => __('lang_v1.all')];
                @endphp
                <label for="default_datatable_page_entries">{{ __('lang_v1.default_datatable_page_entries') }}</label>
                <select name="common_settings[default_datatable_page_entries]" 
                        id="default_datatable_page_entries"
                        class="form-control select2" 
                        style="width: 100%;">
                    @foreach($page_entries as $key => $value)
                        <option value="{{ $key }}" {{ (!empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25) == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Opción de mostrar texto de ayuda -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" 
                               name="enable_tooltip" 
                               value="1" 
                               class="input-icheck"
                               {{ $business->enable_tooltip ? 'checked' : '' }}>
                        {{ __('business.show_help_text') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>