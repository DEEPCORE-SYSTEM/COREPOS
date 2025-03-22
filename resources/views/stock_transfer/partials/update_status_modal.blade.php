<div class="modal fade" id="update_stock_transfer_status_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Formulario para actualizar el estado de la transferencia de stock -->
            <form action="#" method="post" id="update_stock_transfer_status_form">
                @csrf

                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        {{ __('lang_v1.update_status') }} 
                        <span data-toggle="tooltip" title="{{ __('lang_v1.completed_status_help') }}">&#x1F6C8;</span>
                    </h4>
                </div>

                <div class="modal-body">
                    <!-- Campo para seleccionar el estado de la transferencia -->
                    <div class="form-group">
                        <label for="update_status">{{ __('sale.status') }}:*</label>
                        <select name="status" id="update_status" class="form-control select2" required style="width: 100%;">
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
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
</div>
