
<?php $__env->startSection('title', __('product.add_new_product')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('product.add_new_product'); ?></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php
    $form_class = empty($duplicate_product) ? 'create' : '';
    ?>

    <form action="<?php echo e(action('ProductController@store'), false); ?>" method="post" id="product_add_form"
        class="product_form <?php echo e($form_class, false); ?>" enctype="multipart/form-data">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="name"><?php echo e(__('product.product_name'), false); ?>:*</label>
                    <input type="text" name="name" id="name" class="form-control" required
                        placeholder="<?php echo e(__('product.product_name'), false); ?>"
                        value="<?php echo e(!empty($duplicate_product->name) ? $duplicate_product->name : null, false); ?>">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="sku"><?php echo e(__('product.sku'), false); ?>:</label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.sku') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                    <input type="text" name="sku" id="sku" class="form-control" placeholder="<?php echo e(__('product.sku'), false); ?>">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="barcode_type"><?php echo e(__('product.barcode_type'), false); ?>:*</label>
                    <select name="barcode_type" id="barcode_type" class="form-control select2" required>
                        <?php $__currentLoopData = $barcode_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"
                            <?php echo e(!empty($duplicate_product->barcode_type) && $duplicate_product->barcode_type == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="unit_id"><?php echo e(__('product.unit'), false); ?>:*</label>
                    <div class="input-group">
                        <select name="unit_id" id="unit_id" class="form-control select2" required>
                            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id, false); ?>"
                                <?php echo e($id == old('unit_id', session('business.default_unit')) ? 'selected' : '', false); ?>>
                                <?php echo e($name, false); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="input-group-btn">
                            <button type="button" <?php if(!auth()->user()->can('unit.create')): ?> disabled <?php endif; ?>
                                class="btn btn-default bg-white btn-flat btn-modal"
                                data-href="<?php echo e(action('UnitController@create', ['quick_add' => true]), false); ?>"
                                title="<?php echo app('translator')->get('unit.add_unit'); ?>" data-container=".view_modal">
                                <i class="fa fa-plus-circle text-primary fa-lg"></i>
                            </button>
                        </span>
                    </div>
                </div>

            </div>

            <div class="col-sm-4 <?php if(!session('business.enable_sub_units')): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <label for="sub_unit_ids"><?php echo e(__('lang_v1.related_sub_units'), false); ?>:</label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.sub_units_tooltip') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                    <select name="sub_unit_ids[]" id="sub_unit_ids" class="form-control select2" multiple>
                        <!-- Populate with sub-unit options -->
                    </select>
                </div>
            </div>

            <div class="col-sm-4 <?php if(!session('business.enable_brand')): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <label for="brand_id"><?php echo e(__('product.brand'), false); ?>:</label>
                    <div class="input-group">
                        <select name="brand_id" id="brand_id" class="form-control select2">
                            <option value="" disabled selected><?php echo e(__('messages.please_select'), false); ?></option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key, false); ?>"
                                <?php echo e(!empty($duplicate_product->brand_id) && $duplicate_product->brand_id == $key ? 'selected' : '', false); ?>>
                                <?php echo e($value, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="input-group-btn">
                            <button type="button" <?php if(!auth()->user()->can('brand.create')): ?> disabled <?php endif; ?> class="btn
                                btn-default bg-white btn-flat btn-modal"
                                data-href="<?php echo e(action('BrandController@create', ['quick_add' => true]), false); ?>"
                                title="<?php echo app('translator')->get('brand.add_brand'); ?>" data-container=".view_modal"><i
                                    class="fa fa-plus-circle text-primary fa-lg"></i></button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4 <?php if(!session('business.enable_category')): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <label for="category_id"><?php echo e(__('product.category'), false); ?>:</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="" disabled selected><?php echo e(__('messages.please_select'), false); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"
                            <?php echo e(!empty($duplicate_product->category_id) && $duplicate_product->category_id == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div
                class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category'))): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <label for="sub_category_id"><?php echo e(__('product.sub_category'), false); ?>:</label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control select2">
                        <option value="" disabled selected><?php echo e(__('messages.please_select'), false); ?></option>
                        <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"
                            <?php echo e(!empty($duplicate_product->sub_category_id) && $duplicate_product->sub_category_id == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <?php
            $default_location = null;
            if(count($business_locations) == 1){
            $default_location = array_key_first($business_locations->toArray());
            }
            ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="product_locations"><?php echo e(__('business.business_locations'), false); ?>:</label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.product_location_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                    <select name="product_locations[]" id="product_locations" class="form-control select2" multiple>
                        <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php echo e($default_location == $key ? 'selected' : '', false); ?>><?php echo e($value, false); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
                <div class="form-group">
                    <br>
                    <label for="enable_stock">
                        <input type="checkbox" name="enable_stock" id="enable_stock" class="input-icheck" value="1"
                            <?php echo e(!empty($duplicate_product) && $duplicate_product->enable_stock ? 'checked' : '', false); ?>>
                        <strong><?php echo app('translator')->get('product.manage_stock'); ?></strong>
                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.enable_stock') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                    <p class="help-block">
                        <i><?php echo app('translator')->get('product.enable_stock_help'); ?></i>
                    </p>
                </div>
            </div>

            <div class="col-sm-4 <?php if(!empty($duplicate_product) && $duplicate_product->enable_stock == 0): ?> hide <?php endif; ?>"
                id="alert_quantity_div">
                <div class="form-group">
                    <label for="alert_quantity"><?php echo e(__('product.alert_quantity'), false); ?>:</label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.alert_quantity') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                    <input type="text" name="alert_quantity" id="alert_quantity" class="form-control input_number"
                        placeholder="<?php echo e(__('product.alert_quantity'), false); ?>" min="0"
                        value="<?php echo e(!empty($duplicate_product->alert_quantity) ? number_format($duplicate_product->alert_quantity, config('constants.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, false); ?>">
                </div>
            </div>

            <?php if(!empty($common_settings['enable_product_warranty'])): ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="warranty_id"><?php echo e(__('lang_v1.warranty'), false); ?>:</label>
                    <select name="warranty_id" id="warranty_id" class="form-control select2">
                        <option value="" disabled selected><?php echo e(__('messages.please_select'), false); ?></option>
                        <?php $__currentLoopData = $warranties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <?php endif; ?>

            <!-- Include module fields -->
            <?php if(!empty($pos_module_data)): ?>
            <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($value['view_path'])): ?>
            <?php if ($__env->exists($value['view_path'], ['view_data' => $value['view_data']])) echo $__env->make($value['view_path'], ['view_data' => $value['view_data']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <div class="clearfix"></div>

            <div class="col-sm-8">
                <div class="form-group">
                    <label for="product_description"><?php echo e(__('lang_v1.product_description'), false); ?>:</label>
                    <textarea name="product_description" id="product_description"
                        class="form-control"><?php echo e(!empty($duplicate_product->product_description) ? $duplicate_product->product_description : null, false); ?></textarea>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="upload_image"><?php echo e(__('lang_v1.product_image'), false); ?>:</label>
                    <input type="file" name="image" id="upload_image" accept="image/*">
                    <small>
                        <p class="help-block">
                            <?php echo app('translator')->get('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                            1000000)]); ?>
                            <br>
                            <?php echo app('translator')->get('lang_v1.aspect_ratio_should_be_1_1'); ?>
                        </p>
                    </small>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group">
                <label for="product_brochure"><?php echo e(__('lang_v1.product_brochure'), false); ?>:</label>
                <input type="file" name="product_brochure" id="product_brochure"
                    accept="<?php echo e(implode(',', array_keys(config('constants.document_upload_mimes_types'))), false); ?>" />
                <small>
                    <p class="help-block">
                        <?php echo e(__('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]), false); ?>

                        <?php if ($__env->exists('components.document_help_text')) echo $__env->make('components.document_help_text', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </p>
                </small>
            </div>
        </div>

        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <?php if(session('business.enable_product_expiry')): ?>

            <?php if(session('business.expiry_type') == 'add_expiry'): ?>
            <?php
            $expiry_period = 12;
            $hide = true;
            ?>
            <?php else: ?>
            <?php
            $expiry_period = null;
            $hide = false;
            ?>
            <?php endif; ?>
            <div class="col-sm-4 <?php if($hide): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <div class="multi-input">
                        <label for="expiry_period"><?php echo e(__('product.expires_in'), false); ?>:</label><br>
                        <input type="text" name="expiry_period" id="expiry_period"
                            value="<?php echo e(!empty($duplicate_product->expiry_period) ? number_format($duplicate_product->expiry_period) : $expiry_period, false); ?>"
                            class="form-control pull-left input_number" placeholder="<?php echo e(__('product.expiry_period'), false); ?>"
                            style="width: 60%;" />
                        <select name="expiry_period_type" id="expiry_period_type" class="form-control select2 pull-left"
                            style="width: 40%;">
                            <option value="months"
                                <?php echo e(!empty($duplicate_product->expiry_period_type) && $duplicate_product->expiry_period_type == 'months' ? 'selected' : '', false); ?>>
                                <?php echo e(__('product.months'), false); ?></option>
                            <option value="days"
                                <?php echo e(!empty($duplicate_product->expiry_period_type) && $duplicate_product->expiry_period_type == 'days' ? 'selected' : '', false); ?>>
                                <?php echo e(__('product.days'), false); ?></option>
                            <option value=""
                                <?php echo e(!empty($duplicate_product->expiry_period_type) && $duplicate_product->expiry_period_type == '' ? 'selected' : '', false); ?>>
                                <?php echo e(__('product.not_applicable'), false); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-sm-4">
                <div class="form-group">
                    <br>
                    <label>
                        <input type="checkbox" name="enable_sr_no" value="1"
                            <?php echo e(!empty($duplicate_product) && $duplicate_product->enable_sr_no ? 'checked' : '', false); ?>

                            class="input-icheck" />
                        <strong><?php echo e(__('lang_v1.enable_imei_or_sr_no'), false); ?></strong>
                    </label>
                    <span data-toggle="tooltip" title="<?php echo e(__('lang_v1.tooltip_sr_no'), false); ?>"></span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <br>
                    <label>
                        <input type="checkbox" name="not_for_selling" value="1"
                            <?php echo e(!empty($duplicate_product) && $duplicate_product->not_for_selling ? 'checked' : '', false); ?>

                            class="input-icheck" />
                        <strong><?php echo e(__('lang_v1.not_for_selling'), false); ?></strong>
                    </label>
                    <span data-toggle="tooltip" title="<?php echo e(__('lang_v1.tooltip_not_for_selling'), false); ?>"></span>
                </div>
            </div>

            <div class="clearfix"></div>

            <!-- Rack, Row & position number -->
            <?php if(session('business.enable_racks') || session('business.enable_row') ||
            session('business.enable_position')): ?>
            <div class="col-md-12">
                <h4><?php echo app('translator')->get('lang_v1.rack_details'); ?>:
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.tooltip_rack_details') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
                </h4>
            </div>
            <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="rack_<?php echo e($id, false); ?>"><?php echo e($location, false); ?>:</label>

                    <?php if(session('business.enable_racks')): ?>
                    <input type="text" name="product_racks[<?php echo e($id, false); ?>][rack]" id="rack_<?php echo e($id, false); ?>"
                        value="<?php echo e(!empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : '', false); ?>"
                        class="form-control" placeholder="<?php echo e(__('lang_v1.rack'), false); ?>">
                    <?php endif; ?>

                    <?php if(session('business.enable_row')): ?>
                    <input type="text" name="product_racks[<?php echo e($id, false); ?>][row]"
                        value="<?php echo e(!empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : '', false); ?>"
                        class="form-control" placeholder="<?php echo e(__('lang_v1.row'), false); ?>">
                    <?php endif; ?>

                    <?php if(session('business.enable_position')): ?>
                    <input type="text" name="product_racks[<?php echo e($id, false); ?>][position]"
                        value="<?php echo e(!empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : '', false); ?>"
                        class="form-control" placeholder="<?php echo e(__('lang_v1.position'), false); ?>">
                    <?php endif; ?>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="weight"><?php echo e(__('lang_v1.weight'), false); ?>:</label>
                    <input type="text" name="weight" id="weight"
                        value="<?php echo e(!empty($duplicate_product->weight) ? $duplicate_product->weight : '', false); ?>"
                        class="form-control" placeholder="<?php echo e(__('lang_v1.weight'), false); ?>">
                </div>

            </div>
            <?php
            $custom_labels = json_decode(session('business.custom_labels'), true);
            $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ?
            $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
            $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ?
            $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
            $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ?
            $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
            $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ?
            $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
            ?>
            <!--custom fields-->
            <div class="clearfix"></div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field1"><?php echo e($product_custom_field1, false); ?>:</label>
                    <input type="text" name="product_custom_field1" id="product_custom_field1"
                        value="<?php echo e(!empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 : '', false); ?>"
                        class="form-control" placeholder="<?php echo e($product_custom_field1, false); ?>">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field2"><?php echo e($product_custom_field2, false); ?>:</label>
                    <input type="text" name="product_custom_field2" id="product_custom_field2"
                        value="<?php echo e(!empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 : '', false); ?>"
                        class="form-control" placeholder="<?php echo e($product_custom_field2, false); ?>">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field3"><?php echo e($product_custom_field3, false); ?>:</label>
                    <input type="text" name="product_custom_field3" id="product_custom_field3"
                        value="<?php echo e(!empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 : '', false); ?>"
                        class="form-control" placeholder="<?php echo e($product_custom_field3, false); ?>">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field4"><?php echo e($product_custom_field4, false); ?>:</label>
                    <input type="text" name="product_custom_field4" id="product_custom_field4"
                        value="<?php echo e(!empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 : '', false); ?>"
                        class="form-control" placeholder="<?php echo e($product_custom_field4, false); ?>">
                </div>
            </div>

            <!--custom fields-->
            <div class="clearfix"></div>
            <?php echo $__env->make('layouts.partials.module_form_part', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">

            <div class="col-sm-4 <?php if(!session('business.enable_price_tax')): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <label for="tax"><?php echo e(__('product.applicable_tax'), false); ?>:</label>
                    <select name="tax" id="tax" class="form-control select2">
                        <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"
                            <?php echo e(!empty($duplicate_product->tax) && $duplicate_product->tax == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4 <?php if(!session('business.enable_price_tax')): ?> hide <?php endif; ?>">
                <div class="form-group">
                    <label for="tax_type"><?php echo e(__('product.selling_price_tax_type'), false); ?>:*</label>
                    <select name="tax_type" id="tax_type" class="form-control select2" required>
                        <option value="inclusive"
                            <?php echo e(!empty($duplicate_product->tax_type) && $duplicate_product->tax_type == 'inclusive' ? 'selected' : '', false); ?>>
                            <?php echo e(__('product.inclusive'), false); ?></option>
                        <option value="exclusive"
                            <?php echo e(!empty($duplicate_product->tax_type) && $duplicate_product->tax_type == 'exclusive' ? 'selected' : '', false); ?>>
                            <?php echo e(__('product.exclusive'), false); ?></option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="type"><?php echo e(__('product.product_type'), false); ?>:*</label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('tooltip.product_type') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>

                    <select name="type" id="type" class="form-control select2" required
                        data-action="<?php echo e(!empty($duplicate_product) ? 'duplicate' : 'add', false); ?>"
                        data-product_id="<?php echo e(!empty($duplicate_product) ? $duplicate_product->id : '0', false); ?>">
                        <?php $__currentLoopData = $product_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"
                            <?php echo e(!empty($duplicate_product->type) && $duplicate_product->type == $key ? 'selected' : '', false); ?>>
                            <?php echo e($value, false); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                </div>
            </div>

            <div class="form-group col-sm-12" id="product_form_part">
                <?php echo $__env->make('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <input type="hidden" id="variation_counter" value="1">
            <input type="hidden" id="default_profit_percent" value="<?php echo e($default_profit_percent, false); ?>">

        </div>

        <?php echo $__env->renderComponent(); ?>
        <div class="row">
            <div class="col-sm-12">
                <input type="hidden" name="submit_type" id="submit_type">
                <div class="text-center">
                    <div class="btn-group">
                        <?php if($selling_price_group_count): ?>
                        <button type="submit" value="submit_n_add_selling_prices"
                            class="btn btn-warning submit_product_form"><?php echo app('translator')->get('lang_v1.save_n_add_selling_price_group_prices'); ?></button>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.opening_stock')): ?>
                        <button id="opening_stock_button" <?php if(!empty($duplicate_product) &&
                            $duplicate_product->enable_stock == 0): ?> disabled <?php endif; ?> type="submit"
                            value="submit_n_add_opening_stock" class="btn bg-purple
                            submit_product_form"><?php echo app('translator')->get('lang_v1.save_n_add_opening_stock'); ?></button>
                        <?php endif; ?>

                        <button type="submit" value="save_n_add_another"
                            class="btn bg-maroon submit_product_form"><?php echo app('translator')->get('lang_v1.save_n_add_another'); ?></button>

                        <button type="submit" value="submit"
                            class="btn btn-primary submit_product_form"><?php echo app('translator')->get('messages.save'); ?></button>
                    </div>

                </div>
            </div>
    </form>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php $asset_v = env('APP_VERSION'); ?>
<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>

<script type="text/javascript">
$(document).ready(function() {
    __page_leave_confirmation('#product_add_form');
    onScan.attachTo(document, {
        suffixKeyCodes: [13], // enter-key expected at the end of a scan
        reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
        onScan: function(sCode, iQty) {
            $('input#sku').val(sCode);
        },
        onScanError: function(oDebug) {
            console.log(oDebug);
        },
        minLength: 2,
        ignoreIfFocusOn: ['input', '.form-control']
        // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
        //     console.log('Pressed: ' + iKeyCode);
        // }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\resources\views/product/create.blade.php ENDPATH**/ ?>