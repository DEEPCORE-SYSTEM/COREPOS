@extends('layouts.app')
@section('title', __('project::lang.invoices'))

@section('content')
<section class="content">
    <h1>
        <i class="fa fa-file"></i>
        @lang('project::lang.invoice')
        <small>@lang('project::lang.create')</small>
    </h1>

    <!-- Formulario de creación de factura -->
    <form action="{{ action('\Modules\Project\Http\Controllers\InvoiceController@store') }}" method="POST" id="invoice_form">
        @csrf <!-- Token de seguridad para formularios en Laravel -->
        
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <!-- Campo de título de la factura -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pjt_title">@lang('project::lang.title') *</label>
                            <input type="text" name="pjt_title" class="form-control" required>
                        </div>
                    </div>

                    <!-- Campo oculto para el ID del proyecto -->
                    <input type="hidden" name="pjt_project_id" value="{{ $project->id }}">

                    <!-- Selección del esquema de factura -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="invoice_scheme_id">@lang('invoice.invoice_scheme') *</label>
                            <select name="invoice_scheme_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($invoice_schemes as $id => $scheme)
                                    <option value="{{ $id }}" {{ $id == $default_scheme->id ? 'selected' : '' }}>{{ $scheme }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Selección del cliente -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_id">@lang('role.customer') *</label>
                            <select name="contact_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($customers as $id => $customer)
                                    <option value="{{ $id }}" {{ $id == $project->contact_id ? 'selected' : '' }}>{{ $customer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Selección de la ubicación del negocio -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location_id">@lang('business.business_location') *</label>
                            <select name="location_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($business_locations as $id => $location)
                                    <option value="{{ $id }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Fecha de la factura -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="transaction_date">@lang('project::lang.invoice_date') *</label>
                            <input type="text" name="transaction_date" class="form-control date-picker" required readonly>
                        </div>
                    </div>

                    <!-- Términos de pago -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pay_term_number">@lang('contact.pay_term')</label>
                            <div class="input-group">
                                <input type="number" name="pay_term_number" class="form-control width-40">
                                <select name="pay_term_type" class="form-control width-60">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    <option value="months">@lang('lang_v1.months')</option>
                                    <option value="days">@lang('lang_v1.days')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Estado de la factura -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">@lang('sale.status') *</label>
                            <select name="status" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Fin del primer bloque -->

        <!-- Sección de líneas de la factura -->
        <div class="box box-primary">
            <div class="box-body">
                <div class="invoice_lines">
                    <div class="col-md-12 il-bg invoice_line">
                        <div class="row">
                            <!-- Tarea -->
                            <div class="col-md-3">
                                <input type="text" name="task[]" class="form-control" required placeholder="@lang('project::lang.task')">
                            </div>
                            <!-- Tarifa -->
                            <div class="col-md-2">
                                <input type="text" name="rate[]" class="form-control input_number rate" required placeholder="@lang('project::lang.rate')">
                            </div>
                            <!-- Cantidad -->
                            <div class="col-md-2">
                                <input type="text" name="quantity[]" class="form-control input_number quantity" required placeholder="@lang('project::lang.qty')">
                            </div>
                            <!-- Impuestos -->
                            <div class="col-md-2">
                                <select name="tax_rate_id[]" class="form-control tax">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($taxes as $id => $tax)
                                        <option value="{{ $id }}">{{ $tax }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Total -->
                            <div class="col-md-2">
                                <input type="text" name="total[]" class="form-control input_number total" required readonly placeholder="@lang('receipt.total')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <button type="button" class="btn btn-primary btn-sm add_invoice_line">
                        @lang('project::lang.add_a_row') <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
        </div> 

        <!-- Resumen de totales -->
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-10">
                        <b>@lang('sale.subtotal'):</b>
                        <span class="subtotal display_currency" data-currency_symbol="true">0.00</span>
                    </div>
                </div>

                <div class="row">
                    <!-- Tipo de descuento -->
                    <div class="col-md-6">
                        <label>@lang('sale.discount_type')</label>
                        <select name="discount_type" class="form-control select2">
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($discount_types as $id => $type)
                                <option value="{{ $id }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Cantidad de descuento -->
                    <div class="col-md-6">
                        <label>@lang('sale.discount_amount')</label>
                        <input type="text" name="discount_amount" class="form-control input_number">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <b>@lang('project::lang.invoice_total'):</b>
                        <span class="invoice_total display_currency" data-currency_symbol="true">0.00</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
            </div>
        </div>
    </form>
</section>

<link rel="stylesheet" href="{{ asset('modules/project/sass/project.css?v=' . $asset_v) }}">
@endsection
@section('javascript')
<script src="{{ asset('modules/project/js/project.js?v=' . $asset_v) }}"></script>
@endsection