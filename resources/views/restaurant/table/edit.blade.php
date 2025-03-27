<div class="modal-dialog" role="document">
  <div class="modal-content">

    <form action="{{ action('Restaurant\TableController@update', [$table->id]) }}" method="POST" id="table_edit_form">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ __('restaurant.edit_table') }}</h4>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label for="name">{{ __('restaurant.table_name') }}:*</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ $table->name }}" required placeholder="{{ __('brand.brand_name') }}">
        </div>

        <div class="form-group">
          <label for="description">{{ __('restaurant.short_description') }}:</label>
          <input type="text" name="description" id="description" class="form-control" value="{{ $table->description }}" placeholder="{{ __('brand.short_description') }}">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
