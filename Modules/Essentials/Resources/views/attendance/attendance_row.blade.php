<tr data-user_id="{{ $user->id }}">
    <td>
        {{ $user->user_full_name }}
    </td>
    <td>
        @if(empty($attendance->clock_in_time))
            <div class="input-group date">
                <input type="text" name="attendance[{{ $user->id }}][clock_in_time]" 
                       class="form-control date_time_picker" readonly required 
                       placeholder="@lang('essentials::lang.clock_in_time')">
                <span class="input-group-addon"><i class="fas fa-clock"></i></span>
            </div>
        @else
            {{ format_datetime($attendance->clock_in_time) }} <br>
            <small class="text-muted">
                (@lang('essentials::lang.clocked_in') - {{ \Carbon\Carbon::parse($attendance->clock_in_time)->diffForHumans(\Carbon\Carbon::now()) }})
            </small>
            <input type="hidden" name="attendance[{{ $user->id }}][id]" value="{{ $attendance->id }}">
        @endif
    </td>
    <td>
        <div class="input-group date">
            <input type="text" name="attendance[{{ $user->id }}][clock_out_time]" 
                   class="form-control date_time_picker" readonly 
                   placeholder="@lang('essentials::lang.clock_out_time')">
            <span class="input-group-addon"><i class="fas fa-clock"></i></span>
        </div>
    </td>
    <td>
        <select name="attendance[{{ $user->id }}][essentials_shift_id]" class="form-control">
            <option value="">@lang('messages.please_select')</option>
            @foreach($shifts as $key => $value)
                <option value="{{ $key }}" {{ !empty($attendance->essentials_shift_id) && $attendance->essentials_shift_id == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="text" name="attendance[{{ $user->id }}][ip_address]" 
               class="form-control" 
               placeholder="@lang('essentials::lang.ip_address')" 
               value="{{ $attendance->ip_address ?? '' }}">
    </td>
    <td>
        <textarea name="attendance[{{ $user->id }}][clock_in_note]" class="form-control" 
                  placeholder="@lang('essentials::lang.clock_in_note')" rows="3">{{ $attendance->clock_in_note ?? '' }}</textarea>
    </td>
    <td>
        <textarea name="attendance[{{ $user->id }}][clock_out_note]" class="form-control" 
                  placeholder="@lang('essentials::lang.clock_out_note')" rows="3">{{ $attendance->clock_out_note ?? '' }}</textarea>
    </td>
    <td>
        <button type="button" class="btn btn-xs btn-danger remove_attendance_row">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
