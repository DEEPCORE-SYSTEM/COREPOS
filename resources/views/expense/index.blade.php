@extends('layouts.app')
@section('title', __('expense.expenses'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('expense.expenses')</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Componente de filtros -->
            @component('components.filters', ['title' => __('report.filters')])
                @if(auth()->user()->can('all_expense.access'))
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="location_id">{{ __('purchase.business_location') }}:</label>
                            <select name="location_id" id="location_id" class="form-control select2" style="width:100%">
                                @foreach($business_locations as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="expense_for">{{ __('expense.expense_for') }}:</label>
                            <select name="expense_for" id="expense_for" class="form-control select2" style="width:100%">
                                @foreach($users as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="expense_contact_filter">{{ __('contact.contact') }}:</label>
                            <select name="expense_contact_filter" id="expense_contact_filter" class="form-control select2" style="width:100%">
                                <option value="">{{ __('lang_v1.all') }}</option>
                                @foreach($contacts as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="expense_category_id">{{ __('expense.expense_category') }}:</label>
                        <select name="expense_category_id" id="expense_category_id" class="form-control select2" style="width:100%">
                            <option value="">{{ __('report.all') }}</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="expense_date_range">{{ __('report.date_range') }}:</label>
                        <input type="text" name="date_range" id="expense_date_range" class="form-control" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="expense_payment_status">{{ __('purchase.payment_status') }}:</label>
                        <select name="expense_payment_status" id="expense_payment_status" class="form-control select2" style="width:100%">
                            <option value="">{{ __('lang_v1.all') }}</option>
                            <option value="paid">{{ __('lang_v1.paid') }}</option>
                            <option value="due">{{ __('lang_v1.due') }}</option>
                            <option value="partial">{{ __('lang_v1.partial') }}</option>
                        </select>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Componente de tabla de gastos -->
            @component('components.widget', ['class' => 'box-primary', 'title' => __('expense.all_expenses')])
                @can('expense.add')
                    @slot('tool')
                        <div class="box-tools">
                            <a class="btn btn-block btn-primary" href="{{ action('ExpenseController@create') }}">
                                <i class="fa fa-plus"></i> @lang('messages.add')
                            </a>
                        </div>
                    @endslot
                @endcan

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="expense_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.action')</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('lang_v1.recur_details')</th>
                                <th>@lang('expense.expense_category')</th>
                                <th>@lang('business.location')</th>
                                <th>@lang('sale.payment_status')</th>
                                <th>@lang('product.tax')</th>
                                <th>@lang('sale.total_amount')</th>
                                <th>@lang('purchase.payment_due')</th>
                                <th>@lang('expense.expense_for')</th>
                                <th>@lang('contact.contact')</th>
                                <th>@lang('expense.expense_note')</th>
                                <th>@lang('lang_v1.added_by')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                                <td class="footer_payment_status_count"></td>
                                <td></td>
                                <td class="footer_expense_total"></td>
                                <td class="footer_total_due"></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>
</section>

<!-- /.content -->
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')
 <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection