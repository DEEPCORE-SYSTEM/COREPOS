
<?php $__env->startSection('title', __('lang_v1.register')); ?>

<?php $__env->startSection('content'); ?>
<div class="login-form col-md-12 col-xs-12 right-col-content-register">
    
    <p class="form-header text-white"><?php echo app('translator')->get('business.register_and_get_started_in_minutes'); ?></p>
    <form action="<?php echo e(route('business.postRegister'), false); ?>" method="POST" id="business_register_form" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('business.partials.register_form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <input type="hidden" name="package_id" value="<?php echo e($package_id, false); ?>">
    <button type="submit">Enviar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "<?php echo e(route('business.getRegister'), false); ?>?lang=" + $(this).val();
        });
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\resources\views/business/register.blade.php ENDPATH**/ ?>