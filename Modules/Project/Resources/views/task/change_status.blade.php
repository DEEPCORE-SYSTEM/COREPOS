<!-- Modal para cambiar el estado de la tarea -->
<div class="modal-dialog" role="document">
    <form action="{{ action('\Modules\Project\Http\Controllers\TaskController@postTaskStatus', $project_task->id) }}" 
          method="POST" 
          id="change_status">
        @csrf  <!-- Token de seguridad para formularios -->
        @method('PUT')  <!-- Método HTTP PUT para actualizar -->

        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    {{ __("project::lang.change_status") }}  <!-- Título del modal -->
                </h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Selector de estado de la tarea -->
                        <div class="form-group">
                            <label for="status">{{ __('sale.status') }}:*</label>
                            <select name="status" id="status" class="form-control select2" required style="width: 100%;">
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" {{ $project_task->status == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Campo oculto para el ID del proyecto -->
                <input type="hidden" name="project_id" value="{{ $project_task->project_id }}">
            </div>

            <!-- Pie del modal con botones de acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ __('messages.update') }}  <!-- Botón para actualizar -->
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    {{ __('messages.close') }}  <!-- Botón para cerrar el modal -->
                </button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
