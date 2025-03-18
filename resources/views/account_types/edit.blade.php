<!-- Modal para editar un tipo de cuenta -->
<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Formulario para editar un tipo de cuenta -->
        <form action="{{ action('AccountTypeController@update', $account_type->id) }}" method="POST" id="account_type_form">
            @csrf <!-- Token de seguridad para formularios en Laravel -->
            @method('PUT') <!-- Método PUT para actualización de datos -->

            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ __('lang_v1.edit_account_type') }}</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Campo para el nombre del tipo de cuenta -->
                <div class="form-group">
                    <label for="name">{{ __('lang_v1.name') }}:*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                        placeholder="{{ __('lang_v1.name') }}" value="{{ $account_type->name }}">
                </div>

                <!-- Campo para seleccionar el tipo de cuenta padre -->
                <div class="form-group">
                    <label for="parent_account_type_id">{{ __('lang_v1.parent_account_type') }}:</label>
                    <select name="parent_account_type_id" id="parent_account_type_id" class="form-control">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($account_types as $type)
                            <option value="{{ $type->id }}" 
                                {{ $account_type->parent_account_type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pie del modal con los botones de acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </form>
        <!-- Fin del formulario -->
        
    </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
