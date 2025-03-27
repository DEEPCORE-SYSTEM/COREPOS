<div class="modal-dialog" role="document">
  <div class="modal-content">

    <form action="{{ action('Restaurant\ModifierSetsController@store') }}" method="POST" id="table_add_form">
      @csrf

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ __('restaurant.add_modifier') }}</h4>
      </div>

      <div class="modal-body">
        <div class="row">
        
          <div class="col-sm-12">
            <div class="form-group">
              <label for="name">{{ __('restaurant.modifier_set') }}:*</label>
              <input type="text" name="name" id="name" class="form-control" required placeholder="{{ __('lang_v1.name') }}">
            </div>
          </div>

          <div class="col-sm-12">
            <h4>{{ __('restaurant.modifiers') }}</h4>
          </div>

          <div class="col-sm-12">
            <table class="table table-condensed" id="add-modifier-table">
              <thead>
                <tr>
                  <th>{{ __('restaurant.modifier') }}</th>
                  <th>
                    {{ __('lang_v1.price') }}

                    @php
                      $html = '<tr><td>
                            <div class="form-group">
                              <input type="text" name="modifier_name[]" 
                              class="form-control" 
                              placeholder="' . __( 'lang_v1.name' ) . '" required>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <input type="text" name="modifier_price[]" class="form-control input_number" 
                              placeholder="' . __( 'lang_v1.price' ) . '" required>
                            </div>
                          </td>';

                      $html_other_row = $html . '<td>
                              <button class="btn btn-danger btn-xs pull-right remove-modifier-row" type="button"><i class="fa fa-minus"></i></button>
                            </td>
                          </tr>';

                      $html_first_row = $html . "<td>
                              <button class='btn btn-primary btn-xs pull-right add-modifier-row' type='button'
                              data-html='{{ $html_other_row }}'>
                              <i class='fa fa-plus'></i></button>
                            </td>
                          </tr>";
                    @endphp
                    
                  </th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                {!! $html_first_row !!}
              </tbody>
            </table>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
      </div>

    </form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
