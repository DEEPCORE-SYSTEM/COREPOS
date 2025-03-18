@extends('layouts.app')
@section('title', __('purchase.purchases'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@lang('purchase.purchases')
        <small></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">
   
    <!-- Filtros de búsqueda -->
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('report.filters')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <!-- Filtro por ubicación -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="purchase_list_filter_location_id">@lang('purchase.business_location'):</label>
                        <select name="purchase_list_filter_location_id" id="purchase_list_filter_location_id" class="form-control select2" style="width: 100%;">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            @foreach($business_locations as $key => $location)
                                <option value="{{ $key }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filtro por proveedor -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="purchase_list_filter_supplier_id">@lang('purchase.supplier'):</label>
                        <select name="purchase_list_filter_supplier_id" id="purchase_list_filter_supplier_id" class="form-control select2" style="width: 100%;">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            @foreach($suppliers as $key => $supplier)
                                <option value="{{ $key }}">{{ $supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filtro por estado de la compra -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="purchase_list_filter_status">@lang('purchase.purchase_status'):</label>
                        <select name="purchase_list_filter_status" id="purchase_list_filter_status" class="form-control select2" style="width: 100%;">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            @foreach($orderStatuses as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filtro por estado de pago -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="purchase_list_filter_payment_status">@lang('purchase.payment_status'):</label>
                        <select name="purchase_list_filter_payment_status" id="purchase_list_filter_payment_status" class="form-control select2" style="width: 100%;">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            <option value="paid">{{ __('lang_v1.paid') }}</option>
                            <option value="due">{{ __('lang_v1.due') }}</option>
                            <option value="partial">{{ __('lang_v1.partial') }}</option>
                            <option value="overdue">{{ __('lang_v1.overdue') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Filtro por rango de fechas -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="purchase_list_filter_date_range">@lang('report.date_range'):</label>
                        <input type="text" name="purchase_list_filter_date_range" id="purchase_list_filter_date_range" class="form-control" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de todas las compras -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('purchase.all_purchases')</h3>
            @can('purchase.create')
                <div class="box-tools">
                    <a class="btn btn-primary" href="{{ url('purchases/create') }}">
                        <i class="fa fa-plus"></i> @lang('messages.add')
                    </a>
                </div>
            @endcan
        </div>
        <div class="box-body">
            @include('purchase.partials.purchase_table')
        </div>
    </div>

    <!-- Modales para productos, pagos y edición de pagos -->
    <div class="modal fade product_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

    <!-- Modal para actualizar el estado de la compra -->
    @include('purchase.partials.update_purchase_status_modal')
</section>


<section id="receipt_section" class="print_section"></section>

<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
<script>
        //Date range as a button
    $('#purchase_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
           purchase_table.ajax.reload();
        }
    );
    $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#purchase_list_filter_date_range').val('');
        purchase_table.ajax.reload();
    });

    $(document).on('click', '.update_status', function(e){
        e.preventDefault();
        $('#update_purchase_status_form').find('#status').val($(this).data('status'));
        $('#update_purchase_status_form').find('#purchase_id').val($(this).data('purchase_id'));
        $('#update_purchase_status_modal').modal('show');
    });

    $(document).on('submit', '#update_purchase_status_form', function(e){
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success == true) {
                    $('#update_purchase_status_modal').modal('hide');
                    toastr.success(result.msg);
                    purchase_table.ajax.reload();
                    $('#update_purchase_status_form')
                        .find('button[type="submit"]')
                        .attr('disabled', false);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });
</script>
	
@endsection