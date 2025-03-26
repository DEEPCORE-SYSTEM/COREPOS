<div class="modal fade" tabindex="-1" role="dialog" id="modal_payment">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ __('lang_v1.payment') }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-12">
                        <strong>{{ __('lang_v1.advance_balance') }}:</strong> <span id="advance_balance_text"></span>
                        <input type="hidden" id="advance_balance" name="advance_balance" data-error-msg="{{ __('lang_v1.required_advance_balance_not_available') }}">
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <div id="payment_rows_div">
                                @foreach($payment_lines as $index => $payment_line)
                                    @if($payment_line['is_return'] == 1)
                                        @php
                                            $change_return = $payment_line;
                                        @endphp
                                        @continue
                                    @endif
                                    @include('sale_pos.partials.payment_row', ['removable' => $index > 0, 'row_index' => $index, 'payment_line' => $payment_line])
                                @endforeach
                            </div>
                            <input type="hidden" id="payment_row_index" value="{{ count($payment_lines) }}">
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block" id="add-payment-row">
                                    {{ __('sale.add_payment_row') }}
                                </button>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sale_note">{{ __('sale.sell_note') }}:</label>
                                    <textarea name="sale_note" id="sale_note" class="form-control" rows="3" placeholder="{{ __('sale.sell_note') }}">{{ $transaction->additional_notes ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="staff_note">{{ __('sale.staff_note') }}:</label>
                                    <textarea name="staff_note" id="staff_note" class="form-control" rows="3" placeholder="{{ __('sale.staff_note') }}">{{ $transaction->staff_note ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box box-solid bg-orange">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <strong>{{ __('lang_v1.total_items') }}:</strong>
                                    <br/>
                                    <span class="lead text-bold total_quantity">0</span>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>{{ __('sale.total_payable') }}:</strong>
                                    <br/>
                                    <span class="lead text-bold total_payable_span">0</span>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>{{ __('lang_v1.total_paying') }}:</strong>
                                    <br/>
                                    <span class="lead text-bold total_paying">0</span>
                                    <input type="hidden" id="total_paying_input">
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>{{ __('lang_v1.change_return') }}:</strong>
                                    <br/>
                                    <span class="lead text-bold change_return_span">0</span>
                                    <input type="hidden" name="change_return" class="form-control change_return input_number" required id="change_return" value="{{ $change_return['amount'] ?? '' }}">
                                    @if(!empty($change_return['id']))
                                        <input type="hidden" name="change_return_id" value="{{ $change_return['id'] }}">
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <strong>{{ __('lang_v1.balance') }}:</strong>
                                    <br/>
                                    <span class="lead text-bold balance_due">0</span>
                                    <input type="hidden" id="in_balance_due" value="0">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
                <button type="submit" class="btn btn-primary" id="pos-save">{{ __('sale.finalize_payment') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- /.modal -->

<!-- Used for express checkout card transaction -->
<div class="modal fade" tabindex="-1" role="dialog" id="card_details_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ __('lang_v1.card_transaction_details') }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="card_number">{{ __('lang_v1.card_no') }}</label>
                                <input type="text" class="form-control" id="card_number" placeholder="{{ __('lang_v1.card_no') }}" autofocus>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="card_holder_name">{{ __('lang_v1.card_holder_name') }}</label>
                                <input type="text" class="form-control" id="card_holder_name" placeholder="{{ __('lang_v1.card_holder_name') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="card_transaction_number">{{ __('lang_v1.card_transaction_no') }}</label>
                                <input type="text" class="form-control" id="card_transaction_number" placeholder="{{ __('lang_v1.card_transaction_no') }}">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="card_type">{{ __('lang_v1.card_type') }}</label>
                                <select class="form-control select2" id="card_type">
                                    <option value="visa">Visa</option>
                                    <option value="master">MasterCard</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="card_month">{{ __('lang_v1.month') }}</label>
                                <input type="text" class="form-control" id="card_month" placeholder="{{ __('lang_v1.month') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="card_year">{{ __('lang_v1.year') }}</label>
                                <input type="text" class="form-control" id="card_year" placeholder="{{ __('lang_v1.year') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="card_security">{{ __('lang_v1.security_code') }}</label>
                                <input type="text" class="form-control" id="card_security" placeholder="{{ __('lang_v1.security_code') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="pos-save-card">{{ __('sale.finalize_payment') }}</button>
            </div>
        </div>
    </div>
</div>
