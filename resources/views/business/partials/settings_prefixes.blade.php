<!-- Sección de prefijos de referencia -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Prefijo de compra -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_prefix = !empty($business->ref_no_prefixes['purchase']) ? $business->ref_no_prefixes['purchase'] : '';
                @endphp
                <label for="ref_no_prefixes_purchase">{{ __('lang_v1.purchase') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[purchase]" 
                       id="ref_no_prefixes_purchase"
                       class="form-control" 
                       value="{{ $purchase_prefix }}">
            </div>
        </div>

        <!-- Prefijo de devolución de compra -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_return = !empty($business->ref_no_prefixes['purchase_return']) ? $business->ref_no_prefixes['purchase_return'] : '';
                @endphp
                <label for="ref_no_prefixes_purchase_return">{{ __('lang_v1.purchase_return') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[purchase_return]" 
                       id="ref_no_prefixes_purchase_return"
                       class="form-control" 
                       value="{{ $purchase_return }}">
            </div>
        </div>

        <!-- Prefijo de orden de compra -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_order_prefix = !empty($business->ref_no_prefixes['purchase_order']) ? $business->ref_no_prefixes['purchase_order'] : '';
                @endphp
                <label for="ref_no_prefixes_purchase_order">{{ __('lang_v1.purchase_order') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[purchase_order]" 
                       id="ref_no_prefixes_purchase_order"
                       class="form-control" 
                       value="{{ $purchase_order_prefix }}">
            </div>
        </div>

        <!-- Prefijo de transferencia de stock -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $stock_transfer_prefix = !empty($business->ref_no_prefixes['stock_transfer']) ? $business->ref_no_prefixes['stock_transfer'] : '';
                @endphp
                <label for="ref_no_prefixes_stock_transfer">{{ __('lang_v1.stock_transfer') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[stock_transfer]" 
                       id="ref_no_prefixes_stock_transfer"
                       class="form-control" 
                       value="{{ $stock_transfer_prefix }}">
            </div>
        </div>

        <!-- Prefijo de ajuste de stock -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $stock_adjustment_prefix = !empty($business->ref_no_prefixes['stock_adjustment']) ? $business->ref_no_prefixes['stock_adjustment'] : '';
                @endphp
                <label for="ref_no_prefixes_stock_adjustment">{{ __('stock_adjustment.stock_adjustment') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[stock_adjustment]" 
                       id="ref_no_prefixes_stock_adjustment"
                       class="form-control" 
                       value="{{ $stock_adjustment_prefix }}">
            </div>
        </div>

        <!-- Prefijo de devolución de venta -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sell_return_prefix = !empty($business->ref_no_prefixes['sell_return']) ? $business->ref_no_prefixes['sell_return'] : '';
                @endphp
                <label for="ref_no_prefixes_sell_return">{{ __('lang_v1.sell_return') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[sell_return]" 
                       id="ref_no_prefixes_sell_return"
                       class="form-control" 
                       value="{{ $sell_return_prefix }}">
            </div>
        </div>

        <!-- Prefijo de gastos -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $expenses_prefix = !empty($business->ref_no_prefixes['expense']) ? $business->ref_no_prefixes['expense'] : '';
                @endphp
                <label for="ref_no_prefixes_expense">{{ __('expense.expenses') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[expense]" 
                       id="ref_no_prefixes_expense"
                       class="form-control" 
                       value="{{ $expenses_prefix }}">
            </div>
        </div>

        <!-- Prefijo de contactos -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $contacts_prefix = !empty($business->ref_no_prefixes['contacts']) ? $business->ref_no_prefixes['contacts'] : '';
                @endphp
                <label for="ref_no_prefixes_contacts">{{ __('contact.contacts') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[contacts]" 
                       id="ref_no_prefixes_contacts"
                       class="form-control" 
                       value="{{ $contacts_prefix }}">
            </div>
        </div>

        <!-- Prefijo de pago de compra -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_payment = !empty($business->ref_no_prefixes['purchase_payment']) ? $business->ref_no_prefixes['purchase_payment'] : '';
                @endphp
                <label for="ref_no_prefixes_purchase_payment">{{ __('lang_v1.purchase_payment') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[purchase_payment]" 
                       id="ref_no_prefixes_purchase_payment"
                       class="form-control" 
                       value="{{ $purchase_payment }}">
            </div>
        </div>

        <!-- Prefijo de pago de venta -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sell_payment = !empty($business->ref_no_prefixes['sell_payment']) ? $business->ref_no_prefixes['sell_payment'] : '';
                @endphp
                <label for="ref_no_prefixes_sell_payment">{{ __('lang_v1.sell_payment') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[sell_payment]" 
                       id="ref_no_prefixes_sell_payment"
                       class="form-control" 
                       value="{{ $sell_payment }}">
            </div>
        </div>

        <!-- Prefijo de pago de gastos -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $expense_payment = !empty($business->ref_no_prefixes['expense_payment']) ? $business->ref_no_prefixes['expense_payment'] : '';
                @endphp
                <label for="ref_no_prefixes_expense_payment">{{ __('lang_v1.expense_payment') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[expense_payment]" 
                       id="ref_no_prefixes_expense_payment"
                       class="form-control" 
                       value="{{ $expense_payment }}">
            </div>
        </div>

        <!-- Prefijo de ubicación de negocio -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $business_location_prefix = !empty($business->ref_no_prefixes['business_location']) ? $business->ref_no_prefixes['business_location'] : '';
                @endphp
                <label for="ref_no_prefixes_business_location">{{ __('business.business_location') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[business_location]" 
                       id="ref_no_prefixes_business_location"
                       class="form-control" 
                       value="{{ $business_location_prefix }}">
            </div>
        </div>

        <!-- Prefijo de nombre de usuario -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $username_prefix = !empty($business->ref_no_prefixes['username']) ? $business->ref_no_prefixes['username'] : '';
                @endphp
                <label for="ref_no_prefixes_username">{{ __('business.username') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[username]" 
                       id="ref_no_prefixes_username"
                       class="form-control" 
                       value="{{ $username_prefix }}">
            </div>
        </div>

        <!-- Prefijo de suscripción -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $subscription_prefix = !empty($business->ref_no_prefixes['subscription']) ? $business->ref_no_prefixes['subscription'] : '';
                @endphp
                <label for="ref_no_prefixes_subscription">{{ __('lang_v1.subscription_no') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[subscription]" 
                       id="ref_no_prefixes_subscription"
                       class="form-control" 
                       value="{{ $subscription_prefix }}">
            </div>
        </div>

        <!-- Prefijo de borrador -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $draft_prefix = !empty($business->ref_no_prefixes['draft']) ? $business->ref_no_prefixes['draft'] : '';
                @endphp
                <label for="ref_no_prefixes_draft">{{ __('sale.draft') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[draft]" 
                       id="ref_no_prefixes_draft"
                       class="form-control" 
                       value="{{ $draft_prefix }}">
            </div>
        </div>

        <!-- Prefijo de orden de venta -->
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sales_order_prefix = !empty($business->ref_no_prefixes['sales_order']) ? $business->ref_no_prefixes['sales_order'] : '';
                @endphp
                <label for="ref_no_prefixes_sales_order">{{ __('lang_v1.sales_order') }}:</label>
                <input type="text" 
                       name="ref_no_prefixes[sales_order]" 
                       id="ref_no_prefixes_sales_order"
                       class="form-control" 
                       value="{{ $sales_order_prefix }}">
            </div>
        </div>
    </div>
</div>