<div class="modal fade" id="edit_product_location_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(action('ProductController@updateProductLocation'), false); ?>" method="post" id="edit_product_location_form">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="add_to_location_title hide"><?php echo app('translator')->get('lang_v1.add_location_to_the_selected_products'); ?></span>
                        <span class="remove_from_location_title hide"><?php echo app('translator')->get('lang_v1.remove_location_from_the_selected_products'); ?></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_location"><?php echo app('translator')->get('purchase.business_location'); ?>:</label>
                        <select name="product_location[]" class="form-control" style="width:100%" required multiple id="product_location">
                            <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="hidden" name="products" id="products_to_update_location">
                        <input type="hidden" name="update_type" id="update_type">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_product_location"><?php echo app('translator')->get('messages.save'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/product/partials/edit_product_location_modal.blade.php ENDPATH**/ ?>