@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.add_page'))

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('superadmin::lang.add_page')</h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Formulario para crear una nueva página -->
    <form action="{{ action('\Modules\Superadmin\Http\Controllers\PageController@store') }}" method="POST" id="add_page_form">
        @csrf <!-- Token de seguridad para formularios en Laravel -->

        <!-- Primera caja: Información básica de la página -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">

                    <!-- Campo para el título de la página -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="title">@lang('superadmin::lang.page_title'):</label>
                            <input type="text" name="title" class="form-control" placeholder="@lang('superadmin::lang.page_title')" required>
                        </div>
                    </div>

                    <!-- Campo para el slug (URL amigable) -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="slug">@lang('superadmin::lang.slug'):</label>
                            <input type="text" name="slug" class="form-control" placeholder="@lang('superadmin::lang.slug')" required>
                        </div>
                    </div>

                    <!-- Campo para el orden en el menú -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="menu_order">
                                @lang('superadmin::lang.menu_order'):
                                <i class="fa fa-info-circle" data-toggle="tooltip" title="@lang('superadmin::lang.menu_order_tooltip')"></i>
                            </label>
                            <input type="number" name="menu_order" class="form-control" placeholder="@lang('superadmin::lang.menu_order')" value="0">
                        </div>
                    </div>

                    <!-- Checkbox para definir si la página es visible -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_shown" value="1" class="input-icheck" checked>
                                    @lang('superadmin::lang.is_visible')
                                </label>
                            </div>
                        </div>
                    </div>

                </div> <!-- Fin de la fila -->
            </div>
        </div> <!-- Fin de la primera caja -->

        <!-- Segunda caja: Contenido de la página -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="content">@lang('superadmin::lang.page_content'):</label>
                            <textarea name="content" class="form-control" placeholder="@lang('superadmin::lang.page_content')" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Fin de la segunda caja -->

        <!-- Botón para guardar la página -->
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary pull-right btn-flat">@lang('messages.save')</button>
            </div>
        </div>

    </form> <!-- Fin del formulario -->

</section>

@endsection

@section('javascript')
	@include('superadmin::pages.form_script')
@endsection