<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="additional_js">
                    @lang('superadmin::lang.additional_js'):
                </label> 
                @show_tooltip(__('superadmin::lang.additional_js_instructions'))
                
                <textarea name="additional_js" id="additional_js" class="form-control" 
                          placeholder="@lang('superadmin::lang.additional_js')">
                    {{ old('additional_js', $settings['additional_js'] ?? '') }}
                </textarea>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label for="additional_css">
                    @lang('superadmin::lang.additional_css'):
                </label> 
                @show_tooltip(__('superadmin::lang.additional_css_instructions'))
                
                <textarea name="additional_css" id="additional_css" class="form-control" 
                          placeholder="@lang('superadmin::lang.additional_css')">
                    {{ old('additional_css', $settings['additional_css'] ?? '') }}
                </textarea>
            </div>
        </div>
    </div>
</div>
