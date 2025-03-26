<!-- Modal para editar el estado de la orden de venta -->
<div class="modal-dialog" role="document">
    <form action="{{ route('sales_order.update_status', ['id' => $id]) }}" method="POST" id="update_so_status_form">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('lang_v1.edit_status')</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="so_status">@lang('sale.status'):</label>
                            <select name="status" id="so_status" class="form-control" style="width: 100%;">
                                @foreach($statuses as $key => $so_status)
                                    <option value="{{ $key }}" @if($key == $status) selected @endif>
                                        {{ $so_status['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    @lang('messages.close')
                </button>
                <button type="submit" class="btn btn-primary ladda-button">
                    @lang('messages.update')
                </button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
