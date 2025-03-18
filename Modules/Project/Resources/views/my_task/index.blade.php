@extends('layouts.app')
@section('title', __('project::lang.my_tasks'))
@section('content')
@include('project::layouts.nav')
<section class="content-header">
	<h3>
		<i class="fa fa-tasks"></i>
		@lang('project::lang.tasks')
	</h3>
</section>
<section class="content">
    <!-- Filtros de búsqueda -->
    @component('components.filters', ['title' => __('report.filters')])
        <div class="row">
            <!-- Filtro de Proyecto -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="project_id">@lang('project::lang.project'):</label>
                    <select name="project_id" id="project_id" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('messages.all') }}</option>
                        @foreach($projects as $id => $project)
                            <option value="{{ $id }}">{{ $project }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro de Usuario (Solo para administradores) -->
            @if($is_admin)
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="assigned_to_filter">@lang('project::lang.assigned_to'):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <select name="assigned_to_filter" id="assigned_to_filter" class="form-control select2" style="width: 100%;">
                                <option value="">{{ __('messages.all') }}</option>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Filtro de Estado -->
            <div class="col-md-3 status_filter">
                <div class="form-group">
                    <label for="status_filter">@lang('sale.status'):</label>
                    <select name="status_filter" id="status_filter" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('messages.all') }}</option>
                        @foreach($statuses as $id => $status)
                            <option value="{{ $id }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro de Prioridad -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="priority_filter">@lang('project::lang.priority'):</label>
                    <select name="priority_filter" id="priority_filter" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('messages.all') }}</option>
                        @foreach($priorities as $id => $priority)
                            <option value="{{ $id }}">{{ $priority }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro de Fecha de Vencimiento -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="due_date_filter">@lang('project::lang.due_date'):</label>
                    <select name="due_date_filter" id="due_date_filter" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('messages.all') }}</option>
                        @foreach($due_dates as $id => $due_date)
                            <option value="{{ $id }}">{{ $due_date }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endcomponent

    @php
        // Botón para cambiar la vista entre Lista y Tablero Kanban
        $tool = '<div class="btn-group btn-group-toggle pull-right m-5" data-toggle="buttons">
                    <label class="btn btn-info btn-sm active">
                        <input type="radio" name="task_view" value="list_view" class="my_task_view" checked>'
                        . __("project::lang.list_view").'
                    </label>
                    <label class="btn btn-info btn-sm">
                        <input type="radio" name="task_view" value="kanban" class="my_task_view">
                        '. __("project::lang.kanban_board").'
                    </label>
                </div>';
    @endphp

    <!-- Tabla de tareas -->
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'project::lang.my_tasks'), 'tool' => $tool])
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="my_task_table">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th class="col-md-2">@lang('project::lang.project')</th>
                        <th class="col-md-3">@lang('project::lang.subject')</th>
                        <th class="col-md-2">@lang('project::lang.assigned_to')</th>
                        <th>@lang('project::lang.priority')</th>
                        <th>@lang('business.start_date')</th>
                        <th>@lang('project::lang.due_date')</th>
                        <th>@lang('sale.status')</th>
                        <th>@lang('project::lang.assigned_by')</th>
                        <th>@lang('project::lang.task_custom_field_1')</th>
                        <th>@lang('project::lang.task_custom_field_2')</th>
                        <th>@lang('project::lang.task_custom_field_3')</th>
                        <th>@lang('project::lang.task_custom_field_4')</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- Tablero Kanban (Oculto por defecto) -->
        <div class="custom-kanban-board d-none">
            <div class="page">
                <div class="main">
                    <div class="meta-tasks-wrapper">
                        <div id="myKanban" class="meta-tasks"></div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</section>

<div class="modal fade project_task_model" tabindex="-1" role="dialog"></div>
<div class="modal fade view_project_task_model" tabindex="-1" role="dialog"></div>
<link rel="stylesheet" href="{{ asset('modules/project/sass/project.css?v=' . $asset_v) }}">
@endsection
@section('javascript')
<script src="{{ asset('modules/project/js/project.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		initializeMyTaskDataTable();
	});
</script>
@endsection