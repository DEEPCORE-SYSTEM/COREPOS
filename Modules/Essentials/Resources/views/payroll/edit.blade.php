@extends('layouts.app')

@section('title', __( 'essentials::lang.edit_payroll' ))

@section('content')
@include('essentials::layouts.nav_hrm')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang( 'essentials::lang.edit_payroll' )</h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Formulario para actualizar nómina -->
    <form action="{{ action('\Modules\Essentials\Http\Controllers\PayrollController@update', [$payroll->id]) }}" 
          method="POST" id="add_payroll_form">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-12">
                @component('components.widget')
                    <div class="col-md-12">
                        <h4>
                            {!! __('essentials::lang.payroll_of_employee', [
                                'employee' => $payroll->transaction_for->user_full_name, 
                                'date' => $month_name . ' ' . $year
                            ]) !!}
                            (@lang('purchase.ref_no'): {{ $payroll->ref_no }})
                        </h4>
                        <br>
                    </div>

                    <!-- Duración total de trabajo -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="essentials_duration">@lang('essentials::lang.total_work_duration')*</label>
                            <input type="text" name="essentials_duration" id="essentials_duration" class="form-control input_number" 
                                   required placeholder="@lang('essentials::lang.total_work_duration')" 
                                   value="{{ $payroll->essentials_duration }}">
                        </div>
                    </div>

                    <!-- Unidad de duración -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="essentials_duration_unit">@lang('essentials::lang.duration_unit')</label>
                            <input type="text" name="essentials_duration_unit" id="essentials_duration_unit" class="form-control" 
                                   placeholder="@lang('essentials::lang.duration_unit')" value="{{ $payroll->essentials_duration_unit }}">
                        </div>
                    </div>

                    <!-- Monto por unidad de duración -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="essentials_amount_per_unit_duration">@lang('essentials::lang.amount_per_unit_duartion')*</label>
                            <input type="text" name="essentials_amount_per_unit_duration" id="essentials_amount_per_unit_duration" 
                                   class="form-control input_number" required placeholder="@lang('essentials::lang.amount_per_unit_duartion')" 
                                   value="{{ num_format($payroll->essentials_amount_per_unit_duration) }}">
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="total">@lang('sale.total')</label>
                            <input type="text" name="total" id="total" class="form-control input_number" 
                                   placeholder="@lang('sale.total')" 
                                   value="{{ num_format($payroll->essentials_duration * $payroll->essentials_amount_per_unit_duration) }}">
                        </div>
                    </div>
                @endcomponent
            </div>

            <!-- Tabla de asignaciones -->
            <div class="col-md-12">
                @component('components.widget')   
                    <h4>@lang('essentials::lang.allowances'):</h4>
                    <table class="table table-condensed" id="allowance_table">
                        <thead>
                            <tr>
                                <th class="col-md-5">@lang('essentials::lang.allowance')</th>
                                <th class="col-md-3">@lang('essentials::lang.amount_type')</th>
                                <th class="col-md-3">@lang('sale.amount')</th>
                                <th class="col-md-1">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_allowances = 0; @endphp
                            @forelse($allowances['allowance_names'] as $key => $value)
                                @include('essentials::payroll.allowance_and_deduction_row', [
                                    'add_button' => $loop->first,
                                    'type' => 'allowance',
                                    'name' => $value,
                                    'value' => $allowances['allowance_amounts'][$key],
                                    'amount_type' => $allowances['allowance_types'][$key] ?? 'fixed',
                                    'percent' => $allowances['allowance_percents'][$key] ?? 0
                                ])
                                @php $total_allowances += $allowances['allowance_amounts'][$key] ?? 0; @endphp
                            @empty
                                @include('essentials::payroll.allowance_and_deduction_row', ['add_button' => true, 'type' => 'allowance'])
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">@lang('sale.total')</th>
                                <td><span id="total_allowances" class="display_currency" data-currency_symbol="true">{{ $total_allowances }}</span></td>
                                <td>&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
                @endcomponent
            </div>

            <!-- Tabla de deducciones -->
            <div class="col-md-12">
                @component('components.widget')
                    <h4>@lang('essentials::lang.deductions'):</h4>
                    <table class="table table-condensed" id="deductions_table">
                        <thead>
                            <tr>
                                <th class="col-md-5">@lang('essentials::lang.deduction')</th>
                                <th class="col-md-3">@lang('essentials::lang.amount_type')</th>
                                <th class="col-md-3">@lang('sale.amount')</th>
                                <th class="col-md-1">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_deductions = 0; @endphp
                            @forelse($deductions['deduction_names'] as $key => $value)
                                @include('essentials::payroll.allowance_and_deduction_row', [
                                    'add_button' => $loop->first,
                                    'type' => 'deduction',
                                    'name' => $value,
                                    'value' => $deductions['deduction_amounts'][$key],
                                    'amount_type' => $deductions['deduction_types'][$key] ?? 'fixed',
                                    'percent' => $deductions['deduction_percents'][$key] ?? 0
                                ])
                                @php $total_deductions += $deductions['deduction_amounts'][$key] ?? 0; @endphp
                            @empty
                                @include('essentials::payroll.allowance_and_deduction_row', ['add_button' => true, 'type' => 'deduction'])
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">@lang('sale.total')</th>
                                <td><span id="total_deductions" class="display_currency" data-currency_symbol="true">{{ $total_deductions }}</span></td>
                                <td>&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
                @endcomponent
            </div>

            <!-- Monto bruto -->
            <div class="col-md-12">
                <h4 class="pull-right">@lang('essentials::lang.gross_amount'): 
                    <span id="gross_amount_text" class="display_currency" data-currency_symbol="true">{{ $payroll->final_total }}</span>
                </h4>
                <input type="hidden" name="final_total" id="gross_amount" value="{{ $payroll->final_total }}">
            </div>
        </div>

        <!-- Botón de actualización -->
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@stop
@section('javascript')
    @includeIf('essentials::payroll.form_script')
@endsection
