<div class="modal-dialog" role="document">
    <div class="modal-content">

        <form action="<?php echo e(action('WarrantyController@store'), false); ?>" method="POST" id="warranty_form">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.add_warranty'); ?></h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->get('lang_v1.name'); ?>:</label>
                    <input type="text" name="name" id="name" class="form-control" 
                           required placeholder="<?php echo app('translator')->get('lang_v1.name'); ?>">
                </div>

                <div class="form-group">
                    <label for="description"><?php echo app('translator')->get('lang_v1.description'); ?>:</label>
                    <textarea name="description" id="description" class="form-control" 
                              placeholder="<?php echo app('translator')->get('lang_v1.description'); ?>" rows="3"></textarea>
                </div>

                <strong><label for="duration"><?php echo app('translator')->get('lang_v1.duration'); ?>:</label>*</strong>
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" name="duration" id="duration" class="form-control" 
                               placeholder="<?php echo app('translator')->get('lang_v1.duration'); ?>" required>
                        <select name="duration_type" class="form-control" required>
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                            <option value="days"><?php echo app('translator')->get('lang_v1.days'); ?></option>
                            <option value="months"><?php echo app('translator')->get('lang_v1.months'); ?></option>
                            <option value="years"><?php echo app('translator')->get('lang_v1.years'); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>

        </form>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/warranties/create.blade.php ENDPATH**/ ?>