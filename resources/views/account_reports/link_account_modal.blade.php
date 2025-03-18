<!-- Modal para vincular cuenta con pago -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        
        <!-- Formulario para vincular la cuenta -->
        <form action="{{ action('AccountReportsController@postLinkAccount') }}" method="POST" id="link_account_form">
            @csrf <!-- Token de seguridad de Laravel -->

            <div class="modal-header">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    {{ __('account.link_account') }} - {{ __('account.payment_ref_no') }}: {{ $payment->payment_ref_no }}
                </h4>
            </div>

            <div class="modal-body">
                <!-- Campo oculto con el ID del pago -->
                <input type="hidden" name="transaction_payment_id" value="{{ $payment->id }}">

                <!-- Selección de cuenta -->
                <div class="form-group">
                    <label for="account_id">{{ __('account.account') }}:</label>
                    <select name="account_id" id="account_id" class="form-control" required>
                        @foreach($accounts as $id => $account)
                            <option value="{{ $id }}" {{ $payment->account_id == $id ? 'selected' : '' }}>
                                {{ $account }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <!-- Botón para guardar -->
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                <!-- Botón para cerrar -->
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>

        </form> <!-- Fin del formulario -->

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
