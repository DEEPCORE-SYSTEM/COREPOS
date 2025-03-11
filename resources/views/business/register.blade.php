@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')
<div class="login-form col-md-12 col-xs-12 right-col-content-register">
    
    <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
    <form action="{{ route('business.postRegister') }}" method="POST" id="business_register_form" enctype="multipart/form-data">
    @csrf
    @include('business.partials.register_form')
    <input type="hidden" name="package_id" value="{{ $package_id }}">
    <button type="submit">Enviar</button>
    </form>
</div>
@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('business.getRegister') }}?lang=" + $(this).val();
        });
    })
</script>
@endsection