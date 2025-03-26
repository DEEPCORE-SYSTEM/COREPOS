<?php if(!session('business.enable_price_tax')): ?>
<?php
$default = 0;
$class = 'hide';
?>
<?php else: ?>
<?php
$default = null;
$class = '';
?>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered add-product-price-table table-condensed <?php echo e($class, false); ?>">
        <tr>
            <th><?php echo app('translator')->get('product.default_purchase_price'); ?></th>
            <th><?php echo app('translator')->get('product.profit_percent'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.profit_percent') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?></th>
            <th><?php echo app('translator')->get('product.default_selling_price'); ?></th>
            <?php if(empty($quick_add)): ?>
            <th><?php echo app('translator')->get('lang_v1.product_image'); ?></th>
            <?php endif; ?>
        </tr>

        <tr>
            <td>
                <div class="col-sm-6">
                    <label for="single_dpp"><?php echo e(trans('product.exc_of_tax'), false); ?>:*</label>
                    <input type="text" name="single_dpp" id="single_dpp" value="<?php echo e(old('single_dpp', $default), false); ?>"
                        class="form-control input-sm dpp input_number" placeholder="<?php echo e(__('product.exc_of_tax'), false); ?>"
                        required>
                </div>

                <div class="col-sm-6">
                    <label for="single_dpp_inc_tax"><?php echo e(trans('product.inc_of_tax'), false); ?>:*</label>
                    <input type="text" name="single_dpp_inc_tax" id="single_dpp_inc_tax"
                        value="<?php echo e(old('single_dpp_inc_tax', $default), false); ?>"
                        class="form-control input-sm dpp_inc_tax input_number"
                        placeholder="<?php echo e(__('product.inc_of_tax'), false); ?>" required>
                </div>
            </td>


            <td>
                <br />
                <input type="text" name="profit_percent" value="<?php echo e(number_format($profit_percent), false); ?>"
                    class="form-control input-sm input_number" id="profit_percent" required>
            </td>

            <td>
                <label><span class="dsp_label"><?php echo e(__('product.exc_of_tax'), false); ?></span></label>
                <input type="text" name="single_dsp" value="<?php echo e($default, false); ?>"
                    class="form-control input-sm dsp input_number" placeholder="<?php echo e(__('product.exc_of_tax'), false); ?>"
                    id="single_dsp" required>

                <input type="text" name="single_dsp_inc_tax" value="<?php echo e($default, false); ?>"
                    class="form-control input-sm hide input_number" placeholder="<?php echo e(__('product.inc_of_tax'), false); ?>"
                    id="single_dsp_inc_tax" required>
            </td>

            <?php if(empty($quick_add)): ?>
            <td>
                <div class="form-group">
                    <label for="variation_images"><?php echo e(__('lang_v1.product_image'), false); ?>:</label>
                    <input type="file" name="variation_images[]" id="variation_images" class="variation_images"
                        accept="image/*" multiple>

                    <small>
                        <p class="help-block">
                            <?php echo e(__('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]), false); ?>

                            <br>
                            <?php echo e(__('lang_v1.aspect_ratio_should_be_1_1'), false); ?>

                        </p>
                    </small>
                </div>
            </td>
            <?php endif; ?>
        </tr>

    </table>
</div><?php /**PATH C:\xampp\htdocs\corepos\resources\views/product/partials/single_product_form_part.blade.php ENDPATH**/ ?>