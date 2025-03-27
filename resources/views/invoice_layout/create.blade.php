@extends('layouts.app')
@section('title', __('invoice.add_invoice_layout'))

@section('content')
<style type="text/css">



</style>
@php
$custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang('invoice.add_invoice_layout')</h1>
</section>

<!-- Main content -->
<section class="content">
  <form action="{{ action('InvoiceLayoutController@store') }}" method="POST" id="add_invoice_layout_form" enctype="multipart/form-data">
    @csrf
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">

          <div class="col-sm-6">
            <div class="form-group">
              <label for="name">{{ __('invoice.layout_name') }}:*</label>
              <input type="text" name="name" id="name" class="form-control" required placeholder="{{ __('invoice.layout_name') }}" value="{{ old('name') }}">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="design">{{ __('lang_v1.design') }}:*</label>
              <select name="design" id="design" class="form-control">
                @foreach($designs as $value => $label)
                <option value="{{ $value }}" {{ $value == 'classic' ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
              <span class="help-block">
                @lang('lang_v1.used_for_browser_based_printing')
              </span>
            </div>

            <div class="form-group hide" id="columnize-taxes">
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" required="required"
                  placeholder="tax 1 name"
                  disabled>
                @show_tooltip(__('lang_v1.tooltip_columnize_taxes_heading'))
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" placeholder="tax 2 name"
                  disabled>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" placeholder="tax 3 name"
                  disabled>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" placeholder="tax 4 name"
                  disabled>
              </div>
            </div>

          </div>

          <!-- Logo -->
          <div class="col-sm-6">
            <div class="form-group">
              <label for="logo">{{ __('invoice.invoice_logo') }}:</label>
              <input type="file" name="logo" id="logo" accept="image/*">
              <span class="help-block">@lang('lang_v1.invoice_logo_help', ['max_size' => '1 MB'])</span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_logo" value="1" class="input-icheck"> @lang('invoice.show_logo')
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="header_text">{{ __('invoice.header_text') }}:</label>
              <textarea name="header_text" id="header_text" class="form-control" placeholder="{{ __('invoice.header_text') }}" rows="3"></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line1">{{ __('lang_v1.sub_heading_line', ['_number_' => 1]) }}:</label>
              <input type="text" name="sub_heading_line1" id="sub_heading_line1" class="form-control" placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 1]) }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line2">{{ __('lang_v1.sub_heading_line', ['_number_' => 2]) }}:</label>
              <input type="text" name="sub_heading_line2" id="sub_heading_line2" class="form-control" placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 2]) }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line3">{{ __('lang_v1.sub_heading_line', ['_number_' => 3]) }}:</label>
              <input type="text" name="sub_heading_line3" id="sub_heading_line3" class="form-control" placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 3]) }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line4">{{ __('lang_v1.sub_heading_line', ['_number_' => 4]) }}:</label>
              <input type="text" name="sub_heading_line4" id="sub_heading_line4" class="form-control" placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 4]) }}">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line5">{{ __('lang_v1.sub_heading_line', ['_number_' => 5]) }}:</label>
              <input type="text" name="sub_heading_line5" id="sub_heading_line5" class="form-control" placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 5]) }}">
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_heading">{{ __('invoice.invoice_heading') }}:</label>
              <input type="text" name="invoice_heading" id="invoice_heading" class="form-control"
                placeholder="{{ __('invoice.invoice_heading') }}" value="Invoice">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_heading_not_paid">{{ __('invoice.invoice_heading_not_paid') }}:</label>
              <input type="text" name="invoice_heading_not_paid" id="invoice_heading_not_paid" class="form-control"
                placeholder="{{ __('invoice.invoice_heading_not_paid') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_heading_paid">{{ __('invoice.invoice_heading_paid') }}:</label>
              <input type="text" name="invoice_heading_paid" id="invoice_heading_paid" class="form-control"
                placeholder="{{ __('invoice.invoice_heading_paid') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="proforma_heading">{{ __('lang_v1.proforma_heading') }}:</label>
              @show_tooltip(__('lang_v1.tooltip_proforma_heading'))
              <input type="text" name="common_settings[proforma_heading]" id="proforma_heading" class="form-control"
                placeholder="{{ __('lang_v1.proforma_heading') }}" value="{{ __('lang_v1.proforma_invoice') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="quotation_heading">{{ __('lang_v1.quotation_heading') }}:</label>
              @show_tooltip(__('lang_v1.tooltip_quotation_heading'))
              <input type="text" name="quotation_heading" id="quotation_heading" class="form-control"
                placeholder="{{ __('lang_v1.quotation_heading') }}" value="{{ __('lang_v1.quotation') }}">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_no_prefix">{{ __('invoice.invoice_no_prefix') }}:</label>
              <input type="text" name="invoice_no_prefix" id="invoice_no_prefix" class="form-control"
                placeholder="{{ __('invoice.invoice_no_prefix') }}" value="{{ __('sale.invoice_no') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="quotation_no_prefix">{{ __('lang_v1.quotation_no_prefix') }}:</label>
              <input type="text" name="quotation_no_prefix" id="quotation_no_prefix" class="form-control"
                placeholder="{{ __('lang_v1.quotation_no_prefix') }}" value="{{ __('lang_v1.quotation_no') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="date_label">{{ __('lang_v1.date_label') }}:</label>
              <input type="text" name="date_label" id="date_label" class="form-control"
                placeholder="{{ __('lang_v1.date_label') }}" value="{{ __('lang_v1.date') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="due_date_label">{{ __('lang_v1.due_date_label') }}:</label>
              <input type="text" name="common_settings[due_date_label]" id="due_date_label" class="form-control"
                placeholder="{{ __('lang_v1.due_date_label') }}" value="{{ __('lang_v1.due_date') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_due_date]" value="1" class="input-icheck"> @lang('lang_v1.show_due_date')</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="date_time_format">{{ __('lang_v1.date_time_format') }}:</label>
              <input type="text" name="date_time_format" id="date_time_format" class="form-control" placeholder="{{ __('lang_v1.date_time_format') }}">
              <p class="help-block">{!! __('lang_v1.date_time_format_help') !!}</p>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="sales_person_label">{{ __('lang_v1.sales_person_label') }}:</label>
              <input type="text" name="sales_person_label" id="sales_person_label" class="form-control" placeholder="{{ __('lang_v1.sales_person_label') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="commission_agent_label">{{ __('lang_v1.commission_agent_label') }}:</label>
              <input type="text" name="commission_agent_label" id="commission_agent_label" class="form-control"
                placeholder="{{ __('lang_v1.commission_agent_label') }}" value="{{ __('lang_v1.commission_agent') }}">
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_business_name" value="1" class="input-icheck">@lang('invoice.show_business_name')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_location_name" value="1" class="input-icheck" checked>@lang('invoice.show_location_name')</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_sales_person" value="1" class="input-icheck">@lang('lang_v1.show_sales_person')</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_commission_agent" value="1" class="input-icheck">@lang('lang_v1.show_commission_agent')</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-12">
            <h4>@lang('lang_v1.fields_for_customer_details'):</h4>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_customer"
                    id="show_customer"
                    value="1"
                    class="input-icheck"
                    checked>@lang('invoice.show_customer')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="customer_label">{{ __('invoice.customer_label') }}:</label>
              <input type="text"
                name="customer_label"
                id="customer_label"
                class="form-control"
                value="{{ __('contact.customer') }}"
                placeholder="{{ __('invoice.customer_label') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_client_id" value="1" class="input-icheck"> @lang('lang_v1.show_client_id')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="client_id_label">{{ __('lang_v1.client_id_label') }}:</label>
              <input type="text"
                name="client_id_label"
                id="client_id_label"
                class="form-control"
                placeholder="{{ __('lang_v1.client_id_label') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="client_tax_label">{{ __('lang_v1.client_tax_label') }}:</label>
              <input type="text"
                name="client_tax_label"
                id="client_tax_label"
                class="form-control"
                placeholder="{{ __('lang_v1.client_tax_label') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_reward_point"
                    id="show_reward_point"
                    value="1"
                    class="input-icheck"
                    @checked(old('show_reward_point', false))> @lang('lang_v1.show_reward_point')</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="contact_custom_fields[]"
                    value="custom_field1"
                    class="input-icheck">
                  {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field2" class="input-icheck">
                  {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field3" class="input-icheck">
                  {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field4" class="input-icheck">
                  {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}
                </label>
              </div>
            </div>
          </div>


          <div class="clearfix"></div>
          <div class="col-sm-12">
            <h4>@lang('invoice.fields_to_be_shown_in_address'):</h4>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_landmark"
                    value="1"
                    class="input-icheck"
                    @checked(old('show_landmark', true))>
                  @lang('business.landmark')
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_city"
                    value="1"
                    class="input-icheck"
                    @checked(old('show_city', true))>
                  @lang('business.city')
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_state"
                    value="1"
                    class="input-icheck"
                    @checked(old('show_state', true))>
                  @lang('business.state')
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <label>
                    <input type="checkbox"
                      name="show_country"
                      value="1"
                      class="input-icheck"
                      @checked(old('show_country', true))>
                    @lang('business.country')
                  </label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_zip_code"
                    value="1"
                    class="input-icheck"
                    @checked(old('show_zip_code', true))>
                  @lang('business.zip_code')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="location_custom_fields[]"
                    value="custom_field1"
                    class="input-icheck"
                    @checked(in_array('custom_field1', old('location_custom_fields', [])))>
                  {{ $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="location_custom_fields[]"
                    value="custom_field2"
                    class="input-icheck"
                    @checked(old('location_custom_fields') && in_array('custom_field2', old('location_custom_fields', [])))>
                  {{ $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="location_custom_fields[]"
                    value="custom_field3"
                    class="input-icheck"
                    @checked(old('location_custom_fields') && in_array('custom_field3', old('location_custom_fields', [])))>
                  {{ $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="location_custom_fields[]"
                    value="custom_field4"
                    class="input-icheck">
                  {{ $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4') }}</label>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>
          <!-- Shop Communication details -->
          <div class="col-sm-12">
            <h4>@lang('invoice.fields_to_shown_for_communication'):</h4>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_mobile_number"
                    value="1"
                    class="input-icheck"
                    checked>
                  @lang('invoice.show_mobile_number')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_alternate_number"
                    value="1"
                    class="input-icheck">
                  @lang('invoice.show_alternate_number')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_email"
                    value="1"
                    class="input-icheck">
                  @lang('invoice.show_email')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <h4>@lang('invoice.fields_to_shown_for_tax'):</h4>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_tax_1"
                    value="1"
                    class="input-icheck"
                    checked>
                  @lang('invoice.show_tax_1')
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"
                    name="show_tax_2"
                    value="1"
                    class="input-icheck">
                  @lang('invoice.show_tax_2')
                </label>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_product_label">@lang('lang_v1.product_label'):</label>
              <input type="text" name="table_product_label" id="table_product_label"
                class="form-control" placeholder="@lang('lang_v1.product_label')"
                value="@lang('sale.product')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_qty_label">@lang('lang_v1.qty_label'):</label>
              <input type="text" name="table_qty_label" id="table_qty_label"
                class="form-control" placeholder="@lang('lang_v1.qty_label')"
                value="@lang('lang_v1.quantity')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_unit_price_label">@lang('lang_v1.unit_price_label'):</label>
              <input type="text" name="table_unit_price_label" id="table_unit_price_label"
                class="form-control" placeholder="@lang('lang_v1.unit_price_label')"
                value="@lang('sale.unit_price')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_subtotal_label">@lang('lang_v1.subtotal_label'):</label>
              <input type="text" name="table_subtotal_label" id="table_subtotal_label"
                class="form-control" placeholder="@lang('lang_v1.subtotal_label')"
                value="@lang('sale.subtotal')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="cat_code_label">@lang('lang_v1.cat_code_label'):</label>
              <input type="text" name="cat_code_label" id="cat_code_label"
                class="form-control" placeholder="HSN or Category Code"
                value="HSN">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="total_quantity_label">@lang('lang_v1.total_quantity_label'):</label>
              <input type="text" name="common_settings[total_quantity_label]" id="total_quantity_label"
                class="form-control" placeholder="@lang('lang_v1.total_quantity_label')"
                value="Total Quantity">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="item_discount_label">@lang('lang_v1.item_discount_label'):</label>
              <input type="text" name="common_settings[item_discount_label]" id="item_discount_label"
                class="form-control" placeholder="@lang('lang_v1.item_discount_label')"
                value="Discount">
            </div>
          </div>

          <div class="col-sm-12">
            <h4>@lang('lang_v1.product_details_to_be_shown'):</h4>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_brand" value="1" class="input-icheck">
                  @lang('lang_v1.show_brand')
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_sku" value="1" class="input-icheck" checked>
                  @lang('lang_v1.show_sku')
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_cat_code" value="1" class="input-icheck">
                  @lang('lang_v1.show_cat_code')
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_sale_description" value="1" class="input-icheck">
                  @lang('lang_v1.show_sale_description')
                </label>
              </div>
              <p class="help-block">@lang('lang_v1.product_imei_or_sn')</p>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field1" class="input-icheck">
                  {{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field2" class="input-icheck">
                  {{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field3" class="input-icheck">
                  {{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field4" class="input-icheck">
                  {{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}
                </label>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>
          @if(session('business.enable_product_expiry') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_expiry" value="1" class="input-icheck">
                  @lang('lang_v1.show_product_expiry')
                </label>
              </div>
            </div>
          </div>
          @endif

          @if(session('business.enable_lot_number') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_lot" value="1" class="input-icheck">
                  @lang('lang_v1.show_lot_number')
                </label>
              </div>
            </div>
          </div>
          @endif


          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_image" value="1" class="input-icheck">
                  @lang('lang_v1.show_product_image')
                </label>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_warranty_name]" value="1" class="input-icheck">
                  @lang('lang_v1.show_warranty_name')
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_warranty_exp_date]" value="1" class="input-icheck">
                  @lang('lang_v1.show_warranty_exp_date')
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_warranty_description]" value="1" class="input-icheck">
                  @lang('lang_v1.show_warranty_description')
                </label>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_total_label">@lang('invoice.sub_total_label'):</label>
              <input type="text" name="sub_total_label" id="sub_total_label" value="{{ __('sale.subtotal') }}" class="form-control" placeholder="@lang('invoice.sub_total_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="discount_label">@lang('invoice.discount_label'):</label>
              <input type="text" name="discount_label" id="discount_label" value="{{ __('sale.discount') }}" class="form-control" placeholder="@lang('invoice.discount_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="tax_label">@lang('invoice.tax_label'):</label>
              <input type="text" name="tax_label" id="tax_label" value="{{ __('sale.tax') }}" class="form-control" placeholder="@lang('invoice.tax_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="total_label">@lang('invoice.total_label'):</label>
              <input type="text" name="total_label" id="total_label" value="{{ __('sale.total') }}" class="form-control" placeholder="@lang('invoice.total_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="round_off_label">@lang('lang_v1.round_off_label'):</label>
              <input type="text" name="round_off_label" id="round_off_label" value="{{ __('lang_v1.round_off') }}" class="form-control" placeholder="@lang('lang_v1.round_off_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="total_due_label">@lang('invoice.total_due_label') ({{ __('lang_v1.current_sale') }}):</label>
              <input type="text" name="total_due_label" id="total_due_label" value="{{ __('report.total_due') }}" class="form-control" placeholder="@lang('invoice.total_due_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="paid_label">@lang('invoice.paid_label'):</label>
              <input type="text" name="paid_label" id="paid_label" value="{{ __('sale.total_paid') }}" class="form-control" placeholder="@lang('invoice.paid_label')">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_payments" value="1" class="input-icheck" checked> @lang('invoice.show_payments')
                </label>
              </div>
            </div>
          </div>

          <!-- Barcode -->
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_barcode" value="1" class="input-icheck"> @lang('invoice.show_barcode')
                </label>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="prev_bal_label">@lang('invoice.total_due_label') ({{ __('lang_v1.all_sales') }}):</label>
              <input type="text" name="prev_bal_label" id="prev_bal_label" class="form-control" placeholder="@lang('invoice.total_due_label')">
            </div>
          </div>

          <div class="col-sm-5">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_previous_bal" value="1" class="input-icheck"> @lang('lang_v1.show_previous_bal_due')
                </label>
                @show_tooltip(__('lang_v1.previous_bal_due_help'))
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="change_return_label">@lang('lang_v1.change_return_label'):</label>
              @show_tooltip(__('lang_v1.change_return_help'))
              <input type="text" name="change_return_label" id="change_return_label" value="{{ __('lang_v1.change_return') }}" class="form-control" placeholder="@lang('lang_v1.change_return_label')">
            </div>
          </div>

          <div class="col-sm-3 hide" id="hide_price_div">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[hide_price]" value="1" class="input-icheck"> @lang('lang_v1.hide_all_prices')
                </label>
              </div>
            </div>
          </div>


          <div class="col-sm-3">
            <div class="form-group">
              <label>
                <input type="checkbox" name="common_settings[show_total_in_words]" value="1" class="input-icheck">
                @lang('lang_v1.show_total_in_words')</label> @show_tooltip(__('lang_v1.show_in_word_help'))
              @if(!extension_loaded('intl'))
              <p class="help-block">@lang('lang_v1.enable_php_intl_extension')</p>
              @endif
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="word_format">{{ __('lang_v1.word_format') }}:</label>
              @show_tooltip(__('lang_v1.word_format_help'))
              <select name="common_settings[num_to_word_format]" id="word_format" class="form-control">
                <option value="international" selected>{{ __('lang_v1.international') }}</option>
                <option value="indian">{{ __('lang_v1.indian') }}</option>
              </select>

            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6 hide">
            <div class="form-group">
              <label for="highlight_color">{{ __('invoice.highlight_color') }}:</label>
              <input type="text" name="highlight_color" id="highlight_color" class="form-control" value="#000000" placeholder="{{ __('invoice.highlight_color') }}">
            </div>
          </div>

          <div class="clearfix"></div>
          <div class="col-md-12 hide">
            <hr />
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="footer_text">{{ __('invoice.footer_text') }}:</label>
              <textarea name="footer_text" id="footer_text" class="form-control" placeholder="{{ __('invoice.footer_text') }}" rows="3"></textarea>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <br>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="is_default" value="1" class="input-icheck">
                  {{ __('barcode.set_as_default') }}
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @component('components.widget', ['class' => 'box-solid', 'title' => __('lang_v1.qr_code')])
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="show_qr_code" value="1" class="input-icheck">
              @lang('lang_v1.show_qr_code')</label>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
        <h4>@lang('lang_v1.fields_to_be_shown'):</h4>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="business_name" class="input-icheck">
              @lang('business.business_name')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="address" class="input-icheck">
              @lang('lang_v1.business_location_address')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="tax_1" class="input-icheck">
              @lang('lang_v1.business_tax_1')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="tax_2" class="input-icheck">
              @lang('lang_v1.business_tax_2')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="invoice_no" class="input-icheck">
              @lang('sale.invoice_no')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="invoice_datetime" class="input-icheck">
              @lang('lang_v1.invoice_datetime')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="subtotal" class="input-icheck">
              @lang('sale.subtotal')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="total_amount" class="input-icheck">
              @lang('lang_v1.total_amount_with_tax')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="total_tax" class="input-icheck">
              @lang('lang_v1.total_tax')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="customer_name" class="input-icheck">
              @lang('sale.customer_name')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="invoice_url" class="input-icheck">
              @lang('lang_v1.view_invoice_url')</label>
          </div>
        </div>
      </div>
    </div>
    @endcomponent

    @if(!empty($enabled_modules) && in_array('types_of_service', $enabled_modules) )
    @include('types_of_service.invoice_layout_settings')
    @endif

    <!-- Call restaurant module if defined -->
    @include('restaurant.partials.invoice_layout')

    @if(Module::has('Repair'))
    @include('repair::layouts.partials.invoice_layout_settings')
    @endif
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">@lang('lang_v1.layout_credit_note')</h3>
      </div>

      <div class="box-body">
        <div class="row">

          <div class="col-sm-3">
            <div class="form-group">
              <label for="cn_heading">{{ __('lang_v1.cn_heading') }}:</label>
              <input type="text" name="cn_heading" id="cn_heading" class="form-control" value="Credit Note" placeholder="{{ __('lang_v1.cn_heading') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="cn_no_label">{{ __('lang_v1.cn_no_label') }}:</label>
              <input type="text" name="cn_no_label" id="cn_no_label" class="form-control" value="{{ __('purchase.ref_no') }}" placeholder="{{ __('lang_v1.cn_no_label') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="cn_amount_label">{{ __('lang_v1.cn_amount_label') }}:</label>
              <input type="text" name="cn_amount_label" id="cn_amount_label" class="form-control" value="Credit Amount" placeholder="{{ __('lang_v1.cn_amount_label') }}">
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary btn-big">@lang('messages.save')</button>
      </div>
    </div>

  </form>
</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
  __page_leave_confirmation('#add_invoice_layout_form');
</script>
@endsection