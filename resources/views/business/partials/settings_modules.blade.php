<!-- Configuración de módulos habilitados/deshabilitados -->
<div class="pos-tab-content">
    <div class="row">
        @if(!empty($modules))
            <h4>{{ __('lang_v1.enable_disable_modules') }}</h4>

            @foreach($modules as $key => $module)
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="checkbox">
                            <br>
                            <label>
                                <input type="checkbox" name="enabled_modules[]" value="{{ $key }}" 
                                       {{ in_array($key, $enabled_modules) ? 'checked' : '' }} 
                                       class="input-icheck">
                                {{ $module['name'] }}
                            </label>

                            <!-- Muestra el tooltip si está disponible -->
                            @if(!empty($module['tooltip'])) 
                                @show_tooltip($module['tooltip']) 
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
