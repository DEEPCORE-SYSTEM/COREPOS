@extends('layouts.app')

@section('title', __('essentials::lang.messages'))

@section('content')
@include('essentials::layouts.nav_essentials')
<section class="content">
    <!-- Caja de chat -->
    <div class="box box-solid">
        <div class="box-header">
            <i class="fa fa-comments-o"></i>
            <h3 class="box-title">@lang('essentials::lang.messages')</h3>
        </div>

        <!-- Mensajes en el chat -->
        <div class="box-body" id="chat-box" style="height: 70vh; overflow-y: scroll;">
            @can('essentials.view_message')
                @foreach($messages as $message)
                    @include('essentials::messages.message_div')
                @endforeach
            @endcan
        </div>
        <!-- Fin de la sección de chat -->

        @can('essentials.create_message')
            <!-- Formulario para enviar mensajes -->
            <div class="box-footer">
                <form action="{{ action('\Modules\Essentials\Http\Controllers\EssentialsMessageController@store') }}" 
                      method="POST" id="add_essentials_msg_form">
                    @csrf

                    <div class="input-group">
                        <!-- Campo de texto para el mensaje -->
                        <textarea name="message" id="chat-msg" class="form-control" required rows="1" 
                                  placeholder="@lang('essentials::lang.type_message')"></textarea>

                        <!-- Selector de ubicación -->
                        <div class="input-group-addon" style="width: 137px; padding: 0; border: none;">
                            <select name="location_id" class="form-control" style="width: 100%;">
                                <option value="">@lang('lang_v1.select_location')</option>
                                @foreach($business_locations as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón para enviar el mensaje -->
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-success pull-right ladda-button" data-style="expand-right">
                                <span class="ladda-label"><i class="fa fa-plus"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
    </div>
    <!-- Fin de la caja de chat -->
</section>

@endsection

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		scroll_down_chat_div();
		$('#chat-msg').focus();
		$('form#add_essentials_msg_form').submit(function(e) {
			e.preventDefault();
			var msg = $('#chat-msg').val().trim();
			if(msg) {
				var data = $(this).serialize();
				var ladda = Ladda.create(document.querySelector('.ladda-button'));
				ladda.start();
				$.ajax({
					url: "{{action('\Modules\Essentials\Http\Controllers\EssentialsMessageController@store')}}",
					data: data,
					method: 'post',
					dataType: "json",
					success: function(result){
						ladda.stop();
						if(result.html) {
							$('div#chat-box').append(result.html);
							scroll_down_chat_div();
							$('#chat-msg').val('').focus();
						}
					}
				});
			}
		});

		$(document).on('click', 'a.chat-delete', function(e) {
			e.preventDefault();
			swal({
	          title: LANG.sure,
	          icon: "warning",
	          buttons: true,
	          dangerMode: true,
	        }).then((willDelete) => {
	            if (willDelete) {
	            	var chat_item = $(this).closest('.post');
					$.ajax({
						url: $(this).attr('href'),
						method: 'DELETE',
						dataType: "json",
						success: function(result){
							if(result.success == true){
								toastr.success(result.msg);
								chat_item.remove();
							} else {
								toastr.error(result.msg);
							}
						}
					});
	            }
	        });
		});
		var chat_refresh_interval = "{{config('essentials::config.chat_refresh_interval', 20)}}";
		chat_refresh_interval = parseInt(chat_refresh_interval) * 1000;
		setInterval(function(){ getNewMessages() }, chat_refresh_interval);
	});

	function scroll_down_chat_div() {
		var chat_box    = $('#chat-box');
		var height = chat_box[0].scrollHeight;
		chat_box.scrollTop(height);
	}

	function getNewMessages() {
		var last_chat_time =  $('div.msg-box').length ? $('div.msg-box:last').data('delivered-at') : '';
		$.ajax({
            url: "{{action('\Modules\Essentials\Http\Controllers\EssentialsMessageController@getNewMessages')}}?last_chat_time=" + last_chat_time,
            dataType: 'html',
            global: false,
            success: function(result) {
            	if(result.trim() != ''){
            		$('div#chat-box').append(result);
					scroll_down_chat_div();
            	}
            },
        });
	}
</script>
@endsection