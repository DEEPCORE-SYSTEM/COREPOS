<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                <input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id'] ?? '' }}">
                <input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name'] ?? '' }}">
                <input type="hidden" id="default_customer_balance" value="{{ $walk_in_customer['balance'] ?? '' }}">
                <input type="hidden" id="default_customer_address" value="{{ $walk_in_customer['shipping_address'] ?? '' }}">

                @if(!empty($walk_in_customer['price_calculation_type']) && $walk_in_customer['price_calculation_type'] == 'selling_price_group')
                    <input type="hidden" id="default_selling_price_group" value="{{ $walk_in_customer['selling_price_group_id'] ?? '' }}">
                @endif

                <select name="contact_id" class="form-control mousetrap" id="customer_id" required style="width: 100%;">
                    <option value="">{{ __('Enter Customer name / phone') }}</option>
                </select>

                <span class="input-group-btn">
                    <button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""
                        @if(!auth()->user()->can('customer.create')) disabled @endif>
                        <i class="fa fa-plus-circle text-primary fa-lg"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal"
                        data-target="#configure_search_modal" title="{{ __('lang_v1.configure_product_search') }}">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>

                <input type="text" name="search_product" class="form-control mousetrap" id="search_product"
                    placeholder="{{ __('lang_v1.search_product_placeholder') }}"
                    @if(is_null($default_location)) disabled @endif
                    @if(!is_null($default_location)) autofocus @endif>

                <span class="input-group-btn">
                    @if(isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1)
                        <button type="button" class="btn btn-default bg-white btn-flat" id="weighing_scale_btn"
                            data-toggle="modal" data-target="#weighing_scale_modal"
                            title="{{ __('lang_v1.weighing_scale') }}">
                            <i class="fa fa-digital-tachograph text-primary fa-lg"></i>
                        </button>
                    @endif

                    <button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product"
                        data-href="{{ action('ProductController@quickAdd') }}"
                        data-container=".quick_add_product_modal">
                        <i class="fa fa-plus-circle text-primary fa-lg"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if(!empty($pos_settings['show_invoice_layout']))
        <div class="col-md-4">
            <div class="form-group">
                <select name="invoice_layout_id" id="invoice_layout_id" class="form-control select2">
                    <option value="">{{ __('lang_v1.select_invoice_layout') }}</option>
                    @foreach($invoice_layouts as $id => $layout)
                        <option value="{{ $id }}" {{ $default_location->invoice_layout_id == $id ? 'selected' : '' }}>
                            {{ $layout }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <input type="hidden" name="pay_term_number" id="pay_term_number" value="{{ $walk_in_customer['pay_term_number'] ?? '' }}">
    <input type="hidden" name="pay_term_type" id="pay_term_type" value="{{ $walk_in_customer['pay_term_type'] ?? '' }}">

    @if(!empty($commission_agent))
        <div class="col-md-4">
            <div class="form-group">
                <select name="commission_agent" class="form-control select2">
                    <option value="">{{ __('lang_v1.commission_agent') }}</option>
                    @foreach($commission_agent as $id => $agent)
                        <option value="{{ $id }}">{{ $agent }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    @if(!empty($pos_settings['enable_transaction_date']))
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" name="transaction_date" id="transaction_date" class="form-control" value="{{ $default_datetime }}" readonly required>
                </div>
            </div>
        </div>
    @endif

    @if(config('constants.enable_sell_in_diff_currency') == true)
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-exchange-alt"></i>
                    </span>
                    <input type="text" name="exchange_rate" id="exchange_rate" class="form-control input-sm input_number"
                        value="{{ config('constants.currency_exchange_rate') }}"
                        placeholder="{{ __('lang_v1.currency_exchange_rate') }}">
                </div>
            </div>
        </div>
    @endif

    @if(!empty($price_groups) && count($price_groups) > 1)
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    @php
                        reset($price_groups);
                        $selected_price_group = !empty($default_price_group_id) && array_key_exists($default_price_group_id, $price_groups) 
                            ? $default_price_group_id 
                            : null;
                    @endphp
                    <input type="hidden" name="hidden_price_group" id="hidden_price_group" value="{{ key($price_groups) }}">
                    <select name="price_group" id="price_group" class="form-control select2">
                        @foreach($price_groups as $id => $group)
                            <option value="{{ $id }}" {{ $selected_price_group == $id ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-addon">
                        @show_tooltip(__('lang_v1.price_group_help_text'))
                    </span>
                </div>
            </div>
        </div>
    @else
        @php reset($price_groups); @endphp
        <input type="hidden" name="price_group" id="price_group" value="{{ key($price_groups) }}">
    @endif

    @if(!empty($default_price_group_id))
        <input type="hidden" name="default_price_group" id="default_price_group" value="{{ $default_price_group_id }}">
    @endif

    @if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
                    </span>
                    <select name="types_of_service_id" id="types_of_service_id" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('lang_v1.select_types_of_service') }}</option>
                        @foreach($types_of_service as $id => $type)
                            <option value="{{ $id }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="types_of_service_price_group" id="types_of_service_price_group">
                    <span class="input-group-addon">
                        @show_tooltip(__('lang_v1.types_of_service_help'))
                    </span>
                </div>
                <small>
                    <p class="help-block hide" id="price_group_text">@lang('lang_v1.price_group'): <span></span></p>
                </small>
            </div>
        </div>
        <div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    @endif

    @if(!empty($pos_settings['show_invoice_scheme']))
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <select name="invoice_scheme_id" class="form-control">
                    <option value="">{{ __('lang_v1.select_invoice_scheme') }}</option>
                    @foreach($invoice_schemes as $id => $scheme)
                        <option value="{{ $id }}" {{ $default_invoice_schemes->id == $id ? 'selected' : '' }}>
                            {{ $scheme }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    @if(in_array('subscription', $enabled_modules))
        <div class="col-md-4 col-sm-6">
            <label>
                <input type="checkbox" name="is_recurring" id="is_recurring" class="input-icheck" value="1">
                @lang('lang_v1.subscribe')?
            </label>
            <button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link">
                <i class="fa fa-external-link-square-alt"></i>
            </button>
            @show_tooltip(__('lang_v1.recurring_invoice_help'))
        </div>
    @endif

    @if(in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules))
        <div class="clearfix"></div>
        <span id="restaurant_module_span">
            <div class="col-md-3"></div>
        </span>
    @endif
</div>


<!-- include module fields -->
@if(!empty($pos_module_data))
@foreach($pos_module_data as $key => $value)
@if(!empty($value['view_path']))
@includeIf($value['view_path'], ['view_data' => $value['view_data']])
@endif
@endforeach
@endif
<div class="row">
    <div class="col-sm-12 pos_product_div">
        <input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{$business_details->sell_price_tax}}">

        <!-- Keeps count of product rows -->
        <input type="hidden" id="product_row_count" value="0">
        @php
        $hide_tax = '';
        if( session()->get('business.enable_inline_tax') == 0){
        $hide_tax = 'hide';
        }
        @endphp
        <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
            <thead>
                <tr>
                    <th
                        class="tex-center @if(!empty($pos_settings['inline_service_staff'])) col-md-3 @else col-md-4 @endif">
                        @lang('sale.product') @show_tooltip(__('lang_v1.tooltip_sell_product_column'))
                    </th>
                    <th class="text-center col-md-3">
                        @lang('sale.qty')
                    </th>
                    @if(!empty($pos_settings['inline_service_staff']))
                    <th class="text-center col-md-2">
                        @lang('restaurant.service_staff')
                    </th>
                    @endif
                    <th class="text-center col-md-2 {{$hide_tax}}">
                        @lang('sale.price_inc_tax')
                    </th>
                    <th class="text-center col-md-2">
                        @lang('sale.subtotal')
                    </th>
                    <th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>