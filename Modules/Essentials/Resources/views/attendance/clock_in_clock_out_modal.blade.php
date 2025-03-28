<div class="modal fade" id="clock_in_clock_out_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <form action="{{ action('\Modules\Essentials\Http\Controllers\AttendanceController@clockInClockOut') }}"
                method="POST" id="clock_in_clock_out_form">
                @csrf

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <span id="clock_in_text">@lang('essentials::lang.clock_in')</span>
                        <span id="clock_out_text">@lang('essentials::lang.clock_out')</span>
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="type" id="type">

                        <div class="form-group col-md-12">
                            <strong>@lang('essentials::lang.ip_address'): {{ $ip_address }}</strong>
                        </div>

                        <!-- Nota al fichar la entrada -->
                        <div class="form-group col-md-12 clock_in_note @if(!empty($clock_in)) hide @endif">
                            <label for="clock_in_note">@lang('essentials::lang.clock_in_note'):</label>
                            <textarea id="clock_in_note" name="clock_in_note" class="form-control"
                                placeholder="@lang('essentials::lang.clock_in_note')" rows="3"></textarea>
                        </div>

                        <!-- Nota al fichar la salida -->
                        <div class="form-group col-md-12 clock_out_note @if(empty($clock_in)) hide @endif">
                            <label for="clock_out_note">@lang('essentials::lang.clock_out_note'):</label>
                            <textarea id="clock_out_note" name="clock_out_note" class="form-control"
                                placeholder="@lang('essentials::lang.clock_out_note')" rows="3"></textarea>
                        </div>


                        <input type="hidden" name="clock_in_out_location" id="clock_in_out_location" value="">
                    </div>

                    @if($is_location_required)
                    <div class="row">
                        <div class="col-md-12">
                            <b>@lang('messages.location'):</b> <span class="clock_in_out_location"></span>
                        </div>
                        <div class="col-md-12 ask_location" style="display: none;">
                            <span class="location_required error"></span>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div>