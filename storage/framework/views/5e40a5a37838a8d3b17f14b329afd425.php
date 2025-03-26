<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?php echo e(route('warranty.update', $warranty->id), false); ?>" method="POST" id="warranty_form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.edit_warranty'); ?></h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->get('lang_v1.name'); ?>*</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo e($warranty->name, false); ?>" required placeholder="<?php echo app('translator')->get('lang_v1.name'); ?>">
                </div>

                <div class="form-group">
                    <label for="description"><?php echo app('translator')->get('lang_v1.description'); ?></label>
                    <textarea name="description" id="description" class="form-control" placeholder="<?php echo app('translator')->get('lang_v1.description'); ?>" rows="3"><?php echo e($warranty->description, false); ?></textarea>
                </div>

                <div class="form-group">
                    <strong><label for="duration"><?php echo app('translator')->get('lang_v1.duration'); ?>*</label></strong>
                    <div class="d-flex gap-2">
                        <input type="number" name="duration" id="duration" class="form-control w-50" value="<?php echo e($warranty->duration, false); ?>" required placeholder="<?php echo app('translator')->get('lang_v1.duration'); ?>">

                        <select name="duration_type" class="form-control w-50" required>
                            <option value="" disabled selected><?php echo app('translator')->get('messages.please_select'); ?></option>
                            <option value="days" <?php echo e($warranty->duration_type == 'days' ? 'selected' : '', false); ?>><?php echo app('translator')->get('lang_v1.days'); ?></option>
                            <option value="months" <?php echo e($warranty->duration_type == 'months' ? 'selected' : '', false); ?>><?php echo app('translator')->get('lang_v1.months'); ?></option>
                            <option value="years" <?php echo e($warranty->duration_type == 'years' ? 'selected' : '', false); ?>><?php echo app('translator')->get('lang_v1.years'); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/warranties/edit.blade.php ENDPATH**/ ?>