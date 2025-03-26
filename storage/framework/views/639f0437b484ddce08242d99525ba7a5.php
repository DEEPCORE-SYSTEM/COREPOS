<!-- Modal de diálogo para agregar un grupo de precios de venta -->
<div class="modal-dialog" role="document">
  <div class="modal-content">
    
    <!-- Formulario para agregar grupo de precios de venta -->
    <form action="<?php echo e(route('selling-price-group.store'), false); ?>" method="POST" id="selling_price_group_form">
      <?php echo csrf_field(); ?> <!-- Token de seguridad de Laravel -->

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.add_selling_price_group'); ?></h4>
      </div>

      <div class="modal-body">
        <!-- Campo para el nombre del grupo de precios -->
        <div class="form-group">
          <label for="name"><?php echo app('translator')->get('lang_v1.name'); ?>:* </label>
          <input type="text" name="name" class="form-control" required placeholder="<?php echo app('translator')->get('lang_v1.name'); ?>">
        </div>

        <!-- Campo para la descripción del grupo de precios -->
        <div class="form-group">
          <label for="description"><?php echo app('translator')->get('lang_v1.description'); ?>:</label>
          <textarea name="description" class="form-control" placeholder="<?php echo app('translator')->get('lang_v1.description'); ?>" rows="3"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <!-- Botón para guardar -->
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
        <!-- Botón para cerrar el modal -->
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
      </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/selling_price_group/create.blade.php ENDPATH**/ ?>