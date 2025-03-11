@extends('layouts.app')
@section('title', __( 'lang_v1.sales_order'))
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@lang('lang_v1.sales_order')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('report.filters') }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sell_list_filter_location_id">{{ __('purchase.business_location') }}:</label>
                        <select id="sell_list_filter_location_id" class="form-control select2" style="width:100%">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            @foreach($business_locations as $key => $location)
                                <option value="{{ $key }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sell_list_filter_customer_id">{{ __('contact.customer') }}:</label>
                        <select id="sell_list_filter_customer_id" class="form-control select2" style="width:100%">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            @foreach($customers as $key => $customer)
                                <option value="{{ $key }}">{{ $customer }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="so_list_filter_status">{{ __('sale.status') }}:</label>
                        <select id="so_list_filter_status" class="form-control select2" style="width:100%">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            @foreach($sales_order_statuses as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if(!empty($shipping_statuses))
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="so_list_shipping_status">{{ __('lang_v1.shipping_status') }}:</label>
                            <select id="so_list_shipping_status" class="form-control select2" style="width:100%">
                                <option value="">{{ __('lang_v1.all') }}</option>
                                @foreach($shipping_statuses as $key => $status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sell_list_filter_date_range">{{ __('report.date_range') }}:</label>
                        <input type="text" id="sell_list_filter_date_range" class="form-control" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('lang_v1.sales_orders') }}</h3>
            @can('so.create')
                <div class="box-tools">
                    <a class="btn btn-primary" href="{{ action('SellController@create') }}?sale_type=sales_order">
                        <i class="fa fa-plus"></i> {{ __('lang_v1.add_sales_order') }}
                    </a>
                </div>
            @endcan
        </div>

        @if(auth()->user()->can('so.view_own') || auth()->user()->can('so.view_all'))
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped ajax_view" id="sell_table">
                        <thead>
                            <tr>
                                <th>{{ __('messages.action') }}</th>
                                <th>{{ __('messages.date') }}</th>
                                <th>{{ __('restaurant.order_no') }}</th>
                                <th>{{ __('sale.customer_name') }}</th>
                                <th>{{ __('lang_v1.contact_no') }}</th>
                                <th>{{ __('sale.location') }}</th>
                                <th>{{ __('sale.status') }}</th>
                                <th>{{ __('lang_v1.shipping_status') }}</th>
                                <th>{{ __('lang_v1.quantity_remaining') }}</th>
                                <th>{{ __('lang_v1.added_by') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
</section>

<!-- /.content -->
@stop
@section('javascript')
@includeIf('sales_order.common_js')
<script type="text/javascript">
$(document).ready( function(){
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        sell_table.ajax.reload();
    });
    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        "ajax": {
            "url": '/sells?sale_type=sales_order',
            "data": function ( d ) {
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }

                if($('#sell_list_filter_location_id').length) {
                    d.location_id = $('#sell_list_filter_location_id').val();
                }
                d.customer_id = $('#sell_list_filter_customer_id').val();

                if ($('#so_list_filter_status').length) {
                    d.status = $('#so_list_filter_status').val();
                }
                if ($('#so_list_shipping_status').length) {
                    d.shipping_status = $('#so_list_shipping_status').val();
                }

                if($('#created_by').length) {
                    d.created_by = $('#created_by').val();
                }
            }
        },
        columnDefs: [ {
            "targets": 7,
            "orderable": false,
            "searchable": false
        } ],
        columns: [
            { data: 'action', name: 'action'},
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'conatct_name', name: 'conatct_name'},
            { data: 'mobile', name: 'contacts.mobile'},
            { data: 'business_location', name: 'bl.name'},
            { data: 'status', name: 'status'},
            { data: 'shipping_status', name: 'shipping_status'},
            { data: 'so_qty_remaining', name: 'so_qty_remaining', "searchable": false},
            { data: 'added_by', name: 'u.first_name'},
        ]
    });
    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #created_by, #so_list_filter_status, #so_list_shipping_status',  function() {
        sell_table.ajax.reload();
    });
});
</script>
	
@endsection