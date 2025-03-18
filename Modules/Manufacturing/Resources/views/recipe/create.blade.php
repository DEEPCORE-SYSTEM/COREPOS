<div class="modal-dialog" role="document">
    <div class="modal-content">

        {{-- Formulario para elegir producto y copiar receta --}}
        <form action="{{ action('\Modules\Manufacturing\Http\Controllers\RecipeController@addIngredients') }}" method="GET" id="choose_product_form">
            @csrf
            
            <div class="modal-header">
                {{-- Botón para cerrar el modal --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{-- Título del modal --}}
                <h4 class="modal-title">@lang('manufacturing::lang.choose_product')</h4>
            </div>

            <div class="modal-body">
                {{-- Selección de producto --}}
                <div class="form-group">
                    <label for="variation_id">@lang('manufacturing::lang.choose_product'):</label>
                    <select name="variation_id" id="variation_id" class="form-control" required style="width: 100%;">
                        <option value="">@lang('messages.please_select')</option>
                        {{-- Opciones de productos se llenarán dinámicamente --}}
                    </select>
                </div>

                {{-- Copiar receta de otro producto --}}
                <div class="form-group" id="recipe_selection">
                    <label for="copy_recipe_id">@lang('manufacturing::lang.copy_from_recipe'):</label>
                    <select name="copy_recipe_id" id="copy_recipe_id" class="form-control" style="width: 100%;">
                        <option value="">@lang('lang_v1.none')</option>
                        @foreach($recipes as $id => $recipe)
                            <option value="{{ $id }}">{{ $recipe }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                {{-- Botón para cerrar el modal --}}
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                {{-- Botón para continuar con la selección --}}
                <button type="submit" class="btn btn-primary">@lang('manufacturing::lang.continue')</button>
            </div>
        </form>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
