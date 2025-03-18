<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para editar una marca -->
    <form action="{{ action('BrandController@update', [$brand->id]) }}" method="POST" id="brand_edit_form">
        @csrf <!-- Token de seguridad CSRF -->
        @method('PUT') <!-- Método PUT para actualizar -->

        <!-- Encabezado del modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">@lang('brand.edit_brand')</h4>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">

            <!-- Campo para el nombre de la marca -->
            <div class="form-group">
                <label for="name">@lang('brand.brand_name') *</label>
                <input type="text" name="name" value="{{ $brand->name }}" class="form-control" required placeholder="@lang('brand.brand_name')">
            </div>

            <!-- Campo para la descripción de la marca -->
            <div class="form-group">
                <label for="description">@lang('brand.short_description')</label>
                <input type="text" name="description" value="{{ $brand->description }}" class="form-control" placeholder="@lang('brand.short_description')">
            </div>

            <!-- Checkbox para marcar si la marca se usará en reparaciones -->
            @if($is_repair_installed)
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="use_for_repair" value="1" class="input-icheck" {{ $brand->use_for_repair ? 'checked' : '' }}>
                        @lang('repair::lang.use_for_repair')
                    </label>
                    <i class="fa fa-info-circle" data-toggle="tooltip" title="@lang('repair::lang.use_for_repair_help_text')"></i>
                </div>
            @endif

        </div> <!-- Fin del cuerpo del modal -->

        <!-- Pie del modal con botones de acción -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>

    </form> <!-- Fin del formulario -->

  </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
