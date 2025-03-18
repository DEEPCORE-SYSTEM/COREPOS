<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Formulario para actualizar el tipo de permiso -->
        <form action="{{ action('\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController@update', [$leave_type->id]) }}" 
              method="POST" id="edit_leave_type_form">
            @csrf
            @method('PUT')

            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('essentials::lang.edit_leave_type')</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Campo para el nombre del tipo de permiso -->
                <div class="form-group">
                    <label for="leave_type">@lang('essentials::lang.leave_type')*</label>
                    <input type="text" name="leave_type" id="leave_type" class="form-control" required 
                           placeholder="@lang('essentials::lang.leave_type')" 
                           value="{{ $leave_type->leave_type }}">
                </div>

                <!-- Campo para la cantidad máxima de días permitidos -->
                <div class="form-group">
                    <label for="max_leave_count">@lang('essentials::lang.max_leave_count')</label>
                    <input type="number" name="max_leave_count" id="max_leave_count" class="form-control" 
                           placeholder="@lang('essentials::lang.max_leave_count')" 
                           value="{{ $leave_type->max_leave_count }}">
                </div>

                <!-- Opciones para definir el intervalo del conteo de permisos -->
                <div class="form-group">
                    <strong>@lang('essentials::lang.leave_count_interval')</strong><br>
                    <label class="radio-inline">
                        <input type="radio" name="leave_count_interval" value="month" 
                               {{ $leave_type->leave_count_interval == 'month' ? 'checked' : '' }}>
                        @lang('essentials::lang.current_month')
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="leave_count_interval" value="year" 
                               {{ $leave_type->leave_count_interval == 'year' ? 'checked' : '' }}>
                        @lang('essentials::lang.current_fy')
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="leave_count_interval" value="" 
                               {{ empty($leave_type->leave_count_interval) ? 'checked' : '' }}>
                        @lang('lang_v1.none')
                    </label>
                </div>
            </div>

            <!-- Pie del modal con botones de acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </form>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
