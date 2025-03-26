<div class="col-md-3">
    <div class="form-group">
        <!-- Etiqueta para el campo de selección -->
        <label for="repair_model_id"><?php echo app('translator')->get('repair::lang.device_model'); ?>:</label>
        
        <!-- Selección del modelo de dispositivo -->
        <select name="repair_model_id" id="repair_model_id" class="form-control select2" style="width: 100%;">
            <option value=""><?php echo e(__('messages.all'), false); ?></option>
            <?php $__currentLoopData = $view_data['device_models']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key, false); ?>"><?php echo e($model, false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Repair\Providers/../Resources/views/device_model/partials/list_product_filters.blade.php ENDPATH**/ ?>