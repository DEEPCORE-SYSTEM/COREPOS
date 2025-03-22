<div class="modal-dialog modal-lg" role="document">
    <!-- Formulario para actualizar una nota o documento -->
    <form action="{{ action('DocumentAndNoteController@update', $document_note->id) }}" method="POST" id="docus_notes_form">
        @csrf <!-- Token de seguridad obligatorio en Laravel -->
        @method('PUT') <!-- Método PUT para actualizar datos -->

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('lang_v1.edit_note')</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="heading">@lang('lang_v1.heading'):</label>
                            <input type="text" name="heading" class="form-control" value="{{ $document_note->heading }}" required>
                        </div>
                    </div>
                </div>

                <!-- Campo oculto para el ID del modelo (ej. project_id, user_id) -->
                <input type="hidden" name="notable_id" value="{{ $document_note->notable_id }}">

                <!-- Campo oculto para el tipo de modelo (ej. App\User) -->
                <input type="hidden" name="notable_type" value="{{ $notable_type }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('lang_v1.description'):</label>
                            <textarea name="description" id="docs_note_description" class="form-control">{{ $document_note->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fileupload">@lang('lang_v1.documents'):</label>
                            <div class="dropzone" id="docusUpload"></div>
                        </div>
                        <input type="hidden" id="docus_notes_media" name="file_name[]" value="">
                    </div>
                </div>

                @if(Auth::user()->id == $document_note->created_by)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_private" value="1" {{ $document_note->is_private ? 'checked' : '' }}>
                                        @lang('lang_v1.is_private')
                                        <i class="fa fa-info-circle" data-toggle="tooltip" title="@lang('lang_v1.note_will_be_visible_to_u_only')"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    @lang('messages.update')
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    @lang('messages.close')
                </button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
