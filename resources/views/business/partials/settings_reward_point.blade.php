<!-- Configuración del sistema de puntos de recompensa -->
<div class="pos-tab-content">

    <!-- Habilitar/Deshabilitar el sistema de puntos de recompensa -->
    <div class="row well">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_rp" value="1"
                            {{ $business->enable_rp ? 'checked' : '' }} 
                            class="input-icheck" id="enable_rp">
                        {{ __('lang_v1.enable_rp') }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Nombre del sistema de puntos de recompensa -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="rp_name">{{ __('lang_v1.rp_name') }}:</label>
                <input type="text" name="rp_name" id="rp_name"
                    class="form-control" placeholder="{{ __('lang_v1.rp_name') }}"
                    value="{{ $business->rp_name }}">
            </div>
        </div>
    </div>

    <!-- Configuración de acumulación de puntos -->
    <div class="row well">
        <div class="col-sm-12">
            <h4>{{ __('lang_v1.earning_points_setting') }}:</h4>
        </div>

        <!-- Monto necesario para obtener un punto -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="amount_for_unit_rp">
                    {{ __('lang_v1.amount_for_unit_rp') }}:
                </label>
                @show_tooltip(__('lang_v1.amount_for_unit_rp_tooltip'))
                <input type="text" name="amount_for_unit_rp" id="amount_for_unit_rp"
                    class="form-control input_number" placeholder="{{ __('lang_v1.amount_for_unit_rp') }}"
                    value="{{ number_format($business->amount_for_unit_rp, 2) }}">
            </div>
        </div>

        <!-- Pedido mínimo para acumular puntos -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="min_order_total_for_rp">
                    {{ __('lang_v1.min_order_total_for_rp') }}:
                </label>
                @show_tooltip(__('lang_v1.min_order_total_for_rp_tooltip'))
                <input type="text" name="min_order_total_for_rp" id="min_order_total_for_rp"
                    class="form-control input_number" placeholder="{{ __('lang_v1.min_order_total_for_rp') }}"
                    value="{{ number_format($business->min_order_total_for_rp, 2) }}">
            </div>
        </div>

        <!-- Máximo de puntos por pedido -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="max_rp_per_order">
                    {{ __('lang_v1.max_rp_per_order') }}:
                </label>
                @show_tooltip(__('lang_v1.max_rp_per_order_tooltip'))
                <input type="number" name="max_rp_per_order" id="max_rp_per_order"
                    class="form-control" placeholder="{{ __('lang_v1.max_rp_per_order') }}"
                    value="{{ $business->max_rp_per_order }}">
            </div>
        </div>
    </div>

    <!-- Configuración de canje de puntos -->
    <div class="row well">
        <div class="col-sm-12">
            <h4>{{ __('lang_v1.redeem_points_setting') }}:</h4>
        </div>

        <!-- Valor en dinero de cada punto -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="redeem_amount_per_unit_rp">
                    {{ __('lang_v1.redeem_amount_per_unit_rp') }}:
                </label>
                @show_tooltip(__('lang_v1.redeem_amount_per_unit_rp_tooltip'))
                <input type="text" name="redeem_amount_per_unit_rp" id="redeem_amount_per_unit_rp"
                    class="form-control input_number" placeholder="{{ __('lang_v1.redeem_amount_per_unit_rp') }}"
                    value="{{ number_format($business->redeem_amount_per_unit_rp, 2) }}">
            </div>
        </div>

        <!-- Pedido mínimo para canjear puntos -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="min_order_total_for_redeem">
                    {{ __('lang_v1.min_order_total_for_redeem') }}:
                </label>
                @show_tooltip(__('lang_v1.min_order_total_for_redeem_tooltip'))
                <input type="text" name="min_order_total_for_redeem" id="min_order_total_for_redeem"
                    class="form-control input_number" placeholder="{{ __('lang_v1.min_order_total_for_redeem') }}"
                    value="{{ number_format($business->min_order_total_for_redeem, 2) }}">
            </div>
        </div>

        <!-- Mínimo de puntos para canjear -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="min_redeem_point">
                    {{ __('lang_v1.min_redeem_point') }}:
                </label>
                @show_tooltip(__('lang_v1.min_redeem_point_tooltip'))
                <input type="number" name="min_redeem_point" id="min_redeem_point"
                    class="form-control" placeholder="{{ __('lang_v1.min_redeem_point') }}"
                    value="{{ $business->min_redeem_point }}">
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Máximo de puntos a canjear -->
        <div class="col-sm-4">
            <div class="form-group">
                <label for="max_redeem_point">
                    {{ __('lang_v1.max_redeem_point') }}:
                </label>
                @show_tooltip(__('lang_v1.max_redeem_point_tooltip'))
                <input type="number" name="max_redeem_point" id="max_redeem_point"
                    class="form-control" placeholder="{{ __('lang_v1.max_redeem_point') }}"
                    value="{{ $business->max_redeem_point }}">
            </div>
        </div>

        <!-- Período de expiración de los puntos -->
        <div class="col-sm-6">
            <div class="form-group">
                <label for="rp_expiry_period">
                    {{ __('lang_v1.rp_expiry_period') }}:
                </label>
                @show_tooltip(__('lang_v1.rp_expiry_period_tooltip'))
                <div class="input-group">
                    <input type="number" name="rp_expiry_period" id="rp_expiry_period"
                        class="form-control" placeholder="{{ __('lang_v1.rp_expiry_period') }}"
                        value="{{ $business->rp_expiry_period }}">
                    <span class="input-group-addon">-</span>
                    <select name="rp_expiry_type" class="form-control">
                        <option value="month" {{ $business->rp_expiry_type == 'month' ? 'selected' : '' }}>
                            {{ __('lang_v1.month') }}
                        </option>
                        <option value="year" {{ $business->rp_expiry_type == 'year' ? 'selected' : '' }}>
                            {{ __('lang_v1.year') }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</div>
