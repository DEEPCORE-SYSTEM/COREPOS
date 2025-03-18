<!-- Modal para editar una tarea -->
<div class="modal-dialog modal-lg" role="document">
    <form action="{{ action('\Modules\Project\Http\Controllers\TaskController@update', $project_task->id) }}" 
          method="POST" 
          id="project_task_form">
        @csrf  <!-- Token de seguridad para formularios -->
        @method('PUT') <!-- Método PUT para actualizar -->

        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    {{ __('project::lang.edit_task') }}  <!-- Título del modal -->
                </h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Campo para el nombre de la tarea -->
                        <div class="form-group">
                            <label for="subject">{{ __('project::lang.subject') }}:*</label>
                            <input type="text" name="subject" id="subject" class="form-control" value="{{ $project_task->subject }}" required>
                        </div>
                    </div>
                </div>

                <!-- Campo oculto para el ID del proyecto -->
                <input type="hidden" name="project_id" value="{{ $project_task->project_id }}">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Campo para la descripción de la tarea -->
                        <div class="form-group">
                            <label for="description">{{ __('lang_v1.description') }}:</label>
                            <textarea name="description" id="description" class="form-control">{{ $project_task->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Fecha de inicio -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">{{ __('business.start_date') }}:</label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker" value="{{ !empty($project_task->start_date) ? format_date($project_task->start_date) : '' }}" readonly>
                        </div>
                    </div>

                    <!-- Fecha de vencimiento -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="due_date">{{ __('project::lang.due_date') }}:</label>
                            <input type="text" name="due_date" id="due_date" class="form-control datepicker" value="{{ !empty($project_task->due_date) ? format_date($project_task->due_date) : '' }}" readonly>
                        </div>
                    </div>

                    <!-- Prioridad de la tarea -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="priority">{{ __('project::lang.priority') }}:*</label>
                            <select name="priority" id="priority" class="form-control select2" required style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($priorities as $key => $value)
                                    <option value="{{ $key }}" {{ $project_task->priority == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Estado de la tarea -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">{{ __('sale.status') }}:*</label>
                            <select name="status" id="status" class="form-control select2" required style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" {{ $project_task->status == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Miembros asignados a la tarea -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user_id">{{ __('project::lang.members') }}:*</label>
                            <select name="user_id[]" id="user_id" class="form-control select2" multiple required style="width: 100%;">
                                @foreach($project_members as $id => $name)
                                    <option value="{{ $id }}" {{ $project_task->members->pluck('id')->contains($id) ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Campo personalizado 1 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="custom_field_1">{{ __('project::lang.task_custom_field_1') }}:</label>
                            <input type="text" name="custom_field_1" id="custom_field_1" class="form-control" value="{{ $project_task->custom_field_1 }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Campo personalizado 2 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="custom_field_2">{{ __('project::lang.task_custom_field_2') }}:</label>
                            <input type="text" name="custom_field_2" id="custom_field_2" class="form-control" value="{{ $project_task->custom_field_2 }}">
                        </div>
                    </div>

                    <!-- Campo personalizado 3 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="custom_field_3">{{ __('project::lang.task_custom_field_3') }}:</label>
                            <input type="text" name="custom_field_3" id="custom_field_3" class="form-control" value="{{ $project_task->custom_field_3 }}">
                        </div>
                    </div>

                    <!-- Campo personalizado 4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="custom_field_4">{{ __('project::lang.task_custom_field_4') }}:</label>
                            <input type="text" name="custom_field_4" id="custom_field_4" class="form-control" value="{{ $project_task->custom_field_4 }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie del modal con botones de acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm ladda-button" data-style="expand-right">
                    <span class="ladda-label">{{ __('messages.update') }}</span>
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    {{ __('messages.close') }}
                </button>
            </div>
        </div>
    </form>
</div>
