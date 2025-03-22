<!-- Modal para agregar una nueva categoría de gasto -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Formulario para enviar la nueva categoría de gasto -->
        <form action="{{ action('ExpenseCategoryController@store') }}" method="POST" id="expense_category_add_form">
            @csrf <!-- Token de seguridad para formularios en Laravel -->

            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ __('expense.add_expense_category') }}</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Campo para el nombre de la categoría de gasto -->
                <div class="form-group">
                    <label for="name">{{ __('expense.category_name') }}:*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                        placeholder="{{ __('expense.category_name') }}">
                </div>

                <!-- Campo para el código de la categoría (opcional) -->
                <div class="form-group">
                    <label for="code">{{ __('expense.category_code') }}:</label>
                    <input type="text" name="code" id="code" class="form-control" 
                        placeholder="{{ __('expense.category_code') }}">
                </div>
            </div>

            <!-- Pie del modal con los botones de acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
