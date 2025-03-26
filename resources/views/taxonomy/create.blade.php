<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para agregar una nueva categoría -->
    <form action="{{ action('TaxonomyController@store') }}" method="post" id="category_add_form">
      @csrf

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('messages.add') }}</h4>
      </div>

      <div class="modal-body">
        <!-- Campo oculto para el tipo de categoría -->
        <input type="hidden" name="category_type" value="{{ $category_type }}">

        @php
          $name_label = $module_category_data['taxonomy_label'] ?? __('category.category_name');
          $cat_code_enabled = $module_category_data['enable_taxonomy_code'] ?? true;
          $cat_code_label = $module_category_data['taxonomy_code_label'] ?? __('category.code');
          $enable_sub_category = $module_category_data['enable_sub_taxonomy'] ?? true;
          $category_code_help_text = $module_category_data['taxonomy_code_help_text'] ?? __('lang_v1.category_code_help');
        @endphp

        <!-- Campo para el nombre de la categoría -->
        <div class="form-group">
          <label for="name">{{ $name_label }}:*</label>
          <input type="text" name="name" id="name" class="form-control" required
                 placeholder="{{ $name_label }}" value="{{ old('name') }}">
        </div>

        <!-- Campo para el código de la categoría (si está habilitado) -->
        @if($cat_code_enabled)
          <div class="form-group">
            <label for="short_code">{{ $cat_code_label }}:</label>
            <input type="text" name="short_code" id="short_code" class="form-control"
                   placeholder="{{ $cat_code_label }}" value="{{ old('short_code') }}">
            <p class="help-block">{{ $category_code_help_text }}</p>
          </div>
        @endif

        <!-- Campo para la descripción de la categoría -->
        <div class="form-group">
          <label for="description">{{ __('lang_v1.description') }}:</label>
          <textarea name="description" id="description" class="form-control" rows="3"
                    placeholder="{{ __('lang_v1.description') }}">{{ old('description') }}</textarea>
        </div>

        <!-- Checkbox para agregar como subcategoría (si está habilitado) -->
        @if(!empty($parent_categories) && $enable_sub_category)
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="add_as_sub_cat" value="1" class="toggler" data-toggle_id="parent_cat_div">
                {{ __('lang_v1.add_as_sub_txonomy') }}
              </label>
            </div>
          </div>

          <!-- Selección de la categoría padre -->
          <div class="form-group hide" id="parent_cat_div">
            <label for="parent_id">{{ __('category.select_parent_category') }}:</label>
            <select name="parent_id" id="parent_id" class="form-control">
              <option value="">{{ __('messages.please_select') }}</option>
              @foreach($parent_categories as $key => $value)
                <option value="{{ $key }}" {{ old('parent_id') == $key ? 'selected' : '' }}>
                  {{ $value }}
                </option>
              @endforeach
            </select>
          </div>
        @endif
      </div>

      <!-- Botones de acción -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
