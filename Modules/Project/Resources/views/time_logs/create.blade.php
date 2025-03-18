<div class="modal-dialog" role="document">
    {{-- Formulario para registrar un log de tiempo --}}
    <form action="{{ url('project/time-log/store') }}" id="time_log_form" method="POST">
        @csrf
        
        <div class="modal-content">
            <div class="modal-header">
                {{-- Botón para cerrar el modal --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    @lang('project::lang.add_time_log')
                </h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    {{-- Campos ocultos para almacenar el origen del log y el ID del proyecto --}}
                    <input type="hidden" name="added_from" value="{{ $added_from }}">
                    <input type="hidden" name="project_id" value="{{ $project_id }}">

                    @if($added_from == 'task')
                        {{-- Si el log proviene de una tarea, se almacena su ID en un campo oculto --}}
                        <input type="hidden" name="project_task_id" value="{{ $task_id }}">
                    @else
                        {{-- Si no proviene de una tarea específica, permite seleccionar una --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="project_task_id">@lang('project::lang.task'):</label>
                                <select name="project_task_id" class="form-control select2" style="width: 100%;">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($project_tasks as $key => $task)
                                        <option value="{{ $key }}">{{ $task }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    {{-- Fecha y hora de inicio --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_datetime">@lang('project::lang.start_date_time'):* </label>
                            <input type="text" name="start_datetime" class="form-control datetimepicker" readonly required>
                        </div>
                    </div>

                    {{-- Fecha y hora de finalización --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_datetime">@lang('project::lang.end_date_time'):* </label>
                            <input type="text" name="end_datetime" class="form-control datetimepicker" readonly required>
                        </div>
                    </div>

                    @if($is_lead_or_admin)
                        {{-- Si el usuario es líder o administrador, puede seleccionar el usuario que registra el tiempo --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">@lang('role.user'):* </label>
                                <select name="user_id" class="form-control select2" required style="width: 100%;">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($project_members as $key => $member)
                                        <option value="{{ $key }}">{{ $member }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Campo de notas --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note">@lang('brand.note'):</label>
                            <textarea name="note" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botones del modal --}}
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    @lang('messages.save')
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    @lang('messages.close')
                </button>
            </div>
        </div>
    </form>
</div>
