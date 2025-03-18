@php
	$repair = [];
	if (!empty($view_data['job_sheet'])) {
		$repair['repair_job_sheet_id'] = $view_data['job_sheet']['id'];
		$repair['repair_due_date'] = $view_data['job_sheet']['delivery_date'];
		$repair['repair_completed_on'] = null;
		$repair['repair_warranty_id'] = null;
		$repair['repair_status_id'] = $view_data['job_sheet']['status_id'];
		$repair['repair_brand_id'] = $view_data['job_sheet']['brand_id'];
		$repair['repair_device_id'] = $view_data['job_sheet']['device_id'];
		$repair['repair_model_id'] = $view_data['job_sheet']['device_model_id'];
		$repair['repair_serial_no'] = $view_data['job_sheet']['serial_no'];
		$repair['repair_defects'] = $view_data['job_sheet']['defects'];
		$repair['res_waiter_id'] = $view_data['job_sheet']['service_staff'];
	} elseif (!empty($transaction)) {
		$repair['repair_due_date'] = $transaction['repair_due_date'];
		$repair['repair_completed_on'] = $transaction['repair_completed_on'];
		$repair['repair_warranty_id'] = $transaction['repair_warranty_id'];
		$repair['repair_status_id'] = $transaction['repair_status_id'];
		$repair['repair_brand_id'] = $transaction['repair_brand_id'];
		$repair['repair_device_id'] = $transaction['repair_device_id'];
		$repair['repair_model_id'] = $transaction['repair_model_id'];
		$repair['repair_serial_no'] = $transaction['repair_serial_no'];
		$repair['repair_defects'] = $transaction['repair_defects'];
	}
@endphp

<input type="hidden" name="has_module_data" value="true">


@if(!empty($view_data['parts']))
	<input type="hidden" id="pos_repair_parts_used" value="{{json_encode($view_data['parts'])}}">
@endif

@if(!empty($view_data['job_sheet']['location_id']))
<input type="hidden" id="job_sheet_location_id" value="{{$view_data['job_sheet']['location_id']}}">
@endif


<input type="hidden" id="repair_transaction_id" value="@if(!empty($transaction->id)){{$transaction->id}}@endif">
<input type="hidden" id="repair_job_sheet_id" name="repair_job_sheet_id" value="@if(!empty($repair['repair_job_sheet_id'])){{$repair['repair_job_sheet_id']}}@endif">
{{-- override serive staff --}}
@if(!empty($repair['res_waiter_id']))
	<input type="hidden" id="repair_technician" value="{{$repair['res_waiter_id']}}">
@endif

