<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-12">
            <h4>@lang('woocommerce::lang.order_created')</h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="woocommerce_wh_oc_secret">@lang('woocommerce::lang.webhook_secret'):</label>
                <input type="text" name="woocommerce_wh_oc_secret" id="woocommerce_wh_oc_secret" 
                    class="form-control" placeholder="@lang('woocommerce::lang.webhook_secret')" 
                    value="{{ $business->woocommerce_wh_oc_secret ?? '' }}">
            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong>@lang('woocommerce::lang.webhook_delivery_url'):</strong>
                <p>{{ action('\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController@orderCreated', ['business_id' => session()->get('business.id')]) }}</p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4>@lang('woocommerce::lang.order_updated')</h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="woocommerce_wh_ou_secret">@lang('woocommerce::lang.webhook_secret'):</label>
                <input type="text" name="woocommerce_wh_ou_secret" id="woocommerce_wh_ou_secret" 
                    class="form-control" placeholder="@lang('woocommerce::lang.webhook_secret')" 
                    value="{{ $business->woocommerce_wh_ou_secret ?? '' }}">
            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong>@lang('woocommerce::lang.webhook_delivery_url'):</strong>
                <p>{{ action('\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController@orderUpdated', ['business_id' => session()->get('business.id')]) }}</p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4>@lang('woocommerce::lang.order_deleted')</h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="woocommerce_wh_od_secret">@lang('woocommerce::lang.webhook_secret'):</label>
                <input type="text" name="woocommerce_wh_od_secret" id="woocommerce_wh_od_secret" 
                    class="form-control" placeholder="@lang('woocommerce::lang.webhook_secret')" 
                    value="{{ $business->woocommerce_wh_od_secret ?? '' }}">
            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong>@lang('woocommerce::lang.webhook_delivery_url'):</strong>
                <p>{{ action('\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController@orderDeleted', ['business_id' => session()->get('business.id')]) }}</p>
            </div>
        </div>

        <div class="col-xs-12">
            <h4>@lang('woocommerce::lang.order_restored')</h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label for="woocommerce_wh_or_secret">@lang('woocommerce::lang.webhook_secret'):</label>
                <input type="text" name="woocommerce_wh_or_secret" id="woocommerce_wh_or_secret" 
                    class="form-control" placeholder="@lang('woocommerce::lang.webhook_secret')" 
                    value="{{ $business->woocommerce_wh_or_secret ?? '' }}">
            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group">
                <strong>@lang('woocommerce::lang.webhook_delivery_url'):</strong>
                <p>{{ action('\Modules\Woocommerce\Http\Controllers\WoocommerceWebhookController@orderRestored', ['business_id' => session()->get('business.id')]) }}</p>
            </div>
        </div>
    </div>
</div>
