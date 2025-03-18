@extends('layouts.app')
@section('title', __('project::lang.project'))

@section('content')
@include('project::layouts.nav')
<section class="content-header">
	<h1>
    	@lang('project::lang.projects')
    	<small> @lang('project::lang.all_projects')</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <!-- Mostrar la vista de lista si está activa -->
    @if($project_view == 'list_view')
        <div class="row">
            @foreach($project_stats as $project)
                <div class="col-md-3 col-sm-6 col-xs-12 col-custom project_stats">
                    <div class="info-box info-box-new-style">
                        <!-- Icono y color según el estado del proyecto -->
                        <span class="info-box-icon
                            {{ $project->status == 'not_started' ? 'bg-red' : '' }}
                            {{ $project->status == 'on_hold' ? 'bg-yellow' : '' }}
                            {{ $project->status == 'cancelled' ? 'bg-red' : '' }}
                            {{ $project->status == 'in_progress' ? 'bg-aqua' : '' }}
                            {{ $project->status == 'completed' ? 'bg-green' : '' }}">
                            <i class="fas 
                                {{ $project->status == 'not_started' ? 'fa-exclamation' : '' }}
                                {{ $project->status == 'on_hold' ? 'fa-exclamation-triangle' : '' }}
                                {{ $project->status == 'cancelled' ? 'fa-times-circle' : '' }}
                                {{ $project->status == 'in_progress' ? 'fa-sync' : '' }}
                                {{ $project->status == 'completed' ? 'fa-check' : '' }}">
                            </i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ $statuses[$project->status] }}</span>
                            <span class="info-box-number">{{ $project->count }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('project::lang.projects')</h3>
            <div class="box-tools pull-right">
                <!-- Botones para alternar entre lista y Kanban -->
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-info btn-sm {{ $project_view == 'list_view' ? 'active' : '' }}">
                        <input type="radio" name="project_view" value="list_view" class="project_view"
                            data-href="{{ action('\Modules\Project\Http\Controllers\ProjectController@index', ['project_view' => 'list_view']) }}">
                        @lang('project::lang.list_view')
                    </label>
                    <label class="btn btn-info btn-sm {{ $project_view == 'kanban' ? 'active' : '' }}">
                        <input type="radio" name="project_view" value="kanban" class="project_view"
                            data-href="{{ action('\Modules\Project\Http\Controllers\ProjectController@index', ['project_view' => 'kanban']) }}">
                        @lang('project::lang.kanban_board')
                    </label>
                </div>

                <!-- Botón para crear un nuevo proyecto (visible solo para usuarios autorizados) -->
                @can('project.create_project')
                    <button type="button" class="btn btn-primary btn-sm add_new_project"
                        data-href="{{ action('\Modules\Project\Http\Controllers\ProjectController@create') }}">
                        @lang('project::lang.new_project')&nbsp;<i class="fa fa-plus"></i>
                    </button>
                @endcan
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <!-- Filtros para la vista de lista -->
                @if($project_view == 'list_view')
                    <div class="col-md-3 project_status_filter">
                        <div class="form-group">
                            <label for="project_status_filter">@lang('sale.status'):</label>
                            <select id="project_status_filter" name="project_status_filter" class="form-control select2" style="width: 100%;">
                                <option value="">{{ __('messages.all') }}</option>
                                @foreach($statuses as $key => $status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <!-- Filtro por fecha de finalización -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="project_end_date_filter">@lang('project::lang.end_date'):</label>
                        <select id="project_end_date_filter" name="project_end_date_filter" class="form-control select2" style="width: 100%;">
                            <option value="">{{ __('messages.all') }}</option>
                            @foreach($due_dates as $key => $date)
                                <option value="{{ $key }}">{{ $date }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filtro por categoría -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="project_categories_filter">@lang('project::lang.category'):</label>
                        <select id="project_categories_filter" name="project_categories_filter" class="form-control select2" style="width: 100%;">
                            <option value="">{{ __('messages.all') }}</option>
                            @foreach($categories as $key => $category)
                                <option value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Mostrar lista de proyectos -->
            @if($project_view == 'list_view')
                <div class="project_html"></div>
            @endif

            <!-- Mostrar vista Kanban -->
            @if($project_view == 'kanban')
                <div class="project-kanban-board">
                    <div class="page">
                        <div class="main">
                            <div class="meta-tasks-wrapper">
                                <div id="myKanban" class="meta-tasks"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal para gestionar proyectos -->
    <div class="modal fade" tabindex="-1" role="dialog" id="project_model"></div>
</section>

<link rel="stylesheet" href="{{ asset('modules/project/sass/project.css?v=' . $asset_v) }}">
@endsection
@section('javascript')
<script src="{{ asset('modules/project/js/project.js?v=' . $asset_v) }}"></script>
<!-- get list of project on load of page -->
<script type="text/javascript">
	$(document).ready(function() {
		var project_view = urlSearchParam('project_view');

		//if project view is empty, set default to list_view
		if (_.isEmpty(project_view)) {
			project_view = 'list_view';
		}

		if (project_view == 'kanban') {
			$('.kanban').addClass('active');
			$('.list').removeClass('active');
			initializeProjectKanbanBoard();
		} else if(project_view == 'list_view') {
			getProjectList();
		}
	});
</script>
@endsection