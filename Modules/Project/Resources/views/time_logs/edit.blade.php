<div class="modal-dialog" role="document">
    <!-- Formulario para actualizar un registro de tiempo -->
    <form action="{{ url('project/time-log/update', $project_task_time_log->id) }}" id="time_log_form" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-content">
            <div class="modal-header">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Título del modal -->
                <h4 class="modal-title">@lang('project::lang.edit_time_log')</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Selección de la tarea asociada al registro de tiempo -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="project_task_id">@lang('project::lang.task'):</label>
                            <select name="project_task_id" class="form-control select2" style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($project_tasks as $key => $task)
                                    <option value="{{ $key }}" {{ $project_task_time_log->project_task_id == $key ? 'selected' : '' }}>
                                        {{ $task }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Campo oculto para el ID del proyecto -->
                    <input type="hidden" name="project_id" value="{{ $project_task_time_log->project_id }}">

                    <!-- Fecha y hora de inicio -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_datetime">@lang('project::lang.start_date_time'):* </label>
                            <input type="text" name="start_datetime" class="form-control datetimepicker" 
                                   value="{{ date('Y-m-d H:i:s', strtotime($project_task_time_log->start_datetime)) }}" 
                                   readonly required>
                        </div>
                    </div>

                    <!-- Fecha y hora de finalización -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_datetime">@lang('project::lang.end_date_time'):* </label>
                            <input type="text" name="end_datetime" class="form-control datetimepicker" 
                                   value="{{ date('Y-m-d H:i:s', strtotime($project_task_time_log->end_datetime)) }}" 
                                   readonly required>
                        </div>
                    </div>

                    @if($is_lead_or_admin)
                        <!-- Si el usuario es líder o administrador, puede seleccionar el usuario que registra el tiempo -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">@lang('role.user'):* </label>
                                <select name="user_id" class="form-control select2" required style="width: 100%;">
                                    <option value="">{{ __('messages.please_select') }}</option>
                                    @foreach($project_members as $key => $member)
                                        <option value="{{ $key }}" {{ $project_task_time_log->user_id == $key ? 'selected' : '' }}>
                                            {{ $member }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Campo de notas -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note">@lang('brand.note'):</label>
                            <textarea name="note" class="form-control" rows="4">{{ $project_task_time_log->note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones del modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    @lang('messages.update')
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    @lang('messages.close')
                </button>
            </div>
        </div>
    </form>
</div>
