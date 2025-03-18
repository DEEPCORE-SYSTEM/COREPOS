{{-- Sección de configuración de impuestos --}}
<div class="pos-tab-content">
    <div class="row">
        {{-- Primer impuesto - Nombre --}}
        <div class="col-sm-4">
            <div class="form-group">
                <label for="tax_label_1">{{ __('business.tax_1_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_label_1" id="tax_label_1" class="form-control"
                        placeholder="{{ __('business.tax_1_placeholder') }}" value="{{ $business->tax_label_1 }}">
                </div>
            </div>
        </div>

        {{-- Primer impuesto - Número --}}
        <div class="col-sm-4">
            <div class="form-group">
                <label for="tax_number_1">{{ __('business.tax_1_no') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_number_1" id="tax_number_1" class="form-control"
                        value="{{ $business->tax_number_1 }}">
                </div>
            </div>
        </div>

        {{-- Segundo impuesto - Nombre --}}
        <div class="col-sm-4">
            <div class="form-group">
                <label for="tax_label_2">{{ __('business.tax_2_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_label_2" id="tax_label_2" class="form-control"
                        placeholder="{{ __('business.tax_1_placeholder') }}" value="{{ $business->tax_label_2 }}">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        {{-- Segundo impuesto - Número --}}
        <div class="col-sm-4">
            <div class="form-group">
                <label for="tax_number_2">{{ __('business.tax_2_no') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_number_2" id="tax_number_2" class="form-control"
                        value="{{ $business->tax_number_2 }}">
                </div>
            </div>
        </div>

        {{-- Opción para habilitar impuestos en línea --}}
        <div class="col-sm-8">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" name="enable_inline_tax" value="1" class="input-icheck"
                            {{ $business->enable_inline_tax ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_inline_tax') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>