<div class="pos-tab-content">
    <div class="row">
        <!-- Checkbox para habilitar pagos offline -->
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="enable_offline_payment" value="1"
                        class="input-icheck"
                        <?php echo e(!empty($settings["enable_offline_payment"]) ? 'checked' : '', false); ?>>
                    <?php echo app('translator')->get('superadmin::lang.enable_offline_payment'); ?>
                </label>
            </div>
        </div>

        <!-- Detalles del pago offline -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="offline_payment_details"><?php echo app('translator')->get('superadmin::lang.offline_payment_details'); ?>:</label>
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('superadmin::lang.offline_payment_details_tooltip') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                <textarea name="offline_payment_details" id="offline_payment_details" class="form-control"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.offline_payment_details'); ?>" rows="3">
                    <?php echo e(old('offline_payment_details', $settings['offline_payment_details'] ?? ''), false); ?>

                </textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>Stripe:</h4>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="STRIPE_PUB_KEY"><?php echo app('translator')->get('superadmin::lang.stripe_pub_key'); ?>:</label>
                <input type="text" name="STRIPE_PUB_KEY" id="STRIPE_PUB_KEY" class="form-control"
                    value="<?php echo e(old('STRIPE_PUB_KEY', $default_values['STRIPE_PUB_KEY']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.stripe_pub_key'); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="STRIPE_SECRET_KEY"><?php echo app('translator')->get('superadmin::lang.stripe_secret_key'); ?>:</label>
                <input type="text" name="STRIPE_SECRET_KEY" id="STRIPE_SECRET_KEY" class="form-control"
                    value="<?php echo e(old('STRIPE_SECRET_KEY', $default_values['STRIPE_SECRET_KEY']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.stripe_secret_key'); ?>">
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <h4>Paypal:</h4>
        <!-- Selección del modo de Paypal -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PAYPAL_MODE"><?php echo app('translator')->get('superadmin::lang.paypal_mode'); ?>:</label>
                <select name="PAYPAL_MODE" id="PAYPAL_MODE" class="form-control">
                    <option value="live" <?php echo e(old('PAYPAL_MODE', $default_values['PAYPAL_MODE']) == 'live' ? 'selected' : '', false); ?>>Live</option>
                    <option value="sandbox" <?php echo e(old('PAYPAL_MODE', $default_values['PAYPAL_MODE']) == 'sandbox' ? 'selected' : '', false); ?>>Sandbox</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Credenciales Paypal Sandbox -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PAYPAL_SANDBOX_API_USERNAME"><?php echo app('translator')->get('superadmin::lang.paypal_sandbox_api_username'); ?>:</label>
                <input type="text" name="PAYPAL_SANDBOX_API_USERNAME" id="PAYPAL_SANDBOX_API_USERNAME" class="form-control"
                    value="<?php echo e(old('PAYPAL_SANDBOX_API_USERNAME', $default_values['PAYPAL_SANDBOX_API_USERNAME']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.paypal_sandbox_api_username'); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PAYPAL_SANDBOX_API_PASSWORD"><?php echo app('translator')->get('superadmin::lang.paypal_sandbox_api_password'); ?>:</label>
                <input type="text" name="PAYPAL_SANDBOX_API_PASSWORD" id="PAYPAL_SANDBOX_API_PASSWORD" class="form-control"
                    value="<?php echo e(old('PAYPAL_SANDBOX_API_PASSWORD', $default_values['PAYPAL_SANDBOX_API_PASSWORD']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.paypal_sandbox_api_password'); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PAYPAL_SANDBOX_API_SECRET"><?php echo app('translator')->get('superadmin::lang.paypal_sandbox_api_secret'); ?>:</label>
                <input type="text" name="PAYPAL_SANDBOX_API_SECRET" id="PAYPAL_SANDBOX_API_SECRET" class="form-control"
                    value="<?php echo e(old('PAYPAL_SANDBOX_API_SECRET', $default_values['PAYPAL_SANDBOX_API_SECRET']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.paypal_sandbox_api_secret'); ?>">
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Credenciales Paypal Live -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PAYPAL_LIVE_API_USERNAME"><?php echo app('translator')->get('superadmin::lang.paypal_live_api_username'); ?>:</label>
                <input type="text" name="PAYPAL_LIVE_API_USERNAME" id="PAYPAL_LIVE_API_USERNAME" class="form-control"
                    value="<?php echo e(old('PAYPAL_LIVE_API_USERNAME', $default_values['PAYPAL_LIVE_API_USERNAME']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.paypal_live_api_username'); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PAYPAL_LIVE_API_PASSWORD"><?php echo app('translator')->get('superadmin::lang.paypal_live_api_password'); ?>:</label>
                <input type="text" name="PAYPAL_LIVE_API_PASSWORD" id="PAYPAL_LIVE_API_PASSWORD" class="form-control"
                    value="<?php echo e(old('PAYPAL_LIVE_API_PASSWORD', $default_values['PAYPAL_LIVE_API_PASSWORD']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.paypal_live_api_password'); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PAYPAL_LIVE_API_SECRET"><?php echo app('translator')->get('superadmin::lang.paypal_live_api_secret'); ?>:</label>
                <input type="text" name="PAYPAL_LIVE_API_SECRET" id="PAYPAL_LIVE_API_SECRET" class="form-control"
                    value="<?php echo e(old('PAYPAL_LIVE_API_SECRET', $default_values['PAYPAL_LIVE_API_SECRET']), false); ?>"
                    placeholder="<?php echo app('translator')->get('superadmin::lang.paypal_live_api_secret'); ?>">
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <h4>Razorpay: <small>(For INR India)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="RAZORPAY_KEY_ID">Key ID:</label>
                <input type="text" name="RAZORPAY_KEY_ID" id="RAZORPAY_KEY_ID" class="form-control"
                    value="<?php echo e(old('RAZORPAY_KEY_ID', $default_values['RAZORPAY_KEY_ID']), false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="RAZORPAY_KEY_SECRET">Key Secret:</label>
                <input type="text" name="RAZORPAY_KEY_SECRET" id="RAZORPAY_KEY_SECRET" class="form-control"
                    value="<?php echo e(old('RAZORPAY_KEY_SECRET', $default_values['RAZORPAY_KEY_SECRET']), false); ?>">
            </div>
        </div>
    </div>
