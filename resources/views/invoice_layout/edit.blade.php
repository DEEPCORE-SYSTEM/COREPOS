@extends('layouts.app')
@section('title', __('invoice.edit_invoice_layout'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang('invoice.edit_invoice_layout')</h1>
</section>

<!-- Main content -->
<section class="content">
  <form action="{{ action('InvoiceLayoutController@update', [$invoice_layout->id]) }}" method="POST" id="add_invoice_layout_form" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @php
    $product_custom_fields = !empty($invoice_layout->product_custom_fields) ? $invoice_layout->product_custom_fields : [];
    $contact_custom_fields = !empty($invoice_layout->contact_custom_fields) ? $invoice_layout->contact_custom_fields : [];
    $location_custom_fields = !empty($invoice_layout->location_custom_fields) ? $invoice_layout->location_custom_fields : [];
    $custom_labels = json_decode(session('business.custom_labels'), true);
    @endphp
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">

          <div class="col-sm-6">
            <div class="form-group">
              <label for="name">{{ __('invoice.layout_name') }}:*</label>
              <input type="text" name="name" id="name" value="{{ $invoice_layout->name }}"
                class="form-control" required placeholder="{{ __('invoice.layout_name') }}">

            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="design">{{ __('lang_v1.design') }}:*</label>
              <select name="design" id="design" class="form-control">
                @foreach($designs as $key => $value)
                <option value="{{ $key }}" {{ $invoice_layout->design == $key ? 'selected' : '' }}>
                  {{ $value }}
                </option>
                @endforeach
              </select>
              <span class="help-block">
                @lang('lang_v1.used_for_browser_based_printing')
              </span>
            </div>

            <div class="form-group @if($invoice_layout->design != 'columnize-taxes') hide @endif" id="columnize-taxes">
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" required="required" placeholder="tax 1 name" value="{{$invoice_layout->table_tax_headings[0]}}"
                  @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
                @show_tooltip(__('lang_v1.tooltip_columnize_taxes_heading'))
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" placeholder="tax 2 name"
                  value="{{$invoice_layout->table_tax_headings[1]}}"
                  @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" placeholder="tax 3 name"
                  value="{{$invoice_layout->table_tax_headings[2]}}"
                  @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control"
                  name="table_tax_headings[]" placeholder="tax 4 name"
                  value="{{$invoice_layout->table_tax_headings[3]}}"
                  @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
              </div>

            </div>
          </div>

          <!-- Logo -->
          <div class="col-sm-6">
            <div class="form-group">
              <label for="logo">{{ __('invoice.invoice_logo') }}:</label>
              <input type="file" name="logo" id="logo" accept="image/*">
              <span class="help-block">
                {{ __('lang_v1.invoice_logo_help', ['max_size' => '1 MB']) }}<br>
                {{ __('lang_v1.invoice_logo_help2') }}
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_logo" value="1" class="input-icheck"
                    {{ $invoice_layout->show_logo ? 'checked' : '' }}>
                  {{ __('invoice.show_logo') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="header_text">{{ __('invoice.header_text') }}:</label>
              <textarea name="header_text" id="header_text" class="form-control" rows="3"
                placeholder="{{ __('invoice.header_text') }}">{{ old('header_text', $invoice_layout->header_text) }}</textarea>
            </div>
          </div>

          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line1">{{ __('lang_v1.sub_heading_line', ['_number_' => 1]) }}:</label>
              <input type="text" name="sub_heading_line1" id="sub_heading_line1" class="form-control"
                placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 1]) }}"
                value="{{ old('sub_heading_line1', $invoice_layout->sub_heading_line1) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line2">{{ __('lang_v1.sub_heading_line', ['_number_' => 2]) }}:</label>
              <input type="text" name="sub_heading_line2" id="sub_heading_line2" class="form-control"
                placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 2]) }}"
                value="{{ old('sub_heading_line2', $invoice_layout->sub_heading_line2) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line3">{{ __('lang_v1.sub_heading_line', ['_number_' => 3]) }}:</label>
              <input type="text" name="sub_heading_line3" id="sub_heading_line3" class="form-control"
                placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 3]) }}"
                value="{{ old('sub_heading_line3', $invoice_layout->sub_heading_line3) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line4">{{ __('lang_v1.sub_heading_line', ['_number_' => 4]) }}:</label>
              <input type="text" name="sub_heading_line4" id="sub_heading_line4" class="form-control"
                placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 4]) }}"
                value="{{ old('sub_heading_line4', $invoice_layout->sub_heading_line4) }}">
            </div>
          </div>

          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sub_heading_line5">{{ __('lang_v1.sub_heading_line', ['_number_' => 5]) }}:</label>
              <input type="text" name="sub_heading_line5" id="sub_heading_line5" class="form-control"
                placeholder="{{ __('lang_v1.sub_heading_line', ['_number_' => 5]) }}"
                value="{{ old('sub_heading_line5', $invoice_layout->sub_heading_line5) }}">
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
                placeholder="{{ __('invoice.invoice_heading') }}"
                value="{{ old('invoice_heading', $invoice_layout->invoice_heading) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_heading_not_paid">{{ __('invoice.invoice_heading_not_paid') }}:</label>
              <input type="text" name="invoice_heading_not_paid" id="invoice_heading_not_paid" class="form-control"
                placeholder="{{ __('invoice.invoice_heading_not_paid') }}"
                value="{{ old('invoice_heading_not_paid', $invoice_layout->invoice_heading_not_paid) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_heading_paid">{{ __('invoice.invoice_heading_paid') }}:</label>
              <input type="text" name="invoice_heading_paid" id="invoice_heading_paid" class="form-control"
                placeholder="{{ __('invoice.invoice_heading_paid') }}"
                value="{{ old('invoice_heading_paid', $invoice_layout->invoice_heading_paid) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="proforma_heading">{{ __('lang_v1.proforma_heading') }}:</label>
              {!! show_tooltip(__('lang_v1.tooltip_proforma_heading')) !!}
              <input type="text" name="common_settings[proforma_heading]" id="proforma_heading" class="form-control"
                placeholder="{{ __('lang_v1.proforma_heading') }}"
                value="{{ old('common_settings.proforma_heading', $invoice_layout->common_settings['proforma_heading'] ?? null) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="quotation_heading">{{ __('lang_v1.quotation_heading') }}:</label>
              {!! show_tooltip(__('lang_v1.tooltip_quotation_heading')) !!}
              <input type="text" name="quotation_heading" id="quotation_heading" class="form-control"
                placeholder="{{ __('lang_v1.quotation_heading') }}"
                value="{{ old('quotation_heading', $invoice_layout->quotation_heading) }}">
            </div>
          </div>


          <div class="col-sm-3">
            <div class="form-group">
              <label for="invoice_no_prefix">{{ __('invoice.invoice_no_prefix') }}:</label>
              <input type="text" name="invoice_no_prefix" id="invoice_no_prefix" class="form-control"
                placeholder="{{ __('invoice.invoice_no_prefix') }}"
                value="{{ old('invoice_no_prefix', $invoice_layout->invoice_no_prefix) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="quotation_no_prefix">{{ __('lang_v1.quotation_no_prefix') }}:</label>
              <input type="text" name="quotation_no_prefix" id="quotation_no_prefix" class="form-control"
                placeholder="{{ __('lang_v1.quotation_no_prefix') }}"
                value="{{ old('quotation_no_prefix', $invoice_layout->quotation_no_prefix) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="date_label">{{ __('lang_v1.date_label') }}:</label>
              <input type="text" name="date_label" id="date_label" class="form-control"
                placeholder="{{ __('lang_v1.date_label') }}"
                value="{{ old('date_label', $invoice_layout->date_label) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="due_date_label">{{ __('lang_v1.due_date_label') }}:</label>
              <input type="text" name="common_settings[due_date_label]" id="due_date_label" class="form-control"
                placeholder="{{ __('lang_v1.due_date_label') }}"
                value="{{ old('common_settings.due_date_label', $invoice_layout->common_settings['due_date_label'] ?? null) }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_due_date]" value="1"
                    class="input-icheck"
                    @checked(!empty($invoice_layout->common_settings['show_due_date']))>
                  @lang('lang_v1.show_due_date')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="date_time_format">{{ __('lang_v1.date_time_format') }}:</label>
              <input type="text" name="date_time_format" id="date_time_format"
                class="form-control"
                value="{{ $invoice_layout->date_time_format }}"
                placeholder="{{ __('lang_v1.date_time_format') }}">

              <p class="help-block">{!! __('lang_v1.date_time_format_help') !!}</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="sales_person_label">{{ __('lang_v1.sales_person_label') }}:</label>
              <input type="text" name="sales_person_label" id="sales_person_label"
                class="form-control"
                value="{{ $invoice_layout->sales_person_label }}"
                placeholder="{{ __('lang_v1.sales_person_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="commission_agent_label">{{ __('lang_v1.commission_agent_label') }}:</label>
              <input type="text" name="commission_agent_label" id="commission_agent_label"
                class="form-control"
                value="{{ $invoice_layout->commission_agent_label }}"
                placeholder="{{ __('lang_v1.commission_agent_label') }}">

            </div>
          </div>
          <div class="clearfix"></div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_business_name" id="show_business_name"
                    class="input-icheck" value="1"
                    {{ $invoice_layout->show_business_name ? 'checked' : '' }}>
                  <label for="show_business_name">{{ __('invoice.show_business_name') }}</label>
                  @lang('invoice.show_business_name')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_location_name" value="1"
                    class="input-icheck" {{ $invoice_layout->show_location_name ? 'checked' : '' }}>
                  @lang('invoice.show_location_name')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_sales_person" value="1"
                    class="input-icheck" {{ $invoice_layout->show_sales_person ? 'checked' : '' }}>
                  @lang('lang_v1.show_sales_person')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_commission_agent" value="1"
                    class="input-icheck" {{ $invoice_layout->show_commission_agent ? 'checked' : '' }}>
                  @lang('lang_v1.show_commission_agent')</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-12">
            <h4>@lang('lang_v1.fields_for_customer_details'):</h4>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_customer" value="1"
                    class="input-icheck" {{ $invoice_layout->show_customer ? 'checked' : '' }}>
                  @lang('invoice.show_customer')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="customer_label">{{ __('invoice.customer_label') }}:</label>
              <input type="text" name="customer_label" id="customer_label" value="{{ $invoice_layout->customer_label }}"
                class="form-control" placeholder="{{ __('invoice.customer_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_client_id" value="1" class="input-icheck"
                    {{ old('show_client_id', $invoice_layout->show_client_id) ? 'checked' : '' }}>
                  @lang('lang_v1.show_client_id')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="client_id_label">{{ __('lang_v1.client_id_label') }}:</label>
              <input type="text" name="client_id_label" value="{{ old('client_id_label', $invoice_layout->client_id_label) }}" class="form-control" placeholder="{{ __('lang_v1.client_id_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="client_tax_label">{{ __('lang_v1.client_tax_label') }}:</label>
              <input type="text" name="client_tax_label" value="{{ old('client_tax_label', $invoice_layout->client_tax_label) }}" class="form-control" placeholder="{{ __('lang_v1.client_tax_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_reward_point" value="1" class="input-icheck" {{ $invoice_layout->show_reward_point ? 'checked' : '' }}>
                  @lang('lang_v1.show_reward_point')</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field1" class="input-icheck"
                    {{ in_array('custom_field1', $contact_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field2" class="input-icheck"
                    {{ in_array('custom_field2', $contact_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field3" class="input-icheck"
                    {{ in_array('custom_field3', $contact_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="contact_custom_fields[]" value="custom_field4" class="input-icheck"
                    {{ in_array('custom_field4', $contact_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</label>
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
                  <input type="checkbox" name="show_landmark" value="1" class="input-icheck"
                    {{ $invoice_layout->show_landmark ? 'checked' : '' }}>
                  @lang('business.landmark')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_city" value="1" class="input-icheck"
                    {{ $invoice_layout->show_city ? 'checked' : '' }}>
                  @lang('business.city')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_state" value="1" class="input-icheck"
                    {{ $invoice_layout->show_state ? 'checked' : '' }}>
                  @lang('business.state')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_country" value="1" class="input-icheck"
                    {{ $invoice_layout->show_country ? 'checked' : '' }}>
                  @lang('business.country')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_zip_code" value="1" class="input-icheck"
                    {{ $invoice_layout->show_zip_code ? 'checked' : '' }}>
                  @lang('business.zip_code')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="location_custom_fields[]" value="custom_field1" class="input-icheck"
                    {{ in_array('custom_field1', $location_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="location_custom_fields[]" value="custom_field2" class="input-icheck"
                    {{ in_array('custom_field2', $location_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="location_custom_fields[]" value="custom_field3" class="input-icheck"
                    {{ in_array('custom_field3', $location_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="location_custom_fields[]" value="custom_field4" class="input-icheck"
                    {{ in_array('custom_field4', $location_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4') }}</label>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>@lang('invoice.fields_to_shown_for_communication'):</label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_mobile_number" value="1" class="input-icheck"
                    {{ $invoice_layout->show_mobile_number ? 'checked' : '' }}>
                  @lang('invoice.show_mobile_number')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_alternate_number" value="1" class="input-icheck"
                    {{ $invoice_layout->show_alternate_number ? 'checked' : '' }}>
                  @lang('invoice.show_alternate_number')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_email" value="1" class="input-icheck"
                    {{ $invoice_layout->show_email ? 'checked' : '' }}>
                  @lang('invoice.show_email')</label>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label>@lang('invoice.fields_to_shown_for_tax'):</label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_tax_1" value="1" class="input-icheck"
                    {{ $invoice_layout->show_tax_1 ? 'checked' : '' }}>
                  @lang('invoice.show_tax_1')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_tax_2" value="1" class="input-icheck"
                    {{ $invoice_layout->show_tax_2 ? 'checked' : '' }}>
                  @lang('invoice.show_tax_2')</label>
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
              <label for="table_product_label">{{ __('lang_v1.product_label') }}:</label>
              <input type="text" name="table_product_label" id="table_product_label" class="form-control"
                value="{{ $invoice_layout->table_product_label }}"
                placeholder="{{ __('lang_v1.product_label') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_qty_label">{{ __('lang_v1.qty_label') }}:</label>
              <input type="text" name="table_qty_label" id="table_qty_label" class="form-control"
                value="{{ $invoice_layout->table_qty_label }}"
                placeholder="{{ __('lang_v1.qty_label') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_unit_price_label">{{ __('lang_v1.unit_price_label') }}:</label>
              <input type="text" name="table_unit_price_label" id="table_unit_price_label" class="form-control"
                value="{{ $invoice_layout->table_unit_price_label }}"
                placeholder="{{ __('lang_v1.unit_price_label') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="table_subtotal_label">{{ __('lang_v1.subtotal_label') }}:</label>
              <input type="text" name="table_subtotal_label" id="table_subtotal_label" class="form-control"
                value="{{ $invoice_layout->table_subtotal_label }}"
                placeholder="{{ __('lang_v1.subtotal_label') }}">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="cat_code_label">{{ __('lang_v1.cat_code_label') }}:</label>
              <input type="text" name="cat_code_label" id="cat_code_label" class="form-control"
                value="{{ $invoice_layout->cat_code_label }}"
                placeholder="HSN or Category Code">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="total_quantity_label">{{ __('lang_v1.total_quantity_label') }}:</label>
              <input type="text" name="common_settings[total_quantity_label]"
                id="total_quantity_label"
                class="form-control"
                value="{{ !empty($invoice_layout->common_settings['total_quantity_label']) ? $invoice_layout->common_settings['total_quantity_label'] : '' }}"
                placeholder="{{ __('lang_v1.total_quantity_label') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="item_discount_label">{{ __('lang_v1.item_discount_label') }}:</label>
              <input type="text" name="common_settings[item_discount_label]"
                id="item_discount_label"
                class="form-control"
                value="{{ !empty($invoice_layout->common_settings['item_discount_label']) ? $invoice_layout->common_settings['item_discount_label'] : '' }}"
                placeholder="{{ __('lang_v1.item_discount_label') }}">
            </div>
          </div>

          <div class="col-sm-12">
            <h4>@lang('lang_v1.product_details_to_be_shown'):</h4>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_brand" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_brand ? 'checked' : '' }}>
                  @lang('lang_v1.show_brand')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_sku" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_sku ? 'checked' : '' }}>
                  @lang('lang_v1.show_sku')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_cat_code" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_cat_code ? 'checked' : '' }}>
                  @lang('lang_v1.show_cat_code')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_sale_description" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_sale_description ? 'checked' : '' }}>
                  @lang('lang_v1.show_sale_description')</label>
              </div>
              <p class="help-block">@lang('lang_v1.product_imei_or_sn')</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field1"
                    class="input-icheck"
                    {{ in_array('product_custom_field1', $product_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field2"
                    class="input-icheck"
                    {{ in_array('product_custom_field2', $product_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field3"
                    class="input-icheck"
                    {{ in_array('product_custom_field3', $product_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="product_custom_fields[]" value="product_custom_field4"
                    class="input-icheck"
                    {{ in_array('product_custom_field4', $product_custom_fields) ? 'checked' : '' }}>
                  {{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          @if(request()->session()->get('business.enable_product_expiry') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_expiry" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_expiry ? 'checked' : '' }}>
                  @lang('lang_v1.show_product_expiry')</label>
              </div>
            </div>
          </div>
          @endif
          @if(request()->session()->get('business.enable_lot_number') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_lot" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_lot ? 'checked' : '' }}>
                  @lang('lang_v1.show_lot_number')</label>
              </div>
            </div>
          </div>
          @endif

          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_image" value="1"
                    class="input-icheck"
                    {{ !empty($invoice_layout->show_image) ? 'checked' : '' }}>
                  @lang('lang_v1.show_product_image')</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_warranty_name]" value="1"
                    class="input-icheck"
                    {{ !empty($invoice_layout->common_settings['show_warranty_name']) ? 'checked' : '' }}>
                  @lang('lang_v1.show_warranty_name')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_warranty_exp_date]" value="1"
                    class="input-icheck"
                    {{ !empty($invoice_layout->common_settings['show_warranty_exp_date']) ? 'checked' : '' }}>
                  @lang('lang_v1.show_warranty_exp_date')</label>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[show_warranty_description]" value="1"
                    class="input-icheck"
                    {{ !empty($invoice_layout->common_settings['show_warranty_description']) ? 'checked' : '' }}>
                  @lang('lang_v1.show_warranty_description')</label>
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
              <label for="sub_total_label">{{ __('invoice.sub_total_label') }}:</label>
              <input type="text" name="sub_total_label" id="sub_total_label"
                class="form-control"
                value="{{ $invoice_layout->sub_total_label }}"
                placeholder="{{ __('invoice.sub_total_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="discount_label">{{ __('invoice.discount_label') }}:</label>
              <input type="text" name="discount_label" id="discount_label"
                class="form-control"
                value="{{ $invoice_layout->discount_label }}"
                placeholder="{{ __('invoice.discount_label') }}">

            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="tax_label">{{ __('invoice.tax_label') }}:</label>
              <input type="text" name="tax_label" id="tax_label"
                class="form-control"
                value="{{ $invoice_layout->tax_label }}"
                placeholder="{{ __('invoice.tax_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="total_label">{{ __('invoice.total_label') }}:</label>
              <input type="text" name="total_label" id="total_label"
                class="form-control"
                value="{{ $invoice_layout->total_label }}"
                placeholder="{{ __('invoice.total_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="round_off_label">{{ __('lang_v1.round_off_label') }}:</label>
              <input type="text" name="round_off_label" id="round_off_label"
                class="form-control"
                value="{{ $invoice_layout->round_off_label }}"
                placeholder="{{ __('lang_v1.round_off_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="total_due_label">
                {{ __('invoice.total_due_label') }} ({{ __('lang_v1.current_sale') }}):
              </label>
              <input type="text" name="total_due_label" id="total_due_label"
                class="form-control"
                value="{{ $invoice_layout->total_due_label }}"
                placeholder="{{ __('invoice.total_due_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="paid_label">
                {{ __('invoice.paid_label') }}:
              </label>
              <input type="text" name="paid_label" id="paid_label"
                class="form-control"
                value="{{ $invoice_layout->paid_label }}"
                placeholder="{{ __('invoice.paid_label') }}">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_payments" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_payments ? 'checked' : '' }}>
                  @lang('invoice.show_payments')</label>
              </div>
            </div>
          </div>

          <!-- Barcode -->
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_barcode" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_barcode ? 'checked' : '' }}>
                  @lang('invoice.show_barcode')</label>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="prev_bal_label">
                {{ __('invoice.total_due_label') }} ({{ __('lang_v1.all_sales') }}):
              </label>
              <input type="text" name="prev_bal_label" id="prev_bal_label"
                class="form-control"
                placeholder="{{ __('invoice.total_due_label') }}"
                value="{{ $invoice_layout->prev_bal_label }}">

            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="show_previous_bal" value="1"
                    class="input-icheck"
                    {{ $invoice_layout->show_previous_bal ? 'checked' : '' }}>
                  @lang('lang_v1.show_previous_bal_due')</label>
                @show_tooltip(__('lang_v1.previous_bal_due_help'))
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <input type="checkbox" name="show_previous_bal" value="1"
                class="input-icheck"
                {{ $invoice_layout->show_previous_bal ? 'checked' : '' }}>
              @show_tooltip(__('lang_v1.change_return_help'))
              <input type="text" name="change_return_label" class="form-control"
                value="{{ $invoice_layout->change_return_label }}"
                placeholder="{{ __('lang_v1.change_return_label') }}">

            </div>
          </div>
          <div class="col-sm-3 @if($invoice_layout->design != 'slim') hide @endif" id="hide_price_div">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="common_settings[hide_price]" value="1" class="input-icheck"
                    {{ !empty($invoice_layout->common_settings['hide_price']) ? 'checked' : '' }}>
                  @lang('lang_v1.hide_all_prices')</label>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label>
                <input type="checkbox" name="common_settings[show_total_in_words]" value="1" class="input-icheck"
                  {{ !empty($invoice_layout->common_settings['show_total_in_words']) ? 'checked' : '' }}>
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
                <option value="international" {{ ($invoice_layout->common_settings['num_to_word_format'] ?? 'international') == 'international' ? 'selected' : '' }}>
                  {{ __('lang_v1.international') }}
                </option>
                <option value="indian" {{ ($invoice_layout->common_settings['num_to_word_format'] ?? 'international') == 'indian' ? 'selected' : '' }}>
                  {{ __('lang_v1.indian') }}
                </option>
              </select>

            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="box box-solid">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">

            <div class="col-sm-6 hide">
              <div class="form-group">
                <label for="highlight_color">{{ __('invoice.highlight_color') }}:</label>
                <input type="text" name="highlight_color" id="highlight_color" class="form-control"
                  value="{{ $invoice_layout->highlight_color }}"
                  placeholder="{{ __('invoice.highlight_color') }}">

              </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 hide">
              <hr />
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="footer_text">{{ __('invoice.footer_text') }}:</label>
                <textarea name="footer_text" id="footer_text" class="form-control" rows="3"
                  placeholder="{{ __('invoice.footer_text') }}">{{ old('footer_text', $invoice_layout->footer_text) }}</textarea>

              </div>
            </div>
            @if(empty($invoice_layout->is_default))
            <div class="col-sm-6">
              <div class="form-group">
                <br>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="is_default" value="1" class="input-icheck"
                      {{ old('is_default', $invoice_layout->is_default) ? 'checked' : '' }}>
                    @lang('barcode.set_as_default')</label>
                </div>
              </div>
            </div>
            @endif

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
              <input type="checkbox" name="show_qr_code" value="1" class="input-icheck"
                {{ old('show_qr_code', $invoice_layout->show_qr_code) ? 'checked' : '' }}>
              @lang('lang_v1.show_qr_code')</label>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
        <h4>@lang('lang_v1.fields_to_be_shown'):</h4>
      </div>
      @php
      $qr_code_fields = empty($invoice_layout->qr_code_fields) ? [] : $invoice_layout->qr_code_fields;
      @endphp
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="business_name" class="input-icheck"
                {{ in_array('business_name', $qr_code_fields) ? 'checked' : '' }}>
              @lang('business.business_name')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="address" class="input-icheck"
                {{ in_array('address', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.business_location_address')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="tax_1" class="input-icheck"
                {{ in_array('tax_1', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.business_tax_1')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="tax_2" class="input-icheck"
                {{ in_array('tax_2', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.business_tax_2')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="invoice_no" class="input-icheck"
                {{ in_array('invoice_no', $qr_code_fields) ? 'checked' : '' }}>
              @lang('sale.invoice_no')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="invoice_datetime" class="input-icheck"
                {{ in_array('invoice_datetime', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.invoice_datetime')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="subtotal" class="input-icheck"
                {{ in_array('subtotal', $qr_code_fields) ? 'checked' : '' }}>
              @lang('sale.subtotal')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="total_amount" class="input-icheck"
                {{ in_array('total_amount', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.total_amount_with_tax')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="total_tax" class="input-icheck"
                {{ in_array('total_tax', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.total_tax')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="customer_name" class="input-icheck"
                {{ in_array('customer_name', $qr_code_fields) ? 'checked' : '' }}>
              @lang('sale.customer_name')</label>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="qr_code_fields[]" value="invoice_url" class="input-icheck"
                {{ in_array('invoice_url', $qr_code_fields) ? 'checked' : '' }}>
              @lang('lang_v1.view_invoice_url')</label>
          </div>
        </div>
      </div>

    </div>
    @endcomponent
    @if(!empty($enabled_modules) && in_array('types_of_service', $enabled_modules) )
    @include('types_of_service.invoice_layout_settings', ['module_info' => $invoice_layout->module_info])
    @endif
    <!-- Call restaurant module if defined -->
    @include('restaurant.partials.invoice_layout', ['module_info' => $invoice_layout->module_info, 'edit_il' => true])

    @if(Module::has('Repair'))
    @include('repair::layouts.partials.invoice_layout_settings', ['module_info' => $invoice_layout->module_info, 'edit_il' => true])
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
              <input type="text" name="cn_heading" id="cn_heading" class="form-control"
                value="{{ $invoice_layout->cn_heading }}" placeholder="{{ __('lang_v1.cn_heading') }}">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="cn_no_label">{{ __('lang_v1.cn_no_label') }}:</label>
              <input type="text" name="cn_no_label" id="cn_no_label" class="form-control"
                value="{{ $invoice_layout->cn_no_label }}" placeholder="{{ __('lang_v1.cn_no_label') }}">
            </div>
          </div>


          <div class="col-sm-3">
            <div class="form-group">
              <label for="cn_amount_label">{{ __('lang_v1.cn_amount_label') }}:</label>
              <input type="text" name="cn_amount_label" id="cn_amount_label" class="form-control"
                value="{{ $invoice_layout->cn_amount_label }}" placeholder="{{ __('lang_v1.cn_amount_label') }}">
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary btn-big">@lang('messages.update')</button>
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