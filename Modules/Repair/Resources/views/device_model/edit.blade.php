<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Formulario para actualizar un modelo de dispositivo -->
        <form action="{{ url('repair/device-model/update', $model->id) }}" method="POST" id="device_model">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Título del modal -->
                <h4 class="modal-title" id="myModalLabel">@lang('repair::lang.add_device_model')</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Campo para ingresar el nombre del modelo -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">@lang('repair::lang.model_name'):</label>
                            <input type="text" name="name" class="form-control" value="{{ $model->name }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Selección de la marca del dispositivo -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand_id">@lang('product.brand'):</label>
                            <select name="brand_id" id="model_brand_id" class="form-control select2" style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($brands as $key => $brand)
                                    <option value="{{ $key }}" {{ $model->brand_id == $key ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Selección del tipo de dispositivo -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="device_id">@lang('repair::lang.device'):</label>
                            <select name="device_id" id="model_device_id" class="form-control select2" style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($devices as $key => $device)
                                    <option value="{{ $key }}" {{ $model->device_id == $key ? 'selected' : '' }}>{{ $device }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Checklist de reparación -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="repair_checklist">
                                @lang('repair::lang.repair_checklist') @show_tooltip(__('repair::lang.repair_checklist_tooltip'))
                            </label>
                            <textarea name="repair_checklist" id="repair_checklist" class="form-control" rows="3">{{ $model->repair_checklist }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                <!-- Botón para actualizar el modelo de dispositivo -->
                <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
            </div>
        </form>
    </div>
</div>