</div>


<div class="pos-tab-content">
    <div class="row">
        <!-- Habilitar Pago Offline -->
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="enable_offline_payment" value="1"
                        class="input-icheck" <?php echo e(!empty($settings["enable_offline_payment"]) ? 'checked' : '', false); ?>>
                    <?php echo app('translator')->get('superadmin::lang.enable_offline_payment'); ?>
                </label>
            </div>
        </div>

        <!-- Detalles del Pago Offline -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="offline_payment_details"><?php echo app('translator')->get('superadmin::lang.offline_payment_details'); ?>:</label>
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('superadmin::lang.offline_payment_details_tooltip') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                <textarea name="offline_payment_details" id="offline_payment_details" 
                    class="form-control" rows="3" 
                    placeholder="<?php echo app('translator')->get('superadmin::lang.offline_payment_details'); ?>">
                    <?php echo e($settings["offline_payment_details"] ?? '', false); ?>

                </textarea>
            </div>
        </div>
    </div>

    <!-- Stripe -->
    <div class="row">
        <h4>Stripe:</h4>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="STRIPE_PUB_KEY"><?php echo app('translator')->get('superadmin::lang.stripe_pub_key'); ?>:</label>
                <input type="text" name="STRIPE_PUB_KEY" id="STRIPE_PUB_KEY" 
                    class="form-control" placeholder="<?php echo app('translator')->get('superadmin::lang.stripe_pub_key'); ?>"
                    value="<?php echo e($default_values['STRIPE_PUB_KEY'], false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="STRIPE_SECRET_KEY"><?php echo app('translator')->get('superadmin::lang.stripe_secret_key'); ?>:</label>
                <input type="text" name="STRIPE_SECRET_KEY" id="STRIPE_SECRET_KEY" 
                    class="form-control" placeholder="<?php echo app('translator')->get('superadmin::lang.stripe_secret_key'); ?>"
                    value="<?php echo e($default_values['STRIPE_SECRET_KEY'], false); ?>">
            </div>
        </div>
    </div>

    <!-- Paypal -->
    <div class="row">
        <h4>Paypal:</h4>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="PAYPAL_MODE"><?php echo app('translator')->get('superadmin::lang.paypal_mode'); ?>:</label>
                <select name="PAYPAL_MODE" id="PAYPAL_MODE" class="form-control">
                    <option value="live" <?php echo e($default_values['PAYPAL_MODE'] == 'live' ? 'selected' : '', false); ?>>Live</option>
                    <option value="sandbox" <?php echo e($default_values['PAYPAL_MODE'] == 'sandbox' ? 'selected' : '', false); ?>>Sandbox</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Razorpay -->
    <div class="row">
        <h4>Razorpay: <small>(For INR India)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="RAZORPAY_KEY_ID">Key ID:</label>
                <input type="text" name="RAZORPAY_KEY_ID" id="RAZORPAY_KEY_ID" 
                    class="form-control" value="<?php echo e($default_values['RAZORPAY_KEY_ID'], false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="RAZORPAY_KEY_SECRET">Key Secret:</label>
                <input type="text" name="RAZORPAY_KEY_SECRET" id="RAZORPAY_KEY_SECRET" 
                    class="form-control" value="<?php echo e($default_values['RAZORPAY_KEY_SECRET'], false); ?>">
            </div>
        </div>
    </div>

    <!-- Pesapal -->
    <div class="row">
        <h4>Pesapal: <small>(For KES currency)</small></h4>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PESAPAL_CONSUMER_KEY">Consumer Key:</label>
                <input type="text" name="PESAPAL_CONSUMER_KEY" id="PESAPAL_CONSUMER_KEY" 
                    class="form-control" value="<?php echo e($default_values['PESAPAL_CONSUMER_KEY'], false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PESAPAL_CONSUMER_SECRET">Consumer Secret:</label>
                <input type="text" name="PESAPAL_CONSUMER_SECRET" id="PESAPAL_CONSUMER_SECRET" 
                    class="form-control" value="<?php echo e($default_values['PESAPAL_CONSUMER_SECRET'], false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="PESAPAL_LIVE">Is Live?</label>
                <select name="PESAPAL_LIVE" id="PESAPAL_LIVE" class="form-control">
                    <option value="false" <?php echo e($default_values['PESAPAL_LIVE'] == 'false' ? 'selected' : '', false); ?>>False</option>
                    <option value="true" <?php echo e($default_values['PESAPAL_LIVE'] == 'true' ? 'selected' : '', false); ?>>True</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Flutterwave -->
    <div class="row">
        <h4>Flutterwave:</h4>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="FLUTTERWAVE_PUBLIC_KEY">Public key:</label>
                <input type="text" name="FLUTTERWAVE_PUBLIC_KEY" id="FLUTTERWAVE_PUBLIC_KEY" 
                    class="form-control" value="<?php echo e($default_values['FLUTTERWAVE_PUBLIC_KEY'], false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="FLUTTERWAVE_SECRET_KEY">Secret key:</label>
                <input type="text" name="FLUTTERWAVE_SECRET_KEY" id="FLUTTERWAVE_SECRET_KEY" 
                    class="form-control" value="<?php echo e($default_values['FLUTTERWAVE_SECRET_KEY'], false); ?>">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="FLUTTERWAVE_ENCRYPTION_KEY">Encryption key:</label>
                <input type="text" name="FLUTTERWAVE_ENCRYPTION_KEY" id="FLUTTERWAVE_ENCRYPTION_KEY" 
                    class="form-control" value="<?php echo e($default_values['FLUTTERWAVE_ENCRYPTION_KEY'], false); ?>">
            </div>
        </div>
        <div class="col-xs-12">
            <p class="help-block">
                <a href="https://support.flutterwave.com/en/articles/3632719-accepted-currencies" target="_blank">
                    <?php echo app('translator')->get('superadmin::lang.flutterwave_help_text'); ?>
                </a>
            </p>
        </div>
    </div>

    <!-- Nota sobre pasarelas de pago -->
    <div class="col-xs-12">
        <p class="help-block"><i><?php echo app('translator')->get('superadmin::lang.payment_gateway_help'); ?></i></p>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/payment_gateways.blade.php ENDPATH**/ ?>