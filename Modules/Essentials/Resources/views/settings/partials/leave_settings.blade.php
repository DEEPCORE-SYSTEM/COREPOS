<div class="pos-tab-content active">
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
