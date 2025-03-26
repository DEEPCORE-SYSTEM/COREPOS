<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Formulario para agregar marca -->
        <form action="<?php echo e(action('BrandController@store'), false); ?>" method="post" 
              id="<?php echo e($quick_add ? 'quick_add_brand_form' : 'brand_add_form', false); ?>">
            <?php echo csrf_field(); ?>

            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo e(__('brand.add_brand'), false); ?></h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Nombre de la marca -->
                <div class="form-group">
                    <label for="name"><?php echo e(__('brand.brand_name'), false); ?>:*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                           placeholder="<?php echo e(__('brand.brand_name'), false); ?>">
                </div>

                <!-- Descripción corta -->
                <div class="form-group">
                    <label for="description"><?php echo e(__('brand.short_description'), false); ?>:</label>
                    <input type="text" name="description" id="description" class="form-control" 
                           placeholder="<?php echo e(__('brand.short_description'), false); ?>">
                </div>

                <!-- Opción para reparación (si el módulo de reparación está instalado) -->
                <?php if($is_repair_installed): ?>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="use_for_repair" value="1" class="input-icheck">
                            <?php echo e(__('repair::lang.use_for_repair'), false); ?>

                        </label>
                        <small class="text-muted"><?php echo e(__('repair::lang.use_for_repair_help_text'), false); ?></small>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo e(__('messages.save'), false); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('messages.close'), false); ?></button>
            </div>

        </form> <!-- Fin del formulario -->

    </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/brand/create.blade.php ENDPATH**/ ?>