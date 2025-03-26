@php
$custom_labels = json_decode(session('business.custom_labels'), true);
$user_custom_field1 = !empty($custom_labels['user']['custom_field_1']) ? $custom_labels['user']['custom_field_1'] :
__('lang_v1.user_custom_field1');
$user_custom_field2 = !empty($custom_labels['user']['custom_field_2']) ? $custom_labels['user']['custom_field_2'] :
__('lang_v1.user_custom_field2');
$user_custom_field3 = !empty($custom_labels['user']['custom_field_3']) ? $custom_labels['user']['custom_field_3'] :
__('lang_v1.user_custom_field3');
$user_custom_field4 = !empty($custom_labels['user']['custom_field_4']) ? $custom_labels['user']['custom_field_4'] :
__('lang_v1.user_custom_field4');
@endphp
<div class="form-group col-md-3">
    <label for="user_dob">{{ __('lang_v1.dob') }}:</label>
    <input type="text" name="dob" id="user_dob" 
        class="form-control" placeholder="{{ __('lang_v1.dob') }}" 
        value="{{ !empty($user->dob) ? format_date($user->dob) : '' }}" readonly>
</div>

<div class="form-group col-md-3">
    <label for="gender">{{ __('lang_v1.gender') }}:</label>
    <select name="gender" id="gender" class="form-control">
        <option value="">{{ __('messages.please_select') }}</option>
        <option value="male" {{ !empty($user->gender) && $user->gender == 'male' ? 'selected' : '' }}>
            {{ __('lang_v1.male') }}
        </option>
        <option value="female" {{ !empty($user->gender) && $user->gender == 'female' ? 'selected' : '' }}>
            {{ __('lang_v1.female') }}
        </option>
        <option value="others" {{ !empty($user->gender) && $user->gender == 'others' ? 'selected' : '' }}>
            {{ __('lang_v1.others') }}
        </option>
    </select>
</div>

<div class="form-group col-md-3">
    <label for="marital_status">{{ __('lang_v1.marital_status') }}:</label>
    <select name="marital_status" id="marital_status" class="form-control">
        <option value="">{{ __('lang_v1.marital_status') }}</option>
        <option value="married" {{ !empty($user->marital_status) && $user->marital_status == 'married' ? 'selected' : '' }}>
            {{ __('lang_v1.married') }}
        </option>
        <option value="unmarried" {{ !empty($user->marital_status) && $user->marital_status == 'unmarried' ? 'selected' : '' }}>
            {{ __('lang_v1.unmarried') }}
        </option>
        <option value="divorced" {{ !empty($user->marital_status) && $user->marital_status == 'divorced' ? 'selected' : '' }}>
            {{ __('lang_v1.divorced') }}
        </option>
    </select>
</div>

<div class="form-group col-md-3">
    <label for="blood_group">{{ __('lang_v1.blood_group') }}:</label>
    <input type="text" name="blood_group" id="blood_group" 
        class="form-control" placeholder="{{ __('lang_v1.blood_group') }}" 
        value="{{ !empty($user->blood_group) ? $user->blood_group : '' }}">
</div>


<div class="clearfix"></div>

<div class="form-group col-md-3">
    <label for="contact_number">{{ __('lang_v1.mobile_number') }}:</label>
    <input type="text" name="contact_number" id="contact_number" 
        class="form-control" placeholder="{{ __('lang_v1.mobile_number') }}" 
        value="{{ !empty($user->contact_number) ? $user->contact_number : '' }}">
</div>

<div class="form-group col-md-3">
    <label for="alt_number">{{ __('business.alternate_number') }}:</label>
    <input type="text" name="alt_number" id="alt_number" 
        class="form-control" placeholder="{{ __('business.alternate_number') }}" 
        value="{{ !empty($user->alt_number) ? $user->alt_number : '' }}">
</div>

<div class="form-group col-md-3">
    <label for="family_number">{{ __('lang_v1.family_contact_number') }}:</label>
    <input type="text" name="family_number" id="family_number" 
        class="form-control" placeholder="{{ __('lang_v1.family_contact_number') }}" 
        value="{{ !empty($user->family_number) ? $user->family_number : '' }}">
