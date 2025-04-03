<div class="modal-dialog" role="document">
  <div class="modal-content">
    <form action="{{ action('SalesCommissionAgentController@store') }}" method="POST" id="sale_commission_agent_form">
      @csrf

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">@lang('lang_v1.add_sales_commission_agent')</h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="surname">@lang('business.prefix'):</label>
              <input type="text" name="surname" class="form-control" placeholder="@lang('business.prefix_placeholder')">
            </div>
          </div>

          <div class="col-md-5">
            <div class="form-group">
              <label for="first_name">@lang('business.first_name'):* </label>
              <input type="text" name="first_name" class="form-control" required placeholder="@lang('business.first_name')">
            </div>
          </div>

          <div class="col-md-5">
            <div class="form-group">
              <label for="last_name">@lang('business.last_name'):</label>
              <input type="text" name="last_name" class="form-control" placeholder="@lang('business.last_name')">
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="email">@lang('business.email'):</label>
              <input type="text" name="email" class="form-control" placeholder="@lang('business.email')">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="contact_no">@lang('lang_v1.contact_no'):</label>
              <input type="text" name="contact_no" class="form-control" placeholder="@lang('lang_v1.contact_no')">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="address">@lang('business.address'):</label>
              <textarea name="address" class="form-control" placeholder="@lang('business.address')" rows="3"></textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="cmmsn_percent">@lang('lang_v1.cmmsn_percent'):</label>
              <input type="text" name="cmmsn_percent" class="form-control input_number" placeholder="@lang('lang_v1.cmmsn_percent')" required>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
