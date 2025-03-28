<div class="box box-solid @if(!empty($expense->type) && $expense->type == 'expense_refund') hide @endif" id="recur_expense_div">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <br>
                <label>
                    <input type="checkbox" name="is_recurring" value="1" class="input-icheck" id="is_recurring" 
                        {{ !empty($expense->is_recurring) == 1 ? 'checked' : '' }}> 
                    @lang('lang_v1.is_recurring')?
                </label>
                @show_tooltip(__('lang_v1.recurring_expense_help'))
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="recur_interval">@lang('lang_v1.recur_interval'):</label>
                    <div class="input-group">
                        <input type="number" name="recur_interval" id="recur_interval" class="form-control" style="width: 50%;"
                            value="{{ !empty($expense->recur_interval) ? $expense->recur_interval : '' }}">

                        <select name="recur_interval_type" id="recur_interval_type" class="form-control" style="width: 50%;">
                            <option value="days" {{ !empty($expense->recur_interval_type) && $expense->recur_interval_type == 'days' ? 'selected' : '' }}>@lang('lang_v1.days')</option>
                            <option value="months" {{ !empty($expense->recur_interval_type) && $expense->recur_interval_type == 'months' ? 'selected' : '' }}>@lang('lang_v1.months')</option>
                            <option value="years" {{ !empty($expense->recur_interval_type) && $expense->recur_interval_type == 'years' ? 'selected' : '' }}>@lang('lang_v1.years')</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="recur_repetitions">@lang('lang_v1.no_of_repetitions'):</label>
                    <input type="number" name="recur_repetitions" id="recur_repetitions" class="form-control" 
                        value="{{ !empty($expense->recur_repetitions) ? $expense->recur_repetitions : '' }}">
                    <p class="help-block">@lang('lang_v1.recur_expense_repetition_help')</p>
                </div>
            </div>

            @php
                $repetitions = [];
                for ($i = 1; $i <= 30; $i++) { 
                    $repetitions[$i] = str_ordinal($i);
                }
            @endphp

            <div class="recur_repeat_on_div col-md-4 @if(empty($expense->recur_interval_type) || $expense->recur_interval_type != 'months') hide @endif">
                <div class="form-group">
                    <label for="subscription_repeat_on">@lang('lang_v1.repeat_on'):</label>
                    <select name="subscription_repeat_on" id="subscription_repeat_on" class="form-control">
                        <option value="">@lang('messages.please_select')</option>
                        @foreach($repetitions as $key => $value)
                            <option value="{{ $key }}" {{ !empty($expense->subscription_repeat_on) && $expense->subscription_repeat_on == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
