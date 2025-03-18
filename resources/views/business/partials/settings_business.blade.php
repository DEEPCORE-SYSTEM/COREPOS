<!-- Configuración de Negocio -->
<div class="pos-tab-content active">
    <div class="row">
          <!-- Nombre del negocio -->
        <div class="col-sm-4">
            <div class="form-group">
            <label for="name">{{ __('business.business_name') }}:*</label>
                <input type="text" name="name" id="name" class="form-control" 
                       placeholder="{{ __('business.business_name') }}" 
                       value="{{ $business->name }}" required>
            </div>
        </div>
        <!-- Fecha de inicio del negocio -->
        <div class="col-sm-4">
            <div class="form-group">
            <label for="start_date">{{ __('business.start_date') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    
                    <input type="text" name="start_date" id="start_date" 
                           class="form-control start-date-picker" placeholder="{{ __('business.start_date') }}" 
                           value="{{ \Carbon\Carbon::parse($business->start_date)->format('Y-m-d') }}" readonly>
                </div>
            </div>
        </div>
         
        <!-- Porcentaje de ganancia predeterminado -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="default_profit_percent">
                    {{ __('business.default_profit_percent') }}:*
                </label>

                <!-- Tooltip con información adicional -->
                <span class="tooltip-icon" data-toggle="tooltip" 
                    title="{{ __('tooltip.default_profit_percent') }}">
                    <i class="fa fa-info-circle"></i>
                </span>

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <input type="text" name="default_profit_percent" id="default_profit_percent" 
                        class="form-control input_number" 
                        value="{{ number_format($business->default_profit_percent, 2) }}">
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

            <!-- Moneda y formato -->
        <!-- Selección de moneda -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="currency_id">
                    {{ __('business.currency') }}:
                </label>

                <div class="input-group">
                    <!-- Ícono de moneda -->
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>

                    <!-- Selector de moneda con estilos de Select2 -->
                    <select name="currency_id" id="currency_id" class="form-control select2" required>
                        <option value="" disabled selected>{{ __('business.currency') }}</option>
                        @foreach($currencies as $key => $currency)
                            <option value="{{ $key }}" 
                                {{ $business->currency_id == $key ? 'selected' : '' }}>
                                {{ $currency }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        
        <!-- Colocación del símbolo de moneda -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="currency_symbol_placement">
                    {{ __('lang_v1.currency_symbol_placement') }}:
                </label>

                <!-- Selector de posición del símbolo de moneda -->
                <select name="currency_symbol_placement" id="currency_symbol_placement" 
                    class="form-control select2" required>
                    <option value="before" {{ $business->currency_symbol_placement == 'before' ? 'selected' : '' }}>
                        {{ __('lang_v1.before_amount') }}
                    </option>
                    <option value="after" {{ $business->currency_symbol_placement == 'after' ? 'selected' : '' }}>
                        {{ __('lang_v1.after_amount') }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Selección de zona horaria -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="time_zone">
                    {{ __('business.time_zone') }}:
                </label>

                <div class="input-group">
                    <!-- Ícono de reloj -->
                    <span class="input-group-addon">
                        <i class="fas fa-clock"></i>
                    </span>

                    <!-- Selector de zona horaria con estilos de Select2 -->
                    <select name="time_zone" id="time_zone" class="form-control select2" required>
                        @foreach($timezone_list as $key => $timezone)
                            <option value="{{ $key }}" 
                                {{ $business->time_zone == $key ? 'selected' : '' }}>
                                {{ $timezone }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Separador para limpiar flotantes -->
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <!-- Etiqueta para el campo de días de edición de transacciones-->
                <label for="transaction_edit_days">
                    {{ __('business.transaction_edit_days') }}:*
                </label>
                <!-- Tooltip de ayuda -->
                @show_tooltip(__('tooltip.transaction_edit_days'))

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <!-- Campo de entrada para los días de edición de transacciones -->
                    <input type="number" 
                        name="transaction_edit_days" 
                        value="{{ $business->transaction_edit_days }}" 
                        class="form-control" 
                        placeholder="{{ __('business.transaction_edit_days') }}" 
                        required>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
              <!-- Etiqueta para el formato de fecha -->
                <label for="date_format">
                    {{ __('lang_v1.date_format') }}:*
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <!-- Selector de formato de fecha -->
                    <select name="date_format" class="form-control select2" required>
                        @foreach($date_formats as $key => $value)
                            <option value="{{ $key }}" {{ $business->date_format == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
       
                <label for="time_format">
                    {{ __('lang_v1.time_format') }}:*
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-clock"></i>
                    </span>
                    <!-- Selector de formato de hora -->
                    <select name="time_format" class="form-control select2" required>
                        <option value="12" {{ $business->time_format == 12 ? 'selected' : '' }}>
                            {{ __('lang_v1.12_hour') }}
                        </option>
                        <option value="24" {{ $business->time_format == 24 ? 'selected' : '' }}>
                            {{ __('lang_v1.24_hour') }}
                        </option>
                    </select>

                </div>
            </div>
        </div>
    </div>

    
     {{-- code --}}


    <div class="row hide">
         <!-- Código 1 - Etiqueta -->
        <div class="col-sm-6">
            <div class="form-group">
                 <label for="code_label_1">{{ __('lang_v1.code_1_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="code_label_1" id="code_label_1" class="form-control" value="{{ $business->code_label_1 }}">
                </div>
            </div>
        </div>
         <!-- Código 1 - Valor -->
        <div class="col-sm-6">
            <div class="form-group">
            <label for="code_1">{{ __('lang_v1.code_1') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="code_1" id="code_1" class="form-control" value="{{ $business->code_1 }}">
                </div>
            </div>
        </div>
         <!-- Código 2 - Etiqueta -->
        <div class="col-sm-6">
            <div class="form-group">
            <label for="code_label_2">{{ __('lang_v1.code_2_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="code_label_2" id="code_label_2" class="form-control" value="{{ $business->code_label_2 }}">
                </div>
            </div>
        </div>
         <!-- Código 2 - Valor -->
        <div class="col-sm-6">
            <div class="form-group">
            <label for="code_2">{{ __('lang_v1.code_2') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="code_2" id="code_2" class="form-control" value="{{ $business->code_2 }}">
           
                </div>
            </div>
        </div>
    </div>
    <div class="row hide">
        <div class="col-sm-8">
            <div class="form-group">
                <label>
                    <!-- Checkbox para habilitar la exportación de datos -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="common_settings[is_enabled_export]" 
                                class="input-icheck" 
                                {{ !empty($common_settings['is_enabled_export']) ? 'checked' : '' }}>
                            {{ __('lang_v1.enable_export') }}
                        </label>
                    </div>
                
                </label>
            </div>
        </div>
    </div>
</div>