<div class="modal-dialog" role="document">
    <div class="modal-content">
        
        <!-- Encabezado del modal -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">{{ $types_of_service->name }}</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-12">
                    
                    <!-- Cálculo del cargo por empaque -->
                    @php
                        $packing_charge = !empty($transaction) ? $transaction->packing_charge : $types_of_service->packing_charge;
                        $packing_charge_type = !empty($transaction) ? $transaction->packing_charge_type : $types_of_service->packing_charge_type;
                    @endphp

                    <!-- Campo de cargo por empaque -->
                    <label for="packing_charge">{{ __('lang_v1.packing_charge') }}:</label>
                    <div class="input-group" @if($types_of_service->packing_charge_type != 'percent') style="width: 100%;" @endif>
                        <input type="text" name="packing_charge" id="packing_charge" 
                               class="form-control input_number" 
                               placeholder="{{ __('lang_v1.packing_charge') }}" 
                               value="{{ @num_format($packing_charge) }}" 
                               style="width: 100%;">
                        @if($packing_charge_type == 'percent')
                            <span class="input-group-addon">%</span>
                        @endif

                        <input type="hidden" name="packing_charge_type" id="packing_charge_type" value="{{ $packing_charge_type }}">
                    </div>
                </div>

                <!-- Verifica si los campos personalizados están habilitados -->
                @if($types_of_service->enable_custom_fields == 1)
                    @php
                        $custom_labels = json_decode(session('business.custom_labels'), true);
                        $service_custom_field_1 = $custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1');
                        $service_custom_field_2 = $custom_labels['types_of_service']['custom_field_2'] ?? __('lang_v1.service_custom_field_2');
                        $service_custom_field_3 = $custom_labels['types_of_service']['custom_field_3'] ?? __('lang_v1.service_custom_field_3');
                        $service_custom_field_4 = $custom_labels['types_of_service']['custom_field_4'] ?? __('lang_v1.service_custom_field_4');
                        $service_custom_field_5 = $custom_labels['types_of_service']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]);
                        $service_custom_field_6 = $custom_labels['types_of_service']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]);
                    @endphp

                    <!-- Campos personalizados del servicio -->
                    <div class="form-group col-md-6">
                        <label for="service_custom_field_1">{{ $service_custom_field_1 }}:</label>
                        <input type="text" name="service_custom_field_1" id="service_custom_field_1" 
                               class="form-control" placeholder="{{ $service_custom_field_1 }}" 
                               value="{{ old('service_custom_field_1', $transaction->service_custom_field_1 ?? '') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="service_custom_field_2">{{ $service_custom_field_2 }}:</label>
                        <input type="text" name="service_custom_field_2" id="service_custom_field_2" 
                               class="form-control" placeholder="{{ $service_custom_field_2 }}" 
                               value="{{ old('service_custom_field_2', $transaction->service_custom_field_2 ?? '') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="service_custom_field_3">{{ $service_custom_field_3 }}:</label>
                        <input type="text" name="service_custom_field_3" id="service_custom_field_3" 
                               class="form-control" placeholder="{{ $service_custom_field_3 }}" 
                               value="{{ old('service_custom_field_3', $transaction->service_custom_field_3 ?? '') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="service_custom_field_4">{{ $service_custom_field_4 }}:</label>
                        <input type="text" name="service_custom_field_4" id="service_custom_field_4" 
                               class="form-control" placeholder="{{ $service_custom_field_4 }}" 
                               value="{{ old('service_custom_field_4', $transaction->service_custom_field_4 ?? '') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="service_custom_field_5">{{ $service_custom_field_5 }}:</label>
                        <input type="text" name="service_custom_field_5" id="service_custom_field_5" 
                               class="form-control" placeholder="{{ $service_custom_field_5 }}" 
                               value="{{ old('service_custom_field_5', $transaction->service_custom_field_5 ?? '') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="service_custom_field_6">{{ $service_custom_field_6 }}:</label>
                        <input type="text" name="service_custom_field_6" id="service_custom_field_6" 
                               class="form-control" placeholder="{{ $service_custom_field_6 }}" 
                               value="{{ old('service_custom_field_6', $transaction->service_custom_field_6 ?? '') }}">
                    </div>
                @endif

            </div>
        </div>

        <!-- Pie de página del modal con botón de cerrar -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
