<div class="pos-tab-content">
    <div class="row">
        <!-- Permitir usuarios para asistencia -->
        <div class="col-xs-6">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="allow_users_for_attendance" value="1" class="input-icheck"
                           {{ !empty($settings['allow_users_for_attendance']) ? 'checked' : '' }}>
                    @lang('essentials::lang.allow_users_for_attendance')
                </label>
            </div>
        </div>

        <!-- Ubicación obligatoria -->
        <div class="col-xs-6">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_location_required" value="1" class="input-icheck"
                           {{ !empty($settings['is_location_required']) ? 'checked' : '' }}>
                    @lang('essentials::lang.is_location_required')
                </label>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Tiempo de gracia -->
        <div class="col-xs-12">
            <strong>@lang('essentials::lang.grace_time'):</strong>
        </div>

        <!-- Gracia antes del check-in -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="grace_before_checkin">@lang('essentials::lang.grace_before_checkin'):</label>
                <input type="number" name="grace_before_checkin" id="grace_before_checkin" class="form-control" 
                       placeholder="@lang('essentials::lang.grace_before_checkin')" step="1" 
                       value="{{ $settings['grace_before_checkin'] ?? '' }}">
                <p class="help-block">@lang('essentials::lang.grace_before_checkin_help')</p>
            </div>
        </div>

        <!-- Gracia después del check-in -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="grace_after_checkin">@lang('essentials::lang.grace_after_checkin'):</label>
                <input type="number" name="grace_after_checkin" id="grace_after_checkin" class="form-control" 
                       placeholder="@lang('essentials::lang.grace_after_checkin')" step="1" 
                       value="{{ $settings['grace_after_checkin'] ?? '' }}">
                <p class="help-block">@lang('essentials::lang.grace_after_checkin_help')</p>
            </div>
        </div>

        <!-- Gracia antes del check-out -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="grace_before_checkout">@lang('essentials::lang.grace_before_checkout'):</label>
                <input type="number" name="grace_before_checkout" id="grace_before_checkout" class="form-control" 
                       placeholder="@lang('essentials::lang.grace_before_checkout')" step="1" 
                       value="{{ $settings['grace_before_checkout'] ?? '' }}">
                <p class="help-block">@lang('essentials::lang.grace_before_checkout_help')</p>
            </div>
        </div>

        <!-- Gracia después del check-out -->
        <div class="col-xs-6">
            <div class="form-group">
                <label for="grace_after_checkout">@lang('essentials::lang.grace_after_checkout'):</label>
                <input type="number" name="grace_after_checkout" id="grace_after_checkout" class="form-control" 
                       placeholder="@lang('essentials::lang.grace_after_checkout')" step="1" 
                       value="{{ $settings['grace_after_checkout'] ?? '' }}">
                <p class="help-block">@lang('essentials::lang.grace_before_checkin_help')</p>
            </div>
        </div>
    </div>
</div>
