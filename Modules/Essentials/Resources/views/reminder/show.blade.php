<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalCenterTitle">
                @lang('essentials::lang.reminder_details')
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="row">
                <!-- Nombre del evento -->
                <div class="col-md-6">
                    <strong>@lang('essentials::lang.event_name'):</strong> {{ $reminder->name }}
                </div>

                <!-- Fecha y horas -->
                <div class="col-md-6">
                    <strong>@lang('essentials::lang.date'):</strong> {{ format_date($reminder->date) }} <br>
                    <strong>@lang('restaurant.start_time'):</strong> {{ $time }} <br>
                    <strong>@lang('restaurant.end_time'):</strong> 
                    @if(!empty($reminder->end_time)) {{ format_time($reminder->end_time) }} @endif
                </div>
            </div>

            <br><hr>

            <div class="row">
                <!-- Formulario para actualizar la repetición del recordatorio -->
                <div class="col-md-9">
                    <form action="{{ action('\Modules\Essentials\Http\Controllers\ReminderController@update', [$reminder->id]) }}" 
                          method="POST" id="update_reminder_repeat">
                        @csrf
                        @method('PUT')

                        <div class="input-group">
                            <select name="repeat" class="form-control" required>
                                @foreach($repeat as $key => $value)
                                    <option value="{{ $key }}" {{ $reminder->repeat == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary change_reminder_repeat">@lang('messages.update')</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Botón para eliminar el recordatorio -->
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger" id="delete_reminder" 
                            data-href="{{ action('\Modules\Essentials\Http\Controllers\ReminderController@destroy', [$reminder->id]) }}">
                        @lang('essentials::lang.delete_reminder')
                    </button>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                @lang('messages.close')
            </button>
        </div>
    </div>
</div>
