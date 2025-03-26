<div class="tab-pane 
    @if(!empty($view_type) &&  $view_type == 'subscriptions')
        active
    @else
        ''
    @endif"
id="subscriptions_tab">
    <div class="row">
        <div class="col-md-12">
            @component('components.widget')
                <div class="col-md-3">
                <div class="form-group">
    <!-- Etiqueta para el campo de rango de fechas -->
    <label for="subscriptions_filter_date_range">@lang('report.date_range'):</label>

    <!-- Campo de entrada de texto para seleccionar un rango de fechas -->
    <input type="text" name="subscriptions_filter_date_range" id="subscriptions_filter_date_range" 
        class="form-control" placeholder="@lang('lang_v1.select_a_date_range')" readonly>
</div>

                </div>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('sale_pos.partials.subscriptions_table')
        </div>
    </div>
</div>