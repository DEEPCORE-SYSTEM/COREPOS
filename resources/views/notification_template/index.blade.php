@extends('layouts.app')
@section('title', __('lang_v1.notification_templates'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.notification_templates')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Formulario para almacenar las plantillas de notificación -->
    <form action="{{ action('NotificationTemplateController@store') }}" method="POST">
        @csrf {{-- Token de seguridad para evitar ataques CSRF --}}

        <div class="row">
            <div class="col-md-12">
                <!-- Widget para notificaciones generales -->
                @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.notifications') . ':'])
                    @include('notification_template.partials.tabs', ['templates' => $general_notifications])
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Widget para notificaciones de clientes -->
                @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.customer_notifications') . ':'])
                    @include('notification_template.partials.tabs', ['templates' => $customer_notifications])
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Widget para notificaciones de proveedores -->
                @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.supplier_notifications') . ':'])
                    @include('notification_template.partials.tabs', ['templates' => $supplier_notifications])

                    <!-- Nota sobre la limitación del logo en SMS -->
                    <div class="callout callout-warning">
                        <p>@lang('lang_v1.logo_not_work_in_sms'):</p>
                    </div>
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Botón para guardar las notificaciones -->
                <button type="submit" class="btn btn-danger pull-right">@lang('messages.save')</button>
            </div>
        </div>
    </form>
</section>

<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    $('textarea.ckeditor').each( function(){
        var editor_id = $(this).attr('id');
        tinymce.init({
            selector: 'textarea#'+editor_id,
        });
    });
</script>
@endsection