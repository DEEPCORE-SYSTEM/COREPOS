<div class="modal-dialog" role="document">
  <div class="modal-content">
    <form action="<?php echo e(action('\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController@store'), false); ?>" method="POST" id="superadmin_add_subscription">
      <?php echo csrf_field(); ?>

      <input type="hidden" name="business_id" value="<?php echo e($business_id, false); ?>">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?php echo app('translator')->get('superadmin::lang.add_subscription'); ?></h4>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label for="package_id"><?php echo app('translator')->get('superadmin::lang.subscription_packages'); ?>:</label>
          <select name="package_id" id="package_id" class="form-control" required>
            <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($id, false); ?>"><?php echo e($package, false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        <div class="form-group">
          <label for="paid_via"><?php echo app('translator')->get('superadmin::lang.paid_via'); ?>:</label>
          <select name="paid_via" id="paid_via" class="form-control" required>
            <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
            <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($id, false); ?>"><?php echo e($gateway, false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        <div class="form-group">
          <label for="payment_transaction_id"><?php echo app('translator')->get('superadmin::lang.payment_transaction_id'); ?>:</label>
          <input type="text" name="payment_transaction_id" id="payment_transaction_id" class="form-control" placeholder="<?php echo app('translator')->get('superadmin::lang.payment_transaction_id'); ?>">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
      </div>
    </form>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_subscription/add_subscription.blade.php ENDPATH**/ ?>