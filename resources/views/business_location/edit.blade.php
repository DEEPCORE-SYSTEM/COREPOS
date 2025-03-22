<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <!-- Formulario para actualizar la ubicación del negocio -->
        <form action="{{ action('BusinessLocationController@update', [$location->id]) }}" method="POST"
            id="business_location_add_form">
            @csrf
            @method('PUT')

            <!-- Campo oculto para almacenar el ID de la ubicación -->
            <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $location->id }}">

            <!-- Aquí puedes seguir agregando los demás campos del formulario -->
        </form>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang( 'business.edit_business_location' )</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="name">{{ __('invoice.name') }}:*</label>
                        <input type="text" name="name" value="{{ $location->name }}" class="form-control" required
                            placeholder="{{ __('invoice.name') }}">
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="location_id">{{ __('lang_v1.location_id') }}:</label>
                        <input type="text" name="location_id" value="{{ $location->location_id }}" class="form-control"
                            placeholder="{{ __('lang_v1.location_id') }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="landmark">{{ __('business.landmark') }}:</label>
                        <input type="text" name="landmark" value="{{ $location->landmark }}" class="form-control"
                            placeholder="{{ __('business.landmark') }}">
                    </div>
                </div>

                <div class="clearfix"></div>

                @php
                $fields = [
                'city' => __('business.city'),
                'zip_code' => __('business.zip_code'),
                'state' => __('business.state'),
                'country' => __('business.country'),
                ];
                @endphp

                @foreach ($fields as $field => $label)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="{{ $field }}">{{ $label }}:*</label>
                        <input type="text" name="{{ $field }}" value="{{ $location->$field }}" class="form-control"
                            placeholder="{{ $label }}" required>
                    </div>
                </div>
                @endforeach

                <div class="clearfix"></div>

                @php
                $contactFields = [
                'mobile' => __('business.mobile'),
                'alternate_number' => __('business.alternate_number'),
                'email' => __('business.email'),
                'website' => __('lang_v1.website'),
                ];
                @endphp

                @foreach ($contactFields as $field => $label)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="{{ $field }}">{{ $label }}:</label>
                        <input type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                            value="{{ $location->$field }}" class="form-control" placeholder="{{ $label }}">
                    </div>
                </div>
                @endforeach

                <div class="clearfix"></div>

                @php
                $selectFields = [
                'invoice_scheme_id' => $invoice_schemes,
                'invoice_layout_id' => $invoice_layouts,
                'sale_invoice_layout_id' => $invoice_layouts,
                'selling_price_group_id' => $price_groups,
                ];
                @endphp

                @foreach ($selectFields as $field => $options)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="{{ $field }}">{{ __('lang_v1.' . str_replace('_', ' ', $field)) }}:*</label>
                        <select name="{{ $field }}" class="form-control" required>
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach ($options as $key => $value)
                            <option value="{{ $key }}" {{ $location->$field == $key ? 'selected' : '' }}>{{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach

                <div class="clearfix"></div>

                @php
                $custom_labels = json_decode(session('business.custom_labels'), true);
                $custom_fields = [
                'custom_field1' => $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1'),
                'custom_field2' => $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2'),
                'custom_field3' => $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3'),
                'custom_field4' => $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4'),
                ];
                @endphp

                @foreach ($custom_fields as $field => $label)
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="{{ $field }}">{{ $label }}:</label>
                        <input type="text" name="{{ $field }}" value="{{ $location->$field }}" class="form-control"
                            placeholder="{{ $label }}">
                    </div>
                </div>
                @endforeach

                <div class="clearfix"></div>
                <hr>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="featured_products">{{ __('lang_v1.pos_screen_featured_products') }}:</label>
                        <select name="featured_products[]" class="form-control" id="featured_products" multiple>
                            @foreach ($featured_products as $key => $value)
                            <option value="{{ $key }}"
                                {{ in_array($key, $location->featured_products ?? []) ? 'selected' : '' }}>{{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="clearfix"></div>
                <hr>

                <div class="col-sm-12">
                    <strong>{{ __('lang_v1.payment_options') }}</strong>
                    <div class="form-group">
                        <table class="table table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('lang_v1.payment_method') }}</th>
                                    <th class="text-center">{{ __('lang_v1.enable') }}</th>
                                    <th class="text-center @if(empty($accounts)) hide @endif">
                                        {{ __('lang_v1.default_accounts') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $default_payment_accounts = json_decode($location->default_payment_accounts ?? '{}',
                                true);
                                @endphp
                                @foreach($payment_types as $key => $value)
                                <tr>
                                    <td class="text-center">{{ $value }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" name="default_payment_accounts[{{ $key }}][is_enabled]"
                                            value="1"
                                            {{ !empty($default_payment_accounts[$key]['is_enabled']) ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center @if(empty($accounts)) hide @endif">
                                        <select name="default_payment_accounts[{{ $key }}][account]"
                                            class="form-control input-sm">
                                            <option value="">{{ __('messages.please_select') }}</option>
                                            @foreach ($accounts as $accountKey => $accountValue)
                                            <option value="{{ $accountKey }}"
                                                {{ $default_payment_accounts[$key]['account'] ?? '' == $accountKey ? 'selected' : '' }}>
                                                {{ $accountValue }}
                                            </option>
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