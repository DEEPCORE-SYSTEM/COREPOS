@extends('layouts.app')
@section('title', __('essentials::lang.payroll'))

@section('content')
@include('essentials::layouts.nav_hrm')
<section class="content-header">
    <h1>@lang('essentials::lang.payroll')
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters'), 'class' => 'box-solid'])
                @if($is_admin)
                    <!-- Filtro de empleado -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user_id_filter">@lang('essentials::lang.employee'):</label>
                            <select name="user_id_filter" id="user_id_filter" class="form-control select2" style="width:100%">
                                <option value="">{{ __('lang_v1.all') }}</option>
                                @foreach($employees as $key => $employee)
                                    <option value="{{ $key }}">{{ $employee }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Filtro de departamento -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="department_id">@lang('essentials::lang.department'):</label>
                            <select name="department_id" id="department_id" class="form-control select2" style="width:100%">
                                <option value="">{{ __('lang_v1.all') }}</option>
                                @foreach($departments as $key => $department)
                                    <option value="{{ $key }}">{{ $department }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Filtro de designación -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation_id">@lang('essentials::lang.designation'):</label>
                            <select name="designation_id" id="designation_id" class="form-control select2" style="width:100%">
                                <option value="">{{ __('lang_v1.all') }}</option>
                                @foreach($designations as $key => $designation)
                                    <option value="{{ $key }}">{{ $designation }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <!-- Filtro de mes y año -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="month_year_filter">@lang('essentials::lang.month_year'):</label>
                        <div class="input-group">
                            <input type="text" name="month_year_filter" id="month_year_filter" class="form-control" placeholder="@lang('essentials::lang.month_year')">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid', 'title' => __( 'essentials::lang.all_payrolls' )])
                @if($is_admin)
                    @slot('tool')
                        <div class="box-tools">
                            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#payroll_modal">
                                <i class="fa fa-plus"></i> @lang( 'messages.add' )
                            </button>
                        </div>
                    @endslot
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="payrolls_table">
                        <thead>
                            <tr>
                                <th>@lang('essentials::lang.employee')</th>
                                <th>@lang('essentials::lang.department')</th>
                                <th>@lang('essentials::lang.designation')</th>
                                <th>@lang('essentials::lang.month_year')</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('sale.total_amount')</th>
                                <th>@lang('sale.payment_status')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>

    @if($is_admin)
        @includeIf('essentials::payroll.payroll_modal')
    @endif
</section>

<!-- /.content -->
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready( function(){
            payrolls_table = $('#payrolls_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{action('\Modules\Essentials\Http\Controllers\PayrollController@index')}}",
                    data: function (d) {
                        if ($('#user_id_filter').length) {
                            d.user_id = $('#user_id_filter').val();
                        }
                        d.month_year = $('#month_year_filter').val();
                        if ($('#department_id').length) {
                            d.department_id = $('#department_id').val();
                        }
                        if ($('#designation_id').length) {
                            d.designation_id = $('#designation_id').val();
                        }
                    },
                },
                columnDefs: [
                    {
                        targets: 7,
                        orderable: false,
                        searchable: false,
                    },
                ],
                columns: [
                    { data: 'user', name: 'user' },
                    { data: 'department', name: 'dept.name' },
                    { data: 'designation', name: 'dsgn.name' },
                    { data: 'transaction_date', name: 'transaction_date'},
                    { data: 'ref_no', name: 'ref_no'},
                    { data: 'final_total', name: 'final_total'},
                    { data: 'payment_status', name: 'payment_status'},
                    { data: 'action', name: 'action' },
                ],
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#payrolls_table'));
                },
            });

            $(document).on('change', '#user_id_filter, #month_year_filter, #department_id, #designation_id', function() {
                payrolls_table.ajax.reload();
            });

            if ($('#add_payroll_step1').length) {
                $('#add_payroll_step1').validate();
                $('#employee_id').select2({
                    dropdownParent: $('#payroll_modal')
                });
            }

            $('div.view_modal').on('shown.bs.modal', function(e) {
                __currency_convert_recursively($('.view_modal'));
            });

            $('#month_year, #month_year_filter').datepicker({
                autoclose: true,
                format: 'mm/yyyy',
                minViewMode: "months"
            });

            $(document).on('click', '.delete-payroll', function(e) {
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
                                    payrolls_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection
