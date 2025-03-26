<div class="row">
    <input type="hidden" class="payment_row_index" value="{{ $row_index}}">
    @php
    $col_class = 'col-md-6';
    if(!empty($accounts)){
    $col_class = 'col-md-4';
    }
    $readonly = $payment_line['method'] == 'advance' ? true : false;
    @endphp
    <div class="{{$col_class}}">
        <div class="form-group">
            <label for="amount_{{ $row_index }}">{{ __('sale.amount') }}:*</label>
            <input type="text" name="payment[{{ $row_index }}][amount]"
                value="{{ number_format($payment_line['amount'], 2, '.', ',') }}"
                class="form-control payment-amount input_number" required id="amount_{{ $row_index }}"
                placeholder="{{ __('sale.amount') }}" {{ $readonly ? 'readonly' : '' }}>


        </div>
    </div>
</div>
@if(!empty($show_date))
<div class="{{ $col_class }}">
    <div class="form-group">
        <label for="paid_on_{{ $row_index }}">{{ __('lang_v1.paid_on') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" name="payment[{{ $row_index }}][paid_on]" id="paid_on_{{ $row_index }}"
                value="{{ isset($payment_line['paid_on']) ? format_datetime($payment_line['paid_on']) : @format_datetime(now()) }}"
                class="form-control paid_on" readonly required>
        </div>
    </div>
</div>
</div>

@endif
<div class="{{ $col_class }}">
    <div class="form-group">
        <label for="method_{{ $row_index }}">{{ __('lang_v1.payment_method') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
            </span>

            @php
            $_payment_method = empty($payment_line['method']) && array_key_exists('cash', $payment_types)
            ? 'cash'
            : $payment_line['method'];
            @endphp

            <select name="payment[{{ $row_index }}][method]" class="form-control col-md-12 payment_types_dropdown"
                required id="{{ !$readonly ? 'method_'.$row_index : 'method_advance_'.$row_index }}" style="width:100%;"
                {{ $readonly ? 'disabled' : '' }}>
                @foreach ($payment_types as $key => $value)
                <option value="{{ $key }}" {{ $_payment_method == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
                @endforeach
            </select>

            @if ($readonly)
            <input type="hidden" name="payment[{{ $row_index }}][method]" value="{{ $payment_line['method'] }}"
                class="payment_types_dropdown" required id="method_{{ $row_index }}">
            @endif
        </div>
    </div>
</div>

@if(!empty($accounts))
<div class="{{ $col_class }}">
    <div class="form-group {{ $readonly ? 'hide' : '' }}">
        <label for="account_{{ $row_index }}">{{ __('lang_v1.payment_account') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
            </span>

            <select name="payment[{{ $row_index }}][account_id]" class="form-control select2 account-dropdown"
                id="{{ !$readonly ? 'account_'.$row_index : 'account_advance_'.$row_index }}" style="width:100%;"
                {{ $readonly ? 'disabled' : '' }}>

                @foreach ($accounts as $key => $value)
                <option value="{{ $key }}"
                    {{ !empty($payment_line['account_id']) && $payment_line['account_id'] == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@endif
<div class="clearfix"></div>
@include('sale_pos.partials.payment_type_details')
<div class="col-md-12">
    <div class="form-group">
        <label for="note_{{ $row_index }}">{{ __('sale.payment_note') }}:</label>
        <textarea name="payment[{{ $row_index }}][note]" id="note_{{ $row_index }}" class="form-control"
            rows="3">{{ $payment_line['note'] ?? '' }}</textarea>
    </div>

</div>
</div>