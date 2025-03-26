<!-- Edit discount Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="posEditDiscountModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    @if($is_discount_enabled)
                        @lang('sale.discount')
                    @endif
                    @if($is_rp_enabled)
                        {{ session('business.rp_name') }}
                    @endif
                </h4>
            </div>
            <div class="modal-body">
                <div class="row @if(!$is_discount_enabled) hide @endif">
                    <div class="col-md-12">
                        <h4 class="modal-title">@lang('sale.edit_discount'):</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount_type_modal">@lang('sale.discount_type') :*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </span>
                                <select name="discount_type_modal" id="discount_type_modal" class="form-control" required>
                                    <option value="" disabled selected>@lang('messages.please_select')</option>
                                    <option value="fixed" {{ $discount_type == 'fixed' ? 'selected' : '' }}>@lang('lang_v1.fixed')</option>
                                    <option value="percentage" {{ $discount_type == 'percentage' ? 'selected' : '' }}>@lang('lang_v1.percentage')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @php
                        $max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';

                        // Si el descuento es mayor al máximo permitido, se ajusta
                        if($discount_type == 'percentage' && $max_discount != '' && $sales_discount > $max_discount) {
                            $sales_discount = $max_discount;
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount_amount_modal">@lang('sale.discount_amount') :*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </span>

                                <input type="text" name="discount_amount_modal" id="discount_amount_modal"
                                    class="form-control input_number"
                                    data-max-discount="{{ $max_discount }}"
                                    data-max-discount-error_msg="@lang('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? num_format($max_discount) : ''])"
                                    value="{{ number_format($sales_discount) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row @if(!$is_rp_enabled) hide @endif">
                    <div class="well well-sm bg-light-gray col-md-12">
                        <div class="col-md-12">
                            <h4 class="modal-title">{{ session('business.rp_name') }}:</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rp_redeemed_modal">@lang('lang_v1.redeemed') :</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-gift"></i>
                                    </span>
                                    <input type="number" name="rp_redeemed_modal" id="rp_redeemed_modal"
                                        class="form-control"
                                        min="0"
                                        data-amount_per_unit_point="{{ session('business.redeem_amount_per_unit_rp') }}"
                                        data-max_points="{{ $max_available }}"
                                        data-min_order_total="{{ session('business.min_order_total_for_redeem') }}"
                                        value="{{ $rp_redeemed }}">
                                    <input type="hidden" id="rp_name" value="{{ session('business.rp_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">{{ $max_available }}</span></p>
                            <h5>
								<strong>@lang('lang_v1.redeemed_amount'):</strong>
								<span id="rp_redeemed_amount_text">{{ number_format($rp_redeemed_amount) }}</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="posEditDiscountModalUpdate">@lang('messages.update')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
