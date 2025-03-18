<!-- Sección de configuración del POS -->
<div class="pos-tab-content">
    <!-- Atajos de teclado -->
    <h4>@lang('business.add_keyboard_shortcuts'):</h4>
    <p class="help-block">@lang('lang_v1.shortcut_help'); @lang('lang_v1.example'): <b>ctrl+shift+b</b>, <b>ctrl+h</b></p>
    <p class="help-block">
        <b>@lang('lang_v1.available_key_names_are'):</b>
        <br> shift, ctrl, alt, backspace, tab, enter, return, capslock, esc, escape, space, pageup, pagedown, end, home, <br>left, up, right, down, ins, del, and plus
    </p>

    <div class="row">
        <!-- Tabla de atajos de teclado - Columna 1 -->
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th>@lang('business.operations')</th>
                    <th>@lang('business.keyboard_shortcut')</th>
                </tr>
                <tr>
                    <td>{{ __('sale.express_finalize') }}:</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][express_checkout]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['express_checkout']) ? $shortcuts['pos']['express_checkout'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.finalize'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][pay_n_ckeckout]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['pay_n_ckeckout']) ? $shortcuts['pos']['pay_n_ckeckout'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.draft'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][draft]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['draft']) ? $shortcuts['pos']['draft'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('messages.cancel'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][cancel]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['cancel']) ? $shortcuts['pos']['cancel'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('lang_v1.recent_product_quantity'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][recent_product_quantity]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['recent_product_quantity']) ? $shortcuts['pos']['recent_product_quantity'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('lang_v1.weighing_scale'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][weighing_scale]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['weighing_scale']) ? $shortcuts['pos']['weighing_scale'] : null }}">
                    </td>
                </tr>
            </table>
        </div>

        <!-- Tabla de atajos de teclado - Columna 2 -->
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th>@lang('business.operations')</th>
                    <th>@lang('business.keyboard_shortcut')</th>
                </tr>
                <tr>
                    <td>@lang('sale.edit_discount'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][edit_discount]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['edit_discount']) ? $shortcuts['pos']['edit_discount'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.edit_order_tax'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][edit_order_tax]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['edit_order_tax']) ? $shortcuts['pos']['edit_order_tax'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.add_payment_row'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][add_payment_row]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['add_payment_row']) ? $shortcuts['pos']['add_payment_row'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.finalize_payment'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][finalize_payment]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['finalize_payment']) ? $shortcuts['pos']['finalize_payment'] : null }}">
                    </td>
                </tr>
                <tr>
                    <td>@lang('lang_v1.add_new_product'):</td>
                    <td>
                        <input type="text" 
                               name="shortcuts[pos][add_new_product]" 
                               class="form-control" 
                               value="{{ !empty($shortcuts['pos']['add_new_product']) ? $shortcuts['pos']['add_new_product'] : null }}">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <!-- Configuración del POS -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.pos_settings'):</h4>
        </div>

        <!-- Deshabilitar pago y checkout -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_pay_checkout]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['disable_pay_checkout'] ? 'checked' : '' }}>
                        {{ __('lang_v1.disable_pay_checkout') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Deshabilitar borrador -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_draft]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['disable_draft'] ? 'checked' : '' }}>
                        {{ __('lang_v1.disable_draft') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Deshabilitar checkout rápido -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_express_checkout]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['disable_express_checkout'] ? 'checked' : '' }}>
                        {{ __('lang_v1.disable_express_checkout') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Ocultar sugerencias de productos -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[hide_product_suggestion]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['hide_product_suggestion'] ? 'checked' : '' }}>
                        {{ __('lang_v1.hide_product_suggestion') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Ocultar transacciones recientes -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[hide_recent_trans]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['hide_recent_trans'] ? 'checked' : '' }}>
                        {{ __('lang_v1.hide_recent_trans') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Deshabilitar descuentos -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_discount]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['disable_discount'] ? 'checked' : '' }}>
                        {{ __('lang_v1.disable_discount') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Deshabilitar impuestos de orden -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_order_tax]" 
                               value="1" 
                               class="input-icheck"
                               {{ $pos_settings['disable_order_tax'] ? 'checked' : '' }}>
                        {{ __('lang_v1.disable_order_tax') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Subtotal editable -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[is_pos_subtotal_editable]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['is_pos_subtotal_editable']) ? '' : 'checked' }}>
                        {{ __('lang_v1.subtotal_editable') }}
                    </label>
                    @show_tooltip(__('lang_v1.subtotal_editable_help_text'))
                </div>
            </div>
        </div>

        <!-- Deshabilitar suspensión de venta -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_suspend]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['disable_suspend']) ? '' : 'checked' }}>
                        {{ __('lang_v1.disable_suspend_sale') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Habilitar fecha de transacción -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[enable_transaction_date]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['enable_transaction_date']) ? '' : 'checked' }}>
                        {{ __('lang_v1.enable_pos_transaction_date') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Habilitar personal de servicio en línea -->
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[inline_service_staff]" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['inline_service_staff']) ? 'checked' : '' }}>
                        {{ __('lang_v1.enable_service_staff_in_product_line') }}
                    </label>
                    @show_tooltip(__('lang_v1.inline_service_staff_tooltip'))
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Personal de servicio requerido -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[is_service_staff_required]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['is_service_staff_required']) ? '' : 'checked' }}>
                        {{ __('lang_v1.is_service_staff_required') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Deshabilitar botón de venta a crédito -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[disable_credit_sale_button]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['disable_credit_sale_button']) ? '' : 'checked' }}>
                        {{ __('lang_v1.disable_credit_sale_button') }}
                    </label>
                    @show_tooltip(__('lang_v1.show_credit_sale_btn_help'))
                </div>
            </div>
        </div>

        <!-- Habilitar báscula -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[enable_weighing_scale]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['enable_weighing_scale']) ? '' : 'checked' }}>
                        {{ __('lang_v1.enable_weighing_scale') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Mostrar esquema de factura -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[show_invoice_scheme]" 
                               value="1" 
                               class="input-icheck"
                               {{ empty($pos_settings['show_invoice_scheme']) ? '' : 'checked' }}>
                        {{ __('lang_v1.show_invoice_scheme') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Mostrar diseño de factura -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[show_invoice_layout]" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['show_invoice_layout']) ? 'checked' : '' }}>
                        {{ __('lang_v1.show_invoice_layout') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Imprimir al suspender -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[print_on_suspend]" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['print_on_suspend']) ? 'checked' : '' }}>
                        {{ __('lang_v1.print_on_suspend') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Mostrar precios en sugerencias de productos -->
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" 
                               name="pos_settings[show_pricing_on_product_sugesstion]" 
                               value="1" 
                               class="input-icheck"
                               {{ !empty($pos_settings['show_pricing_on_product_sugesstion']) ? 'checked' : '' }}>
                        {{ __('lang_v1.show_pricing_on_product_sugesstion') }}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- Denominaciones de efectivo -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="cash_denominations">{{ __('lang_v1.cash_denominations') }}:</label>
                <input type="text" 
                       name="pos_settings[cash_denominations]" 
                       id="cash_denominations" 
                       class="form-control" 
                       value="{{ isset($pos_settings['cash_denominations']) ? $pos_settings['cash_denominations'] : null }}">
                <p class="help-block">{{ __('lang_v1.cash_denominations_help') }}</p>
            </div>
        </div>
    </div>

    <hr>

    <!-- Configuración de báscula -->
    @include('business.partials.settings_weighing_scale')
</div>