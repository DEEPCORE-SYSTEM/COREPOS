<div class="row mt-15">
    <div class="col-md-12">
        <div class="form-group">
            <label for="status_id_modal">@lang('sale.status'):</label>
            <select name="status_id" id="status_id_modal" class="form-control select2" required style="width:100%">
                <option value="">{{ __('messages.please_select') }}</option>
                @foreach($status_dropdown['statuses'] as $key => $status)
                    <option value="{{ $key }}" 
                        {{ (isset($status_update_data['status_id']) ? $status_update_data['status_id'] : $job_sheet->status_id) == $key ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="update_note">@lang('repair::lang.update_note'):</label>
            <textarea name="update_note" id="update_note" class="form-control" rows="3" 
                      placeholder="@lang('repair::lang.update_note')">{{ $status_update_data['update_note'] ?? '' }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <!-- Opciones de notificación -->
    <div class="col-md-8">
        <div class="form-group">
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="send_sms" value="1" id="send_sms" 
                        {{ !empty($status_update_data['send_sms']) ? 'checked' : '' }}> 
                    @lang('repair::lang.send_sms')
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="send_email" value="1" id="send_email" 
                        {{ !empty($status_update_data['send_email']) ? 'checked' : '' }}> 
                    @lang('repair::lang.send_email')
                </label>
            </div>
        </div>
    </div>

    <!-- Cuerpo del SMS -->
    <div class="col-md-12 sms_body" 
        style="{{ empty($status_update_data['send_sms']) ? 'display: none !important;' : '' }}">
        <div class="form-group">
            <label for="sms_body">@lang('lang_v1.sms_body'):</label>
            <textarea name="sms_body" id="sms_body" class="form-control" rows="4" 
                      placeholder="@lang('lang_v1.sms_body')">{{ $status_update_data['sms_body'] ?? '' }}</textarea>
            <p class="help-block">
                <label>{{ $status_template_tags['help_text'] }}:</label><br>
                {{ implode(', ', $status_template_tags['tags']) }}
            </p>
        </div>
    </div>
</div>

<!-- Plantilla de correo electrónico -->
<div class="row email_template" 
    style="{{ empty($status_update_data['send_email']) ? 'display: none !important;' : '' }}">
    <div class="col-md-12">
        <div class="form-group">
            <label for="email_subject">@lang('lang_v1.email_subject'):</label>
            <input type="text" name="email_subject" id="email_subject" class="form-control" 
                   placeholder="@lang('lang_v1.email_subject')" 
                   value="{{ $status_update_data['email_subject'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="email_body">@lang('lang_v1.email_body'):</label>
            <textarea name="email_body" id="email_body" class="form-control" rows="5" 
                      placeholder="@lang('lang_v1.email_body')">{{ $status_update_data['email_body'] ?? '' }}</textarea>
            <p class="help-block">
                <label>{{ $status_template_tags['help_text'] }}:</label><br>
                {{ implode(', ', $status_template_tags['tags']) }}
            </p>
        </div>
    </div>
</div>
