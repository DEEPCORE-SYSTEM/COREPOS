{{-- Descripción de la tarea con opción de edición --}}
<div class="task_description toggle_description_fields">
    {!! $project_task->description !!}
</div>

{{-- Formulario para actualizar la descripción de la tarea --}}
<form action="{{ url('project/task/update-description', ['id' => $project_task->id, 'project_id' => $project_task->project_id]) }}" 
      id="update_task_description" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <textarea name="description" class="form-control" id="edit_description_of_task">{{ $project_task->description }}</textarea>
    </div>

    {{-- Botón para guardar cambios --}}
    <button type="submit" class="btn btn-primary btn-sm save-description-btn">
        <span>@lang('messages.update')</span>
    </button>

    {{-- Botón para cerrar el formulario sin guardar --}}
    <button type="button" class="btn btn-default btn-sm close_update_task_description_form">
        @lang('messages.close')
    </button>
</form>
