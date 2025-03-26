<!-- Configuración de Pusher -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Campo para el ID de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_ID"><?php echo e(__('superadmin::lang.pusher_app_id'), false); ?>:</label>
                <input type="text" name="PUSHER_APP_ID" id="PUSHER_APP_ID" class="form-control" 
                    placeholder="<?php echo e(__('superadmin::lang.pusher_app_id'), false); ?>" 
                    value="<?php echo e($default_values['PUSHER_APP_ID'], false); ?>">
            </div>
        </div>

        <!-- Campo para la clave de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_KEY"><?php echo e(__('superadmin::lang.pusher_app_key'), false); ?>:</label>
                <input type="text" name="PUSHER_APP_KEY" id="PUSHER_APP_KEY" class="form-control" 
                    placeholder="<?php echo e(__('superadmin::lang.pusher_app_key'), false); ?>" 
                    value="<?php echo e($default_values['PUSHER_APP_KEY'], false); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Campo para el secreto de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_SECRET"><?php echo e(__('superadmin::lang.pusher_app_secret'), false); ?>:</label>
                <input type="text" name="PUSHER_APP_SECRET" id="PUSHER_APP_SECRET" class="form-control" 
                    placeholder="<?php echo e(__('superadmin::lang.pusher_app_secret'), false); ?>" 
                    value="<?php echo e($default_values['PUSHER_APP_SECRET'], false); ?>">
            </div>
        </div>

        <!-- Campo para el clúster de la aplicación de Pusher -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PUSHER_APP_CLUSTER"><?php echo e(__('superadmin::lang.pusher_app_cluster'), false); ?>:</label>
                <input type="text" name="PUSHER_APP_CLUSTER" id="PUSHER_APP_CLUSTER" class="form-control" 
                    placeholder="<?php echo e(__('superadmin::lang.pusher_app_cluster'), false); ?>" 
                    value="<?php echo e($default_values['PUSHER_APP_CLUSTER'], false); ?>">
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/pusher_setting.blade.php ENDPATH**/ ?>