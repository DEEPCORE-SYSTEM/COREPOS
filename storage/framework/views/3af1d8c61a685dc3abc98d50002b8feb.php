
<?php $__env->startSection('title', __('barcode.print_labels')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
<br>
    <h1><?php echo app('translator')->get('barcode.print_labels'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.print_label') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">
    <!-- Formulario para la configuración de etiquetas -->
    <form id="preview_setting_form" onsubmit="return false">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('product.add_product_for_labels')]); ?>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!-- Campo de búsqueda de productos -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" name="search_product" id="search_product_for_label" class="form-control" placeholder="<?php echo e(__('lang_v1.enter_product_name_to_print_labels'), false); ?>" autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!-- Tabla de productos seleccionados -->
                    <table class="table table-bordered table-striped table-condensed" id="product_table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('barcode.products'), false); ?></th>
                                <th><?php echo e(__('barcode.no_of_labels'), false); ?></th>
                                <?php if(session('business.enable_lot_number') == 1): ?>
                                    <th><?php echo e(__('lang_v1.lot_number'), false); ?></th>
                                <?php endif; ?>
                                <?php if(session('business.enable_product_expiry') == 1): ?>
                                    <th><?php echo e(__('product.exp_date'), false); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('lang_v1.packing_date'), false); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $__env->make('labels.partials.show_table_rows', ['index' => 0], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('barcode.info_in_labels')]); ?>
            <div class="row">
                <!-- Opciones de impresión de etiquetas -->
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="print[name]" value="1"> <b><?php echo e(__('barcode.print_name'), false); ?></b>
                        </label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="print[variations]" value="1"> <b><?php echo e(__('barcode.print_variations'), false); ?></b>
                        </label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="print[price]" value="1" id="is_show_price"> <b><?php echo e(__('barcode.print_price'), false); ?></b>
                        </label>
                    </div>
                </div>

                <div class="col-sm-3" id="price_type_div">
                    <div class="form-group">
                        <label><?php echo e(__('barcode.show_price'), false); ?>:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            <select name="print[price_type]" class="form-control">
                                <option value="inclusive"><?php echo e(__('product.inc_of_tax'), false); ?></option>
                                <option value="exclusive"><?php echo e(__('product.exc_of_tax'), false); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="print[business_name]" value="1"> <b><?php echo e(__('barcode.print_business_name'), false); ?></b>
                        </label>
                    </div>
                </div>

                <?php if(session('business.enable_lot_number') == 1): ?>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked name="print[lot_number]" value="1"> <b><?php echo e(__('lang_v1.print_lot_number'), false); ?></b>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('business.enable_product_expiry') == 1): ?>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked name="print[exp_date]" value="1"> <b><?php echo e(__('lang_v1.print_exp_date'), false); ?></b>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="print[packing_date]" value="1"> <b><?php echo e(__('lang_v1.print_packing_date'), false); ?></b>
                        </label>
                    </div>
                </div>

                <div class="col-sm-12">
                    <hr/>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label><?php echo e(__('barcode.barcode_setting'), false); ?>:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-cog"></i>
                            </span>
                            <select name="barcode_setting" class="form-control">
                                <?php $__currentLoopData = $barcode_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id, false); ?>" <?php echo e(!empty($default) && $default->id == $id ? 'selected' : '', false); ?>><?php echo e($setting, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-sm-offset-8">
                    <button type="button" id="labels_preview" class="btn btn-primary btn-block"><?php echo e(__('barcode.preview'), false); ?></button>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </form>

    <div class="col-sm-8 hide display_label_div">
        <h3 class="box-title"><?php echo e(__('barcode.preview'), false); ?></h3>
        <button type="button" class="col-sm-offset-2 btn btn-success btn-block" id="print_label">Print</button>
    </div>
    <div class="clearfix"></div>
</section>

<!-- Preview section-->
<div id="preview_box">
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/labels.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\resources\views/labels/show.blade.php ENDPATH**/ ?>