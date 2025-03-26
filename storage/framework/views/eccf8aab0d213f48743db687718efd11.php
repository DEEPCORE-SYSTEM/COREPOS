
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Business'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'superadmin::lang.all_business' ); ?>
        <small><?php echo app('translator')->get( 'superadmin::lang.manage_business' ); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <label for="package_id"><?php echo e(__('superadmin::lang.packages'), false); ?>:</label>
                <select id="package_id" name="package_id" class="form-control select2" style="width:100%">
                    <option value=""><?php echo e(__('lang_v1.all'), false); ?></option>
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="subscription_status"><?php echo e(__('superadmin::lang.subscription_status'), false); ?>:</label>
                <select id="subscription_status" name="subscription_status" class="form-control select2" style="width:100%">
                    <option value=""><?php echo e(__('lang_v1.all'), false); ?></option>
                    <?php $__currentLoopData = $subscription_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="is_active"><?php echo e(__('sale.status'), false); ?>:</label>
                <select id="is_active" name="is_active" class="form-control select2" style="width:100%">
                    <option value=""><?php echo e(__('lang_v1.all'), false); ?></option>
                    <option value="active"><?php echo e(__('business.is_active'), false); ?></option>
                    <option value="inactive"><?php echo e(__('lang_v1.inactive'), false); ?></option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="last_transaction_date"><?php echo e(__('superadmin::lang.last_transaction_date'), false); ?>:</label>
                <select id="last_transaction_date" name="last_transaction_date" class="form-control select2" style="width:100%">
                    <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
                    <?php $__currentLoopData = $last_transaction_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="no_transaction_since"><?php echo e(__('superadmin::lang.no_transaction_since'), false); ?>:</label>
                <select id="no_transaction_since" name="no_transaction_since" class="form-control select2" style="width:100%">
                    <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
                    <?php $__currentLoopData = $last_transaction_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
	<div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">&nbsp;</h3>
        	<div class="box-tools">
                <a href="<?php echo e(action('\Modules\Superadmin\Http\Controllers\BusinessController@create'), false); ?>" 
                    class="btn btn-block btn-primary">
                	<i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
            </div>
        </div>

        <div class="box-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="superadmin_business_table">
                        <thead>
                            <tr>
                                <th>
                                    <?php echo app('translator')->get('superadmin::lang.registered_on'); ?>
                                </th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.business_name' ); ?></th>
                                <th><?php echo app('translator')->get('business.owner'); ?></th>
                                <th><?php echo app('translator')->get('business.email'); ?></th>
                                <th><?php echo app('translator')->get('superadmin::lang.owner_number'); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.business_contact_number' ); ?></th>
                                <th><?php echo app('translator')->get('business.address'); ?></th>
                                <th><?php echo app('translator')->get( 'sale.status' ); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.current_subscription' ); ?></th>
                                <th><?php echo app('translator')->get( 'business.created_by' ); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.action' ); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready( function(){
        superadmin_business_table = $('#superadmin_business_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(action('\Modules\Superadmin\Http\Controllers\BusinessController@index'), false); ?>",
                data: function(d) {
                    d.package_id = $('#package_id').val();
                    d.subscription_status = $('#subscription_status').val();
                    d.is_active = $('#is_active').val();
                    d.last_transaction_date = $('#last_transaction_date').val();
                    d.no_transaction_since = $('#no_transaction_since').val();
                },
            },
            aaSorting: [[0, 'desc']],
            columns: [
                { data: 'created_at', name: 'business.created_at' },
                { data: 'name', name: 'business.name' },
                { data: 'owner_name', name: 'owner_name', searchable: false},
                { data: 'owner_email', name: 'u.email' },
                { data: 'contact_number', name: 'u.contact_number' },
                { data: 'business_contact_number', name: 'business_contact_number' },
                { data: 'address', name: 'address' },
                { data: 'is_active', name: 'is_active', searchable: false },
                { data: 'current_subscription', name: 'p.name' },
                { data: 'biz_creator', name: 'biz_creator', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#package_id, #subscription_status, #is_active, #last_transaction_date, #no_transaction_since').change( function(){
            superadmin_business_table.ajax.reload();
        });
    });
    $(document).on('click', 'a.delete_business_confirmation', function(e){
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: "Once deleted, you will not be able to recover this business!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/business/index.blade.php ENDPATH**/ ?>