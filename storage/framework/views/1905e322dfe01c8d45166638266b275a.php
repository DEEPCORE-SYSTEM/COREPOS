<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para agregar una nueva unidad -->
    <form action="<?php echo e(action('UnitController@store'), false); ?>" method="post" id="<?php echo e($quick_add ? 'quick_add_unit_form' : 'unit_add_form', false); ?>">
      <?php echo csrf_field(); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'unit.add_unit' ); ?></h4>
    </div>

      <div class="modal-body">
        <div class="row">

          <!-- Campo para el nombre de la unidad -->
          <div class="form-group col-sm-12">
            <label for="actual_name"><?php echo e(__('unit.name'), false); ?>:*</label>
            <input type="text" name="actual_name" id="actual_name" class="form-control" required
                   placeholder="<?php echo e(__('unit.name'), false); ?>">
          </div>

          <!-- Campo para el nombre corto de la unidad -->
          <div class="form-group col-sm-12">
            <label for="short_name"><?php echo e(__('unit.short_name'), false); ?>:*</label>
            <input type="text" name="short_name" id="short_name" class="form-control" required
                   placeholder="<?php echo e(__('unit.short_name'), false); ?>">
          </div>

          <!-- Selección de permitir decimales -->
          <div class="form-group col-sm-12">
            <label for="allow_decimal"><?php echo e(__('unit.allow_decimal'), false); ?>:*</label>
            <select name="allow_decimal" id="allow_decimal" class="form-control" required>
              <option value=""><?php echo e(__('messages.please_select'), false); ?></option>
              <option value="1"><?php echo e(__('messages.yes'), false); ?></option>
              <option value="0"><?php echo e(__('messages.no'), false); ?></option>
            </select>
          </div>

          <!-- Opciones adicionales si no es quick add -->
          <?php if(!$quick_add): ?>
            <!-- Checkbox para definir como unidad base múltiple -->
            <div class="form-group col-sm-12">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="define_base_unit" value="1" class="toggler" data-toggle_id="base_unit_div">
                  <?php echo e(__('lang_v1.add_as_multiple_of_base_unit'), false); ?>

                </label>
                <span data-toggle="tooltip" title="<?php echo e(__('lang_v1.multi_unit_help'), false); ?>">&#x1F6C8;</span>
              </div>
            </div>

            <!-- Campos adicionales para unidades base -->
            <div class="form-group col-sm-12 hide" id="base_unit_div">
              <table class="table">
                <tr>
                  <th style="vertical-align: middle;">1 <span id="unit_name"><?php echo e(__('product.unit'), false); ?></span></th>
                  <th style="vertical-align: middle;">=</th>
                  <td style="vertical-align: middle;">
                    <input type="text" name="base_unit_multiplier" class="form-control input_number"
                           placeholder="<?php echo e(__('lang_v1.times_base_unit'), false); ?>">
                  </td>
                  <td style="vertical-align: middle;">
                    <select name="base_unit_id" class="form-control">
                      <option value=""><?php echo e(__('lang_v1.select_base_unit'), false); ?></option>
                      <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </td>
                </tr>
              </table>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- Botones de acción -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.save'), false); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('messages.close'), false); ?></button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/unit/create.blade.php ENDPATH**/ ?>