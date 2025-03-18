<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para actualizar el estado de la reparación -->
    <form action="{{ action('\Modules\Repair\Http\Controllers\RepairStatusController@update', [$status->id]) }}" method="POST" id="status_form">
      @csrf
      @method('PUT')

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">@lang('repair::lang.edit_status')</h4>
      </div>

      <!-- Cuerpo del modal -->
      <div class="modal-body">
        <div class="row">
          <!-- Nombre del estado -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">@lang('repair::lang.status_name') *</label>
              <input type="text" name="name" class="form-control" required placeholder="@lang('repair::lang.status_name')" value="{{ $status->name }}">
            </div>
          </div>

          <!-- Color del estado -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="color">@lang('repair::lang.color')</label>
              <input type="text" name="color" class="form-control" placeholder="@lang('repair::lang.color')" value="{{ $status->color }}">
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Orden de clasificación -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="sort_order">@lang('repair::lang.sort_order')</label>
              <input type="number" name="sort_order" class="form-control" placeholder="@lang('repair::lang.sort_order')" value="{{ $status->sort_order }}">
            </div>
          </div>

          <!-- Marcar como estado completado -->
          <div class="col-md-6 mt-15">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="is_completed_status" value="1" id="is_completed_status" {{ $status->is_completed_status ? 'checked' : '' }}>
                  @lang('repair::lang.mark_this_status_as_complete')
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Plantilla de SMS -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="sms_template">@lang('repair::lang.sms_template')</label>
              <textarea name="sms_template" class="form-control" placeholder="@lang('repair::lang.sms_template')" rows="4" id="sms_template">{{ $status->sms_template }}</textarea>
            </div>
          </div>

          <!-- Asunto del correo -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="email_subject">@lang('lang_v1.email_subject')</label>
              <input type="text" name="email_subject" class="form-control" placeholder="@lang('lang_v1.email_subject')" id="email_subject" value="{{ $status->email_subject }}">
            </div>
          </div>

          <!-- Cuerpo del correo -->
          <div class="col-md-12">
            <div class="form-group">
              <label for="email_body">@lang('lang_v1.email_body')</label>
              <textarea name="email_body" class="form-control" placeholder="@lang('lang_v1.email_body')" rows="5" id="email_body">{{ $status->email_body }}</textarea>
              <p class="help-block">
                <label>{{ $status_template_tags['help_text'] }}:</label><br>
                {{ implode(', ', $status_template_tags['tags']) }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie del modal -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
      </div>

    </form> <!-- Fin del formulario -->

  </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
