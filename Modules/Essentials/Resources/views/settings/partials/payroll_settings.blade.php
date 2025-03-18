<div class="pos-tab-content">
    <div class="row">
        <!-- Prefijo para el número de referencia de nómina -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="payroll_ref_no_prefix">@lang('essentials::lang.payroll_ref_no_prefix'):</label>
                <input type="text" name="payroll_ref_no_prefix" id="payroll_ref_no_prefix" 
                       class="form-control" placeholder="@lang('essentials::lang.payroll_ref_no_prefix')" 
                       value="{{ $settings['payroll_ref_no_prefix'] ?? '' }}">
            </div>
        </div>
    </div>
</div>
