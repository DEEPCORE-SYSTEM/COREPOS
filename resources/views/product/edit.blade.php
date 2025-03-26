@extends('layouts.app')
@section('title', __('product.edit_product'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('product.edit_product')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ action('ProductController@update', [$product->id]) }}" method="POST" id="product_add_form"
        class="product_form" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="hidden" id="product_id" value="{{ $product->id }}">

        @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="name">{{ __('product.product_name') }}:*</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required
                        placeholder="{{ __('product.product_name') }}">
                </div>
            </div>

            <div
                class="col-sm-4 {{ !(session('business.enable_category') && session('business.enable_sub_category')) ? 'hide' : '' }}">
                <div class="form-group">
                    <label for="sku">{{ __('product.sku') }}:*</label>
                    <input type="text" name="sku" id="sku" value="{{ $product->sku }}" class="form-control"
                        placeholder="{{ __('product.sku') }}" required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="barcode_type">{{ __('product.barcode_type') }}:*</label>
                    <select name="barcode_type" id="barcode_type" class="form-control select2" required>
                        <!-- Options will be inserted dynamically using $barcode_types -->
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="unit_id">{{ __('product.unit') }}:*</label>
                    <div class="input-group">
                        <select name="unit_id" id="unit_id" class="form-control select2" required>
                            <!-- Options will be inserted dynamically using $units -->
                        </select>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat quick_add_unit btn-modal"
                                data-href="{{action('UnitController@create', ['quick_add' => true])}}"
                                title="@lang('unit.add_unit')" data-container=".view_modal">
                                <i class="fa fa-plus-circle text-primary fa-lg"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 {{ !session('business.enable_sub_units') ? 'hide' : '' }}">
                <div class="form-group">
                    <label for="sub_unit_ids">{{ __('lang_v1.related_sub_units') }}:</label>
                    <select name="sub_unit_ids[]" id="sub_unit_ids" class="form-control select2" multiple>
                        <!-- Options will be inserted dynamically using $sub_units -->
                    </select>
                </div>
            </div>

            <div class="col-sm-4 {{ !session('business.enable_brand') ? 'hide' : '' }}">
                <div class="form-group">
                    <label for="brand_id">{{ __('product.brand') }}:</label>
                    <div class="input-group">
                        <select name="brand_id" id="brand_id" class="form-control select2">
                            <!-- Options will be inserted dynamically using $brands -->
                        </select>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat btn-modal"
                                data-href="{{action('BrandController@create', ['quick_add' => true])}}"
                                title="@lang('brand.add_brand')" data-container=".view_modal">
                                <i class="fa fa-plus-circle text-primary fa-lg"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-sm-4 {{ !session('business.enable_category') ? 'hide' : '' }}">
                <div class="form-group">
                    <label for="category_id">{{ __('product.category') }}:</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <!-- Options will be inserted dynamically using $categories -->
                    </select>
                </div>
            </div>

            <div
                class="col-sm-4 {{ !(session('business.enable_category') && session('business.enable_sub_category')) ? 'hide' : '' }}">
                <div class="form-group">
                    <label for="sub_category_id">{{ __('product.sub_category') }}:</label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control select2">
                        <!-- Options will be inserted dynamically using $sub_categories -->
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="product_locations">{{ __('business.business_locations') }}:</label>
                    <select name="product_locations[]" id="product_locations" class="form-control select2" multiple>
                        <!-- Options will be inserted dynamically using $business_locations -->
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">
                <div class="form-group">
                    <br>
                    <label>
                        <input type="checkbox" name="enable_stock" id="enable_stock" value="1"
                            {{ $product->enable_stock ? 'checked' : '' }} class="input-icheck">
                        <strong>@lang('product.manage_stock')</strong>
                    </label>
                    <p class="help-block"><i>@lang('product.enable_stock_help')</i></p>
                </div>
            </div>
            <div class="col-sm-4" id="alert_quantity_div" {{ !$product->enable_stock ? 'style=display:none' : '' }}>
                <div class="form-group">
                    <label for="alert_quantity">{{ __('product.alert_quantity') }}:</label>
                    <input type="text" name="alert_quantity" id="alert_quantity"
                        value="{{ @format_quantity($product->alert_quantity) }}" class="form-control input_number"
                        placeholder="{{ __('product.alert_quantity') }}" min="0">
                </div>
            </div>

            @if(!empty($common_settings['enable_product_warranty']))
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="warranty_id">{{ __('lang_v1.warranty') }}:</label>
                    <select name="warranty_id" id="warranty_id" class="form-control select2">
                        <!-- Options will be inserted dynamically using $warranties -->
                    </select>
                </div>
            </div>
            @endif

            <!-- include module fields -->
            @if(!empty($pos_module_data))
            @foreach($pos_module_data as $key => $value)
            @if(!empty($value['view_path']))
            @includeIf($value['view_path'], ['view_data' => $value['view_data']])
            @endif
            @endforeach
            @endif

            <div class="clearfix"></div>

            <div class="col-sm-8">
                <div class="form-group">
                    <label for="product_description">{{ __('lang_v1.product_description') }}:</label>
                    <textarea name="product_description" id="product_description"
                        class="form-control">{{ $product->product_description }}</textarea>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="image">{{ __('lang_v1.product_image') }}:</label>
                    <input type="file" name="image" id="upload_image" accept="image/*">
                    <small>
                        <p class="help-block">@lang('purchase.max_file_size', ['size' =>
                            (config('constants.document_size_limit') / 1000000)]).
                            @lang('lang_v1.aspect_ratio_should_be_1_1') @if(!empty($product->image)) <br>
                            @lang('lang_v1.previous_image_will_be_replaced') @endif</p>
                    </small>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="product_brochure">{{ __('lang_v1.product_brochure') }}:</label>
                    <input type="file" name="product_brochure" id="product_brochure"
                        accept="{{ implode(',', array_keys(config('constants.document_upload_mimes_types'))) }}">
                    <small>
                        <p class="help-block">
                            @lang('lang_v1.previous_file_will_be_replaced')<br>
                            @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                            1000000)])
                            @includeIf('components.document_help_text')
                        </p>
                    </small>
                </div>
            </div>
        </div>
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            @if(session('business.enable_product_expiry'))

            @if(session('business.expiry_type') == 'add_expiry')
            @php
            $expiry_period = 12;
            $hide = true;
            @endphp
            @else
            @php
            $expiry_period = null;
            $hide = false;
            @endphp
            @endif
            <div class="col-sm-4 @if($hide) hide @endif">
                <div class="form-group">
                    <div class="multi-input">
                        @php
                        $disabled = false;
                        $disabled_period = false;
                        if( empty($product->expiry_period_type) || empty($product->enable_stock) ){
                        $disabled = true;
                        }
                        if( empty($product->enable_stock) ){
                        $disabled_period = true;
                        }
                        @endphp
                        <label for="expiry_period">@lang('product.expires_in'):</label><br>
                        <input type="text" name="expiry_period"
                            value="{{ old('expiry_period', $product->expiry_period) }}"
                            class="form-control pull-left input_number" placeholder="@lang('product.expiry_period')"
                            style="width:60%;" @if($disabled) disabled @endif>
                        <select name="expiry_period_type" class="form-control select2 pull-left" style="width:40%;"
                            id="expiry_period_type" @if($disabled_period) disabled @endif>
                            <option value="months" @if($product->expiry_period_type == 'months') selected @endif>
                                @lang('product.months')
                            </option>
                            <option value="days" @if($product->expiry_period_type == 'days') selected @endif>
                                @lang('product.days')
                            </option>
                            <option value="" @if($product->expiry_period_type == '') selected @endif>
                                @lang('product.not_applicable')
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_sr_no" value="1" class="input-icheck"
                            @if($product->enable_sr_no) checked @endif>
                        <strong>@lang('lang_v1.enable_imei_or_sr_no')</strong>
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_sr_no'))
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <br>
                    <label>
                        <input type="checkbox" name="not_for_selling" value="1" class="input-icheck"
                            @if($product->not_for_selling) checked @endif>
                        <strong>@lang('lang_v1.not_for_selling')</strong>
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
                </div>
            </div>

            <div class="clearfix"></div>

            <!-- Rack, Row & position number -->
            @if(session('business.enable_racks') || session('business.enable_row') ||
            session('business.enable_position'))
            <div class="col-md-12">
                <h4>@lang('lang_v1.rack_details'):
                    @show_tooltip(__('lang_v1.tooltip_rack_details'))
                </h4>
            </div>
            @foreach($business_locations as $id => $location)
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="rack_{{ $id }}">{{ $location }}:</label>

                    @if(!empty($rack_details[$id]))
                    @if(session('business.enable_racks'))
                    <input type="text" name="product_racks_update[{{ $id }}][rack]"
                        value="{{ $rack_details[$id]['rack'] }}" class="form-control" id="rack_{{ $id }}">
                    @endif

                    @if(session('business.enable_row'))
                    <input type="text" name="product_racks_update[{{ $id }}][row]"
                        value="{{ $rack_details[$id]['row'] }}" class="form-control">
                    @endif

                    @if(session('business.enable_position'))
                    <input type="text" name="product_racks_update[{{ $id }}][position]"
                        value="{{ $rack_details[$id]['position'] }}" class="form-control">
                    @endif
                    @else
                    <input type="text" name="product_racks[{{ $id }}][rack]" value="" class="form-control"
                        id="rack_{{ $id }}" placeholder="@lang('lang_v1.rack')">
                    <input type="text" name="product_racks[{{ $id }}][row]" value="" class="form-control"
                        placeholder="@lang('lang_v1.row')">
                    <input type="text" name="product_racks[{{ $id }}][position]" value="" class="form-control"
                        placeholder="@lang('lang_v1.position')">
                    @endif

                </div>
            </div>
            @endforeach
            @endif

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="weight">@lang('lang_v1.weight'):</label>
                    <input type="text" name="weight" value="{{ old('weight', $product->weight) }}" class="form-control"
                        placeholder="@lang('lang_v1.weight')">
                </div>
            </div>
            <div class="clearfix"></div>

            @php
            $custom_labels = json_decode(session('business.custom_labels'), true);
            $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ?
            $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
            $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ?
            $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
            $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ?
            $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
            $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ?
            $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
            @endphp

            <!-- Custom fields -->
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field1">{{ $product_custom_field1 }}:</label>
                    <input type="text" name="product_custom_field1"
                        value="{{ old('product_custom_field1', $product->product_custom_field1) }}" class="form-control"
                        placeholder="{{ $product_custom_field1 }}">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field2">{{ $product_custom_field2 }}:</label>
                    <input type="text" name="product_custom_field2"
                        value="{{ old('product_custom_field2', $product->product_custom_field2) }}" class="form-control"
                        placeholder="{{ $product_custom_field2 }}">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field3">{{ $product_custom_field3 }}:</label>
                    <input type="text" name="product_custom_field3"
                        value="{{ old('product_custom_field3', $product->product_custom_field3) }}" class="form-control"
                        placeholder="{{ $product_custom_field3 }}">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="product_custom_field4">{{ $product_custom_field4 }}:</label>
                    <input type="text" name="product_custom_field4"
                        value="{{ old('product_custom_field4', $product->product_custom_field4) }}" class="form-control"
                        placeholder="{{ $product_custom_field4 }}">
                </div>
            </div>

            <!-- Custom fields -->
            @include('layouts.partials.module_form_part')
        </div>

        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-4 @if(!session('business.enable_price_tax')) hide @endif">
                <div class="form-group">
                    <label for="tax">{{ __('product.applicable_tax') }}:</label>
                    <select name="tax" class="form-control select2">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($taxes as $key => $value)
                        <option value="{{ $key }}" @if($product->tax == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-4 @if(!session('business.enable_price_tax')) hide @endif">
                <div class="form-group">
                    <label for="tax_type">{{ __('product.selling_price_tax_type') }}:*</label>
                    <select name="tax_type" class="form-control select2" required>
                        <option value="inclusive" @if($product->tax_type == 'inclusive') selected
                            @endif>{{ __('product.inclusive') }}</option>
                        <option value="exclusive" @if($product->tax_type == 'exclusive') selected
                            @endif>{{ __('product.exclusive') }}</option>
                    </select>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="type">{{ __('product.product_type') }}:*</label>
                    @show_tooltip(__('tooltip.product_type'))
                    <select name="type" class="form-control select2" required disabled data-action="edit"
                        data-product_id="{{ $product->id }}">
                        @foreach($product_types as $key => $value)
                        <option value="{{ $key }}" @if($product->type == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-12" id="product_form_part"></div>
            <input type="hidden" id="variation_counter" value="0">
            <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">
        </div>

        @endcomponent

        <div class="row">
            <input type="hidden" name="submit_type" id="submit_type">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="btn-group">
                        @if($selling_price_group_count)
                        <button type="submit" value="submit_n_add_selling_prices"
                            class="btn btn-warning submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
                        @endif

                        @can('product.opening_stock')
                        <button type="submit" @if(empty($product->enable_stock)) disabled="true" @endif
                            id="opening_stock_button" value="update_n_edit_opening_stock" class="btn bg-purple
                            submit_product_form">@lang('lang_v1.update_n_edit_opening_stock')</button>
                        @endif

                        <button type="submit" value="save_n_add_another"
                            class="btn bg-maroon submit_product_form">@lang('lang_v1.update_n_add_another')</button>

                        <button type="submit" value="submit"
                            class="btn btn-primary submit_product_form">@lang('messages.update')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->

@endsection

@section('javascript')
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    __page_leave_confirmation('#product_add_form');
});
</script>
@endsection