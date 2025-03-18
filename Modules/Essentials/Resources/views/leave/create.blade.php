<div class="modal-dialog" role="document">
  <div class="modal-content">

    <form action="{{ action('\Modules\Essentials\Http\Controllers\EssentialsLeaveController@store') }}" 
          method="POST" id="add_leave_form">
        @csrf

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">@lang('essentials::lang.add_leave')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                @can('essentials.crud_all_leave')
                    <div class="form-group col-md-12">
                        <label for="employees">@lang('essentials::lang.select_employee'):</label>
                        <select name="employees[]" id="employees" class="form-control select2" style="width: 100%;" multiple required>
                            @foreach($employees as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                @endcan

                <div class="form-group col-md-12">
                    <label for="essentials_leave_type_id">@lang('essentials::lang.leave_type')*</label>
                    <select name="essentials_leave_type_id" id="essentials_leave_type_id" class="form-control select2" required>
                        <option value="">@lang('messages.please_select')</option>
                        @foreach($leave_types as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="start_date">@lang('essentials::lang.start_date')*</label>
                    <div class="input-group data">
                        <input type="text" name="start_date" id="start_date" class="form-control" readonly 
                               placeholder="@lang('essentials::lang.start_date')">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="end_date">@lang('essentials::lang.end_date')*</label>
                    <div class="input-group data">
                        <input type="text" name="end_date" id="end_date" class="form-control" required readonly 
                               placeholder="@lang('essentials::lang.end_date')">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="reason">@lang('essentials::lang.reason')</label>
                    <textarea name="reason" id="reason" class="form-control" rows="4" required 
                              placeholder="@lang('essentials::lang.reason')"></textarea>
                </div>

                <hr>
                <div class="col-md-12">
                    {!! $instructions !!}
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary ladda-button add-leave-btn" data-style="expand-right">
                <span class="ladda-label">@lang('messages.save')</span>
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
