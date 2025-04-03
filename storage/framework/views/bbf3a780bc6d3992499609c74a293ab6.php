
<?php $__env->startSection('title', __('lang_v1.selling_price_group')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->get('lang_v1.selling_price_group'); ?>
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol> -->
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
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary','title' => __('lang_v1.import_export_selling_price_group_prices'),]); ?>
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo e(action('SellingPriceGroupController@export'), false); ?>" class="btn btn-primary"><?php echo app('translator')->get('lang_v1.export_selling_price_group_prices'); ?></a>
                </div>
                <div class="col-sm-6">
                    <!-- Formulario para importar precios del grupo de venta -->
                    <form action="<?php echo e(action('SellingPriceGroupController@import'), false); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="file" name="archivo">
                        <!-- Token de seguridad de Laravel -->

                        <div class="form-group">
                            <!-- Etiqueta para seleccionar archivo a importar -->
                            <label for="product_group_prices"><?php echo e(__('product.file_to_import'), false); ?>:</label>
                            <input type="file" name="product_group_prices" id="product_group_prices" required>
                        </div>

                        <div class="form-group">
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.submit'); ?></button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-12">
                    <h4><?php echo app('translator')->get('lang_v1.instructions'); ?>:</h4>
                    <p>
                        &bull; <?php echo app('translator')->get('lang_v1.price_group_import_istruction'); ?>
                    </p>
                    <p>
                        &bull; <?php echo app('translator')->get('lang_v1.price_group_import_istruction1'); ?>
                    </p>
                    <p>
                        &bull; <?php echo app('translator')->get('lang_v1.price_group_import_istruction2'); ?>
                    </p>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.all_selling_price_group')]); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal"
                        data-href="<?php echo e(action('SellingPriceGroupController@create'), false); ?>" data-container=".view_modal">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="selling_price_group_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lang_v1.name'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.description'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="modal fade brands_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            //selling_price_group_table
            var selling_price_group_table = $('#selling_price_group_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/selling-price-group',
                columnDefs: [{
                    "targets": 2,
                    "orderable": false,
                    "searchable": false
                }]
            });

            $(document).on('submit', 'form#selling_price_group_form', function(e) {
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.view_modal').modal('hide');
                            toastr.success(result.msg);
                            selling_price_group_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            $(document).on('click', 'button.delete_spg_button', function() {
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    selling_price_group_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'button.activate_deactivate_spg', function() {
                var href = $(this).data('href');
                $.ajax({
                    url: href,
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            selling_price_group_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\corepos\resources\views/selling_price_group/index.blade.php ENDPATH**/ ?>