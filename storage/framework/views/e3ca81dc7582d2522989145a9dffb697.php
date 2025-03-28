<div class="col-md-3">
    <div class="form-group">
        <?php
        $is_disabled = !empty($product->woocommerce_disable_sync) ? true : false;
        if(empty($product) && !empty($duplicate_product->woocommerce_disable_sync)){
        $is_disabled = true;
        }
        ?>
        <br>
        <label>
            <input type="hidden" name="woocommerce_disable_sync" value="0">
            <input type="checkbox" name="woocommerce_disable_sync" value="1" class="input-icheck"
                <?php echo e($is_disabled ? 'checked' : '', false); ?>>
            <strong><?php echo app('translator')->get('woocommerce::lang.woocommerce_disable_sync'); ?></strong>

        </label>
        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('woocommerce::lang.woocommerce_disable_sync_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\corepos\Modules\Woocommerce\Providers/../Resources/views/woocommerce/partials/product_form_part.blade.php ENDPATH**/ ?>