</div>

<div class="form-group col-md-3">
    <label for="fb_link">{{ __('lang_v1.fb_link') }}:</label>
    <input type="text" name="fb_link" id="fb_link" 
        class="form-control" placeholder="{{ __('lang_v1.fb_link') }}" 
        value="{{ !empty($user->fb_link) ? $user->fb_link : '' }}">
</div>

<div class="form-group col-md-3">
    <label for="twitter_link">{{ __('lang_v1.twitter_link') }}:</label>
    <input type="text" name="twitter_link" id="twitter_link" 
        class="form-control" placeholder="{{ __('lang_v1.twitter_link') }}" 
        value="{{ !empty($user->twitter_link) ? $user->twitter_link : '' }}">
</div>

<div class="form-group col-md-3">
    <label for="social_media_1">{{ __('lang_v1.social_media', ['number' => 1]) }}:</label>
    <input type="text" name="social_media_1" id="social_media_1" 
        class="form-control" placeholder="{{ __('lang_v1.social_media', ['number' => 1]) }}" 
        value="{{ !empty($user->social_media_1) ? $user->social_media_1 : '' }}">
</div>


<div class="clearfix"></div>

{{-- Campo para la segunda red social --}}
<div class="form-group col-md-3">
    <label for="social_media_2">{{ __('lang_v1.social_media', ['number' => 2]) }}:</label>
    <input type="text" name="social_media_2" id="social_media_2" 
           class="form-control" 
           placeholder="{{ __('lang_v1.social_media', ['number' => 2]) }}" 
           value="{{ old('social_media_2', $user->social_media_2 ?? '') }}">
</div>

{{-- Campo personalizado 1 --}}
<div class="form-group col-md-3">
    <label for="custom_field_1">{{ $user_custom_field1 }}:</label>
    <input type="text" name="custom_field_1" id="custom_field_1" 
           class="form-control" 
           placeholder="{{ $user_custom_field1 }}" 
           value="{{ old('custom_field_1', $user->custom_field_1 ?? '') }}">
</div>

{{-- Campo personalizado 2 --}}
<div class="form-group col-md-3">
    <label for="custom_field_2">{{ $user_custom_field2 }}:</label>
    <input type="text" name="custom_field_2" id="custom_field_2" 
           class="form-control" 
           placeholder="{{ $user_custom_field2 }}" 
           value="{{ old('custom_field_2', $user->custom_field_2 ?? '') }}">
</div>

{{-- Campo personalizado 3 --}}
<div class="form-group col-md-3">
    <label for="custom_field_3">{{ $user_custom_field3 }}:</label>
    <input type="text" name="custom_field_3" id="custom_field_3" 
           class="form-control" 
           placeholder="{{ $user_custom_field3 }}" 
           value="{{ old('custom_field_3', $user->custom_field_3 ?? '') }}">
</div>

{{-- Campo personalizado 4 --}}
<div class="form-group col-md-3">
    <label for="custom_field_4">{{ $user_custom_field4 }}:</label>
    <input type="text" name="custom_field_4" id="custom_field_4" 
           class="form-control" 
           placeholder="{{ $user_custom_field4 }}" 
           value="{{ old('custom_field_4', $user->custom_field_4 ?? '') }}">
</div>

{{-- Nombre del tutor --}}
<div class="form-group col-md-3">
    <label for="guardian_name">{{ __('lang_v1.guardian_name') }}:</label>
    <input type="text" name="guardian_name" id="guardian_name" 
           class="form-control" 
           placeholder="{{ __('lang_v1.guardian_name') }}" 
           value="{{ old('guardian_name', $user->guardian_name ?? '') }}">
</div>

{{-- Nombre del documento de identificación --}}
<div class="form-group col-md-3">
    <label for="id_proof_name">{{ __('lang_v1.id_proof_name') }}:</label>
    <input type="text" name="id_proof_name" id="id_proof_name" 
           class="form-control" 
           placeholder="{{ __('lang_v1.id_proof_name') }}" 
           value="{{ old('id_proof_name', $user->id_proof_name ?? '') }}">
</div>

