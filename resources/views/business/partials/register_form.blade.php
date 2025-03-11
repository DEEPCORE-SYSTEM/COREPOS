@if(empty($is_admin))
    <h3>@lang('business.business')</h3>
@endif
<input type="hidden" name="language" value="{{ request()->lang }}">


<fieldset>
<legend>@lang('business.business_details'):</legend>

<div class="col-md-12">
    <div class="form-group">
        <label for="name">{{ __('business.business_name') }}:*</label>

        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-suitcase"></i>
            </span>
          
            <input type="text" name="name" class="form-control" placeholder="{{ __('business.business_name') }}" required>

        </div>
    </div>
</div>
        
<div class="col-md-6">
    <div class="form-group">
    <label for="start_date">{{ __('business.start_date') }}:</label>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <label for="start_date">{{ __('business.start_date') }}:</label>
        <input type="text" name="start_date" id="start_date" class="form-control start-date-picker" placeholder="{{ __('business.start_date') }}" readonly>

    </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
    <label for="currency_id">{{ __('business.currency') }}:*</label>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="fas fa-money-bill-alt"></i>
        </span>
        <select name="currency_id" id="currency_id" class="form-control select2_register" required>
         <option value="">{{ __('business.currency_placeholder') }}</option>
        @foreach ($currencies as $key => $currency)
        <option value="{{ $key }}">{{ $currency }}</option>
        @endforeach
         </select>

    </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
    <label for="business_logo">{{ __('business.upload_logo') }}:</label>
    <input type="file" name="business_logo" id="business_logo" accept="image/*">

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="website">{{ __('lang_v1.website') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-globe"></i>
            </span>
            <input type="text" name="website" id="website" class="form-control" placeholder="{{ __('lang_v1.website') }}">
        </div>
    </div>
</div>


<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="mobile">{{ __('lang_v1.business_telephone') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-phone"></i>
            </span>
            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="{{ __('lang_v1.business_telephone') }}">
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="alternate_number">{{ __('business.alternate_number') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-phone"></i>
            </span>
            <input type="text" name="alternate_number" id="alternate_number" class="form-control" placeholder="{{ __('business.alternate_number') }}">
        </div>
    </div>
</div>


<div class="clearfix"></div>

<div class="col-md-6">
    <div class="form-group">
        <label for="country">{{ __('business.country') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-globe"></i>
            </span>
            <input type="text" name="country" id="country" class="form-control" placeholder="{{ __('business.country') }}" required>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="state">{{ __('business.state') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="state" id="state" class="form-control" placeholder="{{ __('business.state') }}" required>
        </div>
    </div>
</div>


<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="city">{{ __('business.city') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('business.city') }}" required>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="zip_code">{{ __('business.zip_code') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="{{ __('business.zip_code_placeholder') }}" required>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="landmark">{{ __('business.landmark') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
            </span>
            <input type="text" name="landmark" id="landmark" class="form-control" placeholder="{{ __('business.landmark') }}" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="time_zone">{{ __('business.time_zone') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fas fa-clock"></i>
            </span>
            <select name="time_zone" id="time_zone" class="form-control select2_register" required>
                <option value="">{{ __('business.time_zone') }}</option>
                @foreach ($timezone_list as $key => $value)
                    <option value="{{ $key }}" {{ config('app.timezone') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


</fieldset>

<!-- tax details -->
@if(empty($is_admin))
    <h3>@lang('business.business_settings')</h3>

    <fieldset>
        <legend>@lang('business.business_settings'):</legend>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_label_1">{{ __('business.tax_1_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_label_1" id="tax_label_1" class="form-control" placeholder="{{ __('business.tax_1_placeholder') }}">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_number_1">{{ __('business.tax_1_no') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_number_1" id="tax_number_1" class="form-control">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_label_2">{{ __('business.tax_2_name') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_label_2" id="tax_label_2" class="form-control" placeholder="{{ __('business.tax_1_placeholder') }}">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_number_2">{{ __('business.tax_2_no') }}:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    <input type="text" name="tax_number_2" id="tax_number_2" class="form-control">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fy_start_month">{{ __('business.fy_start_month') }}:*</label> 
                @show_tooltip(__('tooltip.fy_start_month'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <select name="fy_start_month" id="fy_start_month" class="form-control select2_register" required style="width:100%;">
                        @foreach ($months as $key => $month)
                            <option value="{{ $key }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="accounting_method">{{ __('business.accounting_method') }}:*</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calculator"></i>
                    </span>
                    <select name="accounting_method" id="accounting_method" class="form-control select2_register" required style="width:100%;">
                        @foreach ($accounting_methods as $key => $method)
                            <option value="{{ $key }}">{{ $method }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </fieldset>
@endif


<!-- Owner Information -->
@if(empty($is_admin))
    <h3>@lang('business.owner')</h3>
@endif

<fieldset>
<legend>@lang('business.owner_info')</legend>

<div class="col-md-4">
    <div class="form-group">
        <label for="surname">{{ __('business.prefix') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            <input type="text" name="surname" id="surname" class="form-control" placeholder="{{ __('business.prefix_placeholder') }}">
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="first_name">{{ __('business.first_name') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="{{ __('business.first_name') }}" required>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="last_name">{{ __('business.last_name') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-info"></i>
            </span>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="{{ __('business.last_name') }}">
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-6">
    <div class="form-group">
        <label for="username">{{ __('business.username') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-user"></i>
            </span>
            <input type="text" name="username" id="username" class="form-control" placeholder="{{ __('business.username') }}" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="email">{{ __('business.email') }}:</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
            </span>
            <input type="text" name="email" id="email" class="form-control" placeholder="{{ __('business.email') }}">
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-6">
    <div class="form-group">
        <label for="password">{{ __('business.password') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('business.password') }}" required>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="confirm_password">{{ __('business.confirm_password') }}:*</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-lock"></i>
            </span>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="{{ __('business.confirm_password') }}" required>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-md-6">
    @if(!empty($system_settings['superadmin_enable_register_tc']))
        <div class="form-group">
            <label>
                <input type="checkbox" name="accept_tc" class="input-icheck" required>
                <u><a class="terms_condition cursor-pointer" data-toggle="modal" data-target="#tc_modal">
                    @lang('lang_v1.accept_terms_and_conditions') <i></i>
                </a></u>
            </label>
        </div>
        @include('business.partials.terms_conditions')
    @endif
</div>

<div class="clearfix"></div>

</fieldset>