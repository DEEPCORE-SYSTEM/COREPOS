<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para agregar una nueva tasa de impuesto -->
    <form action="{{ action('TaxRateController@store') }}" method="post" id="tax_rate_add_form">
      @csrf

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('tax_rate.add_tax_rate') }}</h4>
      </div>

      <div class="modal-body">
        <!-- Campo para el nombre de la tasa de impuesto -->
        <div class="form-group">
          <label for="name">{{ __('tax_rate.name') }}:*</label>
          <input type="text" name="name" id="name" class="form-control" required
                 placeholder="{{ __('tax_rate.name') }}" value="{{ old('name') }}">
        </div>

        <!-- Campo para la tasa de impuesto -->
        <div class="form-group">
          <label for="amount">{{ __('tax_rate.rate') }}:*</label>
          <span data-toggle="tooltip" title="{{ __('lang_v1.tax_exempt_help') }}">&#x1F6C8;</span>
          <input type="text" name="amount" id="amount" class="form-control input_number" required
                 value="{{ old('amount') }}">
        </div>

        <!-- Checkbox para indicar si es solo para grupos de impuestos -->
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="for_tax_group" value="1" class="input_icheck" {{ old('for_tax_group') ? 'checked' : '' }}>
              {{ __('lang_v1.for_tax_group_only') }}
            </label>
            <span data-toggle="tooltip" title="{{ __('lang_v1.for_tax_group_only_help') }}">&#x1F6C8;</span>
          </div>
        </div>

      </div>

      <!-- Botones de acción -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
