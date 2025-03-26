<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form action="{{ action('CashRegisterController@postCloseRegister') }}" method="POST">
      @csrf

      <input type="hidden" name="user_id" value="{{ $register_details->user_id }}">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">
          @lang('cash_register.current_register') 
          ({{ \Carbon\Carbon::parse($register_details->open_time)->format('jS M, Y h:i A') }} - {{ \Carbon\Carbon::now()->format('jS M, Y h:i A') }})
        </h3>
      </div>

      <div class="modal-body">
        @include('cash_register.payment_details')
        <hr>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="closing_amount">@lang('cash_register.total_cash'):</label>
              <input type="text" name="closing_amount" class="form-control input_number" required 
                     placeholder="@lang('cash_register.total_cash')" 
                     value="{{ number_format($register_details->cash_in_hand + $register_details->total_cash - $register_details->total_cash_refund - $register_details->total_cash_expense, 2) }}">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="total_card_slips">@lang('cash_register.total_card_slips'):</label>
              <input type="number" name="total_card_slips" class="form-control" required 
                     placeholder="@lang('cash_register.total_card_slips')" min="0"
                     value="{{ $register_details->total_card_slips }}">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="total_cheques">@lang('cash_register.total_cheques'):</label>
              <input type="number" name="total_cheques" class="form-control" required 
                     placeholder="@lang('cash_register.total_cheques')" min="0"
                     value="{{ $register_details->total_cheques }}">
            </div>
          </div>
        </div>

        <hr>

        <div class="col-md-8 col-sm-12">
          <h3>@lang('lang_v1.cash_denominations')</h3>
          @if(!empty($pos_settings['cash_denominations']))
            <table class="table table-slim">
              <thead>
                <tr>
                  <th class="text-right">@lang('lang_v1.denomination')</th>
                  <th class="text-center">X</th>
                  <th class="text-center">@lang('lang_v1.count')</th>
                  <th class="text-center">=</th>
                  <th class="text-left">@lang('sale.subtotal')</th>
                </tr>
              </thead>
              <tbody>
                @foreach(explode(',', $pos_settings['cash_denominations']) as $dnm)
                  <tr>
                    <td class="text-right">{{ $dnm }}</td>
                    <td class="text-center">X</td>
                    <td>
                      <input type="number" name="denominations[{{ $dnm }}]" class="form-control cash_denomination input-sm" min="0" data-denomination="{{ $dnm }}" style="width: 100px; margin:auto;">
                    </td>
                    <td class="text-center">=</td>
                    <td class="text-left">
                      <span class="denomination_subtotal">0</span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4" class="text-center">@lang('sale.total')</th>
                  <td><span class="denomination_total">0</span></td>
                </tr>
              </tfoot>
            </table>
          @else
            <p class="help-block">@lang('lang_v1.denomination_add_help_text')</p>
          @endif
        </div>

        <hr>

        <div class="col-sm-12">
          <div class="form-group">
            <label for="closing_note">@lang('cash_register.closing_note'):</label>
            <textarea name="closing_note" class="form-control" placeholder="@lang('cash_register.closing_note')" rows="3"></textarea>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <b>@lang('report.user'):</b> {{ $register_details->user_name }}<br>
          <b>@lang('business.email'):</b> {{ $register_details->email }}<br>
          <b>@lang('business.business_location'):</b> {{ $register_details->location_name }}<br>
        </div>
        @if(!empty($register_details->closing_note))
          <div class="col-xs-6">
            <strong>@lang('cash_register.closing_note'):</strong><br>
            {{ $register_details->closing_note }}
          </div>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
        <button type="submit" class="btn btn-primary">@lang('cash_register.close_register')</button>
      </div>
    </form>
  </div>
</div>
