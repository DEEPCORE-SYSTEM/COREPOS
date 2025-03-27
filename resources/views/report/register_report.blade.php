@extends('layouts.app')
@section('title', __('report.register_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.register_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
            <form action="{{ action('ReportController@getStockReport') }}" method="get" id="register_report_filter_form">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="register_user_id">{{ __('report.user') }}:</label>
                        <select name="register_user_id" id="register_user_id" class="form-control select2" style="width:100%">
                            <option value="">{{ __('report.all_users') }}</option>
                            @foreach($users as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="register_status">{{ __('sale.status') }}:</label>
                        <select name="register_status" id="register_status" class="form-control select2" style="width:100%">
                            <option value="">{{ __('report.all') }}</option>
                            <option value="open">{{ __('cash_register.open') }}</option>
                            <option value="close">{{ __('cash_register.close') }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="register_report_date_range">{{ __('report.date_range') }}:</label>
                        <input type="text" name="register_report_date_range" id="register_report_date_range" class="form-control" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                    </div>
                </div>
            </form>

            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
            <table class="table table-bordered table-striped" id="register_report_table">
                <thead>
                    <tr>
                        <th>@lang('report.open_time')</th>
                        <th>@lang('report.close_time')</th>
                        <th>@lang('sale.location')</th>
                        <th>@lang('report.user')</th>
                        <th>@lang('cash_register.total_card_slips')</th>
                        <th>@lang('cash_register.total_cheques')</th>
                        <th>@lang('cash_register.total_cash')</th>
                        <th>@lang('lang_v1.total_bank_transfer')</th>
                        <th>@lang('lang_v1.total_advance_payment')</th>
                        <th>{{$payment_types['custom_pay_1']}}</th>
                        <th>{{$payment_types['custom_pay_2']}}</th>
                        <th>{{$payment_types['custom_pay_3']}}</th>
                        <th>{{$payment_types['custom_pay_4']}}</th>
                        <th>{{$payment_types['custom_pay_5']}}</th>
                        <th>{{$payment_types['custom_pay_6']}}</th>
                        <th>{{$payment_types['custom_pay_7']}}</th>
                        <th>@lang('cash_register.other_payments')</th>
                        <th>@lang('sale.total')</th>
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                        <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                        <td class="footer_total_card_payment"></td>
                        <td class="footer_total_cheque_payment"></td>
                        <td class="footer_total_cash_payment"></td>
                        <td class="footer_total_bank_transfer_payment"></td>
                        <td class="footer_total_advance_payment"></td>'
                        <td class="footer_total_custom_pay_1"></td>
                        <td class="footer_total_custom_pay_2"></td>
                        <td class="footer_total_custom_pay_3"></td>
                        <td class="footer_total_custom_pay_4"></td>
                        <td class="footer_total_custom_pay_5"></td>
                        <td class="footer_total_custom_pay_6"></td>
                        <td class="footer_total_custom_pay_7"></td>
                        <td class="footer_total_other_payments"></td>
                        <td class="footer_total"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection