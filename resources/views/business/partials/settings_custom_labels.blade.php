<!-- Contenedor principal de etiquetas personalizadas -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Sección de etiquetas para pagos personalizados -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_custom_payments'):</h4>
        </div>
        <div class="clearfix"></div>

        <!-- Campos de pagos personalizados -->
        @for($i = 1; $i <= 7; $i++)
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="custom_payment_{{ $i }}">{{ __('lang_v1.custom_payment' . ($i <= 3 ? '_' . $i : ''), ['number' => $i]) }}</label>
                    <input type="text" 
                           name="custom_labels[payments][custom_pay_{{ $i }}]" 
                           id="custom_payment_{{ $i }}"
                           class="form-control"
                           value="{{ !empty($custom_labels['payments']['custom_pay_' . $i]) ? $custom_labels['payments']['custom_pay_' . $i] : null }}">
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de contactos -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_contact_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de contactos -->
        @for($i = 1; $i <= 10; $i++)
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="contact_custom_field_{{ $i }}">{{ __('lang_v1.contact_custom_field' . ($i <= 4 ? $i : ''), ['number' => $i]) }}</label>
                    <input type="text" 
                           name="custom_labels[contact][custom_field_{{ $i }}]" 
                           id="contact_custom_field_{{ $i }}"
                           class="form-control"
                           value="{{ !empty($custom_labels['contact']['custom_field_' . $i]) ? $custom_labels['contact']['custom_field_' . $i] : null }}">
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de productos -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_product_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de productos -->
        @for($i = 1; $i <= 4; $i++)
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field_{{ $i }}">{{ __('lang_v1.product_custom_field' . $i) }}</label>
                    <input type="text" 
                           name="custom_labels[product][custom_field_{{ $i }}]" 
                           id="product_custom_field_{{ $i }}"
                           class="form-control"
                           value="{{ !empty($custom_labels['product']['custom_field_' . $i]) ? $custom_labels['product']['custom_field_' . $i] : null }}">
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de ubicaciones -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_location_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de ubicaciones -->
        @for($i = 1; $i <= 4; $i++)
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="location_custom_field_{{ $i }}">{{ __('lang_v1.location_custom_field' . $i) }}</label>
                    <input type="text" 
                           name="custom_labels[location][custom_field_{{ $i }}]" 
                           id="location_custom_field_{{ $i }}"
                           class="form-control"
                           value="{{ !empty($custom_labels['location']['custom_field_' . $i]) ? $custom_labels['location']['custom_field_' . $i] : null }}">
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de usuarios -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_user_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de usuarios -->
        @for($i = 1; $i <= 4; $i++)
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="user_custom_field_{{ $i }}">{{ __('lang_v1.user_custom_field' . $i) }}</label>
                    <input type="text" 
                           name="custom_labels[user][custom_field_{{ $i }}]" 
                           id="user_custom_field_{{ $i }}"
                           class="form-control"
                           value="{{ !empty($custom_labels['user']['custom_field_' . $i]) ? $custom_labels['user']['custom_field_' . $i] : null }}">
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de compras -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_purchase_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de compras -->
        @for($i = 1; $i <= 4; $i++)
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="purchase_custom_field_{{ $i }}">{{ __('lang_v1.product_custom_field' . $i) }}</label>
                    <div class="input-group">
                        <input type="text" 
                               name="custom_labels[purchase][custom_field_{{ $i }}]" 
                               id="purchase_custom_field_{{ $i }}"
                               class="form-control"
                               value="{{ !empty($custom_labels['purchase']['custom_field_' . $i]) ? $custom_labels['purchase']['custom_field_' . $i] : null }}">
                        <div class="input-group-addon">
                            <label>
                                <input type="checkbox" 
                                       name="custom_labels[purchase][is_custom_field_{{ $i }}_required]" 
                                       value="1" 
                                       {{ !empty($custom_labels['purchase']['is_custom_field_' . $i . '_required']) && $custom_labels['purchase']['is_custom_field_' . $i . '_required'] == 1 ? 'checked' : '' }}>
                                @lang('lang_v1.is_required')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de envío de compras -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_purchase_shipping_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de envío de compras -->
        @for($i = 1; $i <= 5; $i++)
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="purchase_shipping_custom_field_{{ $i }}">{{ __('lang_v1.custom_field', ['number' => $i]) }}</label>
                    <div class="input-group">
                        <input type="text" 
                               name="custom_labels[purchase_shipping][custom_field_{{ $i }}]" 
                               id="purchase_shipping_custom_field_{{ $i }}"
                               class="form-control"
                               value="{{ !empty($custom_labels['purchase_shipping']['custom_field_' . $i]) ? $custom_labels['purchase_shipping']['custom_field_' . $i] : null }}">
                        <div class="input-group-addon">
                            <label>
                                <input type="checkbox" 
                                       name="custom_labels[purchase_shipping][is_custom_field_{{ $i }}_required]" 
                                       value="1" 
                                       {{ !empty($custom_labels['purchase_shipping']['is_custom_field_' . $i . '_required']) && $custom_labels['purchase_shipping']['is_custom_field_' . $i . '_required'] == 1 ? 'checked' : '' }}>
                                @lang('lang_v1.is_required')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de ventas -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_sell_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de ventas -->
        @for($i = 1; $i <= 4; $i++)
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="sell_custom_field_{{ $i }}">{{ __('lang_v1.product_custom_field' . $i) }}</label>
                    <div class="input-group">
                        <input type="text" 
                               name="custom_labels[sell][custom_field_{{ $i }}]" 
                               id="sell_custom_field_{{ $i }}"
                               class="form-control"
                               value="{{ !empty($custom_labels['sell']['custom_field_' . $i]) ? $custom_labels['sell']['custom_field_' . $i] : null }}">
                        <div class="input-group-addon">
                            <label>
                                <input type="checkbox" 
                                       name="custom_labels[sell][is_custom_field_{{ $i }}_required]" 
                                       value="1" 
                                       {{ !empty($custom_labels['sell']['is_custom_field_' . $i . '_required']) && $custom_labels['sell']['is_custom_field_' . $i . '_required'] == 1 ? 'checked' : '' }}>
                                @lang('lang_v1.is_required')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de envío de ventas -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_sale_shipping_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de envío de ventas -->
        @for($i = 1; $i <= 5; $i++)
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="shipping_custom_field_{{ $i }}">{{ __('lang_v1.custom_field', ['number' => $i]) }}</label>
                    <div class="input-group">
                        <input type="text" 
                               name="custom_labels[shipping][custom_field_{{ $i }}]" 
                               id="shipping_custom_field_{{ $i }}"
                               class="form-control"
                               value="{{ !empty($custom_labels['shipping']['custom_field_' . $i]) ? $custom_labels['shipping']['custom_field_' . $i] : null }}">
                        <div class="input-group-addon">
                            <label>
                                <input type="checkbox" 
                                       name="custom_labels[shipping][is_custom_field_{{ $i }}_required]" 
                                       value="1" 
                                       {{ !empty($custom_labels['shipping']['is_custom_field_' . $i . '_required']) && $custom_labels['shipping']['is_custom_field_' . $i . '_required'] == 1 ? 'checked' : '' }}>
                                @lang('lang_v1.is_required')
                            </label>
                            &nbsp;
                            <label>
                                <input type="checkbox" 
                                       name="custom_labels[shipping][is_custom_field_{{ $i }}_contact_default]" 
                                       value="1" 
                                       {{ !empty($custom_labels['shipping']['is_custom_field_' . $i . '_contact_default']) && $custom_labels['shipping']['is_custom_field_' . $i . '_contact_default'] == 1 ? 'checked' : '' }}>
                                @lang('lang_v1.is_default_for_contact')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

        <div class="clearfix"></div>

        <!-- Sección de etiquetas para campos personalizados de tipos de servicio -->
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_types_of_service_custom_fields'):</h4>
        </div>

        <!-- Campos personalizados de tipos de servicio -->
        @for($i = 1; $i <= 6; $i++)
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="types_of_service_custom_field_{{ $i }}">{{ __('lang_v1.service_custom_field' . ($i <= 4 ? '_' . $i : ''), ['number' => $i]) }}</label>
                    <input type="text" 
                           name="custom_labels[types_of_service][custom_field_{{ $i }}]" 
                           id="types_of_service_custom_field_{{ $i }}"
                           class="form-control"
                           value="{{ !empty($custom_labels['types_of_service']['custom_field_' . $i]) ? $custom_labels['types_of_service']['custom_field_' . $i] : null }}">
                </div>
            </div>
        @endfor
    </div>
</div>