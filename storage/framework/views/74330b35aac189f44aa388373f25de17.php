<!-- Contenido de la pestaña activa -->
<div class="pos-tab-content active">
    <div class="row">

        <!-- Nombre del negocio -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_name"><?php echo e(__('business.business_name'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-suitcase"></i>
                    </span>
                    <input type="text" name="invoice_business_name" id="invoice_business_name" 
                        class="form-control" placeholder="<?php echo e(__('business.business_name'), false); ?>" 
                        required value="<?php echo e($settings['invoice_business_name'], false); ?>">
                </div>
            </div>
        </div>

        <!-- Correo electrónico -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="email"><?php echo e(__('business.email'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" class="form-control" 
                        placeholder="<?php echo e(__('business.email'), false); ?>" value="<?php echo e($settings['email'], false); ?>">
                </div>
            </div>
        </div>

        <!-- Moneda -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="app_currency_id"><?php echo e(__('business.currency'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    <select name="app_currency_id" id="app_currency_id" 
                        class="form-control select2" required>
                        <option value=""><?php echo e(__('business.currency_placeholder'), false); ?></option>
                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key, false); ?>" <?php echo e($settings['app_currency_id'] == $key ? 'selected' : '', false); ?>>
                                <?php echo e($currency, false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Dirección del negocio -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_landmark"><?php echo e(__('business.landmark'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_landmark" id="invoice_business_landmark"
                        class="form-control" placeholder="<?php echo e(__('business.landmark'), false); ?>" 
                        required value="<?php echo e($settings['invoice_business_landmark'], false); ?>">
                </div>
            </div>
        </div>

        <!-- Código postal -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_zip"><?php echo e(__('business.zip_code'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_zip" id="invoice_business_zip"
                        class="form-control" placeholder="<?php echo e(__('business.zip_code'), false); ?>" 
                        required value="<?php echo e($settings['invoice_business_zip'], false); ?>">
                </div>
            </div>
        </div>

        <!-- Estado -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_state"><?php echo e(__('business.state'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_state" id="invoice_business_state"
                        class="form-control" placeholder="<?php echo e(__('business.state'), false); ?>" 
                        required value="<?php echo e($settings['invoice_business_state'], false); ?>">
                </div>
            </div>
        </div>

        <!-- Ciudad -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_city"><?php echo e(__('business.city'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <input type="text" name="invoice_business_city" id="invoice_business_city"
                        class="form-control" placeholder="<?php echo e(__('business.city'), false); ?>" 
                        required value="<?php echo e($settings['invoice_business_city'], false); ?>">
                </div>
            </div>
        </div>

        <!-- País -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="invoice_business_country"><?php echo e(__('business.country'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </span>
                    <input type="text" name="invoice_business_country" id="invoice_business_country"
                        class="form-control" placeholder="<?php echo e(__('business.country'), false); ?>" 
                        required value="<?php echo e($settings['invoice_business_country'], false); ?>">
                </div>
            </div>
        </div>

        <!-- Días de alerta de vencimiento del paquete -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="package_expiry_alert_days"><?php echo e(__('superadmin::lang.package_expiry_alert_days'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-exclamation-triangle"></i>
                    </span>
                    <input type="number" name="package_expiry_alert_days" id="package_expiry_alert_days"
                        class="form-control" placeholder="<?php echo e(__('superadmin::lang.package_expiry_alert_days'), false); ?>" 
                        required value="<?php echo e($settings['package_expiry_alert_days'], false); ?>">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Activar nombres de usuario basados en el negocio -->
        <div class="col-xs-4">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="enable_business_based_username" value="1" 
                        class="input-icheck" <?php echo e($settings['enable_business_based_username'] ? 'checked' : '', false); ?>>
                    <?php echo e(__('superadmin::lang.enable_business_based_username'), false); ?>

                </label>
                <p class="help-block"><?php echo e(__('superadmin::lang.business_based_username_help'), false); ?></p>
            </div>
        </div>

        <!-- Información de la versión -->
        <div class="col-xs-12">
            <p class="help-block">
                <i><?php echo __('superadmin::lang.version_info', ['version' => $superadmin_version]); ?></i>
            </p>
        </div>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/super_admin_settings.blade.php ENDPATH**/ ?>