<div class="modal fade reminder" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <!-- Formulario para agregar recordatorio -->
    <form action="{{ action('\Modules\Essentials\Http\Controllers\ReminderController@store') }}" 
          method="POST" id="reminder_form">
        @csrf

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalCenterTitle">
              @lang('essentials::lang.add_reminder')
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @php
              $repeat = [
                'one_time' => __('essentials::lang.one_time'),
                'every_day' => __('essentials::lang.every_day'),
                'every_week' => __('essentials::lang.every_week'),
                'every_month' => __('essentials::lang.every_month'),
              ];
            @endphp

            <div class="row">
              <!-- Nombre del evento -->
              <div class="col-md-12">
                <label for="name">@lang('essentials::lang.event_name')*</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>

              <div class="clearfix"></div>

              <!-- Repetición -->
              <div class="col-md-6">
                <label for="repeat">@lang('essentials::lang.repeat')*</label>
                <select name="repeat" id="repeat" class="form-control" required>
                  @foreach($repeat as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Fecha -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date">@lang('essentials::lang.date')*</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" name="date" id="date" class="form-control datepicker" required readonly 
                           value="{{ format_date('today') }}">
                  </div>
                </div>
              </div>

              <div class="clearfix"></div>

              <!-- Hora de inicio -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="time">@lang('restaurant.start_time')*</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="text" name="time" id="time" class="form-control" required readonly 
                           value="{{ format_time('now') }}">
                  </div>
                </div>
              </div>

              <!-- Hora de finalización -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="end_time">@lang('restaurant.end_time')</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                    <input type="text" name="end_time" id="end_time" class="form-control" readonly 
                           value="{{ format_time('now') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              @lang('essentials::lang.cancel')
            </button>
            <button type="submit" class="btn btn-primary save_reminder">
              @lang('essentials::lang.submit')
            </button>
          </div>
        </div>
    </form>
  </div>
</div>
