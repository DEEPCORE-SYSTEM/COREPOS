@extends('layouts.app')
@section('title', __('expense.edit_expense'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('expense.edit_expense')</h1>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ action('ExpenseController@update', [$expense->id]) }}" method="POST" id="add_expense_form" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Método PUT para actualizar -->

        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <!-- Selección de ubicación -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="location_id">{{ __('purchase.business_location') }}:*</label>
                            <select name="location_id" id="location_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($business_locations as $key => $location)
                                    <option value="{{ $key }}" {{ $expense->location_id == $key ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Categoría del gasto -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="expense_category_id">{{ __('expense.expense_category') }}:</label>
                            <select name="expense_category_id" id="expense_category_id" class="form-control select2">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($expense_categories as $key => $category)
                                    <option value="{{ $key }}" {{ $expense->expense_category_id == $key ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Número de referencia -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="ref_no">{{ __('purchase.ref_no') }}:*</label>
                            <input type="text" name="ref_no" id="ref_no" class="form-control" value="{{ $expense->ref_no }}" required>
                            <p class="help-block">@lang('lang_v1.leave_empty_to_autogenerate')</p>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Fecha de la transacción -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="transaction_date">{{ __('messages.date') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="transaction_date" id="expense_transaction_date" class="form-control" value="{{ \Carbon\Carbon::parse($expense->transaction_date)->format('Y-m-d H:i:s') }}" readonly required>
                            </div>
                        </div>
                    </div>

                    <!-- Gasto para (usuario) -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="expense_for">{{ __('expense.expense_for') }}:</label>
                            <select name="expense_for" id="expense_for" class="form-control select2">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($users as $key => $user)
                                    <option value="{{ $key }}" {{ $expense->expense_for == $key ? 'selected' : '' }}>
                                        {{ $user }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Contacto relacionado -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="contact_id">{{ __('lang_v1.expense_for_contact') }}:</label>
                            <select name="contact_id" id="contact_id" class="form-control select2">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($contacts as $key => $contact)
                                    <option value="{{ $key }}" {{ $expense->contact_id == $key ? 'selected' : '' }}>
                                        {{ $contact }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Archivo adjunto -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="document">{{ __('purchase.attach_document') }}:</label>
                            <input type="file" name="document" id="upload_document" accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">
                            <p class="help-block">
                                @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                                @includeIf('components.document_help_text')
                            </p>
                        </div>
                    </div>

                    <!-- Impuesto aplicable -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax_id">{{ __('product.applicable_tax') }}:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <select name="tax_id" id="tax_id" class="form-control">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($taxes['tax_rates'] as $key => $tax)
                                        <option value="{{ $key }}" {{ $expense->tax_id == $key ? 'selected' : '' }}>
                                            {{ $tax }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Monto total -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="final_total">{{ __('sale.total_amount') }}:*</label>
                            <input type="text" name="final_total" id="final_total" class="form-control input_number" value="{{ number_format($expense->final_total, 2) }}" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Notas adicionales -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="additional_notes">{{ __('expense.expense_note') }}:</label>
                            <textarea name="additional_notes" id="additional_notes" class="form-control" rows="3">{{ $expense->additional_notes }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Fin de la caja -->

        <!-- Sección de gastos recurrentes -->
        @include('expense.recur_expense_form_part')

        <!-- Botón de actualización -->
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary btn-big">@lang('messages.update')</button>
        </div>
    </form>
</section>

@stop
@section('javascript')
<script type="text/javascript">
  __page_leave_confirmation('#add_expense_form');
</script>
@endsection