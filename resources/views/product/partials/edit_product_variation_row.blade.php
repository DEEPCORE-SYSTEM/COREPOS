@if(!session('business.enable_price_tax'))
@php
$default = 0;
$class = 'hide';
@endphp
@else
@php
$default = null;
$class = '';
@endphp
@endif

@php
$array_name = 'product_variation_edit';
$variation_array_name = 'variations_edit';
if($action == 'duplicate'){
$array_name = 'product_variation';
$variation_array_name = 'variations';
}
@endphp

<tr class="variation_row">
    <td>
        <input type="text" name="{{ $array_name }}[{{ $row_index }}][name]" value="{{ $product_variation->name }}"
            class="form-control input-sm variation_name" required readonly>

        <input type="hidden" name="{{ $array_name }}[{{ $row_index }}][variation_template_id]"
            value="{{ $product_variation->variation_template_id }}">

        <input type="hidden" class="row_index" value="{{ $action == 'edit' ? $row_index : $loop->index }}">
        <input type="hidden" class="row_edit" value="edit">
    </td>


    <td>
        <table class="table table-condensed table-bordered blue-header variation_value_table">
            <thead>
                <tr>
                    <th>@lang('product.sku') @show_tooltip(__('tooltip.sub_sku'))</th>
                    <th>@lang('product.value')</th>
                    <th class="{{$class}}">@lang('product.default_purchase_price')
                        <br />
                        <span class="pull-left"><small><i>@lang('product.exc_of_tax')</i></small></span>

                        <span class="pull-right"><small><i>@lang('product.inc_of_tax')</i></small></span>
                    </th>
                    <th class="{{$class}}">@lang('product.profit_percent')</th>
                    <th class="{{$class}}">@lang('product.default_selling_price')
                        <br />
                        <small><i><span class="dsp_label"></span></i></small>
                    </th>
                    <th>@lang('lang_v1.variation_images')</th>
                    <th><button type="button" class="btn btn-success btn-xs add_variation_value_row">+</button></th>
                </tr>
            </thead>

            <tbody>

                @forelse ($product_variation->variations as $variation)
                @php
                $variation_row_index = $variation->id;
                $sub_sku_required = 'required';
                if($action == 'duplicate'){
                $variation_row_index = $loop->index;
                $sub_sku_required = '';
                }
                @endphp
                <tr>
                    <td>
                        @if($action != 'duplicate')
                        <input type="hidden" class="row_variation_id" value="{{ $variation->id }}">
                        @endif
                        <input type="text"
                            name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][sub_sku]"
                            value="{{ $action == 'edit' ? $variation->sub_sku : null }}"
                            class="form-control input-sm variation_value_name" {{ $sub_sku_required }}>
                    </td>
                    <td>
                        <input type="text"
                            name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][value]"
                            value="{{ $variation->name }}" class="form-control input-sm variation_value_name" required
                            readonly>

                        <input type="hidden"
                            name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][variation_value_id]"
                            value="{{ $variation->variation_value_id }}">
                    </td>
                    <td class="{{ $class }}">
                        <div class="col-sm-6">
                            <input type="text"
                                name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][default_purchase_price]"
                                value="{{ number_format($variation->default_purchase_price, 2) }}"
                                class="form-control input-sm variable_dpp input_number"
                                placeholder="{{ __('product.exc_of_tax') }}" required>
                        </div>

                        <div class="col-sm-6">
                            <input type="text"
                                name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][dpp_inc_tax]"
                                value="{{ number_format($variation->dpp_inc_tax, 2) }}"
                                class="form-control input-sm variable_dpp_inc_tax input_number"
                                placeholder="{{ __('product.inc_of_tax') }}" required>
                        </div>
                    </td>
                    <td class="{{ $class }}">
                        <input type="text"
                            name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][profit_percent]"
                            value="{{ number_format($variation->profit_percent, 2) }}"
                            class="form-control input-sm variable_profit_percent input_number" required>
                    </td>
                    <td class="{{ $class }}">
                        <input type="text"
                            name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][default_sell_price]"
                            value="{{ number_format($variation->default_sell_price, 2) }}"
                            class="form-control input-sm variable_dsp input_number"
                            placeholder="{{ __('product.exc_of_tax') }}" required>

                        <input type="text"
                            name="{{ $array_name }}[{{ $row_index }}][{{ $variation_array_name }}][{{ $variation_row_index }}][sell_price_inc_tax]"
                            value="{{ number_format($variation->sell_price_inc_tax, 2) }}"
                            class="form-control input-sm variable_dsp_inc_tax input_number"
                            placeholder="{{ __('product.inc_of_tax') }}" required>
                    </td>

                    <td>
                        @php
                        $action = $action ?? '';
                        @endphp
                        @if($action !== 'duplicate')
                        @foreach($variation->media as $media)
                        <div class="img-thumbnail">
                            <span class="badge bg-red delete-media"
                                data-href="{{ action('ProductController@deleteMedia', ['media_id' => $media->id]) }}">
                                <i class="fa fa-close"></i>
                            </span>
                            {!! $media->thumbnail() !!}
                        </div>
                        @endforeach
                        <input type="file" name="edit_variation_images_{{ $row_index }}_{{ $variation_row_index }}[]"
                            class="variation_images" accept="image/*" multiple>
                        @else
                        <input type="file" name="edit_variation_images_{{ $row_index }}_{{ $variation_row_index }}[]"
                            class="variation_images" accept="image/*" multiple>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs remove_variation_value_row">-</button>
                        <input type="hidden" class="variation_row_index"
                            value="@if($action == 'duplicate'){{ $loop->index }}@else{{ 0 }}@endif">
                    </td>
                </tr>

                @empty
                &nbsp;
                @endforelse
            </tbody>
        </table>
    </td>
</tr>