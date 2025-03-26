@extends('layouts.app')

@php
if (!empty($status) && $status == 'quotation') {
$title = __('lang_v1.add_quotation');
} else if (!empty($status) && $status == 'draft') {
$title = __('lang_v1.add_draft');
} else {
$title = __('sale.add_sale');
}

if($sale_type == 'sales_order') {
$title = __('lang_v1.sales_order');
}
@endphp

@section('title', $title)

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{$title}}</h1>
</section>
<!-- Main content -->
<section class="content no-print">
    <input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
    @if(!empty($pos_settings['allow_overselling']))
    <input type="hidden" id="is_overselling_allowed">
    @endif
    @if(session('business.enable_rp') == 1)
    <input type="hidden" id="reward_point_enabled">
    @endif
    @if(count($business_locations) > 0)
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <select name="select_location_id" id="select_location_id" class="form-control input-sm" required
                        autofocus @foreach($bl_attributes ?? [] as $key=> $value)
                        {{ is_array($value) ? $key . '="' . implode(',', $value) . '"' : $key . '="' . $value . '"' }}
                        @endforeach
                        >
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($business_locations as $id => $location)
                        <option value="{{ $id }}"
                            {{ (isset($default_location) && $default_location->id == $id) ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                        @endforeach
                    </select>

                    <span class="input-group-addon">
                        @show_tooltip(__('tooltip.sale_location'))
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endif

    @php
    $custom_labels = json_decode(session('business.custom_labels'), true);
    $common_settings = session()->get('business.common_settings');
    @endphp
    <input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
    <form action="{{ action('SellPosController@store') }}" method="POST" id="add_sell_form"
        enctype="multipart/form-data">
        @csrf


        @if(!empty($sale_type))
        <input type="hidden" id="sale_type" name="type" value="{{$sale_type}}">
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @component('components.widget', ['class' => 'box-solid'])

                <input type="hidden" name="location_id" id="location_id" value="{{ $default_location->id ?? '' }}"
                    data-receipt_printer_type="{{ $default_location->receipt_printer_type ?? 'browser' }}"
                    data-default_payment_accounts="{{ $default_location->default_payment_accounts ?? '' }}">


                @if(!empty($price_groups))
                @if(count($price_groups) > 1)
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            @php
                            reset($price_groups);
                            @endphp
                            <input type="hidden" name="hidden_price_group" id="hidden_price_group"
                                value="{{ key($price_groups) }}">

                            <select name="price_group" id="price_group" class="form-control select2">
                                @foreach($price_groups as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>

                            <span class="input-group-addon">
                                @show_tooltip(__('lang_v1.price_group_help_text'))
                            </span>
                        </div>
                    </div>
                </div>

                @else
                @php
                reset($price_groups);
                @endphp
                <input type="hidden" name="price_group" id="price_group" value="{{ key($price_groups) }}">

                @endif
                @endif

                <input type="hidden" name="default_price_group" id="default_price_group" value="">


                @if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
                            </span>
                            <select name="types_of_service_id" id="types_of_service_id" class="form-control"
                                style="width: 100%;">
                                <option value="">{{ __('lang_v1.select_types_of_service') }}</option>
                                @foreach($types_of_service as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>

                            <input type="hidden" name="types_of_service_price_group" id="types_of_service_price_group"
                                value="">


                            <span class="input-group-addon">
                                @show_tooltip(__('lang_v1.types_of_service_help'))
                            </span>
                        </div>
                        <small>
                            <p class="help-block hide" id="price_group_text">@lang('lang_v1.price_group'): <span></span>
                            </p>
                        </small>
                    </div>
                </div>
                <div class="modal fade types_of_service_modal" tabindex="-1" role="dialog"
                    aria-labelledby="gridSystemModalLabel"></div>
                @endif

                @if(in_array('subscription', $enabled_modules))
                <div class="col-md-4 pull-right col-sm-6">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_recurring" id="is_recurring" class="input-icheck" value="1">

                            @lang('lang_v1.subscribe')?
                        </label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal"
                            class="btn btn-link"><i
                                class="fa fa-external-link"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
                    </div>
                </div>
                @endif
                <div class="clearfix"></div>
                <div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
                    <div class="form-group">
                        <label for="contact_id">{{ __('contact.customer') }}:*</label>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id']}}">
                            <input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name']}}">
                            <input type="hidden" id="default_customer_balance"
                                value="{{ $walk_in_customer['balance'] ?? ''}}">
                            <input type="hidden" id="default_customer_address"
                                value="{{ $walk_in_customer['shipping_address'] ?? ''}}">
                            @if(!empty($walk_in_customer['price_calculation_type']) &&
                            $walk_in_customer['price_calculation_type'] == 'selling_price_group')
                            <input type="hidden" id="default_selling_price_group"
                                value="{{ $walk_in_customer['selling_price_group_id'] ?? ''}}">
                            @endif
                            <select name="contact_id" id="customer_id" class="form-control mousetrap" required>
                                <option value="">{{ __('Enter Customer name / phone') }}</option>
                            </select>

                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_customer"
                                    data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                            </span>
                        </div>
                    </div>
                    <small>
                        <strong>
                            @lang('lang_v1.billing_address'):
                        </strong>
                        <div id="billing_address_div">
                            {!! $walk_in_customer['contact_address'] ?? '' !!}
                        </div>
                        <br>
                        <strong>
                            @lang('lang_v1.shipping_address'):
                        </strong>
                        <div id="shipping_address_div">
                            {{$walk_in_customer['supplier_business_name'] ?? ''}},<br>
                            {{$walk_in_customer['name'] ?? ''}},<br>
                            {{$walk_in_customer['shipping_address'] ?? ''}}
                        </div>
                    </small>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <div class="multi-input">
                            <label for="pay_term_number">{{ __('contact.pay_term') }}:</label>

                            @show_tooltip(__('tooltip.pay_term'))
                            <br />
                            <input type="number" name="pay_term_number" class="form-control width-40 pull-left"
                                placeholder="{{ __('contact.pay_term') }}"
                                value="{{ $walk_in_customer['pay_term_number'] ?? '' }}">

                            <select name="pay_term_type" class="form-control width-60 pull-left">
                                <option value="">{{ __('messages.please_select') }}</option>
                                <option value="months"
                                    {{ ($walk_in_customer['pay_term_type'] ?? '') == 'months' ? 'selected' : '' }}>
                                    {{ __('lang_v1.months') }}
                                </option>
                                <option value="days"
                                    {{ ($walk_in_customer['pay_term_type'] ?? '') == 'days' ? 'selected' : '' }}>
                                    {{ __('lang_v1.days') }}
                                </option>
                            </select>

                        </div>
                    </div>
                </div>

                @if(!empty($commission_agent))
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="commission_agent">{{ __('lang_v1.commission_agent') }}:</label>
                        <select name="commission_agent" id="commission_agent" class="form-control select2">
                            @foreach($commission_agent as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                @endif
                <div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
                    <div class="form-group">
                        <label for="transaction_date">{{ __('sale.sale_date') }}:*</label>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>

                            <input type="text" id="transaction_date" name="transaction_date"
                                value="{{ $default_datetime }}" class="form-control" readonly required>

                        </div>

                    </div>
                </div>
                @if(!empty($status))
                <input type="hidden" name="status" id="status" value="{{$status}}">
                @else
                <div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
                    <div class="form-group">
                        <label for="status">{{ __('sale.status') }}:*</label>
                        <select name="status" id="status" class="form-control select2" required>
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($statuses as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                @endif
                @if($sale_type != 'sales_order')
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="invoice_scheme_id">{{ __('invoice.invoice_scheme') }}:</label>
                        <select name="invoice_scheme_id" id="invoice_scheme_id" class="form-control select2">
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($invoice_schemes as $key => $value)
                            <option value="{{ $key }}"
                                {{ isset($default_invoice_schemes) && $default_invoice_schemes->id == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                @endif
                @can('edit_invoice_number')
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="invoice_no">
                            {{ $sale_type == 'sales_order' ? __('restaurant.order_no') : __('sale.invoice_no') }}:
                        </label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                            placeholder="{{ $sale_type == 'sales_order' ? __('restaurant.order_no') : __('sale.invoice_no') }}">

                        <p class="help-block">@lang('lang_v1.keep_blank_to_autogenerate')</p>
                    </div>
                </div>
                @endcan

                @php
                $custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ?
                $custom_labels['sell']['custom_field_1'] : '';

                $is_custom_field_1_required = !empty($custom_labels['sell']['is_custom_field_1_required']) &&
                $custom_labels['sell']['is_custom_field_1_required'] == 1 ? true : false;

                $custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ?
                $custom_labels['sell']['custom_field_2'] : '';

                $is_custom_field_2_required = !empty($custom_labels['sell']['is_custom_field_2_required']) &&
                $custom_labels['sell']['is_custom_field_2_required'] == 1 ? true : false;

                $custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ?
                $custom_labels['sell']['custom_field_3'] : '';

                $is_custom_field_3_required = !empty($custom_labels['sell']['is_custom_field_3_required']) &&
                $custom_labels['sell']['is_custom_field_3_required'] == 1 ? true : false;

                $custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ?
                $custom_labels['sell']['custom_field_4'] : '';

                $is_custom_field_4_required = !empty($custom_labels['sell']['is_custom_field_4_required']) &&
                $custom_labels['sell']['is_custom_field_4_required'] == 1 ? true : false;
                @endphp
                @if(!empty($custom_field_1_label))
                @php
                $label_1 = $custom_field_1_label . ':';
                if($is_custom_field_1_required) {
                $label_1 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="custom_field_1">{{ $label_1 }}</label>
                        <input type="text" name="custom_field_1" id="custom_field_1" class="form-control"
                            placeholder="{{ $custom_field_1_label }}"
                            {{ $is_custom_field_1_required ? 'required' : '' }}>

                    </div>
                </div>
                @endif
                @if(!empty($custom_field_2_label))
                @php
                $label_2 = $custom_field_2_label . ':';
                if($is_custom_field_2_required) {
                $label_2 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="custom_field_2">{{ $label_2 }}</label>
                        <input type="text" name="custom_field_2" id="custom_field_2" class="form-control"
                            placeholder="{{ $custom_field_2_label }}"
                            {{ $is_custom_field_2_required ? 'required' : '' }}>

                    </div>
                </div>
                @endif
                @if(!empty($custom_field_3_label))
                @php
                $label_3 = $custom_field_3_label . ':';
                if($is_custom_field_3_required) {
                $label_3 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="custom_field_3">{{ $label_3 }}</label>
                        <input type="text" name="custom_field_3" id="custom_field_3" class="form-control"
                            placeholder="{{ $custom_field_3_label }}"
                            {{ $is_custom_field_3_required ? 'required' : '' }}>

                    </div>
                </div>
                @endif
                @if(!empty($custom_field_4_label))
                @php
                $label_4 = $custom_field_4_label . ':';
                if($is_custom_field_4_required) {
                $label_4 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="custom_field_4">{{ $label_4 }}</label>
                        <input type="text" name="custom_field_4" id="custom_field_4" class="form-control"
                            placeholder="{{ $custom_field_4_label }}"
                            {{ $is_custom_field_4_required ? 'required' : '' }}>

                    </div>
                </div>
                @endif
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="upload_document">{{ __('purchase.attach_document') }}:</label>
                        <input type="file" name="sell_document" id="upload_document"
                            accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">

                        <p class="help-block">
                            @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                            1000000)])
                            @includeIf('components.document_help_text')
                        </p>
                    </div>
                </div>
                <div class="clearfix"></div>

                @if((!empty($pos_settings['enable_sales_order']) && $sale_type != 'sales_order') ||
                $is_order_request_enabled)
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="sales_order_ids">{{ __('lang_v1.sales_order') }}:</label>
                        <select name="sales_order_ids[]" id="sales_order_ids" class="form-control select2" multiple>
                        </select>

                    </div>
                </div>
                <div class="clearfix"></div>
                @endif
                <!-- Call restaurant module if defined -->
                @if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
                <span id="restaurant_module_span">
                </span>
                @endif
                @endcomponent

                @component('components.widget', ['class' => 'box-solid'])
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal"
                                    data-target="#configure_search_modal"
                                    title="{{__('lang_v1.configure_product_search')}}"><i
                                        class="fas fa-search-plus"></i></button>
                            </div>
                            <input type="text" name="search_product" id="search_product" class="form-control mousetrap"
                                placeholder="{{ __('lang_v1.search_product_placeholder') }}"
                                {{ is_null($default_location) ? 'disabled' : '' }}
                                {{ is_null($default_location) ? '' : 'autofocus' }}>

                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product"
                                    data-href="{{action('ProductController@quickAdd')}}"
                                    data-container=".quick_add_product_modal"><i
                                        class="fa fa-plus-circle text-primary fa-lg"></i></button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row col-sm-12 pos_product_div" style="min-height: 0">

                    <input type="hidden" name="sell_price_tax" id="sell_price_tax"
                        value="{{$business_details->sell_price_tax}}">

                    <!-- Keeps count of product rows -->
                    <input type="hidden" id="product_row_count" value="0">
                    @php
                    $hide_tax = '';
                    if( session()->get('business.enable_inline_tax') == 0){
                    $hide_tax = 'hide';
                    }
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-striped table-responsive"
                            id="pos_table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        @lang('sale.product')
                                    </th>
                                    <th class="text-center">
                                        @lang('sale.qty')
                                    </th>
                                    @if(!empty($pos_settings['inline_service_staff']))
                                    <th class="text-center">
                                        @lang('restaurant.service_staff')
                                    </th>
                                    @endif
                                    <th @can('edit_product_price_from_sale_screen')) hide @endcan>
                                        @lang('sale.unit_price')
                                    </th>
                                    <th @can('edit_product_discount_from_sale_screen') hide @endcan>
                                        @lang('receipt.discount')
                                    </th>
                                    <th class="text-center {{$hide_tax}}">
                                        @lang('sale.tax')
                                    </th>
                                    <th class="text-center {{$hide_tax}}">
                                        @lang('sale.price_inc_tax')
                                    </th>
                                    @if(!empty($common_settings['enable_product_warranty']))
                                    <th>@lang('lang_v1.warranty')</th>
                                    @endif
                                    <th class="text-center">
                                        @lang('sale.subtotal')
                                    </th>
                                    <th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-striped">
                            <tr>
                                <td>
                                    <div class="pull-right">
                                        <b>@lang('sale.item'):</b>
                                        <span class="total_quantity">0</span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>@lang('sale.total'): </b>
                                        <span class="price_total">0</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endcomponent
                @component('components.widget', ['class' => 'box-solid'])
                <div class="col-md-4  @if($sale_type == 'sales_order') hide @endif">
                    <div class="form-group">

                        <label for="discount_type">{{__('sales.discount_type')}}:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            <label for="discount_type">{{ __('messages.please_select') }}</label>
                            <select name="discount_type" id="discount_type" class="form-control" required
                                data-default="percentage">
                                <option value="">{{ __('messages.please_select') }}</option>
                                <option value="fixed" {{ 'percentage' == 'fixed' ? 'selected' : '' }}>
                                    {{ __('lang_v1.fixed') }}</option>
                                <option value="percentage" {{ 'percentage' == 'percentage' ? 'selected' : '' }}>
                                    {{ __('lang_v1.percentage') }}</option>
                            </select>

                        </div>
                    </div>
                </div>
                @php
                $max_discount = !is_null(auth()->user()->max_sales_discount_percent) ?
                auth()->user()->max_sales_discount_percent : '';

                //if sale discount is more than user max discount change it to max discount
                $sales_discount = $business_details->default_sales_discount;
                if($max_discount != '' && $sales_discount > $max_discount) $sales_discount = $max_discount;

                $default_sales_tax = $business_details->default_sales_tax;

                if($sale_type == 'sales_order') {
                $sales_discount = 0;
                $default_sales_tax = null;
                }
                @endphp
                <div class="col-md-4 @if($sale_type == 'sales_order') hide @endif">
                    <div class="form-group">
                        <label for="discount_amount">{{ __('sale.discount_amount') }}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            <input type="text" name="discount_amount" class="form-control input_number"
                                value="{{ number_format($sales_discount) }}" data-default="{{ $sales_discount }}"
                                data-max-discount="{{ $max_discount }}"
                                data-max-discount-error_msg="{{ __('lang_v1.max_discount_error_msg', ['discount' => $max_discount ? num_format($max_discount) : '']) }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 @if($sale_type == 'sales_order') hide @endif"><br>
                    <b>@lang( 'sale.discount_amount' ):</b>(-)
                    <span class="display_currency" id="total_discount">0</span>
                </div>
                <div class="clearfix"></div>
                <div
                    class="col-md-12 well well-sm bg-light-gray @if(session('business.enable_rp') != 1 || $sale_type == 'sales_order') hide @endif">
                    <input type="hidden" name="rp_redeemed" id="rp_redeemed" value="0">
                    <input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="0">
                    <div class="col-md-12">
                        <h4>{{session('business.rp_name')}}</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rp_redeemed_modal">{{ __('lang_v1.redeemed') }}:</label>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-gift"></i>
                                </span>
                                <input type="number" name="rp_redeemed_modal" value="0"
                                    class="form-control direct_sell_rp_input"
                                    data-amount_per_unit_point="{{ session('business.redeem_amount_per_unit_rp') }}"
                                    min="0" data-max_points="0"
                                    data-min_order_total="{{ session('business.min_order_total_for_redeem') }}">
                                <input type="hidden" id="rp_name" value="{{session('business.rp_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">0</span></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>@lang('lang_v1.redeemed_amount'):</strong> (-)<span
                                id="rp_redeemed_amount_text">0</span></p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4  @if($sale_type == 'sales_order') hide @endif">
                    <div class="form-group">

                        <label for="tax_rate_ide">{{__('sale.order_tax') . ':*' }}</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            <select name="tax_rate_id" id="tax_rate_id" class="form-control"
                                data-default="{{ $default_sales_tax }}" @foreach($taxes['attributes'] ?? [] as $key=>
                                $value)
                                {{ is_array($value) ? $key . '="' . implode(',', $value) . '"' : $key . '="' . $value . '"' }}
                                @endforeach
                                >
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($taxes['tax_rates'] as $id => $rate)
                                <option value="{{ $id }}" {{ ($default_sales_tax == $id) ? 'selected' : '' }}>
                                    {{ $rate }}
                                </option>
                                @endforeach
                            </select>

                            <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount"
                                value="@if(empty($edit)) {{@num_format($business_details->tax_calculation_amount)}} @else {{@num_format(optional($transaction->tax)->amount)}} @endif"
                                data-default="{{$business_details->tax_calculation_amount}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4  @if($sale_type == 'sales_order') hide @endif">
                    <b>@lang( 'sale.order_tax' ):</b>(+)
                    <span class="display_currency" id="order_tax">0</span>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sell_note">{{ __('sale.sell_note') }}</label>
                        <textarea name="sale_note" id="sell_note" class="form-control" rows="3"></textarea>
                    </div>

                </div>
                <input type="hidden" name="is_direct_sale" value="1">
                @endcomponent
                @component('components.widget', ['class' => 'box-solid'])
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_details">{{ __('sale.shipping_details') }}</label>
                        <textarea name="shipping_details" id="shipping_details" class="form-control"
                            placeholder="{{ __('sale.shipping_details') }}" rows="3"></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_address">{{ __('lang_v1.shipping_address') }}</label>
                        <textarea name="shipping_address" id="shipping_address" class="form-control"
                            placeholder="{{ __('lang_v1.shipping_address') }}" rows="3"></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_charges">{{ __('sale.shipping_charges') }}</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            <input type="text" name="shipping_charges" id="shipping_charges"
                                class="form-control input_number" placeholder="{{ __('sale.shipping_charges') }}"
                                value="{{ number_format(0.00, 2) }}">
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_status">{{ __('lang_v1.shipping_status') }}</label>
                        <select name="shipping_status" id="shipping_status" class="form-control">
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($shipping_statuses as $key => $status)
                            <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="delivered_to">{{ __('lang_v1.delivered_to') }}:</label>
                            <input type="text" name="delivered_to" id="delivered_to" class="form-control"
                                placeholder="{{ __('lang_v1.delivered_to') }}">
                        </div>
                    </div>

                </div>
                @php
                $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ?
                $custom_labels['shipping']['custom_field_1'] : '';

                $is_shipping_custom_field_1_required = !empty($custom_labels['shipping']['is_custom_field_1_required'])
                &&
                $custom_labels['shipping']['is_custom_field_1_required'] == 1 ? true : false;

                $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ?
                $custom_labels['shipping']['custom_field_2'] : '';

                $is_shipping_custom_field_2_required = !empty($custom_labels['shipping']['is_custom_field_2_required'])
                &&
                $custom_labels['shipping']['is_custom_field_2_required'] == 1 ? true : false;

                $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ?
                $custom_labels['shipping']['custom_field_3'] : '';

                $is_shipping_custom_field_3_required = !empty($custom_labels['shipping']['is_custom_field_3_required'])
                &&
                $custom_labels['shipping']['is_custom_field_3_required'] == 1 ? true : false;

                $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ?
                $custom_labels['shipping']['custom_field_4'] : '';

                $is_shipping_custom_field_4_required = !empty($custom_labels['shipping']['is_custom_field_4_required'])
                &&
                $custom_labels['shipping']['is_custom_field_4_required'] == 1 ? true : false;

                $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ?
                $custom_labels['shipping']['custom_field_5'] : '';

                $is_shipping_custom_field_5_required = !empty($custom_labels['shipping']['is_custom_field_5_required'])
                &&
                $custom_labels['shipping']['is_custom_field_5_required'] == 1 ? true : false;
                @endphp

                @if(!empty($shipping_custom_label_1))
                @php
                $label_1 = $shipping_custom_label_1 . ':';
                if($is_shipping_custom_field_1_required) {
                $label_1 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_custom_field_1">{{ $label_1 }}</label>
                        <input type="text" name="shipping_custom_field_1" id="shipping_custom_field_1"
                            class="form-control" placeholder="{{ $shipping_custom_label_1 }}"
                            value="{{ $walk_in_customer['shipping_custom_field_details']['shipping_custom_field_1'] ?? '' }}"
                            @if($is_shipping_custom_field_1_required) required @endif>

                    </div>
                </div>
                @endif
                @if(!empty($shipping_custom_label_2))
                @php
                $label_2 = $shipping_custom_label_2 . ':';
                if($is_shipping_custom_field_2_required) {
                $label_2 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_custom_field_2">{{ $label_2 }}</label>
                        <input type="text" name="shipping_custom_field_2" id="shipping_custom_field_2"
                            class="form-control" placeholder="{{ $shipping_custom_label_2 }}"
                            value="{{ $walk_in_customer['shipping_custom_field_details']['shipping_custom_field_2'] ?? '' }}"
                            @if($is_shipping_custom_field_2_required) required @endif>

                    </div>
                </div>
                @endif
                @if(!empty($shipping_custom_label_3))
                @php
                $label_3 = $shipping_custom_label_3 . ':';
                if($is_shipping_custom_field_3_required) {
                $label_3 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_custom_field_3">{{ $label_3 }}</label>
                        <input type="text" name="shipping_custom_field_3" id="shipping_custom_field_3"
                            class="form-control" placeholder="{{ $shipping_custom_label_3 }}"
                            value="{{ $walk_in_customer['shipping_custom_field_details']['shipping_custom_field_3'] ?? '' }}"
                            @if($is_shipping_custom_field_3_required) required @endif>

                    </div>
                </div>
                @endif
                @if(!empty($shipping_custom_label_4))
                @php
                $label_4 = $shipping_custom_label_4 . ':';
                if($is_shipping_custom_field_4_required) {
                $label_4 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_custom_field_4">{{ $label_4 }}</label>
                        <input type="text" name="shipping_custom_field_4" id="shipping_custom_field_4"
                            class="form-control" placeholder="{{ $shipping_custom_label_4 }}"
                            value="{{ $walk_in_customer['shipping_custom_field_details']['shipping_custom_field_4'] ?? '' }}"
                            @if($is_shipping_custom_field_4_required) required @endif>

                    </div>
                </div>
                @endif
                @if(!empty($shipping_custom_label_5))
                @php
                $label_5 = $shipping_custom_label_5 . ':';
                if($is_shipping_custom_field_5_required) {
                $label_5 .= '*';
                }
                @endphp

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_custom_field_5">{{ $label_5 }}</label>
                        <input type="text" name="shipping_custom_field_5" id="shipping_custom_field_5"
                            class="form-control" placeholder="{{ $shipping_custom_label_5 }}"
                            value="{{ $walk_in_customer['shipping_custom_field_details']['shipping_custom_field_5'] ?? '' }}"
                            @if($is_shipping_custom_field_5_required) required @endif>

                    </div>
                </div>
                @endif
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shipping_documents">{{ __('lang_v1.shipping_documents') }}:</label>
                        <input type="file" name="shipping_documents[]" id="shipping_documents" multiple
                            accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">

                        <p class="help-block">
                            @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                            1000000)])
                            @includeIf('components.document_help_text')
                        </p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-8">
                    @if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
                    <small id="round_off"><br>(@lang('lang_v1.round_off'): <span id="round_off_text">0</span>)</small>
                    <br />
                    <input type="hidden" name="round_off_amount" id="round_off_amount" value=0>
                    @endif
                    <div><b>@lang('sale.total_payable'): </b>
                        <input type="hidden" name="final_total" id="final_total_input">
                        <span id="total_payable">0</span>
                    </div>
                </div>
                @endcomponent
            </div>
        </div>
        @if(!empty($common_settings['is_enabled_export']) && $sale_type != 'sales_order')
        @component('components.widget', ['class' => 'box-solid', 'title' => __('lang_v1.export')])
        <div class="col-md-12 mb-12">
            <div class="form-check">
                <input type="checkbox" name="is_export" class="form-check-input" id="is_export"
                    @if(!empty($walk_in_customer['is_export'])) checked @endif>
                <label class="form-check-label" for="is_export">@lang('lang_v1.is_export')</label>
            </div>
        </div>
        @php
        $i = 1;
        @endphp
        @for($i; $i <= 6 ; $i++) <div class="col-md-4 export_div" @if(empty($walk_in_customer['is_export']))
            style="display: none;" @endif>
            <div class="form-group">
                <label for="export_custom_field_{{ $i }}">{{ __('lang_v1.export_custom_field' . $i) }}:</label>
                <input type="text" name="export_custom_fields_info[export_custom_field_{{ $i }}]"
                    id="export_custom_field_{{ $i }}" class="form-control"
                    placeholder="{{ __('lang_v1.export_custom_field' . $i) }}"
                    value="{{ old('export_custom_fields_info.export_custom_field_' . $i, $walk_in_customer['export_custom_field_' . $i] ?? null) }}">

            </div>
            </div>
            @endfor
            @endcomponent
            @endif
            @php
            $is_enabled_download_pdf = config('constants.enable_download_pdf');
            $payment_body_id = 'payment_rows_div';
            if ($is_enabled_download_pdf) {
            $payment_body_id = '';
            }
            @endphp
            @if((empty($status) || (!in_array($status, ['quotation', 'draft'])) || $is_enabled_download_pdf) &&
            $sale_type
            != 'sales_order')
            @can('sell.payments')
            @component('components.widget', ['class' => 'box-solid', 'id' => $payment_body_id, 'title' =>
            __('purchase.add_payment')])
            @if($is_enabled_download_pdf)
            <div class="well row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prefer_payment_method">{{ __('lang_v1.prefer_payment_method') }}:</label>

                        @show_tooltip(__('lang_v1.this_will_be_shown_in_pdf'))
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            <select name="prefer_payment_method" class="form-control" style="width:100%;">
                                @foreach($payment_types as $key => $type)
                                <option value="{{ $key }}" {{ $key == 'cash' ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prefer_payment_account">{{ __('lang_v1.prefer_payment_account') }}:</label>

                        @show_tooltip(__('lang_v1.this_will_be_shown_in_pdf'))
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            <select name="prefer_payment_account" id="prefer_payment_account" class="form-control"
                                style="width:100%;">
                                @foreach($accounts as $key => $account)
                                <option value="{{ $key }}">{{ $account }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(empty($status) || !in_array($status, ['quotation', 'draft']))
            <div class="payment_row" @if($is_enabled_download_pdf) id="payment_rows_div" @endif>
                <div class="row">
                    <div class="col-md-12 mb-12">
                        <strong>@lang('lang_v1.advance_balance'):</strong> <span id="advance_balance_text"></span>
                        <input type="hidden" name="advance_balance" id="advance_balance"
                            data-error-msg="{{ __('lang_v1.required_advance_balance_not_available') }}">

                    </div>
                </div>
                @include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true])
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right"><strong>@lang('lang_v1.balance'):</strong> <span
                                class="balance_due">0.00</span></div>
                    </div>
                </div>
            </div>
            @endif
            @endcomponent
            @endcan
            @endif

            <div class="row">
                <input type="hidden" name="is_save_and_print" id="is_save_and_print" value="0">

                <div class="col-sm-12 text-center">
                    <button type="button" id="submit-sell"
                        class="btn btn-primary btn-big">@lang('messages.save')</button>
                    <button type="button" id="save-and-print"
                        class="btn btn-success btn-big">@lang('lang_v1.save_and_print')</button>
                </div>
            </div>

            @if(empty($pos_settings['disable_recurring_invoice']))
            @include('sale_pos.partials.recurring_invoice_modal')
            @endif

    </form>
</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    @include('contact.create', ['quick_add' => true])
</div>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

@include('sale_pos.partials.configure_search_modal')

@stop

@section('javascript')
<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>

<!-- Call restaurant module if defined -->
@if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff'
,$enabled_modules))
<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
@endif
<script type="text/javascript">
$(document).ready(function() {
    $('#status').change(function() {
        if ($(this).val() == 'final') {
            $('#payment_rows_div').removeClass('hide');
        } else {
            $('#payment_rows_div').addClass('hide');
        }
    });
    $('.paid_on').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });

    $('#shipping_documents').fileinput({
        showUpload: false,
        showPreview: false,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,
    });

    $(document).on('change', '#prefer_payment_method', function(e) {
        var default_accounts = $('select#select_location_id').length ?
            $('select#select_location_id')
            .find(':selected')
            .data('default_payment_accounts') : $('#location_id').data('default_payment_accounts');
        var payment_type = $(this).val();
        if (payment_type) {
            var default_account = default_accounts && default_accounts[payment_type]['account'] ?
                default_accounts[payment_type]['account'] : '';
            var account_dropdown = $('select#prefer_payment_account');
            if (account_dropdown.length && default_accounts) {
                account_dropdown.val(default_account);
                account_dropdown.change();
            }
        }
    });

    function setPreferredPaymentMethodDropdown() {
        var payment_settings = $('#location_id').data('default_payment_accounts');
        payment_settings = payment_settings ? payment_settings : [];
        enabled_payment_types = [];
        for (var key in payment_settings) {
            if (payment_settings[key] && payment_settings[key]['is_enabled']) {
                enabled_payment_types.push(key);
            }
        }
        if (enabled_payment_types.length) {
            $("#prefer_payment_method > option").each(function() {
                if (enabled_payment_types.indexOf($(this).val()) != -1) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                }
            });
        }
    }

    setPreferredPaymentMethodDropdown();

    $('#is_export').on('change', function() {
        if ($(this).is(':checked')) {
            $('div.export_div').show();
        } else {
            $('div.export_div').hide();
        }
    });
});
</script>
@endsection