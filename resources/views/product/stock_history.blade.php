@extends('layouts.app')
@section('title', __('lang_v1.product_stock_history'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.product_stock_history')</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="form-group">
                <input type="text" name="search_product" class="form-control" id="search_product" placeholder="{{ __('lang_v1.search_product_to_edit') }}">
            </div>
        </div>
    </div>
    <br>

    <form action="{{ action('ProductController@bulkUpdate') }}" method="post" id="bulk_edit_products_form">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center table-bordered" id="product_table">
                    <thead id="product_table_head">
                        <tr class="bg-gray">
                            <th class="col-md-1">@lang('sale.product')</th>
                            <th class="col-md-2">@lang('product.category')</th>
                            <th class="col-md-2">@lang('product.sub_category')</th>
                            <th class="col-md-2">@lang('product.brand')</th>
                            <th class="col-md-2">@lang('product.tax')</th>
                            <th class="col-md-3">@lang('business.business_locations')</th>
                        </tr>
                    </thead>
                    @foreach($products as $product)
                        @include('product.partials.bulk_edit_product_row')
                    @endforeach
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
            </div>
        </div>
    </form>
</section>

<!-- /.content -->
@endsection

@section('javascript')
   <script type="text/javascript">
        $(document).ready( function(){
            load_stock_history($('#variation_id').val(), $('#location_id').val());
        });

       function load_stock_history(variation_id, location_id) {
            $('#product_stock_history').fadeOut();
            $.ajax({
                url: '/products/stock-history/' + variation_id + "?location_id=" + location_id,
                dataType: 'html',
                success: function(result) {
                    $('#product_stock_history')
                        .html(result)
                        .fadeIn();

                    __currency_convert_recursively($('#product_stock_history'));

                    $('#stock_history_table').DataTable({
                        searching: false,
                        ordering: false
                    });
                },
            });
       }

       $(document).on('change', '#variation_id, #location_id', function(){
            load_stock_history($('#variation_id').val(), $('#location_id').val());
       });
   </script>
@endsection