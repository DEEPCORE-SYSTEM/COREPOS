@extends('layouts.app')

@section('title', __('essentials::lang.todo'))

@extends('layouts.app')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Tarjeta con información de la tarea -->
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">
						<i class="ion ion-clipboard"></i>
						<small><code>({{ $todo->task_id }})</code></small> {{ $todo->task }}
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<strong>{{ __('business.start_date') }}:</strong> {{ format_date($todo->date) }}<br>
							<strong>{{ __('essentials::lang.end_date') }}:</strong> {{ $todo->end_date ? format_date($todo->end_date) : '' }}<br>
							<strong>{{ __('essentials::lang.estimated_hours') }}:</strong> {{ $todo->estimated_hours }}
						</div>
						<div class="col-md-4">
							<strong>{{ __('essentials::lang.assigned_by') }}:</strong> {{ optional($todo->assigned_by)->user_full_name }}<br>
							<strong>{{ __('essentials::lang.assigned_to') }}:</strong> {{ implode(', ', $users) }}
						</div>
						<div class="col-md-4">
							<strong>{{ __('essentials::lang.priority') }}:</strong> {{ $priorities[$todo->priority] ?? '' }}<br>
							<strong>{{ __('sale.status') }}:</strong> {{ $task_statuses[$todo->status] ?? '' }}
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<br>
							<strong>{{ __('lang_v1.description') }}:</strong> {!! $todo->description !!}
						</div>
					</div>
				</div>
			</div>

			<!-- Sección de pestañas -->
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#comments_tab" data-toggle="tab">
								<i class="fa fa-comment"></i> @lang('essentials::lang.comments')
							</a>
						</li>
						<li>
							<a href="#documents_tab" data-toggle="tab">
								<i class="fa fa-file"></i> @lang('lang_v1.documents')
							</a>
						</li>
						<li>
							<a href="#activities_tab" data-toggle="tab">
								<i class="fa fa-pen-square"></i> @lang('lang_v1.activities')
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<!-- Comentarios -->
						<div class="tab-pane active" id="comments_tab">
							<div class="row">
								<form action="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@addComment') }}" method="post" id="task_comment_form">
									@csrf
									<div class="col-md-6">
										<div class="form-group">
											<label for="comment">@lang('essentials::lang.add_comment'):</label>
											<textarea name="comment" rows="3" class="form-control" required></textarea>
											<input type="hidden" name="task_id" value="{{ $todo->id }}">
										</div>
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary pull-right">@lang('messages.add')</button>
									</div>
								</form>

								<div class="col-md-12">
									<hr>
									<div class="direct-chat-messages">
										@foreach ($todo->comments as $comment)
											@include('essentials::todo.comment', ['comment' => $comment])
										@endforeach
									</div>
								</div>
							</div>
						</div>

						<!-- Documentos -->
						<div class="tab-pane" id="documents_tab">
							<div class="row">
								<form action="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@uploadDocument') }}" method="post" id="task_upload_doc_form" enctype="multipart/form-data">
									@csrf
									<div class="col-md-12">
										<div class="form-group">
											<label for="documents">@lang('lang_v1.upload_documents'):</label>
											<input type="file" name="documents[]" id="documents" multiple required>
											<input type="hidden" name="task_id" value="{{ $todo->id }}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="description">@lang('lang_v1.description'):</label>
											<textarea name="description" class="form-control" rows="3"></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary pull-right">@lang('essentials::lang.upload')</button>
									</div>
								</form>

								<!-- Lista de documentos -->
								<div class="col-md-12">
									<hr>
									<table class="table">
										<thead>
											<tr>
												<th>@lang('lang_v1.documents')</th>
												<th>@lang('lang_v1.description')</th>
												<th>@lang('lang_v1.uploaded_by')</th>
												<th>@lang('lang_v1.download')</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($todo->media as $media)
												<tr>
													<td>{{ $media->display_name }}</td>
													<td>{{ $media->description }}</td>
													<td>{{ optional($media->uploaded_by_user)->user_full_name }}</td>
													<td>
														<a href="{{ $media->display_url }}" download class="btn btn-success btn-xs">@lang('lang_v1.download')</a>
														@if (auth()->user()->id == $media->uploaded_by || auth()->user()->id == $todo->created_by)
															<a href="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@deleteDocument', $media->id) }}" class="btn btn-danger btn-xs">
																<i class="fa fa-trash"></i> @lang('messages.delete')
															</a>
														@endif
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- Actividades -->
						<div class="tab-pane" id="activities_tab">
							<div class="row">
								<div class="col-md-12">
									@include('activity_log.activities', ['activity_type' => 'sell', 'statuses' => $task_statuses])
								</div>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</section>

<!-- Modal para agregar o editar tareas -->
<div class="modal fade" id="task_modal" tabindex="-1" role="dialog"></div>
@endsection


@section('javascript')
<script type="text/javascript">
//form submit
$(document).on('submit', 'form#task_comment_form', function(e){
	e.preventDefault();
	var url = $(this).attr("action");
	var method = $(this).attr("method");
	var data = $("form#task_comment_form").serialize();
	var ladda = Ladda.create(document.querySelector('.add-comment-btn'));
	ladda.start();
	$.ajax({
		method: method,
		url: url,
		data: data,
		dataType: "json",
		success: function(result){
			ladda.stop();
			if(result.success == true){
				toastr.success(result.msg);
				$('.direct-chat-messages').prepend(result.comment_html);
				$("form#task_comment_form").find('#comment').val('');
			} else {
				toastr.error(result.msg);
			}
		}
	});
});
$(document).on('click', '.delete-comment', function(e){
	var element = $(this);
	$.ajax({
		url: '/essentials/todo/delete-comment/' + element.data('comment_id'),
		dataType: "json",
		success: function(result){
			if(result.success == true){
				toastr.success(result.msg);
				element.closest('.direct-chat-msg').remove();
			} else {
				toastr.error(result.msg);
			}
		}
	});
});

$(document).on('click', '.delete-document', function(e){
	e.preventDefault();
	var element = $(this);
	var url = $(this).attr('href');
	$.ajax({
		url: url,
		dataType: "json",
		success: function(result){
			if(result.success == true){
				toastr.success(result.msg);
				element.closest('tr').remove();
			} else {
				toastr.error(result.msg);
			}
		}
	});
});
</script>
@endsection