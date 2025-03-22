<!-- Modal de diálogo para editar garantía -->
<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para actualizar garantía -->
    <form action="{{ route('warranty.update', [$warranty->id]) }}" method="POST" id="warranty_form">
      @csrf <!-- Token de seguridad de Laravel -->
      @method('PUT') <!-- Método PUT para actualizar -->

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('lang_v1.edit_warranty')</h4>
      </div>

      <div class="modal-body">
        <!-- Campo para el nombre de la garantía -->
        <div class="form-group">
          <label for="name">@lang('lang_v1.name'):* </label>
          <input type="text" name="name" value="{{ $warranty->name }}" class="form-control" required placeholder="@lang('lang_v1.name')">
        </div>

        <!-- Campo para la descripción de la garantía -->
        <div class="form-group">
          <label for="description">@lang('lang_v1.description'):</label>
          <textarea name="description" class="form-control" placeholder="@lang('lang_v1.description')" rows="3">{{ $warranty->description }}</textarea>
        </div>
        
        <!-- Campo para la duración de la garantía -->
        <strong><label for="duration">@lang('lang_v1.duration'):</label>*</strong>
        <div class="form-group">
          <input type="number" name="duration" value="{{ $warranty->duration }}" class="form-control width-40 pull-left" placeholder="@lang('lang_v1.duration')" required>
          
          <select name="duration_type" class="form-control width-60 pull-left" required>
            <option value="">@lang('messages.please_select')</option>
            <option value="days" {{ $warranty->duration_type == 'days' ? 'selected' : '' }}>@lang('lang_v1.days')</option>
            <option value="months" {{ $warranty->duration_type == 'months' ? 'selected' : '' }}>@lang('lang_v1.months')</option>
            <option value="years" {{ $warranty->duration_type == 'years' ? 'selected' : '' }}>@lang('lang_v1.years')</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <!-- Botón para actualizar -->
        <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
        <!-- Botón para cerrar el modal -->
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
