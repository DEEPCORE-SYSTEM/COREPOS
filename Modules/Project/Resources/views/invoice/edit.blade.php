@extends('layouts.app')
@section('title', __('project::lang.invoices'))

@section('content')
<section class="content">
    <h1>
        <i class="fa fa-file"></i>
        @lang('project::lang.invoice')
        <small>@lang('project::lang.edit')</small>
    </h1>

    <!-- Formulario para actualizar la factura -->
    <form action="{{ action('\Modules\Project\Http\Controllers\InvoiceController@update', $transaction->id) }}" method="POST" id="invoice_form">
        @csrf
        @method('PUT') <!-- Método PUT para actualizar -->

        <!-- Información principal de la factura -->
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <!-- Título de la factura -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pjt_title">@lang('project::lang.title') *</label>
                            <input type="text" name="pjt_title" class="form-control" value="{{ $transaction->pjt_title }}" required>
                        </div>
                    </div>

                    <!-- ID del proyecto (campo oculto) -->
                    <input type="hidden" name="pjt_project_id" value="{{ $transaction->pjt_project_id }}">

                    <!-- Selección del cliente -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contact_id">@lang('role.customer') *</label>
                            <select name="contact_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($customers as $id => $customer)
                                    <option value="{{ $id }}" {{ $id == $transaction->contact_id ? 'selected' : '' }}>{{ $customer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Selección de la ubicación -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="location_id">@lang('business.business_location') *</label>
                            <select name="location_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($business_locations as $id => $location)
                                    <option value="{{ $id }}" {{ $id == $transaction->location_id ? 'selected' : '' }}>{{ $location }}</option>
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
                            <input type="text" name="transaction_date" class="form-control date-picker" value="{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') }}" required readonly>
                        </div>
                    </div>

                    <!-- Términos de pago -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pay_term_number">@lang('contact.pay_term')</label>
                            <div class="input-group">
                                <input type="number" id="pay_term_number" name="pay_term_number" class="form-control width-40" value="{{ $transaction->pay_term_number }}">
                                <select name="pay_term_type" class="form-control width-60">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    <option value="months" {{ $transaction->pay_term_type == 'months' ? 'selected' : '' }}>@lang('lang_v1.months')</option>
                                    <option value="days" {{ $transaction->pay_term_type == 'days' ? 'selected' : '' }}>@lang('lang_v1.days')</option>
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
                                    <option value="{{ $id }}" {{ $id == $transaction->status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de líneas de la factura -->
        <div class="box box-primary">
            <div class="box-body">
                <div class="invoice_lines">
                    @foreach($transaction->invoiceLines as $key => $invoiceLine)
                        <div class="row invoice_line">
                            <!-- ID de la línea de factura (campo oculto) -->
                            <input type="hidden" name="invoice_line_id[]" value="{{ $invoiceLine->id }}">

                            <!-- Tarea -->
                            <div class="col-md-3">
                                <input type="text" name="existing_task[]" class="form-control" value="{{ $invoiceLine->task }}" required>
                            </div>

                            <!-- Tarifa -->
                            <div class="col-md-2">
                                <input type="text" name="existing_rate[]" class="form-control input_number rate" value="{{ number_format($invoiceLine->rate, 2) }}" required>
                            </div>

                            <!-- Cantidad -->
                            <div class="col-md-2">
                                <input type="text" name="existing_quantity[]" class="form-control input_number quantity" value="{{ number_format($invoiceLine->quantity, 2) }}" required>
                            </div>

                            <!-- Impuesto -->
                            <div class="col-md-2">
                                <select name="existing_tax_rate_id[]" class="form-control tax">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($taxes as $id => $tax)
                                        <option value="{{ $id }}" {{ $id == $invoiceLine->tax_rate_id ? 'selected' : '' }}>{{ $tax }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Total -->
                            <div class="col-md-2">
                                <input type="text" name="existing_total[]" class="form-control input_number total" value="{{ number_format($invoiceLine->total, 2) }}" required readonly>
                            </div>

                            <!-- Botón para eliminar la fila -->
                            @if($key != 0)
                                <div class="col-md-1">
                                    <i class="fa fa-trash text-danger cursor-pointer remove_this_row"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Botón para agregar más líneas -->
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
                                <option value="{{ $id }}" {{ $id == $transaction->discount_type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cantidad de descuento -->
                    <div class="col-md-6">
                        <label>@lang('sale.discount_amount')</label>
                        <input type="text" name="discount_amount" class="form-control input_number" value="{{ number_format($transaction->discount_amount, 2) }}">
                    </div>
                </div>

                <!-- Botón para actualizar -->
                <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
            </div>
        </div>
    </form>
</section>

<link rel="stylesheet" href="{{ asset('modules/project/sass/project.css?v=' . $asset_v) }}">
@endsection
@section('javascript')
<script src="{{ asset('modules/project/js/project.js?v=' . $asset_v) }}"></script>
<!-- call a function to calculate subtotal once edit page is loaded -->
<script type="text/javascript">
	$(document).ready(function() {
		calculateSubtotal();
	});
</script>
@endsection