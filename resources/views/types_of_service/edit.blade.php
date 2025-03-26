<div class="modal-dialog" role="document">
  <div class="modal-content">

    <!-- Formulario para actualizar el tipo de servicio -->
    <form action="{{ action('TypesOfServiceController@update', $type_of_service->id) }}" method="post" id="types_of_service_form">
      @csrf
      @method('PUT')

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('lang_v1.edit_type_of_service') }}</h4>
      </div>

      <div class="modal-body">
        <div class="row">

          <!-- Campo para el nombre del servicio -->
          <div class="form-group col-md-12">
            <label for="name">{{ __('tax_rate.name') }}:*</label>
            <input type="text" name="name" id="name" class="form-control" required
                   placeholder="{{ __('tax_rate.name') }}" 
                   value="{{ old('name', $type_of_service->name) }}">
          </div>

          <!-- Campo para la descripción del servicio -->
          <div class="form-group col-md-12">
            <label for="description">{{ __('lang_v1.description') }}:</label>
            <textarea name="description" id="description" class="form-control" rows="3"
                      placeholder="{{ __('lang_v1.description') }}">{{ old('description', $type_of_service->description) }}</textarea>
          </div>

          <!-- Tabla de asignación de grupos de precios por ubicación -->
          <div class="form-group col-md-12">
            <table class="table table-slim">
              <thead>
                <tr>
                  <th>{{ __('sale.location') }}</th>
                  <th>{{ __('lang_v1.price_group') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($locations as $key => $value)
                  <tr>
                    <td>{{ $value }}</td>
                    <td>
                      <select name="location_price_group[{{ $key }}]" class="form-control input-sm select2" style="width: 100%;">
                        <option value="">{{ __('lang_v1.select_price_group') }}</option>
                        @foreach($price_groups as $group_id => $group_name)
                          <option value="{{ $group_id }}" 
                                  {{ old("location_price_group.$key", $type_of_service->location_price_group[$key] ?? '') == $group_id ? 'selected' : '' }}>
                            {{ $group_name }}
                          </option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Tipo de cargo por empaque -->
          <div class="form-group col-md-6">
            <label for="packing_charge_type">{{ __('lang_v1.packing_charge_type') }}:</label>
            <select name="packing_charge_type" id="packing_charge_type" class="form-control">
              <option value="fixed" {{ old('packing_charge_type', $type_of_service->packing_charge_type) == 'fixed' ? 'selected' : '' }}>
                {{ __('lang_v1.fixed') }}
              </option>
              <option value="percent" {{ old('packing_charge_type', $type_of_service->packing_charge_type) == 'percent' ? 'selected' : '' }}>
                {{ __('lang_v1.percentage') }}
              </option>
            </select>
          </div>

          <!-- Monto del cargo por empaque -->
          <div class="form-group col-md-6">
            <label for="packing_charge">{{ __('lang_v1.packing_charge') }}:</label>
            <input type="text" name="packing_charge" id="packing_charge" 
                   class="form-control input_number" 
                   placeholder="{{ __('lang_v1.packing_charge') }}" 
                   value="{{ old('packing_charge', @num_format($type_of_service->packing_charge) ?? '') }}">
          </div>

          <!-- Checkbox para habilitar campos personalizados -->
          <div class="form-group col-md-12">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="enable_custom_fields" value="1"
                       {{ old('enable_custom_fields', $type_of_service->enable_custom_fields) ? 'checked' : '' }}>
                {{ __('lang_v1.enable_custom_fields') }}
              </label>
              <span data-toggle="tooltip" title="{{ __('lang_v1.types_of_service_custom_field_help') }}">&#x1F6C8;</span>
            </div>
          </div>

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
