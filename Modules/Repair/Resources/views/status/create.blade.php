<!-- Modal para agregar un nuevo estado de reparación -->
<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Formulario para agregar estado de reparación -->
        <form action="{{ action('\Modules\Repair\Http\Controllers\RepairStatusController@store') }}" 
              method="post" id="status_form">
            @csrf

            <!-- Encabezado del modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ __('repair::lang.add_status') }}</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- Nombre del estado -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('repair::lang.status_name') }}:*</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   required placeholder="{{ __('repair::lang.status_name') }}">
                        </div>
                    </div>

                    <!-- Color del estado -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color">{{ __('repair::lang.color') }}:</label>
                            <input type="text" name="color" id="color" class="form-control" 
                                   placeholder="{{ __('repair::lang.color') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Orden de clasificación -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sort_order">{{ __('repair::lang.sort_order') }}:</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" 
                                   placeholder="{{ __('repair::lang.sort_order') }}">
                        </div>
                    </div>

                    <!-- Marcar como estado completado -->
                    <div class="col-md-6 mt-15">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_completed_status" value="1" id="is_completed_status">
                                    {{ __('repair::lang.mark_this_status_as_complete') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Plantilla de SMS -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sms_template">{{ __('repair::lang.sms_template') }}:</label>
                            <textarea name="sms_template" id="sms_template" class="form-control" 
                                      placeholder="{{ __('repair::lang.sms_template') }}" rows="4"></textarea>
                        </div>
                    </div>

                    <!-- Asunto del correo -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email_subject">{{ __('lang_v1.email_subject') }}:</label>
                            <input type="text" name="email_subject" id="email_subject" class="form-control" 
                                   placeholder="{{ __('lang_v1.email_subject') }}">
                        </div>
                    </div>

                    <!-- Cuerpo del correo -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email_body">{{ __('lang_v1.email_body') }}:</label>
                            <textarea name="email_body" id="email_body" class="form-control" 
                                      placeholder="{{ __('lang_v1.email_body') }}" rows="5"></textarea>
                            <p class="help-block">
                                <label>{{ $status_template_tags['help_text'] }}:</label><br>
                                {{ implode(', ', $status_template_tags['tags']) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>

        </form> <!-- Fin del formulario -->

    </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
