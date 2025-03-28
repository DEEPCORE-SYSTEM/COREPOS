
<?php $__env->startSection('title', __('lang_v1.import_opening_stock')); ?>

<?php $__env->startSection('content'); ?>
<br />
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.import_opening_stock'); ?></h1>
</section>

<!-- Main content -->
<section class="content">

    <?php if(session('notification') || !empty($notification)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php if(!empty($notification['msg'])): ?>
                <?php echo e($notification['msg'], false); ?>

                <?php elseif(session('notification.msg')): ?>
                <?php echo e(session('notification.msg'), false); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <form action="<?php echo e(action('ImportOpeningStockController@store'), false); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="products_csv"><?php echo app('translator')->get('product.file_to_import'); ?>:</label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.tooltip_import_opening_stock') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                                <input type="file" name="products_csv" id="products_csv" accept=".xls" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.submit'); ?></button>
                        </div>
                    </div>
                </div>
            </form>

            <br><br>
            <div class="row">
                <div class="col-sm-4">
                    <a href="<?php echo e(asset('files/import_opening_stock_csv_template.xls'), false); ?>" class="btn btn-success"
                        download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_template_file'); ?></a>
                </div>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.instructions')]); ?>
            <strong><?php echo app('translator')->get('lang_v1.instruction_line1'); ?></strong><br><?php echo app('translator')->get('lang_v1.instruction_line2'); ?>
            <br><br>
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.col_no'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.col_name'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.instruction'); ?></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><?php echo app('translator')->get('product.sku'); ?><small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><?php echo app('translator')->get('business.location'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)
                            <br><?php echo app('translator')->get('lang_v1.location_ins'); ?></small></td>
                    <td><?php echo app('translator')->get('lang_v1.location_ins1'); ?><br>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><?php echo app('translator')->get('lang_v1.quantity'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><?php echo app('translator')->get('purchase.unit_cost_before_tax'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><?php echo app('translator')->get('lang_v1.lot_number'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><?php echo app('translator')->get('lang_v1.expiry_date'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo __('lang_v1.expiry_date_in_business_date_format'); ?> <br /> <b><?php echo e($date_format, false); ?></b></td>
                </tr>
            </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\resources\views/import_opening_stock/index.blade.php ENDPATH**/ ?>