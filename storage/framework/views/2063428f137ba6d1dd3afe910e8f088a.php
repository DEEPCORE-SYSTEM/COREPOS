<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="additional_js">
                    <?php echo app('translator')->get('superadmin::lang.additional_js'); ?>:
                </label> 
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('superadmin::lang.additional_js_instructions') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                
                <textarea name="additional_js" id="additional_js" class="form-control" 
                          placeholder="<?php echo app('translator')->get('superadmin::lang.additional_js'); ?>">
                    <?php echo e(old('additional_js', $settings['additional_js'] ?? ''), false); ?>

                </textarea>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label for="additional_css">
                    <?php echo app('translator')->get('superadmin::lang.additional_css'); ?>:
                </label> 
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('superadmin::lang.additional_css_instructions') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                
                <textarea name="additional_css" id="additional_css" class="form-control" 
                          placeholder="<?php echo app('translator')->get('superadmin::lang.additional_css'); ?>">
                    <?php echo e(old('additional_css', $settings['additional_css'] ?? ''), false); ?>

                </textarea>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/partials/additional_js_css.blade.php ENDPATH**/ ?>