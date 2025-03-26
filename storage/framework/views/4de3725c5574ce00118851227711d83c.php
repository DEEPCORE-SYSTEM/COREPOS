<!-- Campo oculto para indicar que hay datos del módulo -->
<input type="hidden" name="has_module_data" value="true">

<div class="col-sm-4">
    <div class="form-group">
        <!-- Etiqueta para la selección del modelo de dispositivo -->
        <label for="repair_model_id"><?php echo app('translator')->get('repair::lang.device_model'); ?>:</label>

        <!-- Selección del modelo de dispositivo -->
        <select name="repair_model_id" id="repair_model_id" class="form-control select2">
            <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
            <?php $__currentLoopData = $view_data['device_models']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key, false); ?>" <?php echo e(!empty($product->repair_model_id) && $product->repair_model_id == $key ? 'selected' : '', false); ?>>
                    <?php echo e($model, false); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Repair\Providers/../Resources/views/device_model/partials/repair_product_screen.blade.php ENDPATH**/ ?>