{{-- Número del documento de identificación --}}
<div class="form-group col-md-3">
    <label for="id_proof_number">{{ __('lang_v1.id_proof_number') }}:</label>
    <input type="text" name="id_proof_number" id="id_proof_number" 
           class="form-control" 
           placeholder="{{ __('lang_v1.id_proof_number') }}" 
           value="{{ old('id_proof_number', $user->id_proof_number ?? '') }}">
</div>

<div class="clearfix"></div>

{{-- Dirección permanente --}}
<div class="form-group col-md-6">
    <label for="permanent_address">{{ __('lang_v1.permanent_address') }}:</label>
    <textarea name="permanent_address" id="permanent_address" class="form-control" rows="3"
              placeholder="{{ __('lang_v1.permanent_address') }}">{{ old('permanent_address', $user->permanent_address ?? '') }}</textarea>
</div>

{{-- Dirección actual --}}
<div class="form-group col-md-6">
    <label for="current_address">{{ __('lang_v1.current_address') }}:</label>
    <textarea name="current_address" id="current_address" class="form-control" rows="3"
              placeholder="{{ __('lang_v1.current_address') }}">{{ old('current_address', $user->current_address ?? '') }}</textarea>
</div>

{{-- Encabezado de detalles bancarios --}}
<div class="col-md-12">
    <hr>
    <h4>{{ __('lang_v1.bank_details') }}:</h4>
</div>

{{-- Nombre del titular de la cuenta --}}
<div class="form-group col-md-3">
    <label for="account_holder_name">{{ __('lang_v1.account_holder_name') }}:</label>
    <input type="text" name="bank_details[account_holder_name]" id="account_holder_name" class="form-control"
           placeholder="{{ __('lang_v1.account_holder_name') }}"
           value="{{ old('bank_details.account_holder_name', $bank_details['account_holder_name'] ?? '') }}">
</div>

{{-- Número de cuenta bancaria --}}
<div class="form-group col-md-3">
    <label for="account_number">{{ __('lang_v1.account_number') }}:</label>
    <input type="text" name="bank_details[account_number]" id="account_number" class="form-control"
           placeholder="{{ __('lang_v1.account_number') }}"
           value="{{ old('bank_details.account_number', $bank_details['account_number'] ?? '') }}">
</div>

{{-- Nombre del banco --}}
<div class="form-group col-md-3">
    <label for="bank_name">{{ __('lang_v1.bank_name') }}:</label>
    <input type="text" name="bank_details[bank_name]" id="bank_name" class="form-control"
           placeholder="{{ __('lang_v1.bank_name') }}"
           value="{{ old('bank_details.bank_name', $bank_details['bank_name'] ?? '') }}">
</div>

{{-- Código del banco con tooltip --}}
<div class="form-group col-md-3">
    <label for="bank_code">{{ __('lang_v1.bank_code') }}:</label> 
    <span data-toggle="tooltip" title="{{ __('lang_v1.bank_code_help') }}">&#x1F6C8;</span>
    <input type="text" name="bank_details[bank_code]" id="bank_code" class="form-control"
           placeholder="{{ __('lang_v1.bank_code') }}"
           value="{{ old('bank_details.bank_code', $bank_details['bank_code'] ?? '') }}">
</div>

{{-- Sucursal del banco --}}
<div class="form-group col-md-3">
    <label for="branch">{{ __('lang_v1.branch') }}:</label>
    <input type="text" name="bank_details[branch]" id="branch" class="form-control"
           placeholder="{{ __('lang_v1.branch') }}"
           value="{{ old('bank_details.branch', $bank_details['branch'] ?? '') }}">
</div>

{{-- ID del contribuyente con tooltip --}}
<div class="form-group col-md-3">
    <label for="tax_payer_id">{{ __('lang_v1.tax_payer_id') }}:</label>
    <span data-toggle="tooltip" title="{{ __('lang_v1.tax_payer_id_help') }}">&#x1F6C8;</span>
    <input type="text" name="bank_details[tax_payer_id]" id="tax_payer_id" class="form-control"
           placeholder="{{ __('lang_v1.tax_payer_id') }}"
           value="{{ old('bank_details.tax_payer_id', $bank_details['tax_payer_id'] ?? '') }}">
</div>
