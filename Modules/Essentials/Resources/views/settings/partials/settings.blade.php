<div class="pos-tab-content">
    <div class="row">
        <!-- Prefijo para el número de referencia de permisos -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="leave_ref_no_prefix">@lang('essentials::lang.leave_ref_no_prefix'):</label>
                <input type="text" name="leave_ref_no_prefix" id="leave_ref_no_prefix" 
                       class="form-control" placeholder="@lang('essentials::lang.leave_ref_no_prefix')" 
                       value="{{ $settings['leave_ref_no_prefix'] ?? '' }}">
            </div>
        </div>

        <!-- Prefijo para el número de referencia de nómina -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="payroll_ref_no_prefix">@lang('essentials::lang.payroll_ref_no_prefix'):</label>
                <input type="text" name="payroll_ref_no_prefix" id="payroll_ref_no_prefix" 
                       class="form-control" placeholder="@lang('essentials::lang.payroll_ref_no_prefix')" 
                       value="{{ $settings['payroll_ref_no_prefix'] ?? '' }}">
            </div>
        </div>

        <!-- Permitir a los usuarios registrar asistencia -->
        <div class="col-xs-4">
            <div class="checkbox">
                <label>
                    <br/>
                    <input type="checkbox" name="allow_users_for_attendance" value="1" class="input-icheck" 
                           {{ !empty($settings['allow_users_for_attendance']) ? 'checked' : '' }}>
                    @lang('essentials::lang.allow_users_for_attendance')
                </label>
            </div>
        </div>

        <!-- Instrucciones para permisos -->
        <div class="col-xs-12">
            <div class="form-group">
                <label for="leave_instructions">@lang('essentials::lang.leave_instructions'):</label>
                <textarea name="leave_instructions" id="leave_instructions" class="form-control" 
                          placeholder="@lang('essentials::lang.leave_instructions')">{{ $settings['leave_instructions'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>
