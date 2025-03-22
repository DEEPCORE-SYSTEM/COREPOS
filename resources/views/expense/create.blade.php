@extends('layouts.app')
@section('title', __('expense.add_expense'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('expense.add_expense')</h1>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ action('ExpenseController@store') }}" method="POST" id="add_expense_form" enctype="multipart/form-data">
        @csrf <!-- Token de seguridad de Laravel -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">

                    <!-- Determinar la ubicación por defecto -->
                    @php
                        $default_location = count($business_locations) == 1 ? current(array_keys($business_locations->toArray())) : null;
                    @endphp

                    <!-- Selección de ubicación -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="location_id">{{ __('purchase.business_location') }}:*</label>
                            <select name="location_id" id="location_id" class="form-control select2" required>
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($business_locations as $key => $location)
                                    <option value="{{ $key }}" {{ $default_location == $key ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Categoría de gasto -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="expense_category_id">{{ __('expense.expense_category') }}:</label>
                            <select name="expense_category_id" id="expense_category_id" class="form-control select2">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($expense_categories as $key => $category)
                                    <option value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Número de referencia -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="ref_no">{{ __('purchase.ref_no') }}:</label>
                            <input type="text" name="ref_no" id="ref_no" class="form-control">
                            <p class="help-block">{{ __('lang_v1.leave_empty_to_autogenerate') }}</p>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Fecha de la transacción -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="transaction_date">{{ __('messages.date') }}:*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="transaction_date" id="transaction_date" class="form-control" value="{{ now()->format('Y-m-d H:i:s') }}" readonly required>
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
                                    <option value="{{ $key }}">{{ $user }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Contacto relacionado al gasto -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="contact_id">{{ __('lang_v1.expense_for_contact') }}:</label>
                            <select name="contact_id" id="contact_id" class="form-control select2">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($contacts as $key => $contact)
                                    <option value="{{ $key }}">{{ $contact }}</option>
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
                            <small>
                                <p class="help-block">
                                    {{ __('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) }}
                                </p>
                            </small>
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
                                        <option value="{{ $key }}">{{ $tax }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Monto total -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="final_total">{{ __('sale.total_amount') }}:*</label>
                            <input type="text" name="final_total" id="final_total" class="form-control input_number" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Notas adicionales -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="additional_notes">{{ __('expense.expense_note') }}:</label>
                            <textarea name="additional_notes" id="additional_notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- ¿Es un reembolso? -->
                    <div class="col-md-4 col-sm-6">
                        <br>
                        <label>
                            <input type="checkbox" name="is_refund" value="1" class="input-icheck"> {{ __('lang_v1.is_refund') }}?
                        </label>
                    </div>

                </div>
            </div>
        </div> <!-- Fin de caja -->

        <!-- Sección de pagos -->
        <div class="box box-solid">
            <div class="box-body">
                <h4>{{ __('purchase.add_payment') }}:</h4>
                @include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true])
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right">
                            <strong>{{ __('purchase.payment_due') }}:</strong>
                            <span id="payment_due">{{ number_format(0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de guardar -->
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary btn-big">{{ __('messages.save') }}</button>
        </div>
    </form>
</section>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).ready( function(){
		$('.paid_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
	});
	
	__page_leave_confirmation('#add_expense_form');
	$(document).on('change', 'input#final_total, input.payment-amount', function() {
		calculateExpensePaymentDue();
	});

	function calculateExpensePaymentDue() {
		var final_total = __read_number($('input#final_total'));
		var payment_amount = __read_number($('input.payment-amount'));
		var payment_due = final_total - payment_amount;
		$('#payment_due').text(__currency_trans_from_en(payment_due, true, false));
	}

	$(document).on('change', '#recur_interval_type', function() {
	    if ($(this).val() == 'months') {
	        $('.recur_repeat_on_div').removeClass('hide');
	    } else {
	        $('.recur_repeat_on_div').addClass('hide');
	    }
	});

	$('#is_refund').on('ifChecked', function(event){
		$('#recur_expense_div').addClass('hide');
	});
	$('#is_refund').on('ifUnchecked', function(event){
		$('#recur_expense_div').removeClass('hide');
	});

	$(document).on('change', '.payment_types_dropdown, #location_id', function(e) {
	    var default_accounts = $('select#location_id').length ? 
	                $('select#location_id')
	                .find(':selected')
	                .data('default_payment_accounts') : [];
	    var payment_types_dropdown = $('.payment_types_dropdown');
	    var payment_type = payment_types_dropdown.val();
	    if (payment_type) {
	        var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
	            default_accounts[payment_type]['account'] : '';
	        var payment_row = payment_types_dropdown.closest('.payment_row');
	        var row_index = payment_row.find('.payment_row_index').val();

	        var account_dropdown = payment_row.find('select#account_' + row_index);
	        if (account_dropdown.length && default_accounts) {
	            account_dropdown.val(default_account);
	            account_dropdown.change();
	        }
	    }
	});
</script>
@endsection