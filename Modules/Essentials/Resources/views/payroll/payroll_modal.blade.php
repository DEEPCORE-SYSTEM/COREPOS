<div class="modal fade" id="payroll_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Formulario para crear nómina -->
            <form action="{{ action('\Modules\Essentials\Http\Controllers\PayrollController@create') }}" 
                  method="GET" id="add_payroll_step1">
                @csrf

                <div class="modal-body">
                    <!-- Selección de empleado -->
                    <div class="form-group">
                        <label for="employee_id">@lang('essentials::lang.employee')*</label>
                        <select name="employee_id" id="employee_id" class="form-control select2" required style="width: 100%;">
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($employees as $key => $employee)
                                <option value="{{ $key }}">{{ $employee }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selección de mes y año -->
                    <div class="form-group">
                        <label for="month_year">@lang('essentials::lang.month_year')*</label>
                        <div class="input-group">
                            <input type="text" name="month_year" id="month_year" class="form-control" 
                                   placeholder="@lang('essentials::lang.month_year')" required readonly>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('essentials::lang.proceed')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
