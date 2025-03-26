<!-- Modal de diálogo para agregar un grupo de precios de venta -->
<div class="modal-dialog" role="document">
  <div class="modal-content">
    
    <!-- Formulario para agregar grupo de precios de venta -->
    <form action="{{ route('selling-price-group.store') }}" method="POST" id="selling_price_group_form">
      @csrf <!-- Token de seguridad de Laravel -->

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('lang_v1.add_selling_price_group')</h4>
      </div>

      <div class="modal-body">
        <!-- Campo para el nombre del grupo de precios -->
        <div class="form-group">
          <label for="name">@lang('lang_v1.name'):* </label>
          <input type="text" name="name" class="form-control" required placeholder="@lang('lang_v1.name')">
        </div>

        <!-- Campo para la descripción del grupo de precios -->
        <div class="form-group">
          <label for="description">@lang('lang_v1.description'):</label>
          <textarea name="description" class="form-control" placeholder="@lang('lang_v1.description')" rows="3"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <!-- Botón para guardar -->
        <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
        <!-- Botón para cerrar el modal -->
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
