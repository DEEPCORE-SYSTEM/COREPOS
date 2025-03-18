<div class="modal-dialog" role="document">
  <div class="modal-content">
    <form action="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@update', $todo->id) }}" 
          id="task_form" method="POST">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">@lang('essentials::lang.edit_to_do')</h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <!-- Campo de tarea -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="task">@lang('essentials::lang.task'):</label>
              <input type="text" name="task" id="task" class="form-control" value="{{ $todo->task }}" required>
            </div>
          </div>

          <!-- Asignación de usuarios (solo si tiene permiso) -->
          @can('essentials.assign_todos')
            <div class="col-md-12">
              <div class="form-group">
                <label for="users">@lang('essentials::lang.assigned_to'):</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <select name="users[]" id="users" class="form-control select2" multiple required style="width: 100%;">
                    @foreach($users as $id => $name)
                      <option value="{{ $id }}" {{ in_array($id, $todo->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          @endcan

          <div class="clearfix"></div>

          <!-- Prioridad -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="priority">@lang('essentials::lang.priority'):</label>
              <select name="priority" id="priority" class="form-control select2" style="width: 100%;">
                <option value="">@lang('messages.please_select')</option>
                @foreach($priorities as $key => $priority)
                  <option value="{{ $key }}" {{ $todo->priority == $key ? 'selected' : '' }}>{{ $priority }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- Estado -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="status">@lang('sale.status'):</label>
              <select name="status" id="status" class="form-control select2" style="width: 100%;">
                <option value="">@lang('messages.please_select')</option>
                @foreach($task_statuses as $key => $status)
                  <option value="{{ $key }}" {{ $todo->status == $key ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="clearfix"></div>

          <!-- Fecha de inicio -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="date">@lang('business.start_date'):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" name="date" id="date" class="form-control datepicker text-center" 
                       value="{{ \Carbon\Carbon::parse($todo->date)->format('Y-m-d') }}" required readonly>
              </div>
            </div>
          </div>

          <!-- Fecha de finalización -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_date">@lang('essentials::lang.end_date'):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" name="end_date" id="end_date" class="form-control datepicker text-center" 
                       value="{{ $todo->end_date ? \Carbon\Carbon::parse($todo->end_date)->format('Y-m-d') : '' }}" readonly>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <!-- Horas estimadas -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="estimated_hours">@lang('essentials::lang.estimated_hours'):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                <input type="text" name="estimated_hours" id="estimated_hours" class="form-control" value="{{ $todo->estimated_hours }}">
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <!-- Descripción -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="to_do_description">@lang('lang_v1.description'):</label>
              <textarea name="description" id="to_do_description" class="form-control">{{ $todo->description }}</textarea>
            </div>
          </div>

          <!-- Subida de documentos -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="media_upload">@lang('lang_v1.upload_documents'):</label>
              <div class="dropzone" id="media_upload"></div>

              <!-- Parámetros ocultos para la subida de archivos -->
              <input type="hidden" id="media_upload_url" value="{{ route('attach.medias.to.model') }}">
              <input type="hidden" id="model_id" value="{{ $todo->id }}">
              <input type="hidden" id="model_type" value="Modules\Essentials\Entities\ToDo">
              <input type="hidden" id="model_media_type" value="">
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary ladda-button" data-style="expand-right">
          <span class="ladda-label">@lang('messages.save')</span>
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
      </div>

    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
