<div class="modal fade" id="add_booking_modal" tabindex="-1" role="dialog"
	aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<form action="{{ action('Restaurant\\BookingController@store') }}" method="POST" id="add_booking_form">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">@lang( 'restaurant.add_booking' )</h4>
				</div>

				<div class="modal-body">
					@if(count($business_locations) == 1)
					@php
					$default_location = current(array_keys($business_locations->toArray()))
					@endphp
					@else
					@php $default_location = null; @endphp
					@endif
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</span>
									</span>
									<select name="location_id" class="form-control" id="booking_location_id" required>
										<option value="" disabled selected>{{ __('purchase.business_location') }}</option>
										@foreach($business_locations as $id => $location)
										<option value="{{ $id }}" {{ $default_location == $id ? 'selected' : '' }}>{{ $location }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<select name="contact_id" class="form-control" id="booking_customer_id" required>
										<option value="" disabled selected>{{ __('contact.customer') }}</option>
										@foreach($customers as $id => $customer)
										<option value="{{ $id }}">{{ $customer }}</option>
										@endforeach
									</select>
									<span class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name="" @if(!auth()->user()->can('customer.create')) disabled @endif><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
									</span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<select name="correspondent" class="form-control" id="correspondent">
										<option value="" disabled selected>{{ __('restaurant.select_correspondent') }}</option>
										@foreach($correspondents as $id => $correspondent)
										<option value="{{ $id }}">{{ $correspondent }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div id="restaurant_module_span"></div>
						<div class="clearfix"></div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="start_time">@lang('restaurant.start_time') *</label>
								<div class="input-group date">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
									<input type="text" name="booking_start" id="start_time" class="form-control" placeholder="@lang('restaurant.start_time')" required readonly>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label for="status">@lang('restaurant.end_time') *</label>
								<div class="input-group date">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
									<input type="text" name="booking_end" value="{{ old('booking_end') }}" class="form-control" placeholder="@lang('restaurant.end_time')" required id="end_time" readonly>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="booking_note">@lang('restaurant.customer_note')</label>
								<textarea name="booking_note" class="form-control" placeholder="@lang('restaurant.customer_note')" rows="3">{{ old('booking_note') }}</textarea>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<div class="checkbox">
									<input type="checkbox" name="send_notification" value="1" id="send_notification" class="input-icheck" checked>
									<label for="send_notification">@lang('restaurant.send_notification_to_customer')</label>
								</div>
							</div>
						</div>


						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
						</div>

			</form>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>