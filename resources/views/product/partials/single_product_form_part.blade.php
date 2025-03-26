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

<div class="table-responsive">
    <table class="table table-bordered add-product-price-table table-condensed {{$class}}">
        <tr>
            <th>@lang('product.default_purchase_price')</th>
            <th>@lang('product.profit_percent') @show_tooltip(__('tooltip.profit_percent'))</th>
            <th>@lang('product.default_selling_price')</th>
            @if(empty($quick_add))
            <th>@lang('lang_v1.product_image')</th>
            @endif
        </tr>

        <tr>
            <td>
                <div class="col-sm-6">
                    <label for="single_dpp">{{ trans('product.exc_of_tax') }}:*</label>
                    <input type="text" name="single_dpp" id="single_dpp" value="{{ old('single_dpp', $default) }}"
                        class="form-control input-sm dpp input_number" placeholder="{{ __('product.exc_of_tax') }}"
                        required>
                </div>

                <div class="col-sm-6">
                    <label for="single_dpp_inc_tax">{{ trans('product.inc_of_tax') }}:*</label>
                    <input type="text" name="single_dpp_inc_tax" id="single_dpp_inc_tax"
                        value="{{ old('single_dpp_inc_tax', $default) }}"
                        class="form-control input-sm dpp_inc_tax input_number"
                        placeholder="{{ __('product.inc_of_tax') }}" required>
                </div>
            </td>


            <td>
                <br />
                <input type="text" name="profit_percent" value="{{ number_format($profit_percent) }}"
                    class="form-control input-sm input_number" id="profit_percent" required>
            </td>

            <td>
                <label><span class="dsp_label">{{ __('product.exc_of_tax') }}</span></label>
                <input type="text" name="single_dsp" value="{{ $default }}"
                    class="form-control input-sm dsp input_number" placeholder="{{ __('product.exc_of_tax') }}"
                    id="single_dsp" required>

                <input type="text" name="single_dsp_inc_tax" value="{{ $default }}"
                    class="form-control input-sm hide input_number" placeholder="{{ __('product.inc_of_tax') }}"
                    id="single_dsp_inc_tax" required>
            </td>

            @if(empty($quick_add))
            <td>
                <div class="form-group">
                    <label for="variation_images">{{ __('lang_v1.product_image') }}:</label>
                    <input type="file" name="variation_images[]" id="variation_images" class="variation_images"
                        accept="image/*" multiple>

                    <small>
                        <p class="help-block">
                            {{ __('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) }}
                            <br>
                            {{ __('lang_v1.aspect_ratio_should_be_1_1') }}
                        </p>
                    </small>
                </div>
            </td>
            @endif
        </tr>

    </table>
</div>