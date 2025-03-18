<form action="{{ action('\Modules\Project\Http\Controllers\ProjectController@postSettings', ['project_id' => $project->id]) }}" id="settings_form" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Habilitar registro de tiempo -->
        <div class="col-md-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="enable_timelog" value="1" 
                        {{ isset($project->settings['enable_timelog']) && $project->settings['enable_timelog'] ? 'checked' : '' }}> 
                    @lang('project::lang.enable_timelog')
                </label>
            </div>
        </div>

        <!-- Habilitar notas y documentos -->
        <div class="col-md-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="enable_notes_documents" value="1" 
                        {{ isset($project->settings['enable_notes_documents']) && $project->settings['enable_notes_documents'] ? 'checked' : '' }}>
                    @lang('project::lang.enable_notes_documents')
                </label>
            </div>
        </div>

        <!-- Habilitar facturación -->
        <div class="col-md-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="enable_invoice" value="1" 
                        {{ isset($project->settings['enable_invoice']) && $project->settings['enable_invoice'] ? 'checked' : '' }}>
                    @lang('project::lang.enable_invoice')
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Vista de tareas -->
        <div class="col-md-4">
            <label>@lang('project::lang.task_view'):</label>
            <label class="radio-inline">
                <input type="radio" name="task_view" value="list_view" required 
                    {{ isset($project->settings['task_view']) && $project->settings['task_view'] == 'list_view' ? 'checked' : '' }}>
                @lang('project::lang.list_view')
            </label>
            <label class="radio-inline">
                <input type="radio" name="task_view" value="kanban" required 
                    {{ isset($project->settings['task_view']) && $project->settings['task_view'] == 'kanban' ? 'checked' : '' }}>
                @lang('project::lang.kanban_board')
            </label>
        </div>

        <!-- Prefijo de ID de tarea -->
        <div class="col-md-4">
            <div class="form-group form-inline">
                <label for="task_id_prefix">@lang('project::lang.task_id_prefix'):</label>
                <input type="text" id="task_id_prefix" name="task_id_prefix" class="form-control" required 
                    value="{{ $project->settings['task_id_prefix'] ?? '' }}">
            </div>
        </div>
    </div>

    <br>

    <!-- Permisos para miembros -->
    <div class="row">
        <div class="col-md-3"><label>@lang('user.permissions')</label></div>
        <div class="col-md-3"><label>@lang('project::lang.members')</label></div>
    </div>

    <!-- Permisos individuales -->
    <div class="row">
        <div class="col-md-3">
            <label for="members_crud_task">@lang('project::lang.add_a_task')</label>
        </div>
        <div class="col-md-3">
            <input type="checkbox" id="members_crud_task" name="members_crud_task" value="1" 
                {{ isset($project->settings['members_crud_task']) && $project->settings['members_crud_task'] ? 'checked' : '' }}>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label for="members_crud_timelog">@lang('project::lang.add_time_log')</label>
        </div>
        <div class="col-md-3">
            <input type="checkbox" id="members_crud_timelog" name="members_crud_timelog" value="1" 
                {{ isset($project->settings['members_crud_timelog']) && $project->settings['members_crud_timelog'] ? 'checked' : '' }}>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label for="members_crud_note">@lang('project::lang.add_notes_docs')</label>
        </div>
        <div class="col-md-3">
            <input type="checkbox" id="members_crud_note" name="members_crud_note" value="1" 
                {{ isset($project->settings['members_crud_note']) && $project->settings['members_crud_note'] ? 'checked' : '' }}>
        </div>
    </div>

    <!-- Botón de actualización -->
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-sm pull-right">
                @lang('messages.update')
            </button>
        </div>
    </div>
</form>
