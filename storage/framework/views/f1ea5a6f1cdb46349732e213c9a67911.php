<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para agregar una nueva categoría -->
    <form action="<?php echo e(action('TaxonomyController@store'), false); ?>" method="post" id="category_add_form">
      <?php echo csrf_field(); ?>

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?php echo e(__('messages.add'), false); ?></h4>
      </div>

      <div class="modal-body">
        <!-- Campo oculto para el tipo de categoría -->
        <input type="hidden" name="category_type" value="<?php echo e($category_type, false); ?>">

        <?php
          $name_label = $module_category_data['taxonomy_label'] ?? __('category.category_name');
          $cat_code_enabled = $module_category_data['enable_taxonomy_code'] ?? true;
          $cat_code_label = $module_category_data['taxonomy_code_label'] ?? __('category.code');
          $enable_sub_category = $module_category_data['enable_sub_taxonomy'] ?? true;
          $category_code_help_text = $module_category_data['taxonomy_code_help_text'] ?? __('lang_v1.category_code_help');
        ?>

        <!-- Campo para el nombre de la categoría -->
        <div class="form-group">
          <label for="name"><?php echo e($name_label, false); ?>:*</label>
          <input type="text" name="name" id="name" class="form-control" required
                 placeholder="<?php echo e($name_label, false); ?>" value="<?php echo e(old('name'), false); ?>">
        </div>

        <!-- Campo para el código de la categoría (si está habilitado) -->
        <?php if($cat_code_enabled): ?>
          <div class="form-group">
            <label for="short_code"><?php echo e($cat_code_label, false); ?>:</label>
            <input type="text" name="short_code" id="short_code" class="form-control"
                   placeholder="<?php echo e($cat_code_label, false); ?>" value="<?php echo e(old('short_code'), false); ?>">
            <p class="help-block"><?php echo e($category_code_help_text, false); ?></p>
          </div>
        <?php endif; ?>

        <!-- Campo para la descripción de la categoría -->
        <div class="form-group">
          <label for="description"><?php echo e(__('lang_v1.description'), false); ?>:</label>
          <textarea name="description" id="description" class="form-control" rows="3"
                    placeholder="<?php echo e(__('lang_v1.description'), false); ?>"><?php echo e(old('description'), false); ?></textarea>
        </div>

        <!-- Checkbox para agregar como subcategoría (si está habilitado) -->
        <?php if(!empty($parent_categories) && $enable_sub_category): ?>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="add_as_sub_cat" value="1" class="toggler" data-toggle_id="parent_cat_div">
                <?php echo e(__('lang_v1.add_as_sub_txonomy'), false); ?>

              </label>
            </div>
          </div>

          <!-- Selección de la categoría padre -->
          <div class="form-group hide" id="parent_cat_div">
            <label for="parent_id"><?php echo e(__('category.select_parent_category'), false); ?>:</label>
            <select name="parent_id" id="parent_id" class="form-control">
              <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
              <?php $__currentLoopData = $parent_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key, false); ?>" <?php echo e(old('parent_id') == $key ? 'selected' : '', false); ?>>
                  <?php echo e($value, false); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        <?php endif; ?>
      </div>

      <!-- Botones de acción -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.save'), false); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('messages.close'), false); ?></button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/taxonomy/create.blade.php ENDPATH**/ ?>