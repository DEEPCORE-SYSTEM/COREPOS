<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para editar una marca -->
    <form action="<?php echo e(action('BrandController@update', [$brand->id]), false); ?>" method="POST" id="brand_edit_form">
        <?php echo csrf_field(); ?> <!-- Token de seguridad CSRF -->
        <?php echo method_field('PUT'); ?> <!-- Método PUT para actualizar -->

        <!-- Encabezado del modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><?php echo app('translator')->get('brand.edit_brand'); ?></h4>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">

            <!-- Campo para el nombre de la marca -->
            <div class="form-group">
                <label for="name"><?php echo app('translator')->get('brand.brand_name'); ?> *</label>
                <input type="text" name="name" value="<?php echo e($brand->name, false); ?>" class="form-control" required placeholder="<?php echo app('translator')->get('brand.brand_name'); ?>">
            </div>

            <!-- Campo para la descripción de la marca -->
            <div class="form-group">
                <label for="description"><?php echo app('translator')->get('brand.short_description'); ?></label>
                <input type="text" name="description" value="<?php echo e($brand->description, false); ?>" class="form-control" placeholder="<?php echo app('translator')->get('brand.short_description'); ?>">
            </div>

            <!-- Checkbox para marcar si la marca se usará en reparaciones -->
            <?php if($is_repair_installed): ?>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="use_for_repair" value="1" class="input-icheck" <?php echo e($brand->use_for_repair ? 'checked' : '', false); ?>>
                        <?php echo app('translator')->get('repair::lang.use_for_repair'); ?>
                    </label>
                    <i class="fa fa-info-circle" data-toggle="tooltip" title="<?php echo app('translator')->get('repair::lang.use_for_repair_help_text'); ?>"></i>
                </div>
            <?php endif; ?>

        </div> <!-- Fin del cuerpo del modal -->

        <!-- Pie del modal con botones de acción -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

    </form> <!-- Fin del formulario -->

  </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/brand/edit.blade.php ENDPATH**/ ?>