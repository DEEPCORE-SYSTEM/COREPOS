@extends('layouts.app')
@section('title', __('lang_v1.sell_return'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@lang('lang_v1.sell_return')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    {{-- Componente de Filtros --}}
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">{{ __('report.filters') }}</h3>
        </div>
        <div class="box-body row">
            {{-- Filtro por ubicación de negocio --}}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sell_list_filter_location_id">{{ __('purchase.business_location') }}:</label>
                    <select id="sell_list_filter_location_id" name="sell_list_filter_location_id" class="form-control select2" style="width:100%">
                        <option value="">{{ __('lang_v1.all') }}</option>
                        @foreach($business_locations as $id => $location)
                            <option value="{{ $id }}">{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{-- Filtro por cliente --}}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sell_list_filter_customer_id">{{ __('contact.customer') }}:</label>
                    <select id="sell_list_filter_customer_id" name="sell_list_filter_customer_id" class="form-control select2" style="width:100%">
                        <option value="">{{ __('lang_v1.all') }}</option>
                        @foreach($customers as $id => $customer)
                            <option value="{{ $id }}">{{ $customer }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{-- Filtro por rango de fechas --}}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sell_list_filter_date_range">{{ __('report.date_range') }}:</label>
                    <input type="text" id="sell_list_filter_date_range" name="sell_list_filter_date_range" class="form-control" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                </div>
            </div>
            
            {{-- Filtro por usuario que realizó la venta (solo si tiene permiso) --}}
            @can('access_sell_return')
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_by">{{ __('report.user') }}:</label>
                        <select id="created_by" name="created_by" class="form-control select2" style="width:100%">
                            @foreach($sales_representative as $id => $user)
                                <option value="{{ $id }}">{{ $user }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endcan
        </div>
    </div>

    {{-- Componente de Lista de Devoluciones --}}
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ __('lang_v1.sell_return') }}</h3>
        </div>
        <div class="box-body">
            {{-- Se incluye la lista de devoluciones de venta --}}
            @include('sell_return.partials.sell_return_list')
        </div>
    </div>

    {{-- Modales para pagos --}}
    <div class="modal fade payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
</section>


<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
<script>
    $(document).ready(function(){
        $('#sell_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                sell_return_table.ajax.reload();
            }
        );
        $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#sell_list_filter_date_range').val('');
            sell_return_table.ajax.reload();
        });

        sell_return_table = $('#sell_return_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": "/sell-return",
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

                    if($('#created_by').length) {
                        d.created_by = $('#created_by').val();
                    }
                }
            },
            columnDefs: [ {
                "targets": [7, 8],
                "orderable": false,
                "searchable": false
            } ],
            columns: [
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'parent_sale', name: 'T1.invoice_no'},
                { data: 'name', name: 'contacts.name'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'payment_status', name: 'payment_status'},
                { data: 'final_total', name: 'final_total'},
                { data: 'payment_due', name: 'payment_due'},
                { data: 'action', name: 'action'}
            ],
            "fnDrawCallback": function (oSettings) {
                var total_sell = sum_table_col($('#sell_return_table'), 'final_total');
                $('#footer_sell_return_total').text(total_sell);
                
                $('#footer_payment_status_count_sr').html(__sum_status_html($('#sell_return_table'), 'payment-status-label'));

                var total_due = sum_table_col($('#sell_return_table'), 'payment_due');
                $('#footer_total_due_sr').text(total_due);

                __currency_convert_recursively($('#sell_return_table'));
            },
            createdRow: function( row, data, dataIndex ) {
                $( row ).find('td:eq(2)').attr('class', 'clickable_td');
            }
        });
        $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #created_by',  function() {
            sell_return_table.ajax.reload();
        });
    })

    $(document).on('click', 'a.delete_sell_return', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            sell_return_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
</script>
	
@endsection