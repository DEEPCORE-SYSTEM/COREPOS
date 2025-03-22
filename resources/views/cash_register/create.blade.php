@extends('layouts.app')
@section('title',  __('cash_register.open_cash_register'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('cash_register.open_cash_register')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Formulario para abrir una caja registradora -->
    <form action="{{ action('CashRegisterController@store') }}" method="POST" id="add_cash_register_form">
        @csrf

        <div class="box box-solid">
            <div class="box-body">
                <br><br><br>

                <!-- Campo oculto para sub_type -->
                <input type="hidden" name="sub_type" value="{{ $sub_type }}">

                <div class="row">
                    @if($business_locations->count() > 0)
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="form-group">
                                <!-- Etiqueta para el campo de monto en caja -->
                                <label for="amount">@lang('cash_register.cash_in_hand') *</label>
                                <input type="text" name="amount" id="amount" class="form-control input_number" 
                                    placeholder="@lang('cash_register.enter_amount')" required>
                            </div>
                        </div>

                        @if(count($business_locations) > 1)
                            <div class="clearfix"></div>
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <!-- Etiqueta y selector para ubicación del negocio -->
                                    <label for="location_id">@lang('business.business_location')</label>
                                    <select name="location_id" id="location_id" class="form-control select2">
                                        <option value="">@lang('lang_v1.select_location')</option>
                                        @foreach($business_locations as $id => $location)
                                            <option value="{{ $id }}">{{ $location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <!-- Campo oculto si solo hay una ubicación disponible -->
                            <input type="hidden" name="location_id" value="{{ array_key_first($business_locations->toArray()) }}">
                        @endif

                        <div class="col-sm-8 col-sm-offset-2">
                            <!-- Botón para abrir caja registradora -->
                            <button type="submit" class="btn btn-primary pull-right">@lang('cash_register.open_register')</button>
                        </div>
                    @else
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h3>@lang('lang_v1.no_location_access_found')</h3>
                        </div>
                    @endif
                </div>
                <br><br><br>
            </div>
        </div>
    </form>
</section>

<!-- /.content -->
@endsection