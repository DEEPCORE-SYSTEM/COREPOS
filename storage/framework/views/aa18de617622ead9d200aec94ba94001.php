<div class="pos-tab-content">
    <div class="row">
        <!-- Campo para el nombre de la aplicación -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="APP_NAME"><?php echo app('translator')->get('superadmin::lang.app_name'); ?>:</label>
                <input type="text" name="APP_NAME" value="<?php echo e($default_values['APP_NAME'], false); ?>" class="form-control" placeholder="<?php echo app('translator')->get('superadmin::lang.app_name'); ?>">
            </div>
        </div>

        <!-- Campo para el título de la aplicación -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="APP_TITLE"><?php echo app('translator')->get('superadmin::lang.app_title'); ?>:</label>
                <input type="text" name="APP_TITLE" value="<?php echo e($default_values['APP_TITLE'], false); ?>" class="form-control" placeholder="<?php echo app('translator')->get('superadmin::lang.app_title'); ?>">
            </div>
        </div>

        <!-- Selección del idioma predeterminado -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="APP_LOCALE"><?php echo app('translator')->get('superadmin::lang.app_default_language'); ?>:</label>
                <select name="APP_LOCALE" class="form-control">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php echo e($default_values['APP_LOCALE'] == $key ? 'selected' : '', false); ?>><?php echo e($language, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Checkbox para permitir el registro de usuarios -->
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="ALLOW_REGISTRATION" value="1" class="input-icheck" <?php echo e(!empty($default_values["ALLOW_REGISTRATION"]) ? 'checked' : '', false); ?>>
                    <?php echo app('translator')->get('superadmin::lang.allow_registration'); ?>
                </label>
            </div>
        </div>

        <!-- Checkbox para habilitar términos y condiciones en el registro -->
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="superadmin_enable_register_tc" value="1" class="input-icheck" <?php echo e(!empty($settings["superadmin_enable_register_tc"]) ? 'checked' : '', false); ?>>
                    <?php echo app('translator')->get('superadmin::lang.enable_register_tc'); ?>
                </label>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Área de texto para los términos y condiciones del registro -->
        <div class="col-xs-12">
            <div class="form-group">
                <label for="superadmin_register_tc"><?php echo app('translator')->get('superadmin::lang.register_tc'); ?>:</label>
                <textarea name="superadmin_register_tc" class="form-control"><?php echo e(!empty($settings['superadmin_register_tc']) ? $settings['superadmin_register_tc'] : '', false); ?></textarea>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Campo para la clave de API de Google Maps -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="GOOGLE_MAP_API_KEY"><?php echo app('translator')->get('superadmin::lang.google_map_api_key'); ?>:</label>
                <input type="text" name="GOOGLE_MAP_API_KEY" value="<?php echo e($default_values['GOOGLE_MAP_API_KEY'], false); ?>" class="form-control" placeholder="<?php echo app('translator')->get('superadmin::lang.google_map_api_key'); ?>">
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/application_settings.blade.php ENDPATH**/ ?>