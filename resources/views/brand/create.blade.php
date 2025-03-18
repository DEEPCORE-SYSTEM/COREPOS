<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Formulario para agregar marca -->
        <form action="{{ action('BrandController@store') }}" method="post" 
              id="{{ $quick_add ? 'quick_add_brand_form' : 'brand_add_form' }}">
            @csrf

            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ __('brand.add_brand') }}</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Nombre de la marca -->
                <div class="form-group">
                    <label for="name">{{ __('brand.brand_name') }}:*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                           placeholder="{{ __('brand.brand_name') }}">
                </div>

                <!-- Descripción corta -->
                <div class="form-group">
                    <label for="description">{{ __('brand.short_description') }}:</label>
                    <input type="text" name="description" id="description" class="form-control" 
                           placeholder="{{ __('brand.short_description') }}">
                </div>

                <!-- Opción para reparación (si el módulo de reparación está instalado) -->
                @if($is_repair_installed)
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="use_for_repair" value="1" class="input-icheck">
                            {{ __('repair::lang.use_for_repair') }}
                        </label>
                        <small class="text-muted">{{ __('repair::lang.use_for_repair_help_text') }}</small>
                    </div>
                @endif
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>

        </form> <!-- Fin del formulario -->

    </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
