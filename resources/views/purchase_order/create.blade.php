@extends('layouts.app')
@section('title', __('lang_v1.add_purchase_order'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.add_purchase_order') <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="@include('purchase.partials.keyboard_shortcuts_details')" data-html="true"
            data-trigger="hover" data-original-title="" title=""></i></h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Page level currency setting -->
    <input type="hidden" id="p_code" value="{{$currency_details->code}}">
    <input type="hidden" id="p_symbol" value="{{$currency_details->symbol}}">
    <input type="hidden" id="p_thousand" value="{{$currency_details->thousand_separator}}">
    <input type="hidden" id="p_decimal" value="{{$currency_details->decimal_separator}}">

    @include('layouts.partials.error')

    <Form action="{{ action('PurchaseOrderController@store') }}" method="POST" id="add_purchase_form"
        enctype="multipart/form-data">
        @csrf

        @component('components.widget', ['class' => 'box-solid'])
        <input type="hidden" id="is_purchase_order">
        <div class="row">
            <div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
                <div class="form-group">
                    {!! Form::label('supplier_id', __('purchase.supplier') . ':*') !!}
                    <label for="supplier_id">{{__('purchase.supplier')}}:*</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <select name="contact_id" class="form-control" id="supplier_id" required>
                            <option value="" disabled selected>{{ __('messages.please_select') }}</option>
                            @foreach ($contacts as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier"
                                data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                        </span>
                    </div>
                </div>
                <strong>
                    @lang('business.address'):
                </strong>
                <div id="supplier_address_div"></div>
            </div>
            <div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
                <div class="form-group">
                    <label for="ref_no">{{ __('purchase.ref_no') }}:</label>
                    <input type="text" name="ref_no" class="form-control" id="ref_no" value="{{ old('ref_no') }}">

                </div>
            </div>
            <div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
                <div class="form-group">
                    <label for="transaction_date">{{ __('lang_v1.order_date') }}:*</label>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" name="transaction_date" class="form-control"
                            value="{{ format_datetime(now()) }}" readonly required>

                    </div>
                </div>
            </div>
            

            @if(count($business_locations) == 1)
            @php
            $default_location = current(array_keys($business_locations->toArray()));
            $search_disable = false;
            @endphp
            @else
            @php $default_location = null;
            $search_disable = true;
            @endphp
            @endif
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="location_id">{{ __('purchase.business_location') }}:*</label>

                    @show_tooltip(__('tooltip.purchase_location'))
                    <select name="location_id" class="form-control select2" required>
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}" {{ $key == $default_location ? 'selected' : '' }}>{{ $value }}
                        </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <!-- Currency Exchange Rate -->
            <div class="col-sm-3 @if(!$currency_details->purchase_in_diff_currency) hide @endif">
                <div class="form-group">
                    <label for="exchange_rate">{{ __('purchase.p_exchange_rate') }}:*</label>

                    @show_tooltip(__('tooltip.currency_exchange_factor'))
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        <input type="number" name="exchange_rate" class="form-control"
                            value="{{ $currency_details->p_exchange_rate }}" required step="0.001">

                    </div>
                    <span class="help-block text-danger">
                        @lang('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
                    </span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <div class="multi-input">
                        <label for="pay_term_number">{{ __('contact.pay_term') }}:</label>

                        @show_tooltip(__('tooltip.pay_term'))
                        <br />
                        <input type="number" name="pay_term_number" class="form-control width-40 pull-left"
                            placeholder="{{ __('contact.pay_term') }}">

                        <select name="pay_term_type" class="form-control width-60 pull-left" id="pay_term_type">
                            <option value="">{{ __('messages.please_select') }}</option>
                            <option value="months">{{ __('lang_v1.months') }}</option>
                            <option value="days">{{ __('lang_v1.days') }}</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="document">{{ __('purchase.attach_document') }}:</label>
                    <input type="file" name="document" id="upload_document"
                        accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">

                    <p class="help-block">
                        @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                        @includeIf('components.document_help_text')
                    </p>
                </div>
            </div>
        </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-solid'])
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="text" name="search_product" id="search_product" class="form-control mousetrap"
                                placeholder="{{ __('lang_v1.search_product_placeholder') }}"
                                {{ $search_disable ? 'disabled' : '' }} {{ $search_disable ? '' : 'autofocus' }}>



                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button tabindex="-1" type="button" class="btn btn-link btn-modal"
                        data-href="{{action('ProductController@quickAdd')}}"
                        data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> @lang(
                        'product.add_new_product' ) </button>
                </div>
            </div>
        </div>
        @php
        $hide_tax = '';
        if( session()->get('business.enable_inline_tax') == 0){
        $hide_tax = 'hide';
        }
        @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-th-green text-center table-striped"
                        id="purchase_entry_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang( 'product.product_name' )</th>
                                <th>@lang( 'lang_v1.order_quantity' )</th>
                                <th>@lang( 'lang_v1.unit_cost_before_discount' )</th>
                                <th>@lang( 'lang_v1.discount_percent' )</th>
                                <th>@lang( 'purchase.unit_cost_before_tax' )</th>
                                <th class="{{$hide_tax}}">@lang( 'purchase.subtotal_before_tax' )</th>
                                <th class="{{$hide_tax}}">@lang( 'purchase.product_tax' )</th>
                                <th class="{{$hide_tax}}">@lang( 'purchase.net_cost' )</th>
                                <th>@lang( 'purchase.line_total' )</th>
                                <th class="hide">
                                    @lang( 'lang_v1.profit_margin' )
                                </th>
                                <th><i class="fa fa-trash" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <hr />
                <div class="pull-right col-md-5">
                    <table class="pull-right col-md-12">
                        <tr>
                            <th class="col-md-7 text-right">@lang( 'lang_v1.total_items' ):</th>
                            <td class="col-md-5 text-left">
                                <span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
                            </td>
                        </tr>
                        <tr class="hide">
                            <th class="col-md-7 text-right">@lang( 'purchase.total_before_tax' ):</th>
                            <td class="col-md-5 text-left">
                                <span id="total_st_before_tax" class="display_currency"></span>
                                <input type="hidden" id="st_before_tax_input" value=0>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-md-7 text-right">@lang( 'purchase.net_total_amount' ):</th>
                            <td class="col-md-5 text-left">
                                <span id="total_subtotal" class="display_currency"></span>
                                <!-- This is total before purchase tax-->
                                <input type="hidden" id="total_subtotal_input" value=0 name="total_before_tax">
                            </td>
                        </tr>
                    </table>
                </div>

                <input type="hidden" id="row_count" value="0">
            </div>
        </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-solid'])
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shipping_details">{{ __('sale.shipping_details') }}</label>
                    <textarea name="shipping_details" class="form-control"
                        placeholder="{{ __('sale.shipping_details') }}" rows="3" cols="30"></textarea>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shipping_address">{{ __('lang_v1.shipping_address') }}</label>
                    <textarea name="shipping_address" class="form-control"
                        placeholder="{{ __('lang_v1.shipping_address') }}" rows="3" cols="30"></textarea>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shipping_charges">{{ __('sale.shipping_charges') }}</label>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        <input type="text" name="shipping_charges" value="{{ @num_format(0.00) }}"
                            class="form-control input_number" placeholder="{{ __('sale.shipping_charges') }}">

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shipping_status">{{ __('lang_v1.shipping_status') }}</label>
                    <select name="shipping_status" class="form-control"
                        placeholder="{{ __('messages.please_select') }}">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($shipping_statuses as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivered_to">{{ __('lang_v1.delivered_to') }}:</label>
                    <input type="text" name="delivered_to" class="form-control"
                        placeholder="{{ __('lang_v1.delivered_to') }}">

                </div>
            </div>
            @php
            $custom_labels = json_decode(session('business.custom_labels'), true);
            $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ?
            $custom_labels['shipping']['custom_field_1'] : '';

            $is_shipping_custom_field_1_required = !empty($custom_labels['shipping']['is_custom_field_1_required']) &&
            $custom_labels['shipping']['is_custom_field_1_required'] == 1 ? true : false;

            $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ?
            $custom_labels['shipping']['custom_field_2'] : '';

            $is_shipping_custom_field_2_required = !empty($custom_labels['shipping']['is_custom_field_2_required']) &&
            $custom_labels['shipping']['is_custom_field_2_required'] == 1 ? true : false;

            $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ?
            $custom_labels['shipping']['custom_field_3'] : '';

            $is_shipping_custom_field_3_required = !empty($custom_labels['shipping']['is_custom_field_3_required']) &&
            $custom_labels['shipping']['is_custom_field_3_required'] == 1 ? true : false;

            $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ?
            $custom_labels['shipping']['custom_field_4'] : '';

            $is_shipping_custom_field_4_required = !empty($custom_labels['shipping']['is_custom_field_4_required']) &&
            $custom_labels['shipping']['is_custom_field_4_required'] == 1 ? true : false;

            $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ?
            $custom_labels['shipping']['custom_field_5'] : '';

            $is_shipping_custom_field_5_required = !empty($custom_labels['shipping']['is_custom_field_5_required']) &&
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
                    <input type="text" name="shipping_custom_field_1" class="form-control"
                        placeholder="{{ $shipping_custom_label_1 }}"
                        required="{{ $is_shipping_custom_field_1_required }}">

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
                    <input type="text" name="shipping_custom_field_2" class="form-control"
                        placeholder="{{ $shipping_custom_label_2 }}"
                        required="{{ $is_shipping_custom_field_2_required }}">

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
                    <input type="text" name="shipping_custom_field_3" class="form-control"
                        placeholder="{{ $shipping_custom_label_3 }}"
                        required="{{ $is_shipping_custom_field_3_required }}">

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
                    <input type="text" name="shipping_custom_field_4" class="form-control"
                        placeholder="{{ $shipping_custom_label_4 }}"
                        required="{{ $is_shipping_custom_field_4_required }}">

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
                    <input type="text" name="shipping_custom_field_5" class="form-control"
                        placeholder="{{ $shipping_custom_label_5 }}"
                        required="{{ $is_shipping_custom_field_5_required }}">

                </div>
            </div>
            @endif
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shipping_documents">{{ __('lang_v1.shipping_documents') }}:</label>
                    <input type="file" name="shipping_documents[]" id="shipping_documents" multiple
                        accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">

                    <p class="help-block">
                        @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                        @includeIf('components.document_help_text')
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-sm" id="toggle_additional_expense"> <i
                        class="fas fa-plus"></i> @lang('lang_v1.add_additional_expenses') <i
                        class="fas fa-chevron-down"></i></button>
            </div>
            <div class="col-md-8 col-md-offset-4" id="additional_expenses_div" style="display: none;">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>@lang('lang_v1.additional_expense_name')</th>
                            <th>@lang('sale.amount')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" name="additional_expense_key_1" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="additional_expense_value_1" value="0"
                                    class="form-control input_number" id="additional_expense_value_1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="additional_expense_key_2" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="additional_expense_value_2" value="0"
                                    class="form-control input_number" id="additional_expense_value_2">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="additional_expense_key_3" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="additional_expense_value_3" value="0"
                                    class="form-control input_number" id="additional_expense_value_3">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="additional_expense_key_4" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="additional_expense_value_4" value="0"
                                    class="form-control input_number" id="additional_expense_value_4">
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-8">
                <input type="hidden" name="final_total" value="0" id="grand_total_hidden">

                <b>@lang('lang_v1.order_total'): </b><span id="grand_total" class="display_currency"
                    data-currency_symbol='true'>0</span>
            </div>
        </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-solid'])
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <tr class="hide">
                        <td class="col-md-3">
                            <div class="form-group">
                                <label for="discount_type">{{ __('purchase.discount_type') }}:</label>
                                <select name="discount_type" id="discount_type" class="form-control select2">
                                    <option value="">{{ __('lang_v1.none') }}</option>
                                    <option value="fixed">{{ __('lang_v1.fixed') }}</option>
                                    <option value="percentage">{{ __('lang_v1.percentage') }}</option>
                                </select>

                            </div>
                        </td>
                        <td class="col-md-3">
                            <div class="form-group">
                                <label for="discount_amount">{{ __('purchase.discount_amount') }}:</label>
                                <input type="text" name="discount_amount" id="discount_amount" value="0"
                                    class="form-control input_number" required>

                            </div>
                        </td>
                        <td class="col-md-3">
                            &nbsp;
                        </td>
                        <td class="col-md-3">
                            <b>@lang( 'purchase.discount' ):</b>(-)
                            <span id="discount_calculated_amount" class="display_currency">0</span>
                        </td>
                    </tr>
                    <tr class="hide">
                        <td>
                            <div class="form-group">
                                <label for="tax_id">{{ __('purchase.purchase_tax') }}:</label>

                                <select name="tax_id" id="tax_id" class="form-control select2"
                                    placeholder="'Please Select'">
                                    <option value="" data-tax_amount="0" data-tax_type="fixed" selected>
                                        @lang('lang_v1.none')</option>
                                    @foreach($taxes as $tax)
                                    <option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}"
                                        data-tax_type="{{ $tax->calculation_type }}">{{ $tax->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="tax_amount" value="0" id="tax_amount">

                            </div>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <b>@lang( 'purchase.purchase_tax' ):</b>(+)
                            <span id="tax_calculated_amount" class="display_currency">0</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-group">
                                <label for="additional_notes">{{ __('purchase.additional_notes') }}</label>
                                <textarea name="additional_notes" id="additional_notes" class="form-control"
                                    rows="3"></textarea>

                            </div>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        @endcomponent
        <div class="row">
            <div class="col-sm-12">
                <button type="button" id="submit_purchase_form"
                    class="btn btn-primary pull-right btn-flat">@lang('messages.save')</button>
            </div>
        </div>

    </Form>
</section>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    @include('contact.create', ['quick_add' => true])
</div>
<!-- /.content -->
@endsection

@section('javascript')
<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    __page_leave_confirmation('#add_purchase_form');
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
});
</script>
@include('purchase.partials.keyboard_shortcuts')
@endsection