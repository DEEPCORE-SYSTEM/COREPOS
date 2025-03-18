@php
    if($type == 'allowance') {
        $name_col = 'allowance_names';
        $val_col = 'allowance_amounts';
        $val_class = 'allowance';
        $type_col = 'allowance_types';
        $percent_col = 'allowance_percent';
    } elseif($type == 'deduction') {
        $name_col = 'deduction_names';
        $val_col = 'deduction_amounts';
        $val_class = 'deduction';
        $type_col = 'deduction_types';
        $percent_col = 'deduction_percent';
    }

    $amount_type = !empty($amount_type) ? $amount_type : 'fixed';
    $percent = $amount_type == 'percent' && !empty($percent) ?  $percent : 0;
@endphp
<tr>
    <!-- Campo de texto para el nombre -->
    <td>
        <input type="text" name="{{ $name_col }}[]" class="form-control input-sm" 
               value="{{ !empty($name) ? $name : '' }}">
    </td>

    <!-- Selector para tipo de monto (fijo o porcentaje) -->
    <td>
        <select name="{{ $type_col }}[]" class="form-control input-sm amount_type">
            <option value="fixed" {{ $amount_type == 'fixed' ? 'selected' : '' }}>@lang('lang_v1.fixed')</option>
            <option value="percent" {{ $amount_type == 'percent' ? 'selected' : '' }}>@lang('lang_v1.percentage')</option>
        </select>

        <!-- Campo de porcentaje (visible solo si el tipo es 'percent') -->
        <div class="input-group percent_field {{ $amount_type != 'percent' ? 'hide' : '' }}">
            <input type="text" name="{{ $percent_col }}[]" class="form-control input-sm input_number percent" 
                   value="{{ isset($percent) ? num_format($percent) : '' }}">
            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
        </div>
    </td>

    <!-- Campo de valor con control de solo lectura si es porcentaje -->
    <td>
        @php
            $readonly = $amount_type == 'percent' ? 'readonly' : '';
        @endphp
        <input type="text" name="{{ $val_col }}[]" class="form-control input-sm value_field input_number {{ $val_class }}" 
               value="{{ !empty($value) ? num_format((float) $value) : 0 }}" {{ $readonly }}>
    </td>

    <!-- Botón para agregar o eliminar fila -->
    <td>
        @if(!empty($add_button))
            <button type="button" class="btn btn-primary btn-xs" 
                    id="{{ $type == 'allowance' ? 'add_allowance' : ($type == 'deduction' ? 'add_deduction' : '') }}">
                <i class="fa fa-plus"></i>
            </button>
        @else
            <button type="button" class="btn btn-danger btn-xs remove_tr">
                <i class="fa fa-minus"></i>
            </button>
        @endif
    </td>
</tr>
