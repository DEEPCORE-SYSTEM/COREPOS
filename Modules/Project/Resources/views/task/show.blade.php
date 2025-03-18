<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            {{-- Botón para cerrar el modal --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            {{-- Título del modal con nombre de la tarea y botón de edición --}}
            <h3 class="modal-title">
                <i class="fa fa-tasks"></i>
                {{ $project_task->subject }}
                <code>({{ $project_task->task_id }})</code>
                <button data-href="{{ url('project/task/edit', ['id' => $project_task->id, 'project_id' => $project_task->project_id]) }}" 
                        class="btn btn-sm btn-primary pull-right">
                    <i class="fa fa-edit"></i>
                    {{ __("messages.edit") }}
                </button>
            </h3>

            {{-- Etiqueta con el nombre del proyecto --}}
            <span class="label label-primary mb-2" data-toggle="tooltip" title="@lang('project::lang.project')">
                <i class="fa fa-tag"></i> {{ $project_task->project->name }}
            </span>

            {{-- Fecha de vencimiento de la tarea (si existe) --}}
            @if(isset($project_task->due_date))
                <span class="label label-default mb-2" data-toggle="tooltip" title="@lang('project::lang.due_date')">
                    <i class="fa fa-calendar-times-o"></i>
                    {{ date('d/m/Y', strtotime($project_task->due_date)) }}
                </span>
            @endif

            {{-- Prioridad de la tarea con color dinámico --}}
            <span class="label mb-2 {{ $project_task->priority == 'low' ? 'bg-green' : ($project_task->priority == 'medium' ? 'bg-yellow' : ($project_task->priority == 'high' ? 'bg-orange' : 'bg-red')) }}"
                data-toggle="tooltip" title="@lang('project::lang.priority')">
                {{ __('project::lang.' . $project_task->priority) }}
            </span>

            {{-- Estado de la tarea con color dinámico --}}
            <span class="label mb-2 {{ $project_task->status == 'completed' ? 'bg-green' : ($project_task->status == 'cancelled' ? 'bg-red' : ($project_task->status == 'on_hold' ? 'bg-yellow' : ($project_task->status == 'in_progress' ? 'bg-info' : 'bg-red'))) }}"
                data-toggle="tooltip" title="@lang('sale.status')">
                {{ __('project::lang.' . $project_task->status) }}
            </span>

            {{-- Miembros asignados a la tarea --}}
            @includeIf('project::avatar.create', ['max_count' => '10', 'members' => $project_task->members])
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    {{-- Descripción de la tarea con opción de edición --}}
                    <h5>
                        <i class="fa fa-bars"></i>&nbsp;
                        <b>{{ __('lang_v1.description') }}</b>
                        <i class="fa fa-edit cursor-pointer edit_task_description toggle_description_fields" data-toggle="tooltip" title="@lang('messages.edit')"></i>
                    </h5>
                    <div class="form_n_description">
                        @includeIf('project::task.partials.edit_description')
                    </div>
                </div>
            </div>
            <hr>

            {{-- Registro de tiempo de la tarea (si está habilitado) --}}
            @if(!empty($project_task->project->settings['enable_timelog']))
                @includeIf('project::task.partials.time_log')
            @endif
            <hr>

            {{-- Formulario para agregar comentarios --}}
            <form action="{{ url('project/task/comment/store') }}" id="add_comment_form" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="fas fa-comments"></i> <b>{{ __('project::lang.add_comment') }}</b></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="comment">{{ __('project::lang.comment') }}:*</label>
                            <textarea name="comment" class="form-control" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="project_task_id" value="{{ $project_task->id }}">
                    </div>
                </div>

                {{-- Subida de archivos adjuntos --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group toggleMedia">
                            <label for="fileupload">@lang('project::lang.file_upload'):</label>
                            <div class="dropzone" id="fileupload"></div>
                        </div>
                        <input type="hidden" id="comment_media" name="file_name[]" value="">
                    </div>
                </div>

                {{-- Botones del formulario --}}
                <button type="button" class="btn btn-info btn-sm upload_doc">
                    @lang('project::lang.upload_doc')
                </button>
                <button type="submit" class="btn btn-primary btn-sm comment_btn">
                   <span class="ladda-label">@lang('project::lang.save_comment')</span>
                </button>
                <button type="button" class="btn btn-default btn-sm hide_upload_btn toggleMedia">
                    @lang('messages.close')
                </button>
            </form>

            <hr>

            {{-- Sección de actividad y comentarios previos --}}
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fas fa-comment-dots"></i> <b>{{ __('project::lang.activity') }}</b></h5>
                    <div class="direct-chat-messages" style="max-height: 500px;">
                        @includeIf('project::task.partials.comment', ['comments' => $project_task->comments])
                    </div>
                </div>
            </div>
        </div>

        {{-- Pie de página del modal --}}
        <div class="modal-footer">
            <span class="pull-left">
                <i class="fas fa-pencil-alt"></i>
                @lang('project::lang.added_this_task_on', ['name' => $project_task->createdBy->user_full_name])
                {{ date('d/m/Y', strtotime($project_task->created_at)) }}
            </span>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                @lang('messages.close')
            </button>
        </div>
    </div>
</div>
