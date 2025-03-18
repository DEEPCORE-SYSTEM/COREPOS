<div class="modal-dialog" role="document">
  <div class="modal-content">

    <form action="{{ action('\Modules\Essentials\Http\Controllers\EssentialsHolidayController@update', [$holiday->id]) }}" 
          method="POST" id="add_holiday_form">
        @csrf
        @method('PUT')

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">@lang('essentials::lang.edit_holiday')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name">@lang('lang_v1.name')*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                           placeholder="@lang('lang_v1.name')" value="{{ $holiday->name }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="start_date">@lang('essentials::lang.start_date')*</label>
                    <div class="input-group data">
                        <input type="text" name="start_date" id="start_date" class="form-control" readonly 
                               placeholder="@lang('essentials::lang.start_date')" 
                               value="{{ format_date($holiday->start_date) }}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="end_date">@lang('essentials::lang.end_date')*</label>
                    <div class="input-group data">
                        <input type="text" name="end_date" id="end_date" class="form-control" required readonly 
                               placeholder="@lang('essentials::lang.end_date')" 
                               value="{{ format_date($holiday->end_date) }}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="location_id">@lang('business.business_location')</label>
                    <select name="location_id" id="location_id" class="form-control select2">
                        <option value="">@lang('lang_v1.all')</option>
                        @foreach($locations as $key => $value)
                            <option value="{{ $key }}" {{ $holiday->location_id == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="note">@lang('brand.note')</label>
                    <textarea name="note" id="note" class="form-control" rows="3" 
                              placeholder="@lang('brand.note')">{{ $holiday->note }}</textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
