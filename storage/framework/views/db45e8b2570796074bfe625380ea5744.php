<!-- Contenido de la pestaña de configuración de respaldo -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Selección del disco de respaldo -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="BACKUP_DISK"><?php echo e(__('superadmin::lang.backup_disk'), false); ?>:</label>
                <select name="BACKUP_DISK" id="BACKUP_DISK" class="form-control">
                    <?php $__currentLoopData = $backup_disk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php echo e($default_values['BACKUP_DISK'] == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <!-- Campo para el token de acceso de Dropbox (visible solo si se selecciona Dropbox) -->
        <div class="col-xs-8 <?php echo e(env('BACKUP_DISK') != 'dropbox' ? 'hide' : '', false); ?>" id="dropbox_access_token_div">
            <div class="form-group">
                <label for="DROPBOX_ACCESS_TOKEN"><?php echo e(__('superadmin::lang.dropbox_access_token'), false); ?>:</label>
                <input type="text" name="DROPBOX_ACCESS_TOKEN" id="DROPBOX_ACCESS_TOKEN" class="form-control" 
                    placeholder="<?php echo e(__('superadmin::lang.dropbox_access_token'), false); ?>" 
                    value="<?php echo e($default_values['DROPBOX_ACCESS_TOKEN'], false); ?>">
            </div>

            <!-- Ayuda sobre cómo obtener el token de acceso de Dropbox -->
            <p class="help-block">
                <?php echo __('superadmin::lang.dropbox_help', ['link' => 'https://www.dropbox.com/developers/apps/create']); ?>

            </p>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/backup.blade.php ENDPATH**/ ?>