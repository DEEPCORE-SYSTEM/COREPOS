@extends('layouts.app')
@section('title', __('project::lang.project_report'))

@section('content')
@include('project::layouts.nav')
<section class="content-header">
    <h1>
        @lang('report.reports')
        <small>
            @lang('project::lang.time_logs') @lang('project::lang.by_employees')
        </small>
    </h1>
</section>
<section class="content">
    @component('components.filters', ['title' => __('report.filters')])
        <div class="row">
            <!-- Filtro: Usuario -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employee_timelog_report_user_id">@lang('role.user'):</label>
                    <select id="employee_timelog_report_user_id" name="user_id[]" class="form-control select2" multiple style="width: 100%;">
                        @foreach($employees as $key => $employee)
                            <option value="{{ $key }}">{{ $employee }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro: Proyecto -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employee_timelog_report_project_id">@lang('project::lang.project'):</label>
                    <select id="employee_timelog_report_project_id" name="project_id[]" class="form-control select2" multiple style="width: 100%;">
                        @foreach($projects as $key => $project)
                            <option value="{{ $key }}">{{ $project }}</option>
                        @endforeach
                    </select>
                </div>    
            </div>

            <!-- Filtro: Rango de fechas -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employee_timelog_report_daterange">@lang('report.date_range'):</label>
                    <input type="text" id="employee_timelog_report_daterange" name="date_range" class="form-control" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                </div>
            </div>
        </div>
    @endcomponent

    <!-- Contenedor para los registros de tiempo del empleado -->
    <div class="box box-solid">
        <div class="box-body employee_time_logs_report">
            <!-- Aquí se cargarán los datos del reporte -->
        </div>
    </div>
</section>

@endsection
@section('javascript')
<script src="{{ asset('modules/project/js/project.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        getEmployeeTimeLogReport();
    });
</script>
@endsection