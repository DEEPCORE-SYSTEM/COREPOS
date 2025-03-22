<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Formulario para editar ubicación del negocio -->
        <form action="{{ action('BusinessLocationController@update', [$location->id]) }}" method="POST" id="business_location_add_form">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('business.edit_business_location')</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Campo para el nombre -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">@lang('invoice.name') *</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $location->name }}" required placeholder="@lang('invoice.name')">
                        </div>
                    </div>

                    <!-- Campo para punto de referencia -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="landmark">@lang('business.landmark')</label>
                            <input type="text" name="landmark" id="landmark" class="form-control" value="{{ $location->landmark }}" placeholder="@lang('business.landmark')">
                        </div>
                    </div>

                    <!-- Campo para la ciudad -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="city">@lang('business.city') *</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ $location->city }}" required placeholder="@lang('business.city')">
                        </div>
                    </div>

                    <!-- Campo para el código postal -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="zip_code">@lang('business.zip_code') *</label>
                            <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ $location->zip_code }}" required placeholder="@lang('business.zip_code')">
                        </div>
                    </div>

                    <!-- Campo para el estado -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="state">@lang('business.state') *</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ $location->state }}" required placeholder="@lang('business.state')">
                        </div>
                    </div>

                    <!-- Campo para el país -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="country">@lang('business.country') *</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{ $location->country }}" required placeholder="@lang('business.country')">
                        </div>
                    </div>

                    <!-- Selección de esquema de factura -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_scheme_id">@lang('invoice.invoice_scheme') *</label> 
                            @show_tooltip(__('tooltip.invoice_scheme'))
                            <select name="invoice_scheme_id" id="invoice_scheme_id" class="form-control" required>
                                <option value="">@lang('messages.please_select')</option>
                                @foreach($invoice_schemes as $id => $scheme)
                                    <option value="{{ $id }}" {{ $location->invoice_scheme_id == $id ? 'selected' : '' }}>
                                        {{ $scheme }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Selección de diseño de factura -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_layout_id">@lang('invoice.invoice_layout') *</label> 
                            @show_tooltip(__('tooltip.invoice_layout'))
                            <select name="invoice_layout_id" id="invoice_layout_id" class="form-control" required>
                                <option value="">@lang('messages.please_select')</option>
                                @foreach($invoice_layouts as $id => $layout)
                                    <option value="{{ $id }}" {{ $location->invoice_layout_id == $id ? 'selected' : '' }}>
                                        {{ $layout }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <!-- Botón para guardar cambios -->
                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                <!-- Botón para cerrar modal -->
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>

        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
