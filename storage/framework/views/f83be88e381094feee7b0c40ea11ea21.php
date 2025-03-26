<div class="modal-dialog" role="document">
  <div class="modal-content">

    <form action="<?php echo e(action('TaxonomyController@update', [$category->id]), false); ?>" method="POST" id="category_edit_form">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?php echo e(__('messages.edit'), false); ?></h4>
      </div>

      <div class="modal-body">
        <?php
          $name_label = !empty($module_category_data['taxonomy_label']) ? $module_category_data['taxonomy_label'] : __('category.category_name');
          $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
          $cat_code_label = !empty($module_category_data['taxonomy_code_label']) ? $module_category_data['taxonomy_code_label'] : __('category.code');
          $enable_sub_category = isset($module_category_data['enable_sub_taxonomy']) && !$module_category_data['enable_sub_taxonomy'] ? false : true;
          $category_code_help_text = !empty($module_category_data['taxonomy_code_help_text']) ? $module_category_data['taxonomy_code_help_text'] : __('lang_v1.category_code_help');
        ?>

        <div class="form-group">
          <label for="name"><?php echo e($name_label, false); ?>:*</label>
          <input type="text" name="name" id="name" class="form-control" required placeholder="<?php echo e($name_label, false); ?>" value="<?php echo e($category->name, false); ?>">
        </div>

        <?php if($cat_code_enabled): ?>
          <div class="form-group">
            <label for="short_code"><?php echo e($cat_code_label, false); ?>:</label>
            <input type="text" name="short_code" id="short_code" class="form-control" placeholder="<?php echo e($cat_code_label, false); ?>" value="<?php echo e($category->short_code, false); ?>">
            <p class="help-block"><?php echo e($category_code_help_text, false); ?></p>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="description"><?php echo e(__('lang_v1.description'), false); ?>:</label>
          <textarea name="description" id="description" class="form-control" placeholder="<?php echo e(__('lang_v1.description'), false); ?>" rows="3"><?php echo e($category->description, false); ?></textarea>
        </div>

        <?php if(!empty($parent_categories) && $enable_sub_category): ?>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="add_as_sub_cat" value="1" class="toggler" data-toggle_id="parent_cat_div" <?php echo e(!$is_parent ? 'checked' : '', false); ?>>
                <?php echo e(__('lang_v1.add_as_sub_txonomy'), false); ?>

              </label>
            </div>
          </div>
          <div class="form-group <?php echo e($is_parent ? 'hide' : '', false); ?>" id="parent_cat_div">
            <label for="parent_id"><?php echo e(__('lang_v1.select_parent_taxonomy'), false); ?>:</label>
            <select name="parent_id" id="parent_id" class="form-control">
              <?php $__currentLoopData = $parent_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key, false); ?>" <?php echo e($selected_parent == $key ? 'selected' : '', false); ?>><?php echo e($value, false); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        <?php endif; ?>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.update'), false); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('messages.close'), false); ?></button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/taxonomy/edit.blade.php ENDPATH**/ ?>