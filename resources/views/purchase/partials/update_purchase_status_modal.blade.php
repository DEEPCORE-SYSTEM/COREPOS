<div class="modal fade" id="update_purchase_status_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulario para actualizar el estado de la compra -->
            <form action="{{ url('purchases/update-status') }}" method="POST" id="update_purchase_status_form">
                @csrf

                <div class="modal-header">
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- Título del modal -->
                    <h4 class="modal-title">@lang('lang_v1.update_status')</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <!-- Selección del estado de la compra -->
                        <label for="status">@lang('purchase.purchase_status'):</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">{{ __('messages.please_select') }}</option>
                            @foreach($orderStatuses as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>

                        <!-- Campo oculto para el ID de la compra -->
                        <input type="hidden" name="purchase_id" id="purchase_id">
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- Botón para actualizar el estado -->
                    <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
