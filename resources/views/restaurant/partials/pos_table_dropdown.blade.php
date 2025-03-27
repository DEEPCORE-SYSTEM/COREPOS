@if($tables_enabled)
<div class="col-sm-4">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa fa-table"></i>
			</span>
			<select name="res_table_id" class="form-control">
				<option value="">{{ __('restaurant.select_table') }}</option>
				@foreach($tables as $key => $value)
				<option value="{{ $key }}" {{ old('res_table_id', $view_data['res_table_id'] ?? '') == $key ? 'selected' : '' }}>
					{{ $value }}
				</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
@endif
@if($waiters_enabled)
<div class="col-sm-4">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa fa-user-secret"></i>
			</span>
			<select name="res_waiter_id" id="res_waiter_id" class="form-control" {{ $is_service_staff_required ? 'required' : '' }}>
				<option value="">{{ __('restaurant.select_service_staff') }}</option>
				@foreach($waiters as $key => $value)
				<option value="{{ $key }}" {{ old('res_waiter_id', $view_data['res_waiter_id'] ?? '') == $key ? 'selected' : '' }}>
					{{ $value }}
				</option>
				@endforeach
			</select>
			@if(!empty($pos_settings['inline_service_staff']))
			<div class="input-group-btn">
				<button type="button" class="btn btn-default bg-white btn-flat" id="select_all_service_staff" data-toggle="tooltip" title="@lang('lang_v1.select_same_for_all_rows')"><i class="fa fa-check"></i></button>
			</div>
			@endif
		</div>
	</div>
</div>
@endif