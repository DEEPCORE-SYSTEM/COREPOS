<div class="row">
    <div class="col-md-12">
        <x-widget title="{{ __('essentials::lang.hrm_details') }}">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="essentials_department_id">{{ __('essentials::lang.department') }}:</label>
                    <select name="essentials_department_id" id="essentials_department_id" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($departments as $id => $name)
                            <option value="{{ $id }}" {{ isset($user) && $user->essentials_department_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="essentials_designation_id">{{ __('essentials::lang.designation') }}:</label>
                    <select name="essentials_designation_id" id="essentials_designation_id" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($designations as $id => $name)
                            <option value="{{ $id }}" {{ isset($user) && $user->essentials_designation_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-widget>
    </div>
</div>
