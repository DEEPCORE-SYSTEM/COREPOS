<div class="modal-dialog" role="document">
  <div class="modal-content">

    <form action="{{ action('AccountController@update', $account->id) }}" method="POST" id="edit_payment_account_form">
        @csrf
        @method('PUT')

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('account.edit_account')</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="name">@lang('lang_v1.name')*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                        placeholder="@lang('lang_v1.name')" value="{{ $account->name }}">
                </div>

                <div class="form-group">
                    <label for="account_number">@lang('account.account_number')*</label>
                    <input type="text" name="account_number" id="account_number" class="form-control" required 
                        placeholder="@lang('account.account_number')" value="{{ $account->account_number }}">
                </div>

                <div class="form-group">
                    <label for="account_type_id">@lang('account.account_type')</label>
                    <select name="account_type_id" id="account_type_id" class="form-control select2">
                        <option>@lang('messages.please_select')</option>
                        @foreach($account_types as $account_type)
                            <optgroup label="{{ $account_type->name }}">
                                <option value="{{ $account_type->id }}" 
                                        {{ $account->account_type_id == $account_type->id ? 'selected' : '' }}>
                                    {{ $account_type->name }}
                                </option>
                                @foreach($account_type->sub_types as $sub_type)
                                    <option value="{{ $sub_type->id }}" 
                                            {{ $account->account_type_id == $sub_type->id ? 'selected' : '' }}>
                                        {{ $sub_type->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <label>@lang('lang_v1.account_details'):</label>
                <table class="table table-striped">
                    <tr>
                        <th>@lang('lang_v1.label')</th>
                        <th>@lang('product.value')</th>
                    </tr>
                    @if(!empty($account->account_details))
                        @foreach($account->account_details as $key => $account_detail)
                            <tr>
                                <td>
                                    <input type="text" name="account_details[{{ $key }}][label]" 
                                        class="form-control" 
                                        value="{{ $account_detail['label'] ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" name="account_details[{{ $key }}][value]" 
                                        class="form-control" 
                                        value="{{ $account_detail['value'] ?? '' }}">
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @for ($i = 0; $i < 6; $i++)
                            <tr>
                                <td>
                                    <input type="text" name="account_details[{{ $i }}][label]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="account_details[{{ $i }}][value]" class="form-control">
                                </td>
                            </tr>
                        @endfor
                    @endif
                </table>

                <div class="form-group">
                    <label for="note">@lang('brand.note')</label>
                    <textarea name="note" id="note" class="form-control" placeholder="@lang('brand.note')" rows="4">{{ $account->note }}</textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>
    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->