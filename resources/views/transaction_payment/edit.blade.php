<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para actualizar una marca -->
    <form action="{{ action('BrandController@update', [$brand->id]) }}" method="post" id="brand_edit_form">
      @csrf
      @method('PUT')

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('brand.edit_brand') }}</h4>
      </div>

      <div class="modal-body">
        <!-- Campo para el nombre de la marca -->
        <div class="form-group">
          <label for="name">{{ __('brand.brand_name') }}:*</label>
          <input type="text" name="name" id="name" class="form-control" required
                 placeholder="{{ __('brand.brand_name') }}" 
                 value="{{ old('name', $brand->name) }}">
        </div>

        <!-- Campo para la descripción corta de la marca -->
        <div class="form-group">
          <label for="description">{{ __('brand.short_description') }}:</label>
          <input type="text" name="description" id="description" class="form-control"
                 placeholder="{{ __('brand.short_description') }}" 
                 value="{{ old('description', $brand->description) }}">
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
