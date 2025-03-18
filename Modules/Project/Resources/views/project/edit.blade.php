<div class="modal-dialog modal-lg" role="document">
    <form action="{{ action('\Modules\Project\Http\Controllers\ProjectController@update', $project->id) }}" id="project_form" method="POST">
        @csrf <!-- Token de seguridad -->
        @method('PUT') <!-- Método PUT para actualizar -->

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    @lang('project::lang.edit_project')
                </h4>
            </div>

            <div class="modal-body">
                <!-- Nombre del proyecto -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">@lang('messages.name'):</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}" required>
                        </div>
                    </div>
                </div>

                <!-- Descripción del proyecto -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('lang_v1.description'):</label>
                            <textarea name="description" id="description" class="form-control">{{ $project->description }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Cliente, Estado y Líder del Proyecto -->
                <div class="row">
                    <!-- Cliente -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contact_id">@lang('role.customer'):</label>
                            <select name="contact_id" id="contact_id" class="form-control select2" style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($customers as $id => $customer)
                                    <option value="{{ $id }}" {{ $id == $project->contact_id ? 'selected' : '' }}>{{ $customer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">@lang('sale.status'):</label>
                            <select name="status" id="status" class="form-control select2" required style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ $id == $project->status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Líder del Proyecto -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lead_id">@lang('project::lang.lead'):</label>
                            <select name="lead_id" id="lead_id" class="form-control select2" required style="width: 100%;">
                                <option value="">{{ __('messages.please_select') }}</option>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ $id == $project->lead_id ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Fechas -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">@lang('business.start_date'):</label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker" value="{{ !empty($project->start_date) ? format_date($project->start_date) : '' }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">@lang('project::lang.end_date'):</label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker" value="{{ !empty($project->end_date) ? format_date($project->end_date) : '' }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Miembros y Categorías -->
                <div class="row">
                    <!-- Miembros del Proyecto -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">@lang('project::lang.members'):</label>
                            <select name="user_id[]" id="user_id" class="form-control select2" multiple required style="width: 100%;">
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ in_array($id, $project->members->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Categorías del Proyecto -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">@lang('project::lang.category'):</label>
                            <select name="category_id[]" id="category_id" class="form-control select2" multiple style="width: 100%;">
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ in_array($id, $project->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm ladda-button" data-style="expand-right">
                    <span class="ladda-label">@lang('messages.update')</span>
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    @lang('messages.close')
                </button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
