<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para agregar una nueva unidad -->
    <form action="{{ action('UnitController@store') }}" method="post" id="{{ $quick_add ? 'quick_add_unit_form' : 'unit_add_form' }}">
      @csrf

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'unit.add_unit' )</h4>
    </div>

      <div class="modal-body">
        <div class="row">

          <!-- Campo para el nombre de la unidad -->
          <div class="form-group col-sm-12">
            <label for="actual_name">{{ __('unit.name') }}:*</label>
            <input type="text" name="actual_name" id="actual_name" class="form-control" required
                   placeholder="{{ __('unit.name') }}">
          </div>

          <!-- Campo para el nombre corto de la unidad -->
          <div class="form-group col-sm-12">
            <label for="short_name">{{ __('unit.short_name') }}:*</label>
            <input type="text" name="short_name" id="short_name" class="form-control" required
                   placeholder="{{ __('unit.short_name') }}">
          </div>

          <!-- Selección de permitir decimales -->
          <div class="form-group col-sm-12">
            <label for="allow_decimal">{{ __('unit.allow_decimal') }}:*</label>
            <select name="allow_decimal" id="allow_decimal" class="form-control" required>
              <option value="">{{ __('messages.please_select') }}</option>
              <option value="1">{{ __('messages.yes') }}</option>
              <option value="0">{{ __('messages.no') }}</option>
            </select>
          </div>

          <!-- Opciones adicionales si no es quick add -->
          @if(!$quick_add)
            <!-- Checkbox para definir como unidad base múltiple -->
            <div class="form-group col-sm-12">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="define_base_unit" value="1" class="toggler" data-toggle_id="base_unit_div">
                  {{ __('lang_v1.add_as_multiple_of_base_unit') }}
                </label>
                <span data-toggle="tooltip" title="{{ __('lang_v1.multi_unit_help') }}">&#x1F6C8;</span>
              </div>
            </div>

            <!-- Campos adicionales para unidades base -->
            <div class="form-group col-sm-12 hide" id="base_unit_div">
              <table class="table">
                <tr>
                  <th style="vertical-align: middle;">1 <span id="unit_name">{{ __('product.unit') }}</span></th>
                  <th style="vertical-align: middle;">=</th>
                  <td style="vertical-align: middle;">
                    <input type="text" name="base_unit_multiplier" class="form-control input_number"
                           placeholder="{{ __('lang_v1.times_base_unit') }}">
                  </td>
                  <td style="vertical-align: middle;">
                    <select name="base_unit_id" class="form-control">
                      <option value="">{{ __('lang_v1.select_base_unit') }}</option>
                      @foreach($units as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
              </table>
            </div>
          @endif

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
