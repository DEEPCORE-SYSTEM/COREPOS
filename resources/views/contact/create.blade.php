<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        @php
        $form_id = 'contact_add_form';
        if(isset($quick_add)){
        $form_id = 'quick_add_contact';
        }

        if(isset($store_action)) {
        $url = $store_action;
        $type = 'lead';
        $customer_groups = [];
        } else {
        $url = action('ContactController@store');
        $type = isset($selected_type) ? $selected_type : '';
        $sources = [];
        $life_stages = [];
        $users = [];
        }
        @endphp
        <form action="{{ $url }}" method="POST" id="{{ $form_id }}">
            @csrf



            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang('contact.add_contact')</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 contact_type_div">
                        <div class="form-group">

                            <label for="type">{{__('contact.contact_type')}}:*</label>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <select name="type" id="contact_type" class="form-control" required>
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($types as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $type ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-15">
                        <label class="radio-inline">
                            <input type="radio" name="contact_type_radio" id="inlineRadio1" value="individual">
                            @lang('lang_v1.individual')
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="contact_type_radio" id="inlineRadio2" value="business">
                            @lang('business.business')
                        </label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contact_id">{{ __('lang_v1.contact_id') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-id-badge"></i>
                                </span>
                                <input type="text" name="contact_id" id="contact_id" class="form-control"
                                    placeholder="{{ __('lang_v1.contact_id') }}">
                            </div>
                            <p class="help-block">
                                {{ __('lang_v1.leave_empty_to_autogenerate') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 customer_fields">
                        <div class="form-group">
                            <label for="customer_group_id">{{ __('lang_v1.customer_group') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <select name="customer_group_id" id="customer_group_id" class="form-control">
                                    @foreach($customer_groups as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix customer_fields"></div>
                    <div class="col-md-4 business" style="display: none;">
                        <div class="form-group">
                            <label for="supplier_business_name">{{ __('business.business_name') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-briefcase"></i>
                                </span>
                                <input type="text" name="supplier_business_name" id="supplier_business_name"
                                    class="form-control" placeholder="{{ __('business.business_name') }}">
                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>

                    <div class="col-md-3 individual" style="display: none;">
                        <div class="form-group">
                            <label for="prefix">{{ __('business.prefix') }}:</label>
                            <input type="text" name="prefix" id="prefix" class="form-control"
                                placeholder="{{ __('business.prefix_placeholder') }}">
                        </div>
                    </div>

                    <div class="col-md-3 individual" style="display: none;">
                        <div class="form-group">
                            <label for="first_name">{{ __('business.first_name') }}:*</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required
                                placeholder="{{ __('business.first_name') }}">
                        </div>
                    </div>

                    <div class="col-md-3 individual" style="display: none;">
                        <div class="form-group">
                            <label for="middle_name">{{ __('lang_v1.middle_name') }}:</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control"
                                placeholder="{{ __('lang_v1.middle_name') }}">
                        </div>
                    </div>

                    <div class="col-md-3 individual" style="display: none;">
                        <div class="form-group">
                            <label for="last_name">{{ __('business.last_name') }}:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="{{ __('business.last_name') }}">
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mobile">{{ __('contact.mobile') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-mobile"></i>
                                </span>
                                <input type="text" name="mobile" id="mobile" class="form-control" required
                                    placeholder="{{ __('contact.mobile') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="alternate_number">{{ __('contact.alternate_contact_number') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" name="alternate_number" id="alternate_number" class="form-control"
                                    placeholder="{{ __('contact.alternate_contact_number') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">{{ __('contact.landline') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" name="landline" id="landline" class="form-control"
                                    placeholder="{{ __('contact.landline') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">{{ __('business.email') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="{{ __('business.email') }}">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-4 individual" style="display: none;">
                        <div class="form-group">
                            <label for="dob">{{ __('lang_v1.dob') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="dob" id="dob" class="form-control dob-date-picker"
                                    placeholder="{{ __('lang_v1.dob') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- lead additional field -->
                    <div class="col-md-4 lead_additional_div">
                        <div class="form-group">
                            <label for="crm_source">{{ __('lang_v1.source') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa fa-search"></i>
                                </span>
                                <select name="crm_source" id="crm_source" class="form-control">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach ($sources as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 lead_additional_div">
                        <div class="form-group">
                            <label for="crm_life_stage">{{ __('lang_v1.life_stage') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa fa-life-ring"></i>
                                </span>
                                <select name="crm_life_stage" id="crm_life_stage" class="form-control">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach ($life_stages as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 lead_additional_div">
                        <div class="form-group">
                            <label for="user_id">{{ __('lang_v1.assigned_to') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <select name="user_id[]" id="user_id" class="form-control select2" multiple required
                                    style="width: 100%;">
                                    @foreach ($users as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary center-block more_btn"
                            data-target="#more_div">@lang('lang_v1.more_info') <i
                                class="fa fa-chevron-down"></i></button>
                    </div>

                    <div id="more_div" class="hide">
                        <input type="hidden" name="position" id="position">

                        <div class="col-md-12">
                            <hr />
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tax_number">{{ __('contact.tax_no') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    <input type="text" name="tax_number" id="tax_number" class="form-control"
                                        placeholder="{{ __('contact.tax_no') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 opening_balance">
                            <div class="form-group">
                                <label for="opening_balance">{{ __('lang_v1.opening_balance') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </span>
                                    <input type="text" name="opening_balance" id="opening_balance"
                                        class="form-control input_number" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 pay_term">
                            <div class="form-group">
                                <div class="multi-input">
                                    <label for="pay_term_number">{{ __('contact.pay_term') }}:</label>
                                    @show_tooltip(__('tooltip.pay_term'))
                                    <br />
                                    <input type="number" name="pay_term_number" id="pay_term_number"
                                        class="form-control width-40 pull-left"
                                        placeholder="{{ __('contact.pay_term') }}">

                                    <select name="pay_term_type" id="pay_term_type"
                                        class="form-control width-60 pull-left">
                                        <option value="">{{ __('messages.please_select') }}</option>
                                        <option value="months">{{ __('lang_v1.months') }}</option>
                                        <option value="days">{{ __('lang_v1.days') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        @php
                        $common_settings = session()->get('business.common_settings');
                        $default_credit_limit = !empty($common_settings['default_credit_limit']) ?
                        $common_settings['default_credit_limit'] : null;
                        @endphp
                        <div class="col-md-4 customer_fields">
                            <div class="form-group">
                                <label for="credit_limit">{{ __('lang_v1.credit_limit') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </span>
                                    <input type="text" name="credit_limit" id="credit_limit"
                                        class="form-control input_number" value="{{ $default_credit_limit ?? '' }}">
                                </div>
                                <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr />
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_line_1">{{ __('lang_v1.address_line_1') }}:</label>
                                <input type="text" name="address_line_1" id="address_line_1" class="form-control"
                                    placeholder="{{ __('lang_v1.address_line_1') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_line_2">{{ __('lang_v1.address_line_2') }}:</label>
                                <input type="text" name="address_line_2" id="address_line_2" class="form-control"
                                    placeholder="{{ __('lang_v1.address_line_2') }}">
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">{{ __('business.city') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="{{ __('business.city') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state">{{ __('business.state') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" name="state" id="state" class="form-control"
                                        placeholder="{{ __('business.state') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country">{{ __('business.country') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                    </span>
                                    <input type="text" name="country" id="country" class="form-control"
                                        placeholder="{{ __('business.country') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zip_code">{{ __('business.zip_code') }}:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" name="zip_code" id="zip_code" class="form-control"
                                        placeholder="{{ __('business.zip_code_placeholder') }}">
                                </div>
                            </div>
                        </div>


                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <hr />
                        </div>
                        @php
                        $custom_labels = json_decode(session('business.custom_labels'), true);
                        $contact_custom_field1 = !empty($custom_labels['contact']['custom_field_1']) ?
                        $custom_labels['contact']['custom_field_1'] : __('lang_v1.contact_custom_field1');
                        $contact_custom_field2 = !empty($custom_labels['contact']['custom_field_2']) ?
                        $custom_labels['contact']['custom_field_2'] : __('lang_v1.contact_custom_field2');
                        $contact_custom_field3 = !empty($custom_labels['contact']['custom_field_3']) ?
                        $custom_labels['contact']['custom_field_3'] : __('lang_v1.contact_custom_field3');
                        $contact_custom_field4 = !empty($custom_labels['contact']['custom_field_4']) ?
                        $custom_labels['contact']['custom_field_4'] : __('lang_v1.contact_custom_field4');
                        $contact_custom_field5 = !empty($custom_labels['contact']['custom_field_5']) ?
                        $custom_labels['contact']['custom_field_5'] : __('lang_v1.custom_field', ['number' => 5]);
                        $contact_custom_field6 = !empty($custom_labels['contact']['custom_field_6']) ?
                        $custom_labels['contact']['custom_field_6'] : __('lang_v1.custom_field', ['number' => 6]);
                        $contact_custom_field7 = !empty($custom_labels['contact']['custom_field_7']) ?
                        $custom_labels['contact']['custom_field_7'] : __('lang_v1.custom_field', ['number' => 7]);
                        $contact_custom_field8 = !empty($custom_labels['contact']['custom_field_8']) ?
                        $custom_labels['contact']['custom_field_8'] : __('lang_v1.custom_field', ['number' => 8]);
                        $contact_custom_field9 = !empty($custom_labels['contact']['custom_field_9']) ?
                        $custom_labels['contact']['custom_field_9'] : __('lang_v1.custom_field', ['number' => 9]);
                        $contact_custom_field10 = !empty($custom_labels['contact']['custom_field_10']) ?
                        $custom_labels['contact']['custom_field_10'] : __('lang_v1.custom_field', ['number' => 10]);
                        @endphp
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field1">{{ $contact_custom_field1 }}:</label>
                                <input type="text" name="custom_field1" id="custom_field1" class="form-control"
                                    placeholder="{{ $contact_custom_field1 }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field2">{{ $contact_custom_field2 }}:</label>
                                <input type="text" name="custom_field2" id="custom_field2" class="form-control"
                                    placeholder="{{ $contact_custom_field2 }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field3">{{ $contact_custom_field3 }}:</label>
                                <input type="text" name="custom_field3" id="custom_field3" class="form-control"
                                    placeholder="{{ $contact_custom_field3 }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field4">{{ $contact_custom_field4 }}:</label>
                                <input type="text" name="custom_field4" id="custom_field4" class="form-control"
                                    placeholder="{{ $contact_custom_field4 }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field5">{{ $contact_custom_field5 }}:</label>
                                <input type="text" name="custom_field5" id="custom_field5" class="form-control"
                                    placeholder="{{ $contact_custom_field5 }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field6">{{ $contact_custom_field6 }}:</label>
                                <input type="text" name="custom_field6" id="custom_field6" class="form-control"
                                    placeholder="{{ $contact_custom_field6 }}">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field7">{{ $contact_custom_field7 }}:</label>
                                <input type="text" name="custom_field7" id="custom_field7" class="form-control"
                                    placeholder="{{ $contact_custom_field7 }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field8">{{ $contact_custom_field8 }}:</label>
                                <input type="text" name="custom_field8" id="custom_field8" class="form-control"
                                    placeholder="{{ $contact_custom_field8 }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field9">{{ $contact_custom_field9 }}:</label>
                                <input type="text" name="custom_field9" id="custom_field9" class="form-control"
                                    placeholder="{{ $contact_custom_field9 }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="custom_field10">{{ $contact_custom_field10 }}:</label>
                                <input type="text" name="custom_field10" id="custom_field10" class="form-control"
                                    placeholder="{{ $contact_custom_field10 }}">
                            </div>
                        </div>

                        <div class="col-md-12 shipping_addr_div">
                            <hr>
                        </div>

                        <div class="col-md-8 col-md-offset-2 shipping_addr_div mb-10">
                            <strong>{{ __('lang_v1.shipping_address') }}</strong><br>
                            <input type="text" name="shipping_address" id="shipping_address" class="form-control"
                                placeholder="{{ __('lang_v1.search_address') }}">
                            <div class="mb-10" id="map"></div>
                        </div>

                        @php
                        $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ?
                        $custom_labels['shipping']['custom_field_1'] : '';

                        $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ?
                        $custom_labels['shipping']['custom_field_2'] : '';

                        $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ?
                        $custom_labels['shipping']['custom_field_3'] : '';

                        $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ?
                        $custom_labels['shipping']['custom_field_4'] : '';

                        $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ?
                        $custom_labels['shipping']['custom_field_5'] : '';
                        @endphp

                        @if(!empty($custom_labels['shipping']['is_custom_field_1_contact_default']) &&
                        !empty($shipping_custom_label_1))
                        @php
                        $label_1 = $shipping_custom_label_1 . ':';
                        @endphp

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipping_custom_field_1">{{ $label_1 }}</label>
                                <input type="text" name="shipping_custom_field_details[shipping_custom_field_1]"
                                    id="shipping_custom_field_1" class="form-control"
                                    placeholder="{{ $shipping_custom_label_1 }}">
                            </div>
                        </div>

                        @endif
                        @if(!empty($custom_labels['shipping']['is_custom_field_2_contact_default']) &&
                        !empty($shipping_custom_label_2))
                        @php
                        $label_2 = $shipping_custom_label_2 . ':';
                        @endphp

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipping_custom_field_2">{{ $label_2 }}</label>
                                <input type="text" name="shipping_custom_field_details[shipping_custom_field_2]"
                                    id="shipping_custom_field_2" class="form-control"
                                    placeholder="{{ $shipping_custom_label_2 }}">
                            </div>
                        </div>

                        @endif
                        @if(!empty($custom_labels['shipping']['is_custom_field_3_contact_default']) &&
                        !empty($shipping_custom_label_3))
                        @php
                        $label_3 = $shipping_custom_label_3 . ':';
                        @endphp

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipping_custom_field_3">{{ $label_3 }}</label>
                                <input type="text" name="shipping_custom_field_details[shipping_custom_field_3]"
                                    id="shipping_custom_field_3" class="form-control"
                                    placeholder="{{ $shipping_custom_label_3 }}">
                            </div>
                        </div>

                        @endif
                        @if(!empty($custom_labels['shipping']['is_custom_field_4_contact_default']) &&
                        !empty($shipping_custom_label_4))
                        @php
                        $label_4 = $shipping_custom_label_4 . ':';
                        @endphp

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipping_custom_field_4">{{ $label_4 }}</label>
                                <input type="text" name="shipping_custom_field_details[shipping_custom_field_4]"
                                    id="shipping_custom_field_4" class="form-control"
                                    placeholder="{{ $shipping_custom_label_4 }}">
                            </div>
                        </div>

                        @endif
                        @if(!empty($custom_labels['shipping']['is_custom_field_5_contact_default']) &&
                        !empty($shipping_custom_label_5))
                        @php
                        $label_5 = $shipping_custom_label_5 . ':';
                        @endphp

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipping_custom_field_5">{{ $label_5 }}</label>
                                <input type="text" name="shipping_custom_field_details[shipping_custom_field_5]"
                                    id="shipping_custom_field_5" class="form-control"
                                    placeholder="{{ $shipping_custom_label_5 }}">
                            </div>
                        </div>

                        @endif
                        @if(!empty($common_settings['is_enabled_export']))
                        <div class="col-md-12 mb-12">
                            <div class="form-check">
                                <input type="checkbox" name="is_export" class="form-check-input"
                                    id="is_customer_export">
                                <label class="form-check-label"
                                    for="is_customer_export">@lang('lang_v1.is_export')</label>
                            </div>
                        </div>
                        @php
                        $i = 1;
                        @endphp
                        @for($i; $i <= 6 ; $i++) <div class="col-md-4 export_div" style="display: none;">
                            <div class="form-group">
                                <label
                                    for="export_custom_field_{{ $i }}">{{ __('lang_v1.export_custom_field'.$i) }}:</label>
                                <input type="text" name="export_custom_field_{{ $i }}" id="export_custom_field_{{ $i }}"
                                    class="form-control" placeholder="{{ __('lang_v1.export_custom_field'.$i) }}">
                            </div>
                    </div>

                    @endfor
                    @endif
                </div>
            </div>
            @include('layouts.partials.module_form_part')
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    </form>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->