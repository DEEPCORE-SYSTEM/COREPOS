<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{ action('BusinessLocationController@store') }}" method="POST" id="business_location_add_form">
            @csrf
            <!-- Aquí van los demás campos del formulario -->



            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang( 'business.add_business_location' )</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">@lang('invoice.name'):</label>
                            <input type="text" name="name" id="name" class="form-control" required
                                placeholder="@lang('invoice.name')">
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <!-- Campo para ingresar el ID de la ubicación -->
                        <div class="form-group">
                            <label for="location_id">@lang('lang_v1.location_id'):</label>
                            <input type="text" name="location_id" id="location_id" class="form-control"
                                placeholder="@lang('lang_v1.location_id')">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Campo para ingresar un punto de referencia -->
                        <div class="form-group">
                            <label for="landmark">@lang('business.landmark'):</label>
                            <input type="text" name="landmark" id="landmark" class="form-control"
                                placeholder="@lang('business.landmark')">
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <!-- Campo obligatorio para ingresar la ciudad -->
                        <div class="form-group">
                            <label for="city">@lang('business.city'):</label>
                            <input type="text" name="city" id="city" class="form-control"
                                placeholder="@lang('business.city')" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Campo obligatorio para ingresar el código postal -->
                        <div class="form-group">
                            <label for="zip_code">@lang('business.zip_code'):</label>
                            <input type="text" name="zip_code" id="zip_code" class="form-control"
                                placeholder="@lang('business.zip_code')" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <!-- Campo obligatorio para ingresar el estado o provincia -->
                        <div class="form-group">
                            <label for="state">@lang('business.state'):</label>
                            <input type="text" name="state" id="state" class="form-control"
                                placeholder="@lang('business.state')" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Campo obligatorio para ingresar el país -->
                        <div class="form-group">
                            <label for="country">@lang('business.country'):</label>
                            <input type="text" name="country" id="country" class="form-control"
                                placeholder="@lang('business.country')" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <!-- Campo opcional para ingresar un número de celular -->
                        <div class="form-group">
                            <label for="mobile">@lang('business.mobile'):</label>
                            <input type="text" name="mobile" id="mobile" class="form-control"
                                placeholder="@lang('business.mobile')">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Campo opcional para ingresar un número de teléfono alternativo -->
                        <div class="form-group">
                            <label for="alternate_number">@lang('business.alternate_number'):</label>
                            <input type="text" name="alternate_number" id="alternate_number" class="form-control"
                                placeholder="@lang('business.alternate_number')">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <!-- Campo para ingresar el correo electrónico -->
                        <div class="form-group">
                            <label for="email">@lang('business.email'):</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="@lang('business.email')">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Campo para ingresar la página web -->
                        <div class="form-group">
                            <label for="website">@lang('lang_v1.website'):</label>
                            <input type="text" name="website" id="website" class="form-control"
                                placeholder="@lang('lang_v1.website')">
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <!-- Selección de esquema de facturación -->
                        <div class="form-group">
                            <label for="invoice_scheme_id">@lang('invoice.invoice_scheme'):</label>
                            <span data-toggle="tooltip" title="@lang('tooltip.invoice_scheme')">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <select name="invoice_scheme_id" id="invoice_scheme_id" class="form-control" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($invoice_schemes as $id => $scheme)
                                <option value="{{ $id }}">{{ $scheme }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Selección del diseño de factura para POS -->
                        <div class="form-group">
                            <label for="invoice_layout_id">@lang('lang_v1.invoice_layout_for_pos'):</label>
                            <span data-toggle="tooltip" title="@lang('tooltip.invoice_layout')">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <select name="invoice_layout_id" id="invoice_layout_id" class="form-control" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($invoice_layouts as $id => $layout)
                                <option value="{{ $id }}">{{ $layout }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Selección del diseño de factura para ventas -->
                        <div class="form-group">
                            <label for="sale_invoice_layout_id">@lang('lang_v1.invoice_layout_for_sale'):</label>
                            <span data-toggle="tooltip" title="@lang('lang_v1.invoice_layout_for_sale_tooltip')">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <select name="sale_invoice_layout_id" id="sale_invoice_layout_id" class="form-control"
                                required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($invoice_layouts as $id => $layout)
                                <option value="{{ $id }}">{{ $layout }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- Selección del grupo de precios predeterminado -->
                        <div class="form-group">
                            <label for="selling_price_group_id">@lang('lang_v1.default_selling_price_group'):</label>
                            <span data-toggle="tooltip" title="@lang('lang_v1.location_price_group_help')">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <select name="selling_price_group_id" id="selling_price_group_id" class="form-control">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($price_groups as $id => $group)
                                <option value="{{ $id }}">{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    @php
                    $custom_labels = json_decode(session('business.custom_labels'), true);
                    $location_custom_field1 = !empty($custom_labels['location']['custom_field_1']) ?
                    $custom_labels['location']['custom_field_1'] : __('lang_v1.location_custom_field1');
                    $location_custom_field2 = !empty($custom_labels['location']['custom_field_2']) ?
                    $custom_labels['location']['custom_field_2'] : __('lang_v1.location_custom_field2');
                    $location_custom_field3 = !empty($custom_labels['location']['custom_field_3']) ?
                    $custom_labels['location']['custom_field_3'] : __('lang_v1.location_custom_field3');
                    $location_custom_field4 = !empty($custom_labels['location']['custom_field_4']) ?
                    $custom_labels['location']['custom_field_4'] : __('lang_v1.location_custom_field4');
                    @endphp
                    <div class="col-sm-3">
                        <!-- Campo para el primer campo personalizado -->
                        <div class="form-group">
                            <label for="custom_field1">{{ $location_custom_field1 }}:</label>
                            <input type="text" name="custom_field1" id="custom_field1" class="form-control"
                                placeholder="{{ $location_custom_field1 }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- Campo para el segundo campo personalizado -->
                        <div class="form-group">
                            <label for="custom_field2">{{ $location_custom_field2 }}:</label>
                            <input type="text" name="custom_field2" id="custom_field2" class="form-control"
                                placeholder="{{ $location_custom_field2 }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- Campo para el tercer campo personalizado -->
                        <div class="form-group">
                            <label for="custom_field3">{{ $location_custom_field3 }}:</label>
                            <input type="text" name="custom_field3" id="custom_field3" class="form-control"
                                placeholder="{{ $location_custom_field3 }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- Campo para el cuarto campo personalizado -->
                        <div class="form-group">
                            <label for="custom_field4">{{ $location_custom_field4 }}:</label>
                            <input type="text" name="custom_field4" id="custom_field4" class="form-control"
                                placeholder="{{ $location_custom_field4 }}">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <div class="col-sm-12">
                        <!-- Selección de productos destacados en la pantalla POS -->
                        <div class="form-group">
                            <label for="featured_products">@lang('lang_v1.pos_screen_featured_products'):</label>
                            <span data-toggle="tooltip" title="@lang('lang_v1.featured_products_help')">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <select name="featured_products[]" id="featured_products" class="form-control" multiple>
                                @foreach($featured_products as $id => $product)
                                <option value="{{ $id }}">{{ $product }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-sm-12">
                        <strong>@lang('lang_v1.payment_options'):
                            @show_tooltip(__('lang_v1.payment_option_help'))</strong>
                        <div class="form-group">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">@lang('lang_v1.payment_method')</th>
                                        <th class="text-center">@lang('lang_v1.enable')</th>
                                        <th class="text-center @if(empty($accounts)) hide @endif">
                                            @lang('lang_v1.default_accounts')
                                            @show_tooltip(__('lang_v1.default_account_help'))</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payment_types as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $value }}</td>
                                        <td class="text-center">
                                            <input type="checkbox"
                                                name="default_payment_accounts[{{ $key }}][is_enabled]" value="1"
                                                checked>
                                        </td>
                                        <td class="text-center @if(empty($accounts)) hide @endif">
                                            <select name="default_payment_accounts[{{ $key }}][account]"
                                                class="form-control input-sm">
                                                @foreach($accounts as $accountKey => $accountValue)
                                                <option value="{{ $accountKey }}">{{ $accountValue }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
            </div>

        </form>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->