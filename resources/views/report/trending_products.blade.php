@extends('layouts.app')
@section('title', __('report.trending_products'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.trending_products')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row no-print">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
            <form action="{{ action('ReportController@getTrendingProducts') }}" method="GET">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="location_id">{{ __('purchase.business_location') }}:</label>
                        <select name="location_id" class="form-control select2" style="width:100%">
                            @foreach($business_locations as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category_id">{{ __('product.category') }}:</label>
                        <select name="category" id="category_id" class="form-control select2" style="width:100%">
                            <option value="">{{ __('messages.all') }}</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sub_category_id">{{ __('product.sub_category') }}:</label>
                        <select name="sub_category" id="sub_category_id" class="form-control select2" style="width:100%">
                            <option value="">{{ __('messages.all') }}</option>
                            <!-- Sub categories options will be populated dynamically -->
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="brand">{{ __('product.brand') }}:</label>
                        <select name="brand" class="form-control select2" style="width:100%">
                            <option value="">{{ __('messages.all') }}</option>
                            @foreach($brands as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="unit">{{ __('product.unit') }}:</label>
                        <select name="unit" class="form-control select2" style="width:100%">
                            <option value="">{{ __('messages.all') }}</option>
                            @foreach($units as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="trending_product_date_range">{{ __('report.date_range') }}:</label>
                        <input type="text" name="date_range" class="form-control" id="trending_product_date_range" placeholder="{{ __('lang_v1.select_a_date_range') }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="limit">{{ __('lang_v1.no_of_products') }}:</label>
                        <!-- Tooltip for no of products -->
                        <input type="number" name="limit" value="5" class="form-control" placeholder="{{ __('lang_v1.no_of_products') }}" min="1">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="product_type">{{ __('product.product_type') }}:</label>
                        <select name="product_type" class="form-control select2" style="width:100%">
                            <option value="single">{{ __('lang_v1.single') }}</option>
                            <option value="variable">{{ __('lang_v1.variable') }}</option>
                            <option value="combo">{{ __('lang_v1.combo') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary pull-right">{{ __('report.apply_filters') }}</button>
                </div>
            </form>
            
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @component('components.widget', ['class' => 'box-primary'])
                @slot('title')
                    @lang('report.top_trending_products') @show_tooltip(__('tooltip.top_trending_products'))
                @endslot
                {!! $chart->container() !!}
            @endcomponent
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary pull-right" 
            aria-label="Print" onclick="window.print();"
            ><i class="fa fa-print"></i> @lang( 'messages.print' )</button>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    {!! $chart->script() !!}
@endsection