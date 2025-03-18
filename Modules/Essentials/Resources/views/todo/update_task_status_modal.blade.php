<!-- Modal para actualizar el estado de una tarea -->
<div class="modal fade" id="update_task_status_modal" tabindex="-1" role="dialog" 
     aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Cabecera del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('essentials::lang.change_status')</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="updated_status">@lang('sale.status'):</label>
                    <select name="status" id="updated_status" class="form-control" style="width: 100%;">
                        <option value="">@lang('messages.please_select')</option>
                        @foreach($task_statuses as $key => $status)
                            <option value="{{ $key }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    <!-- Campo oculto para almacenar el ID de la tarea -->
                    <input type="hidden" id="task_id" name="task_id">
                </div>
            </div>

            <!-- Pie del modal con botones de acción -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update_status_btn">
                    @lang('messages.update')
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    @lang('messages.close')
                </button>
            </div>
        </div>
    </div>
</div>
