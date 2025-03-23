<?php if(empty($is_admin)): ?>
    <h3><?php echo app('translator')->get('business.business'); ?></h3>
<?php endif; ?>
<input type="hidden" name="language" value="<?php echo e(request()->lang, false); ?>">


<fieldset>
<legend><?php echo app('translator')->get('business.business_details'); ?>:</legend>

<div class="col-md-12">
    <div class="form-group">
        <label for="name"><?php echo e(__('business.business_name'), false); ?>:*</label>

        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-suitcase"></i>
            </span>
          
            <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('business.business_name'), false); ?>" required>

        </div>
    </div>
</div>
        
<div class="col-md-6">
    <div class="form-group">
    <label for="start_date"><?php echo e(__('business.start_date'), false); ?>:</label>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <label for="start_date"><?php echo e(__('business.start_date'), false); ?>:</label>
        <input type="text" name="start_date" id="start_date" class="form-control start-date-picker" placeholder="<?php echo e(__('business.start_date'), false); ?>" readonly>

    </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
    <label for="currency_id"><?php echo e(__('business.currency'), false); ?>:*</label>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="fas fa-money-bill-alt"></i>
        </span>
        <select name="currency_id" id="currency_id" class="form-control select2_register" required>
         <option value=""><?php echo e(__('business.currency_placeholder'), false); ?></option>
        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($key, false); ?>"><?php echo e($currency, false); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </select>

    </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
    <label for="business_logo"><?php echo e(__('business.upload_logo'), false); ?>:</label>
    <input type="file" name="business_logo" id="business_logo" accept="image/*">

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="website"><?php echo e(__('lang_v1.website'), false); ?>:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-globe"></i>
            </span>
            <input type="text" name="website" id="website" class="form-control" placeholder="<?php echo e(__('lang_v1.website'), false); ?>">
        </div>
    </div>
</div>


<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="mobile"><?php echo e(__('lang_v1.business_telephone'), false); ?>:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-phone"></i>
            </span>
            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="<?php echo e(__('lang_v1.business_telephone'), false); ?>">
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="alternate_number"><?php echo e(__('business.alternate_number'), false); ?>:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-phone"></i>
            </span>
            <input type="text" name="alternate_number" id="alternate_number" class="form-control" placeholder="<?php echo e(__('business.alternate_number'), false); ?>">
        </div>
    </div>
</div>


<div class="clearfix"></div>

<div class="col-md-6">
    <div class="form-group">
        <label for="country"><?php echo e(__('business.country'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-globe"></i>
            </span>
            <input type="text" name="country" id="country" class="form-control" placeholder="<?php echo e(__('business.country'), false); ?>" required>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="state"><?php echo e(__('business.state'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="state" id="state" class="form-control" placeholder="<?php echo e(__('business.state'), false); ?>" required>
        </div>
    </div>
</div>


<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="city"><?php echo e(__('business.city'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="city" id="city" class="form-control" placeholder="<?php echo e(__('business.city'), false); ?>" required>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="zip_code"><?php echo e(__('business.zip_code'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="<?php echo e(__('business.zip_code_placeholder'), false); ?>" required>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="landmark"><?php echo e(__('business.landmark'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="landmark" id="landmark" class="form-control" placeholder="<?php echo e(__('business.landmark'), false); ?>" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="time_zone"><?php echo e(__('business.time_zone'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fas fa-clock"></i>
            </span>
            <select name="time_zone" id="time_zone" class="form-control select2_register" required>
                <option value=""><?php echo e(__('business.time_zone'), false); ?></option>
                <?php $__currentLoopData = $timezone_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" <?php echo e(config('app.timezone') == $key ? 'selected' : '', false); ?>><?php echo e($value, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div>


</fieldset>

<!-- tax details -->
<?php if(empty($is_admin)): ?>
    <h3><?php echo app('translator')->get('business.business_settings'); ?></h3>

    <fieldset>
        <legend><?php echo app('translator')->get('business.business_settings'); ?>:</legend>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_label_1"><?php echo e(__('business.tax_1_name'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_label_1" id="tax_label_1" class="form-control" placeholder="<?php echo e(__('business.tax_1_placeholder'), false); ?>">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_number_1"><?php echo e(__('business.tax_1_no'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_number_1" id="tax_number_1" class="form-control">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_label_2"><?php echo e(__('business.tax_2_name'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_label_2" id="tax_label_2" class="form-control" placeholder="<?php echo e(__('business.tax_1_placeholder'), false); ?>">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_number_2"><?php echo e(__('business.tax_2_no'), false); ?>:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_number_2" id="tax_number_2" class="form-control">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fy_start_month"><?php echo e(__('business.fy_start_month'), false); ?>:*</label> 
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.fy_start_month') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <select name="fy_start_month" id="fy_start_month" class="form-control select2_register" required style="width:100%;">
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key, false); ?>"><?php echo e($month, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="accounting_method"><?php echo e(__('business.accounting_method'), false); ?>:*</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calculator"></i>
                    </span>
                    <select name="accounting_method" id="accounting_method" class="form-control select2_register" required style="width:100%;">
                        <?php $__currentLoopData = $accounting_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key, false); ?>"><?php echo e($method, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
<?php endif; ?>


<!-- Owner Information -->
<?php if(empty($is_admin)): ?>
    <h3><?php echo app('translator')->get('business.owner'); ?></h3>
<?php endif; ?>

<fieldset>
<legend><?php echo app('translator')->get('business.owner_info'); ?></legend>

<div class="col-md-4">
    <div class="form-group">
        <label for="surname"><?php echo e(__('business.prefix'), false); ?>:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            <input type="text" name="surname" id="surname" class="form-control" placeholder="<?php echo e(__('business.prefix_placeholder'), false); ?>">
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="first_name"><?php echo e(__('business.first_name'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="<?php echo e(__('business.first_name'), false); ?>" required>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="last_name"><?php echo e(__('business.last_name'), false); ?>:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="<?php echo e(__('business.last_name'), false); ?>">
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-6">
    <div class="form-group">
        <label for="username"><?php echo e(__('business.username'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-user"></i>
            </span>
            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo e(__('business.username'), false); ?>" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="email"><?php echo e(__('business.email'), false); ?>:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
            </span>
            <input type="text" name="email" id="email" class="form-control" placeholder="<?php echo e(__('business.email'), false); ?>">
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-6">
    <div class="form-group">
        <label for="password"><?php echo e(__('business.password'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo e(__('business.password'), false); ?>" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="confirm_password"><?php echo e(__('business.confirm_password'), false); ?>:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="<?php echo e(__('business.confirm_password'), false); ?>" required>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-6">
    <?php if(!empty($system_settings['superadmin_enable_register_tc'])): ?>
        <div class="form-group">
            <label>
                <input type="checkbox" name="accept_tc" class="input-icheck" required>
                <u><a class="terms_condition cursor-pointer" data-toggle="modal" data-target="#tc_modal">
                    <?php echo app('translator')->get('lang_v1.accept_terms_and_conditions'); ?> <i></i>
                </a></u>
            </label>
        </div>
        <?php echo $__env->make('business.partials.terms_conditions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
</div>

<div class="clearfix"></div>

</fieldset><?php /**PATH C:\xampp\htdocs\corepos\resources\views/business/partials/register_form.blade.php ENDPATH**/ ?>