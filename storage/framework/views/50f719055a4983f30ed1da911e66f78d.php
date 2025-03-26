
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Superadmin Settings'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.super_admin_settings'); ?><small><?php echo app('translator')->get('superadmin::lang.edit_super_admin_settings'); ?></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('layouts.partials.search_settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <br>
    
    <form action="<?php echo e(action('\Modules\Superadmin\Http\Controllers\SuperadminSettingsController@update'), false); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 pos-tab-container">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get('superadmin::lang.super_admin_settings'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.application_settings'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.email_smtp_settings'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.payment_gateways'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.backup'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.cron'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.pusher_settings'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('superadmin::lang.additional_js_css'); ?></a>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.super_admin_settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.application_settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.email_smtp_settings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.payment_gateways', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.backup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.cron', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.pusher_setting', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('superadmin::superadmin_settings.partials.additional_js_css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-danger"><?php echo app('translator')->get('messages.update'); ?></button>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).on('change', '#BACKUP_DISK', function() {
        if($(this).val() == 'dropbox'){
            $('div#dropbox_access_token_div').removeClass('hide');
        } else {
            $('div#dropbox_access_token_div').addClass('hide');
        }
    });

    $(document).ready( function(){
        if ($('#welcome_email_body').length) {
            tinymce.init({
                selector: 'textarea#welcome_email_body',
            });
        }

        if ($('#superadmin_register_tc').length) {
            tinymce.init({
                selector: 'textarea#superadmin_register_tc'
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/superadmin_settings/edit.blade.php ENDPATH**/ ?>