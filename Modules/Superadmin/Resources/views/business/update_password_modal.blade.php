<!-- Modal para actualizar contraseña -->
<div class="modal fade" id="update_password_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Formulario para actualizar la contraseña -->
            <form action="{{ action('\Modules\Superadmin\Http\Controllers\BusinessController@updatePassword') }}" method="POST" id="password_update_form">
                @csrf

                <!-- Encabezado del modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <span id="user_name"></span> - {{ __('superadmin::lang.update_password') }}
                    </h4>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Campo para la nueva contraseña -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">{{ __('business.password') }}:</label>
                                <input type="password" name="password" class="form-control" placeholder="{{ __('business.password') }}" required>
                                <input type="hidden" name="user_id" id="user_id">
                            </div>
                        </div>

                        <!-- Campo para confirmar la nueva contraseña -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password">{{ __('business.confirm_password') }}:</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="{{ __('business.confirm_password') }}" required data-rule-equalTo="#password">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie del modal con los botones -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </form>

        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
