<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para actualizar un grupo de impuestos -->
    <form action="{{ action('GroupTaxController@update', [$tax_rate->id]) }}" method="post" id="tax_group_edit_form">
      @csrf
      @method('PUT')

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('tax_rate.edit_tax_group') }}</h4>
      </div>

      <div class="modal-body">
        <!-- Campo para el nombre del grupo de impuestos -->
        <div class="form-group">
          <label for="name">{{ __('tax_rate.name') }}:*</label>
          <input type="text" name="name" id="name" class="form-control" required
                 placeholder="{{ __('tax_rate.name') }}" value="{{ old('name', $tax_rate->name) }}">
        </div>

        <!-- Selección de impuestos que conforman el grupo -->
        <div class="form-group">
          <label for="taxes">{{ __('tax_rate.sub_taxes') }}:*</label>
          <select name="taxes[]" id="taxes" class="form-control select2" required multiple>
            @foreach($taxes as $key => $value)
              <option value="{{ $key }}" {{ in_array($key, old('taxes', $sub_taxes ?? [])) ? 'selected' : '' }}>
                {{ $value }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
