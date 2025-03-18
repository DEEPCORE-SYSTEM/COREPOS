<div class="modal-dialog" role="document">
  <div class="modal-content">

	<form action="{{ action('\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController@store') }}" 
		method="POST" id="add_allowance_form">
		@csrf

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title">@lang('essentials::lang.add_allowance_and_deduction')</h4>
		</div>

		<div class="modal-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label for="description">@lang('lang_v1.description')*</label>
					<input type="text" name="description" id="description" class="form-control" required 
						placeholder="@lang('lang_v1.description')">
				</div>

				<div class="form-group col-md-12">
					<label for="type">@lang('lang_v1.type')*</label>
					<select name="type" id="type" class="form-control" required>
						<option value="allowance">@lang('essentials::lang.allowance')</option>
						<option value="deduction">@lang('essentials::lang.deduction')</option>
					</select>
				</div>

				<div class="form-group col-md-12">
					<label for="employees">@lang('essentials::lang.employee')*</label>
					<select name="employees[]" id="employees" class="form-control select2" required multiple>
						@foreach($users as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="amount_type">@lang('essentials::lang.amount_type')*</label>
					<select name="amount_type" id="amount_type" class="form-control" required>
						<option value="fixed">@lang('lang_v1.fixed')</option>
						<option value="percent">@lang('lang_v1.percentage')</option>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="amount">@lang('sale.amount')*</label>
					<input type="text" name="amount" id="amount" class="form-control input_number" required 
						placeholder="@lang('sale.amount')">
				</div>

				<div class="form-group col-md-12">
					<label for="applicable_date">
						@lang('essentials::lang.applicable_date') 
						@show_tooltip(__('essentials::lang.applicable_date_help'))
					</label>
					<div class="input-group data">
						<input type="text" name="applicable_date" id="applicable_date" class="form-control" 
							placeholder="@lang('essentials::lang.applicable_date')" readonly>
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">@lang('messages.save')</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	</form>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->