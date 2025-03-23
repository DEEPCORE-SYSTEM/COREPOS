<div class="modal fade" id="clock_in_clock_out_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <form action="<?php echo e(action('\Modules\Essentials\Http\Controllers\AttendanceController@clockInClockOut'), false); ?>"
                method="POST" id="clock_in_clock_out_form">
                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <span id="clock_in_text"><?php echo app('translator')->get('essentials::lang.clock_in'); ?></span>
                        <span id="clock_out_text"><?php echo app('translator')->get('essentials::lang.clock_out'); ?></span>
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="type" id="type">

                        <div class="form-group col-md-12">
                            <strong><?php echo app('translator')->get('essentials::lang.ip_address'); ?>: <?php echo e($ip_address, false); ?></strong>
                        </div>

                        <!-- Nota al fichar la entrada -->
                        <div class="form-group col-md-12 clock_in_note <?php if(!empty($clock_in)): ?> hide <?php endif; ?>">
                            <label for="clock_in_note"><?php echo app('translator')->get('essentials::lang.clock_in_note'); ?>:</label>
                            <textarea id="clock_in_note" name="clock_in_note" class="form-control"
                                placeholder="<?php echo app('translator')->get('essentials::lang.clock_in_note'); ?>" rows="3"></textarea>
                        </div>

                        <!-- Nota al fichar la salida -->
                        <div class="form-group col-md-12 clock_out_note <?php if(empty($clock_in)): ?> hide <?php endif; ?>">
                            <label for="clock_out_note"><?php echo app('translator')->get('essentials::lang.clock_out_note'); ?>:</label>
                            <textarea id="clock_out_note" name="clock_out_note" class="form-control"
                                placeholder="<?php echo app('translator')->get('essentials::lang.clock_out_note'); ?>" rows="3"></textarea>
                        </div>


                        <input type="hidden" name="clock_in_out_location" id="clock_in_out_location" value="">
                    </div>

                    <?php if($is_location_required): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <b><?php echo app('translator')->get('messages.location'); ?>:</b> <span class="clock_in_out_location"></span>
                        </div>
                        <div class="col-md-12 ask_location" style="display: none;">
                            <span class="location_required error"></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.submit'); ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                </div>
            </form>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><?php /**PATH C:\xampp\htdocs\corepos\Modules\Essentials\Providers/../Resources/views/attendance/clock_in_clock_out_modal.blade.php ENDPATH**/ ?>