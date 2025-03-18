<tr>
	<td>
		{{-- Icono para ordenar los ingredientes --}}
		<i class="fas fa-sort pull-left handle cursor-pointer" title="@lang('lang_v1.sort_order')"></i>&nbsp;
		
		{{-- Nombre del ingrediente --}}
		{{ $ingredient->full_name }}

		{{-- Precio del ingrediente (oculto) --}}
		<input type="hidden" class="ingredient_price" value="{{ $ingredient->dpp_inc_tax }}">

		{{-- ID del ingrediente --}}
		<input type="hidden" name="ingredients[{{ $row_index }}][ingredient_id]" class="ingredient_id" value="{{ $ingredient->id }}">

		{{-- Orden de clasificación del ingrediente --}}
		<input type="hidden" name="ingredients[{{ $row_index }}][sort_order]" class="sort_order" 
			value="{{ $ingredient->sort_order ?? $sort_order ?? '' }}">

		{{-- ID de la línea de ingrediente (si existe) --}}
		@if(!empty($ingredient->ingredient_line_id))
			<input type="hidden" name="ingredients[{{ $row_index }}][ingredient_line_id]" value="{{ $ingredient->ingredient_line_id }}">
		@endif

		{{-- Grupo de ingredientes (si aplica) --}}
		@if(!empty($ingredient->mfg_ingredient_group_id))
			<input type="hidden" name="ingredients[{{ $row_index }}][mfg_ingredient_group_id]" value="{{ $ingredient->mfg_ingredient_group_id }}">
		@endif

		{{-- Índice del grupo de ingredientes (si aplica) --}}
		@if(isset($ig_index))
			<input type="hidden" name="ingredients[{{ $row_index }}][ig_index]" value="{{ $ig_index }}">
		@endif
	</td>

	{{-- Porcentaje de desperdicio --}}
	<td>
		<div class="input-group">
			<input type="text" name="ingredients[{{ $row_index }}][waste_percent]" 
				class="form-control input_number waste_percent input-sm" 
				placeholder="@lang('lang_v1.waste_percent')" 
				value="{{ isset($ingredient->waste_percent) ? number_format($ingredient->waste_percent, 2) : 0 }}">
			<span class="input-group-addon"><i class="fa fa-percent"></i></span>
		</div>
	</td>

	{{-- Cantidad de ingredientes con unidad de medida --}}
	<td>
		<div class="{{ empty($ingredient->sub_units) ? 'input-group' : 'input_inline' }}">
			<input type="text" name="ingredients[{{ $row_index }}][quantity]" 
				class="form-control input_number quantity input-sm" 
				placeholder="@lang('lang_v1.quantity')" required
				value="{{ isset($ingredient->quantity) ? number_format($ingredient->quantity, 2) : 1 }}">

			<span class="{{ empty($ingredient->sub_units) ? 'input-group-addon' : '' }}">
				@if(!empty($ingredient->sub_units))
					<select name="ingredients[{{ $row_index }}][sub_unit_id]" class="form-control input-sm row_sub_unit_id">
						@foreach($ingredient->sub_units as $key => $value)
							<option value="{{ $key }}" data-multiplier="{{ $value['multiplier'] }}"
								{{ (!empty($ingredient->sub_unit_id) && $key == $ingredient->sub_unit_id) ? 'selected' : '' }}>
								{{ $value['name'] }}
							</option>
						@endforeach
					</select>
				@else
					{{ $ingredient->unit }}
				@endif
			</span>
		</div>
	</td>

	{{-- Precio calculado del ingrediente --}}
	@php
		$price = (!empty($ingredient->quantity) ? $ingredient->quantity * $ingredient->dpp_inc_tax : $ingredient->dpp_inc_tax) * $ingredient->multiplier;
	@endphp
	<td>
		<span class="ingredient_price">{{ number_format($price, 2) }}</span>
	</td>

	{{-- Botón para eliminar el ingrediente --}}
	<td>
		<button type="button" class="btn btn-danger btn-xs remove_ingredient">
			<i class="fas fa-times"></i>
		</button>
	</td>
</tr>
