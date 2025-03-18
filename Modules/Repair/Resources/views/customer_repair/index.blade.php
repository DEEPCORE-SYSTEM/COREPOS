@extends('repair::layouts.repair_status')

@section('title', __('repair::lang.repair_status'))

@section('content')
<div class="login-form col-md-12 col-xs-12 right-col-content">
    <p class="form-header text-white">{{ __('repair::lang.repair_status') }}</p>

    <!-- Formulario para verificar el estado de la reparación -->
    <form method="POST" action="{{ url('repair/check-status') }}" id="check_repair_status">
        @csrf

        <!-- Selección del tipo de búsqueda y número de referencia -->
        <div class="form-group">
            @php
                $search_options = [
                    'job_sheet_no' => __('repair::lang.job_sheet_no'), 
                    'invoice_no' => __('sale.invoice_no')
                ];

                $placeholder = __('repair::lang.job_sheet_or_invoice_no');

                if (config('repair.enable_repair_check_using_mobile_num')) {
                    $search_options['mobile_num'] = __('lang_v1.mobile_number');
                    $placeholder .= ' / ' . __('lang_v1.mobile_number');
                }
            @endphp

            <div class="multi-input">
                <select name="search_type" class="form-control width-60 pull-left">
                    @foreach($search_options as $key => $option)
                        <option value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>

                <input type="text" name="search_number" class="form-control width-40 pull-left" required placeholder="{{ $placeholder }}">
            </div>
        </div>

        <!-- Campo para ingresar el número de serie -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fas fa-microchip"></i></div>
                <input type="text" name="serial_no" class="form-control" id="repair_serial_no" placeholder="@lang('repair::lang.serial_no')">
            </div>
        </div>

        <!-- Botón de búsqueda -->
        <div class="form-group">
            <button type="submit" class="btn-login btn btn-primary btn-flat ladda-button">
                @lang('lang_v1.search')
            </button>
        </div>
    </form>
</div>

<!-- Contenedor donde se mostrará el estado de la reparación -->
<div class="col-md-12 col-xs-12">
    <div class="row repair_status_details"></div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('submit', 'form#check_repair_status', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var ladda = Ladda.create(document.querySelector('.ladda-button'));
            ladda.start();

            $.ajax({
                method: 'POST',
                url: url,
                dataType: 'json',
                data: data,
                success: function(result) {
                    ladda.stop();
                    if (result.success) {
                        $(".repair_status_details").html(result.repair_html);
                        toastr.success(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
@endsection
