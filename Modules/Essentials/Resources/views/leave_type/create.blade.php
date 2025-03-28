<div class="modal fade" id="add_leave_type_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ action('\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController@store') }}" 
                  method="POST" id="add_leave_type_form">
                @csrf

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">@lang('essentials::lang.add_leave_type')</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="leave_type">@lang('essentials::lang.leave_type')*</label>
                        <input type="text" name="leave_type" id="leave_type" class="form-control" required 
                               placeholder="@lang('essentials::lang.leave_type')">
                    </div>

                    <div class="form-group">
                        <label for="max_leave_count">@lang('essentials::lang.max_leave_count')</label>
                        <input type="number" name="max_leave_count" id="max_leave_count" class="form-control" 
                               placeholder="@lang('essentials::lang.max_leave_count')">
                    </div>

                    <div class="form-group">
                        <strong>@lang('essentials::lang.leave_count_interval')</strong><br>
                        <label class="radio-inline">
                            <input type="radio" name="leave_count_interval" value="month"> @lang('essentials::lang.current_month')
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="leave_count_interval" value="year"> @lang('essentials::lang.current_fy')
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="leave_count_interval" value=""> @lang('lang_v1.none')
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