<!-- Fila para fechas y estado de reparación -->
<div class="row">
    <!-- Fecha de entrega esperada -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_due_date">{{ __('repair::lang.delivery_date') }}:</label>
            <small class="text-muted">{{ __('repair::lang.repair_due_date_tooltip') }}</small>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" name="repair_due_date" id="repair_due_date" 
                       class="form-control" readonly 
                       value="{{ !empty($repair['repair_due_date']) ? format_datetime($repair['repair_due_date']) : '' }}">
                <span class="input-group-addon">
                    <i class="fas fa-times-circle cursor-pointer clear_repair_due_date"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Fecha de finalización de reparación -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_completed_on">{{ __('repair::lang.repair_completed_on') }}:</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" name="repair_completed_on" id="repair_completed_on" 
                       class="form-control" readonly 
                       value="{{ !empty($repair['repair_completed_on']) ? format_datetime($repair['repair_completed_on']) : '' }}">
                <span class="input-group-addon">
                    <i class="fas fa-times-circle cursor-pointer clear_repair_completed_on"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Selección de garantía (si hay disponibles) -->
    @if(!empty($view_data['warranties']))
        <div class="col-sm-4">
            <div class="form-group">
                <label for="repair_warranty_id">{{ __('lang_v1.warranty') }}:</label>
                <select name="repair_warranty_id" id="repair_warranty_id" class="form-control select2">
                    <option value="">{{ __('messages.please_select') }}</option>
                    @foreach($view_data['warranties'] as $id => $warranty)
                        <option value="{{ $id }}" 
                            {{ !empty($repair['repair_warranty_id']) && $repair['repair_warranty_id'] == $id ? 'selected' : '' }}>
                            {{ $warranty }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <!-- Estado de reparación -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_status_id">{{ __('sale.status') }}:</label>
            <select name="repair_status_id" id="repair_status_id" class="form-control" required>
                <!-- Opciones de estado se llenarán dinámicamente -->
            </select>
        </div>
    </div>
</div>

<!-- Fila para información del dispositivo -->
<div class="row">
    <!-- Marca del dispositivo -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_brand_id">{{ __('product.brand') }}:</label>
            <select name="repair_brand_id" id="repair_brand_id" class="form-control select2">
                <option value="">{{ __('messages.please_select') }}</option>
                @foreach($view_data['brands'] as $id => $brand)
                    <option value="{{ $id }}" 
                        {{ !empty($repair['repair_brand_id']) && $repair['repair_brand_id'] == $id ? 'selected' : '' }}>
                        {{ $brand }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Tipo de dispositivo -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_device_id">{{ __('repair::lang.device') }}:</label>
            <select name="repair_device_id" id="repair_device_id" class="form-control select2">
                <option value="">{{ __('messages.please_select') }}</option>
                @foreach($view_data['devices'] as $id => $device)
                    <option value="{{ $id }}" 
                        {{ !empty($repair['repair_device_id']) && $repair['repair_device_id'] == $id ? 'selected' : '' }}>
                        {{ $device }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Modelo del dispositivo -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_model_id">{{ __('repair::lang.device_model') }}:</label>
            <select name="repair_model_id" id="repair_model_id" class="form-control select2">
                <option value="">{{ __('messages.please_select') }}</option>
                @foreach($view_data['device_models'] as $id => $model)
                    <option value="{{ $id }}" 
                        {{ !empty($repair['repair_model_id']) && $repair['repair_model_id'] == $id ? 'selected' : '' }}>
                        {{ $model }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<!-- Fila para número de serie y botones de seguridad/checklist -->
<div class="row">
    <!-- Número de serie -->
    <div class="col-sm-4">
        <div class="form-group">
            <label for="repair_serial_no">{{ __('repair::lang.serial_no') }}:</label>
            <input type="text" name="repair_serial_no" id="repair_serial_no" class="form-control"
                   placeholder="{{ __('repair::lang.serial_no') }}"
                   value="{{ !empty($repair['repair_serial_no']) ? $repair['repair_serial_no'] : '' }}">
        </div>
    </div>

    <!-- Botones de checklist y seguridad -->
    <div class="col-sm-6 mt-15">
        <div class="btn-group mt-5" role="group">
            <!-- Botón para abrir modal de checklist -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#checklist_modal">
                <i class="fa fa-plus"></i> {{ __('repair::lang.pre_repair_checklist') }}
            </button>

            <!-- Botón para abrir modal de seguridad -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#security_modal">
                <i class="fa fa-lock"></i> {{ __('repair::lang.security') }}
            </button>
        </div>
    </div>
</div>

<!-- Fila para problemas reportados -->
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="repair_defects">{{ __('repair::lang.problem_reported_by_customer') }}:</label>
            <textarea name="repair_defects" id="repair_defects" class="form-control tags-look" rows="3">
                {{ !empty($repair['repair_defects']) ? $repair['repair_defects'] : '' }}
            </textarea>
        </div>
    </div>
</div>



@include('repair::repair.partials.security_modal')
@include('repair::repair.partials.checklist_modal')

<style type="text/css">
	#product_category_div, #feature_product_div, #product_brand_div{
		display: none !important;
	}
</style>