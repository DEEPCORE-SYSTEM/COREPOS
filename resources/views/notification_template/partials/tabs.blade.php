<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach($templates as $key => $value)
            <li class="{{ $loop->first ? 'active' : '' }}">
                <a href="#cn_{{ $key }}" data-toggle="tab" aria-expanded="true">
                    {{ $value['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($templates as $key => $value)
            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="cn_{{ $key }}">
                <div class="row">
                    <div class="col-md-12">
                        @if(!empty($value['extra_tags']))
                            <strong>@lang('lang_v1.available_tags'):</strong>
                            <p class="text-primary">{{ implode(', ', $value['extra_tags']) }}</p>
                        @endif
                        @if(!empty($value['help_text']))
                            <p class="help-block">{{ $value['help_text'] }}</p>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="{{ $key }}_subject">@lang('lang_v1.email_subject'):</label>
                            <input type="text" name="template_data[{{ $key }}][subject]" 
                                   class="form-control" id="{{ $key }}_subject" 
                                   placeholder="@lang('lang_v1.email_subject')" 
                                   value="{{ $value['subject'] }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="{{ $key }}_cc">CC:</label>
                            <input type="email" name="template_data[{{ $key }}][cc]" 
                                   class="form-control" id="{{ $key }}_cc" 
                                   placeholder="CC" value="{{ $value['cc'] }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="{{ $key }}_bcc">BCC:</label>
                            <input type="email" name="template_data[{{ $key }}][bcc]" 
                                   class="form-control" id="{{ $key }}_bcc" 
                                   placeholder="BCC" value="{{ $value['bcc'] }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="{{ $key }}_email_body">@lang('lang_v1.email_body'):</label>
                            <textarea name="template_data[{{ $key }}][email_body]" 
                                      class="form-control ckeditor" id="{{ $key }}_email_body" 
                                      placeholder="@lang('lang_v1.email_body')" rows="6">{{ $value['email_body'] }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 {{ $key == 'send_ledger' ? 'hide' : '' }}">
                        <div class="form-group">
                            <label for="{{ $key }}_sms_body">@lang('lang_v1.sms_body'):</label>
                            <textarea name="template_data[{{ $key }}][sms_body]" 
                                      class="form-control" id="{{ $key }}_sms_body" 
                                      placeholder="@lang('lang_v1.sms_body')" rows="6">{{ $value['sms_body'] }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 {{ $key == 'send_ledger' ? 'hide' : '' }}">
                        <div class="form-group">
                            <label for="{{ $key }}_whatsapp_text">@lang('lang_v1.whatsapp_text'):</label>
                            <textarea name="template_data[{{ $key }}][whatsapp_text]" 
                                      class="form-control" id="{{ $key }}_whatsapp_text" 
                                      placeholder="@lang('lang_v1.whatsapp_text')" rows="6">{{ $value['whatsapp_text'] }}</textarea>
                        </div>
                    </div>

                    @if($key == 'new_sale')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="template_data[{{ $key }}][auto_send]" 
                                           class="input-icheck" value="1" 
                                           {{ $value['auto_send'] ? 'checked' : '' }}> @lang('lang_v1.autosend_email')
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="template_data[{{ $key }}][auto_send_sms]" 
                                           class="input-icheck" value="1" 
                                           {{ $value['auto_send_sms'] ? 'checked' : '' }}> @lang('lang_v1.autosend_sms')
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="template_data[{{ $key }}][auto_send_wa_notif]" 
                                           class="input-icheck" value="1" 
                                           {{ $value['auto_send_wa_notif'] ? 'checked' : '' }}> @lang('lang_v1.auto_send_wa_notif')
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
