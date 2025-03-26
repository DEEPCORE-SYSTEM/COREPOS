<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Formulario para editar un grupo de clientes -->
        <form action="{{ action('CustomerGroupController@update', [$customer_group->id]) }}" method="POST"
            id="customer_group_edit_form">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('lang_v1.edit_customer_group')</h4>
            </div>

            <div class="modal-body">
                <!-- Campo para el nombre del grupo de clientes -->
                <div class="form-group">
                    <label for="name">@lang('lang_v1.customer_group_name'):</label>
                    <input type="text" name="name" id="name" class="form-control" required
                        placeholder="@lang('lang_v1.customer_group_name')" value="{{ $customer_group->name }}">
                </div>

                <!-- Selección del tipo de cálculo de precio -->
                <div class="form-group">
                    <label for="price_calculation_type">@lang('lang_v1.price_calculation_type'):</label>
                    <select name="price_calculation_type" id="price_calculation_type" class="form-control">
                        <option value="percentage"
                            {{ $customer_group->price_calculation_type == 'percentage' ? 'selected' : '' }}>
                            @lang('lang_v1.percentage')
                        </option>
                        <option value="selling_price_group"
                            {{ $customer_group->price_calculation_type == 'selling_price_group' ? 'selected' : '' }}>
                            @lang('lang_v1.selling_price_group')
                        </option>
                    </select>
                </div>

                <!-- Campo para el porcentaje de cálculo -->
                <div
                    class="form-group percentage-field {{ $customer_group->price_calculation_type != 'percentage' ? 'hide' : '' }}">
                    <label for="amount">@lang('lang_v1.calculation_percentage'):</label>
                    @show_tooltip(__('lang_v1.tooltip_calculation_percentage'))
                    <input type="text" name="amount" id="amount" class="form-control input_number"
                        placeholder="@lang('lang_v1.calculation_percentage')"
                        value="{{ num_format($customer_group->amount) }}">
                </div>

                <!-- Selección del grupo de precios de venta -->
                <div
                    class="form-group selling_price_group-field {{ $customer_group->price_calculation_type != 'selling_price_group' ? 'hide' : '' }}">
                    <label for="selling_price_group_id">@lang('lang_v1.selling_price_group'):</label>
                    <select name="selling_price_group_id" id="selling_price_group_id" class="form-control">
                        @foreach ($price_groups as $id => $group)
                        <option value="{{ $id }}"
                            {{ $customer_group->selling_price_group_id == $id ? 'selected' : '' }}>
                            {{ $group }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->