<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{ action('ExpenseController@store') }}" method="POST" id="add_expense_modal_form" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('expense.add_expense')</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    @php
                        $default_location = count($business_locations) == 1 
                            ? current(array_keys($business_locations->toArray())) 
                            : request()->input('location_id');
                    @endphp

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_location_id">@lang('purchase.business_location'):</label>
                            <select name="location_id" id="expense_location_id" class="form-control select2" required>
                                <option value="">@lang('messages.please_select')</option>
                                @foreach($business_locations as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $default_location ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_category_id">@lang('expense.expense_category'):</label>
                            <select name="expense_category_id" id="expense_category_id" class="form-control select2">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach($expense_categories as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_ref_no">@lang('purchase.ref_no'):</label>
                            <input type="text" name="ref_no" id="expense_ref_no" class="form-control">
                            <p class="help-block">@lang('lang_v1.leave_empty_to_autogenerate')</p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_transaction_date">@lang('messages.date'):</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="transaction_date" id="expense_transaction_date" class="form-control" value="{{ @format_datetime('now') }}" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_for">@lang('expense.expense_for'):</label>
                            <select name="expense_for" id="expense_for" class="form-control select2">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach($users as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expense_tax_id">@lang('product.applicable_tax'):</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </span>
                                <select name="tax_id" id="expense_tax_id" class="form-control">
                                    @foreach($taxes['tax_rates'] as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="0">
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_final_total">@lang('sale.total_amount'):</label>
                            <input type="text" name="final_total" id="expense_final_total" class="form-control input_number" placeholder="@lang('sale.total_amount')" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="expense_additional_notes">@lang('expense.expense_note'):</label>
                            <textarea name="additional_notes" id="expense_additional_notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="payment_row">
                    <h4>@lang('purchase.add_payment'):</h4>
                    @include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true])
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <strong>@lang('purchase.payment_due'):</strong>
                                <span id="expense_payment_due">{{ @num_format(0) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </form>
    </div>
</div>
