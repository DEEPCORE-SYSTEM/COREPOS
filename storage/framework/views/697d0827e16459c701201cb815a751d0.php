<div class="pos-tab-content">
    <div class="row">
        
        <div class="col-xs-4">
            <div class="form-group">
                <label for="MAIL_DRIVER"><?php echo e(__('superadmin::lang.mail_driver'), false); ?>:</label>
                <select name="MAIL_DRIVER" id="MAIL_DRIVER" class="form-control">
                    <?php $__currentLoopData = $mail_drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php echo e($default_values['MAIL_DRIVER'] == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        
        <?php
            $mail_fields = [
                'MAIL_HOST' => __('superadmin::lang.mail_host'),
                'MAIL_PORT' => __('superadmin::lang.mail_port'),
                'MAIL_USERNAME' => __('superadmin::lang.mail_username'),
                'MAIL_PASSWORD' => __('superadmin::lang.mail_password'),
                'MAIL_ENCRYPTION' => __('superadmin::lang.mail_encryption'),
                'MAIL_FROM_ADDRESS' => __('superadmin::lang.mail_from_address'),
                'MAIL_FROM_NAME' => __('superadmin::lang.mail_from_name')
            ];
        ?>

        <?php $__currentLoopData = $mail_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="<?php echo e($field, false); ?>"><?php echo e($label, false); ?>:</label>
                    <input type="<?php echo e($field == 'MAIL_FROM_ADDRESS' ? 'email' : 'text', false); ?>" 
                           name="<?php echo e($field, false); ?>" 
                           id="<?php echo e($field, false); ?>" 
                           value="<?php echo e($default_values[$field] ?? '', false); ?>" 
                           class="form-control" 
                           placeholder="<?php echo e($label, false); ?>">
                </div>
            </div>
            <?php if($loop->iteration % 3 == 0): ?> 
                <div class="clearfix"></div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="clearfix"></div>

        
        <?php
            $checkbox_settings = [
                'allow_email_settings_to_businesses' => __('superadmin::lang.allow_email_settings_to_businesses'),
                'enable_new_business_registration_notification' => __('superadmin::lang.enable_new_business_registration_notification'),
                'enable_new_subscription_notification' => __('superadmin::lang.enable_new_subscription_notification'),
                'enable_welcome_email' => __('superadmin::lang.enable_welcome_email')
            ];
        ?>

        <?php $__currentLoopData = $checkbox_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="<?php echo e($name, false); ?>" value="1" class="input-icheck"
                               <?php echo e(!empty($settings[$name]) ? 'checked' : '', false); ?>>
                        <?php echo e($label, false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('superadmin::lang.' . Str::snake($name) . '_tooltip') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                </div>
            </div>
            <?php if($loop->iteration % 3 == 0): ?> 
                <div class="clearfix"></div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="clearfix"></div>

        
        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('superadmin::lang.welcome_email_template'); ?>:</h4>
            <strong><?php echo app('translator')->get('lang_v1.available_tags'); ?>:</strong> {business_name}, {owner_name} <br><br>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label for="welcome_email_subject"><?php echo e(__('superadmin::lang.welcome_email_subject'), false); ?>:</label>
                <input type="text" name="welcome_email_subject" id="welcome_email_subject" 
                       value="<?php echo e($settings['welcome_email_subject'] ?? '', false); ?>" 
                       class="form-control" 
                       placeholder="<?php echo e(__('superadmin::lang.welcome_email_subject'), false); ?>">
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label for="welcome_email_body"><?php echo e(__('superadmin::lang.welcome_email_body'), false); ?>:</label>
                <textarea name="welcome_email_body" id="welcome_email_body" 
                          class="form-control" 
                          placeholder="<?php echo e(__('superadmin::lang.welcome_email_body'), false); ?>"><?php echo e($settings['welcome_email_body'] ?? '', false); ?></textarea>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/email_smtp_settings.blade.php ENDPATH**/ ?>