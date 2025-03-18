@if($__is_repair_enabled)

@php
	$default = [
		'show_repair_status' => 1,
		'repair_status_label' => 'Repair Status',

		'show_repair_warranty' => 1,
		'repair_warranty_label' => 'Repair Warranty',

		'show_serial_no' => 1,
		'serial_no_label' => 'Serial No.',

		'show_defects' => 1,
		'defects_label' => 'Defects',
		'show_model' => 1,
		'model_no_label' => 'Model No.',
		'show_repair_checklist' => 1,
		'repair_checklist_label' => 'Repair Checklist',
		'show_device' => 1,
		'device_label' => 'Device',
		'show_brand' => 1,
		'brand_label' => 'Brand',
	];

	if(!empty($edit_il)){
		$default = [
			'show_repair_status' => !empty($module_info['repair']['show_repair_status']) ? 1 : 0,
			'repair_status_label' => !empty($module_info['repair']['repair_status_label']) ? $module_info['repair']['repair_status_label'] : '',

			'show_repair_warranty' => !empty($module_info['repair']['show_repair_warranty']) ? 1 : 0,
			'repair_warranty_label' => !empty($module_info['repair']['repair_warranty_label']) ? $module_info['repair']['repair_warranty_label'] : '',

			'show_serial_no' => !empty($module_info['repair']['show_serial_no']) ? 1 : 0,
			'serial_no_label' =>  !empty($module_info['repair']['serial_no_label']) ? $module_info['repair']['serial_no_label'] : '',

			'show_defects' => !empty($module_info['repair']['show_defects']) ? 1 : 0,
			'defects_label' =>  !empty($module_info['repair']['defects_label']) ? $module_info['repair']['defects_label'] : '',

			'show_model' => !empty($module_info['repair']['show_model']) ? 1 : 0,
			'model_no_label' =>  !empty($module_info['repair']['model_no_label']) ? $module_info['repair']['model_no_label'] : '',

			'show_repair_checklist' => !empty($module_info['repair']['show_repair_checklist']) ? 1 : 0,
			'repair_checklist_label' =>  !empty($module_info['repair']['repair_checklist_label']) ? $module_info['repair']['repair_checklist_label'] : '',

			'show_device' => !empty($module_info['repair']['show_device']) ? 1 : 0,
			'device_label' =>  !empty($module_info['repair']['device_label']) ? $module_info['repair']['device_label'] : '',

			'show_brand' => !empty($module_info['repair']['show_brand']) ? 1 : 0,
			'brand_label' =>  !empty($module_info['repair']['brand_label']) ? $module_info['repair']['brand_label'] : '',
		];
	}
	
@endphp

@component('components.widget', ['class' => 'box-solid', 'title' => __('repair::lang.repair_module_settings')])
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="module_info[repair][show_repair_status]" value="1"
                               class="input-icheck" 
                               {{ $default['show_repair_status'] ? 'checked' : '' }}>
                        @lang('repair::lang.show_repair_status')
                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="form-group">
                <label for="repair_status_label">@lang('repair::lang.repair_status_label'):</label>
                <input type="text" name="module_info[repair][repair_status_label]" 
                       id="repair_status_label" class="form-control" 
                       placeholder="@lang('repair::lang.repair_status_label')"
                       value="{{ $default['repair_status_label'] }}">
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="module_info[repair][show_repair_warranty]" value="1"
                               class="input-icheck" 
                               {{ $default['show_repair_warranty'] ? 'checked' : '' }}>
                        @lang('repair::lang.show_repair_warranty')
                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="form-group">
                <label for="repair_warranty_label">@lang('repair::lang.repair_warranty_label'):</label>
                <input type="text" name="module_info[repair][repair_warranty_label]" 
                       id="repair_warranty_label" class="form-control" 
                       placeholder="@lang('repair::lang.repair_warranty_label')"
                       value="{{ $default['repair_warranty_label'] }}">
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="module_info[repair][show_brand]" value="1"
                               class="input-icheck" 
                               {{ $default['show_brand'] ? 'checked' : '' }}>
                        @lang('repair::lang.show_brand')
                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <label for="brand_label">@lang('repair::lang.brand_label'):</label>
                <input type="text" name="module_info[repair][brand_label]" 
                       id="brand_label" class="form-control" 
                       placeholder="@lang('repair::lang.brand_label')"
                       value="{{ $default['brand_label'] }}">
            </div>
        </div>

        @php
            $fields = [
                'show_device' => 'show_device',
                'device_label' => 'device_label',
                'show_model' => 'show_model',
                'model_no_label' => 'model_no_label',
                'show_serial_no' => 'show_serial_no',
                'serial_no_label' => 'serial_no_label',
                'show_defects' => 'show_defects',
                'defects_label' => 'defects_label',
                'show_repair_checklist' => 'show_repair_checklist',
                'repair_checklist_label' => 'repair_checklist_label'
            ];
        @endphp

        @foreach($fields as $key => $label)
            <div class="col-sm-3">
                <div class="form-group">
                    @if(str_starts_with($key, 'show'))
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="module_info[repair][{{ $key }}]" value="1"
                                       class="input-icheck" 
                                       {{ $default[$key] ? 'checked' : '' }}>
                                @lang("repair::lang.$label")
                            </label>
                        </div>
                    @else
                        <label for="{{ $key }}">@lang("repair::lang.$label"):</label>
                        <input type="text" name="module_info[repair][{{ $key }}]" 
                               id="{{ $key }}" class="form-control" 
                               placeholder="@lang("repair::lang.$label")"
                               value="{{ $default[$key] }}">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endcomponent

@endif