
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.packages'); ?> <small><?php echo app('translator')->get('superadmin::lang.add_package'); ?></small></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">

	<!-- Page level currency setting -->
	<input type="hidden" id="p_code" value="<?php echo e($currency->code, false); ?>">
	<input type="hidden" id="p_symbol" value="<?php echo e($currency->symbol, false); ?>">
	<input type="hidden" id="p_thousand" value="<?php echo e($currency->thousand_separator, false); ?>">
	<input type="hidden" id="p_decimal" value="<?php echo e($currency->decimal_separator, false); ?>">

	<form action="<?php echo e(action('\Modules\Superadmin\Http\Controllers\PackagesController@store'), false); ?>" 
      method="POST" id="add_package_form">
    <?php echo csrf_field(); ?>
    <!-- Aquí van los campos del formulario -->


	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				
			<div class="col-sm-6">
		<div class="form-group">
			
			<label for="name"><?php echo e(__('lang_v1.name'), false); ?>:</label>
			<input type="text" name="name" id="name" class="form-control" required>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="description"><?php echo e(__('superadmin::lang.description'), false); ?>:</label>
			<input type="text" name="description" id="description" class="form-control" required>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="location_count"><?php echo e(__('superadmin::lang.location_count'), false); ?>:</label>
			<input type="number" name="location_count" id="location_count" class="form-control" required min="0">
			<span class="help-block"><?php echo app('translator')->get('superadmin::lang.infinite_help'); ?></span>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="user_count"><?php echo e(__('superadmin::lang.user_count'), false); ?>:</label>
			<input type="number" name="user_count" id="user_count" class="form-control" required min="0">
			<span class="help-block"><?php echo app('translator')->get('superadmin::lang.infinite_help'); ?></span>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="product_count"><?php echo e(__('superadmin::lang.product_count'), false); ?>:</label>
			<input type="number" name="product_count" id="product_count" class="form-control" required min="0">
			<span class="help-block"><?php echo app('translator')->get('superadmin::lang.infinite_help'); ?></span>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="invoice_count"><?php echo e(__('superadmin::lang.invoice_count'), false); ?>:</label>
			<input type="number" name="invoice_count" id="invoice_count" class="form-control" required min="0">
			<span class="help-block"><?php echo app('translator')->get('superadmin::lang.infinite_help'); ?></span>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="interval"><?php echo e(__('superadmin::lang.interval'), false); ?>:</label>
			<select name="interval" id="interval" class="form-control select2" required>
				<option value=""><?php echo e(__('messages.please_select'), false); ?></option>
				<?php $__currentLoopData = $intervals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
	</div>


	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="interval_count"><?php echo e(__('superadmin::lang.interval_count'), false); ?>:</label>
			<input type="number" name="interval_count" id="interval_count" class="form-control" required min="1">
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="trial_days"><?php echo e(__('superadmin::lang.trial_days'), false); ?>:</label>
			<input type="number" name="trial_days" id="trial_days" class="form-control" required min="0">
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="price"><?php echo e(__('superadmin::lang.price'), false); ?>:</label>
			<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('superadmin::lang.tooltip_pkg_price') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>

			<div class="input-group">
				<span class="input-group-addon" id="basic-addon3"><b><?php echo e($currency->code, false); ?> <?php echo e($currency->symbol, false); ?></b></span>
				<input type="text" name="price" id="price" class="form-control input_number" required>
			</div>
			<span class="help-block">
				0 = <?php echo app('translator')->get('superadmin::lang.free_package'); ?>
			</span>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-6">
		<div class="form-group">
			
			<label for="sort_order"><?php echo e(__('superadmin::lang.sort_order'), false); ?>:</label>
			<input type="number" name="sort_order" id="sort_order" class="form-control" required value="1">
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-6">
		<div class="checkbox">
			<label>
				
				<input type="checkbox" name="is_private" class="input-icheck" value="1">
				<?php echo e(__('superadmin::lang.private_superadmin_only'), false); ?>

			</label>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="checkbox">
			<label>
				
				<input type="checkbox" name="is_one_time" class="input-icheck" value="1">
				<?php echo e(__('superadmin::lang.one_time_only_subscription'), false); ?>

			</label>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-sm-4">
		<div class="checkbox">
			<label>
				
				<input type="checkbox" name="enable_custom_link" id="enable_custom_link" class="input-icheck" value="1">
				<?php echo e(__('superadmin::lang.enable_custom_subscription_link'), false); ?>

			</label>
		</div>
	</div>

	
	<div id="custom_link_div" class="hide">
		<div class="col-sm-4">
			<div class="form-group">
				<label for="custom_link"><?php echo e(__('superadmin::lang.custom_link'), false); ?>:</label>
				<input type="text" name="custom_link" id="custom_link" class="form-control">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="custom_link_text"><?php echo e(__('superadmin::lang.custom_link_text'), false); ?>:</label>
				<input type="text" name="custom_link_text" id="custom_link_text" class="form-control">
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	
	<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module => $module_permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php $__currentLoopData = $module_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-sm-3">
				<div class="checkbox">
					<label>
						
						<input type="checkbox" name="custom_permissions[<?php echo e($permission['name'], false); ?>]" class="input-icheck" value="1" 
							<?php if($permission['default']): ?> checked <?php endif; ?>>
						<?php echo e($permission['label'], false); ?>

					</label>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<div class="col-sm-3">
		<div class="checkbox">
			<label>
				
				<input type="checkbox" name="is_active" class="input-icheck" value="1" checked>
				<?php echo e(__('superadmin::lang.is_active'), false); ?>

			</label>
		</div>
	</div>


				
			</div>

			<div class="row">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary pull-right btn-flat"><?php echo app('translator')->get('messages.save'); ?></button>
				</div>
			</div>

		</div>
	</div>

	</form>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form#add_package_form').validate();
		});
		$('#enable_custom_link').on('ifChecked', function(event){
		   $("div#custom_link_div").removeClass('hide');
		});
		$('#enable_custom_link').on('ifUnchecked', function(event){
		   $("div#custom_link_div").addClass('hide');
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\Modules\Superadmin\Providers/../Resources/views/packages/create.blade.php ENDPATH**/ ?>