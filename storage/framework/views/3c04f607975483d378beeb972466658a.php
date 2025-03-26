<div class="modal-dialog" role="document">
    <div class="modal-content">

        <form action="<?php echo e(action('VariationTemplateController@store'), false); ?>" 
              method="POST" id="variation_add_form" class="form-horizontal">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.add_variation'); ?></h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"><?php echo app('translator')->get('lang_v1.variation_name'); ?>:*</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control" 
                               required placeholder="<?php echo app('translator')->get('lang_v1.variation_name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo app('translator')->get('lang_v1.add_variation_values'); ?>:*</label>
                    <div class="col-sm-7">
                        <input type="text" name="variation_values[]" class="form-control" required>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" id="add_variation_values">+</button>
                    </div>
                </div>

                <div id="variation_values"></div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>

        </form>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/variation/create.blade.php ENDPATH**/ ?>