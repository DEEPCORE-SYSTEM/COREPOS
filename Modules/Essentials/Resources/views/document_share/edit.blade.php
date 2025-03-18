<div class="modal-dialog" role="document">
  <div class="modal-content">
    <form action="{{ action('\Modules\Essentials\Http\Controllers\DocumentShareController@update', [$id]) }}" 
          method="POST" id="share_document_form">
        @csrf
        @method('PUT')

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center" id="exampleModalLabel">
                @if(!empty($type))
                    @lang('essentials::lang.share_memos')
                @else
                    @lang('essentials::lang.share_document')
                @endif
            </h4>
        </div>

        <div class="modal-body">
            <input type="hidden" name="document_id" id="document_id" value="{{ $id }}">

            <div class="form-group">
                <label for="user">@lang('essentials::lang.user'):</label> <br>
                <select name="user[]" id="user" class="form-control select2" multiple style="width: 50%; height:50%;">
                    @foreach($users as $key => $value)
                        <option value="{{ $key }}" {{ in_array($key, $shared_user) ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="role">@lang('essentials::lang.role'):</label> <br>
                <select name="role[]" id="role" class="form-control select2" multiple style="width: 50%; height:50%;">
                    @foreach($roles as $key => $value)
                        <option value="{{ $key }}" {{ in_array($key, $shared_role) ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary pull-right ladda-button doc-share-btn" data-style="expand-right">
                <span class="ladda-label">@lang('messages.update')</span>
            </button>
        </div>
    </form>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    __select2($('.select2'));
  })
</script>