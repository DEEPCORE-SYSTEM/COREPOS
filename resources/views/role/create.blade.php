@extends('layouts.app')
@section('title', __('role.add_role'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('role.add_role')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @php
            $pos_settings = !empty(session('business.pos_settings'))
                ? json_decode(session('business.pos_settings'), true)
                : [];
        @endphp
        @component('components.widget', ['class' => 'box-primary'])
            <form action="{{ action('RoleController@store') }}" method="post" id="role_add_form">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">{{ __('user.role_name') }}:*</label>
                            <input type="text" name="name" id="name" class="form-control" required
                                placeholder="{{ __('user.role_name') }}">
                        </div>
                    </div>
                </div>


                @if (in_array('service_staff', $enabled_modules))
                    <div class="row">
                        <div class="col-md-2">
                            <h4>@lang('lang_v1.user_type')</h4>
                        </div>
                        <div class="col-md-9 col-md-offset-1">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_service_staff" value="1" class="input-icheck"
                                            {{ old('is_service_staff', false) || false ? 'checked' : '' }}>
                                        {{ __('restaurant.service_staff') }}
                                    </label>
                                    @show_tooltip(__('restaurant.tooltip_service_staff'))
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <label>@lang('user.permissions'):</label>
                    </div>
                </div>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.user')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="user.view" class="input-icheck">
                                    {{ __('role.user.view') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="user.create" class="input-icheck">
                                    {{ __('role.user.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="user.update" class="input-icheck">
                                    {{ __('role.user.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="user.delete" class="input-icheck">
                                    {{ __('role.user.delete') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('user.roles')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="roles.view" class="input-icheck">
                                    {{ __('lang_v1.view_role') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="roles.create" class="input-icheck">
                                    {{ __('role.add_role') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="roles.update" class="input-icheck">
                                    {{ __('role.edit_role') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="roles.delete" class="input-icheck">
                                    {{ __('lang_v1.delete_role') }}
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.supplier')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="radio-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[supplier_view]" value="supplier.view"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_all_supplier') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[supplier_view]" value="supplier.view_own"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_own_supplier') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="supplier.create"
                                        class="input-icheck">
                                    {{ __('role.supplier.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="supplier.update"
                                        class="input-icheck">
                                    {{ __('role.supplier.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="supplier.delete"
                                        class="input-icheck">
                                    {{ __('role.supplier.delete') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.customer') @show_tooltip(__('lang_v1.customer_permissions_tooltip'))</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[customer_view]" value="customer.view"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_all_customer') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[customer_view]" value="customer.view_own"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_own_customer') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[customer_view_by_sell]"
                                        value="customer_with_no_sell_one_month" class="input-icheck">
                                    {{ __('lang_v1.customer_with_no_sell_one_month') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[customer_view_by_sell]"
                                        value="customer_with_no_sell_three_month" class="input-icheck">
                                    {{ __('lang_v1.customer_with_no_sell_three_month') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[customer_view_by_sell]"
                                        value="customer_with_no_sell_six_month" class="input-icheck">
                                    {{ __('lang_v1.customer_with_no_sell_six_month') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[customer_view_by_sell]"
                                        value="customer_with_no_sell_one_year" class="input-icheck">
                                    {{ __('lang_v1.customer_with_no_sell_one_year') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="customer.create"
                                        class="input-icheck">
                                    {{ __('role.customer.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="customer.update"
                                        class="input-icheck">
                                    {{ __('role.customer.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="customer.delete"
                                        class="input-icheck">
                                    {{ __('role.customer.delete') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('business.product')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="product.view" class="input-icheck">
                                    {{ __('role.product.view') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="product.create" class="input-icheck">
                                    {{ __('role.product.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="product.update" class="input-icheck">
                                    {{ __('role.product.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="product.delete" class="input-icheck">
                                    {{ __('role.product.delete') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="product.opening_stock"
                                        class="input-icheck">
                                    {{ __('lang_v1.add_opening_stock') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="view_purchase_price"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_purchase_price') }}
                                </label>
                                @show_tooltip(__('lang_v1.view_purchase_price_tooltip'))
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                @if (in_array('purchases', $enabled_modules) || in_array('stock_adjustment', $enabled_modules))
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4>@lang('role.purchase')</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[purchase_view]" value="purchase.view"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_all_purchase_n_stock_adjustment') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[purchase_view]" value="view_own_purchase"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_own_purchase_n_stock_adjustment') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase.create"
                                            class="input-icheck">
                                        {{ __('role.purchase.create') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase.update"
                                            class="input-icheck">
                                        {{ __('role.purchase.update') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase.delete"
                                            class="input-icheck">
                                        {{ __('role.purchase.delete') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase.payments"
                                            class="input-icheck">
                                        {{ __('lang_v1.purchase.payments') }}
                                    </label>
                                    @show_tooltip(__('lang_v1.purchase_payments'))
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase.update_status"
                                            class="input-icheck">
                                        {{ __('lang_v1.update_status') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                @endif

                @if (!empty($common_settings['enable_purchase_order']))
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4>@lang('lang_v1.purchase_order')</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[purchase_order_view]"
                                            value="purchase_order.view_all" class="input-icheck">
                                        {{ __('lang_v1.view_all_purchase_order') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[purchase_order_view]"
                                            value="purchase_order.view_own" class="input-icheck">
                                        {{ __('lang_v1.view_own_purchase_order') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase_order.create"
                                            class="input-icheck">
                                        {{ __('lang_v1.create_purchase_order') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase_order.update"
                                            class="input-icheck">
                                        {{ __('lang_v1.edit_purchase_order') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase_order.delete"
                                            class="input-icheck">
                                        {{ __('lang_v1.delete_purchase_order') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                @endif
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('sale.pos_sale')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (in_array('pos_sale', $enabled_modules))
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="sell.view" class="input-icheck">
                                        {{ __('role.sell.view') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="sell.create"
                                            class="input-icheck">
                                        {{ __('role.sell.create') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="sell.update"
                                            class="input-icheck">
                                        {{ __('role.sell.update') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="sell.delete"
                                            class="input-icheck">
                                        {{ __('role.sell.delete') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]"
                                            value="edit_product_price_from_pos_screen" class="input-icheck">
                                        {{ __('lang_v1.edit_product_price_from_pos_screen') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]"
                                            value="edit_product_discount_from_pos_screen" class="input-icheck">
                                        {{ __('lang_v1.edit_product_discount_from_pos_screen') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="print_invoice"
                                            class="input-icheck">
                                        {{ __('lang_v1.print_invoice') }}
                                    </label>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('sale.sale') @show_tooltip(__('lang_v1.sell_permissions_tooltip'))</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (in_array('add_sale', $enabled_modules))
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[sell_view]" value="direct_sell.view"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_all_sale') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[sell_view]" value="view_own_sell_only"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_own_sell_only') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="view_paid_sells_only"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_paid_sells_only') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="view_due_sells_only"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_due_sells_only') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="view_partial_sells_only"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_partially_paid_sells_only') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="view_overdue_sells_only"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_overdue_sells_only') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="direct_sell.access"
                                            class="input-icheck">
                                        {{ __('lang_v1.add_sell') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="direct_sell.update"
                                            class="input-icheck">
                                        {{ __('lang_v1.update_sale') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="direct_sell.delete"
                                            class="input-icheck">
                                        {{ __('lang_v1.delete_sell') }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="view_commission_agent_sell"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_commission_agent_sell') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sell.payments" class="input-icheck">
                                    {{ __('lang_v1.sell.payments') }}
                                </label>
                                @show_tooltip(__('lang_v1.sell_payments'))
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="edit_product_price_from_sale_screen"
                                        class="input-icheck">
                                    {{ __('lang_v1.edit_product_price_from_sale_screen') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]"
                                        value="edit_product_discount_from_sale_screen" class="input-icheck">
                                    {{ __('lang_v1.edit_product_discount_from_sale_screen') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="discount.access"
                                        class="input-icheck">
                                    {{ __('lang_v1.discount.access') }}
                                </label>
                            </div>
                        </div>

                        @if (in_array('types_of_service', $enabled_modules))
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="permissions[]"
                                                        value="access_types_of_service" class="input-icheck">
                                                    {{ __('access_types_of_service') }}
                                                </label>
                                            </div>
                                        </div>
                                        {{ __('lang_v1.access_types_of_service') }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="access_sell_return"
                                        class="input-icheck">
                                    {{ __('lang_v1.access_all_sell_return') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="access_own_sell_return"
                                        class="input-icheck">
                                    {{ __('lang_v1.access_own_sell_return') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="edit_invoice_number"
                                        class="input-icheck">
                                    {{ __('lang_v1.add_edit_invoice_number') }}
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
                <hr>
                @if (!empty($pos_settings['enable_sales_order']))
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4>@lang('lang_v1.sales_order')</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[so_view]" value="so.view_all"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_all_so') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[so_view]" value="so.view_own"
                                            class="input-icheck">
                                        {{ __('lang_v1.view_own_so') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="so.create" class="input-icheck">
                                        {{ __('lang_v1.create_so') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="so.update" class="input-icheck">
                                        {{ __('lang_v1.edit_so') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="so.delete" class="input-icheck">
                                        {{ __('lang_v1.delete_so') }}
                                    </label>
                                </div>
                            </div>


                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('sale.draft')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[draft_view]" value="draft.view_all"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_all_drafts') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[draft_view]" value="draft.view_own"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_own_drafts') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="draft.update" class="input-icheck">
                                    {{ __('lang_v1.edit_draft') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="draft.delete" class="input-icheck">
                                    {{ __('lang_v1.delete_draft') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('lang_v1.quotation')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[quotation_view]" value="quotation.view_all"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_all_quotations') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[quotation_view]" value="quotation.view_own"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_own_quotations') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="quotation.update"
                                        class="input-icheck">
                                    {{ __('lang_v1.edit_quotation') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="quotation.delete"
                                        class="input-icheck">
                                    {{ __('lang_v1.delete_quotation') }}
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('lang_v1.shipments')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[shipping_view]" value="access_shipping"
                                        class="input-icheck">
                                    {{ __('lang_v1.access_all_shipments') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="radio_option[shipping_view]" value="access_own_shipping"
                                        class="input-icheck">
                                    {{ __('lang_v1.access_own_shipping') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="access_pending_shipments_only"
                                        class="input-icheck">
                                    {{ __('lang_v1.access_pending_shipments_only') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="access_commission_agent_shipping"
                                        class="input-icheck">
                                    {{ __('lang_v1.access_commission_agent_shipping') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('cash_register.cash_register')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="view_cash_register"
                                        class="input-icheck">
                                    {{ __('lang_v1.view_cash_register') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="close_cash_register"
                                        class="input-icheck">
                                    {{ __('lang_v1.close_cash_register') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>

                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.brand')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="brand.view" class="input-icheck">
                                    {{ __('role.brand.view') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="brand.create" class="input-icheck">
                                    {{ __('role.brand.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="brand.update" class="input-icheck">
                                    {{ __('role.brand.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="brand.delete" class="input-icheck">
                                    {{ __('role.brand.delete') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.tax_rate')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="tax_rate.view" class="input-icheck">
                                    {{ __('role.tax_rate.view') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="tax_rate.create"
                                        class="input-icheck">
                                    {{ __('role.tax_rate.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="tax_rate.update"
                                        class="input-icheck">
                                    {{ __('role.tax_rate.update') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="tax_rate.delete"
                                        class="input-icheck">
                                    {{ __('role.tax_rate.delete') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.unit')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="unit.view" class="input-icheck"
                                        {{ old('permissions') && in_array('unit.view', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.unit.view') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="unit.create" class="input-icheck"
                                        {{ old('permissions') && in_array('unit.create', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.unit.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="unit.update" class="input-icheck"
                                        {{ old('permissions') && in_array('unit.update', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.unit.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="unit.delete" class="input-icheck"
                                        {{ old('permissions') && in_array('unit.delete', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.unit.delete') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('category.category')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="category.view" class="input-icheck"
                                        {{ old('permissions') && in_array('category.view', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.category.view') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="category.create" class="input-icheck"
                                        {{ old('permissions') && in_array('category.create', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.category.create') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="category.update" class="input-icheck"
                                        {{ old('permissions') && in_array('category.update', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.category.update') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="category.delete" class="input-icheck"
                                        {{ old('permissions') && in_array('category.delete', old('permissions')) ? 'checked' : '' }}>
                                    {{ __('role.category.delete') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.report')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (in_array('purchases', $enabled_modules) ||
                                in_array('add_sale', $enabled_modules) ||
                                in_array('pos_sale', $enabled_modules))
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="purchase_n_sell_report.view"
                                            class="input-icheck"
                                            {{ old('permissions') && in_array('purchase_n_sell_report.view', old('permissions')) ? 'checked' : '' }}>
                                        {{ __('role.purchase_n_sell_report.view') }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="tax_report.view" class="input-icheck"
                                    {{ in_array('tax_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.tax_report.view') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="contacts_report.view"
                                    class="input-icheck"
                                    {{ in_array('contacts_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.contacts_report.view') }}
                            </label>
                        </div>

                        @if (in_array('expenses', $enabled_modules))
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="expense_report.view"
                                            class="input-icheck"
                                            {{ in_array('expense_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                        {{ __('role.expense_report.view') }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="profit_loss_report.view"
                                    class="input-icheck"
                                    {{ in_array('profit_loss_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.profit_loss_report.view') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="stock_report.view" class="input-icheck"
                                    {{ in_array('stock_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.stock_report.view') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="trending_product_report.view"
                                    class="input-icheck"
                                    {{ in_array('trending_product_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.trending_product_report.view') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="register_report.view"
                                    class="input-icheck"
                                    {{ in_array('register_report.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.register_report.view') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="sales_representative.view"
                                    class="input-icheck"
                                    {{ in_array('sales_representative.view', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.sales_representative.view') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="view_product_stock_value"
                                    class="input-icheck"
                                    {{ in_array('view_product_stock_value', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('lang_v1.view_product_stock_value') }}
                            </label>
                        </div>


                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-1">
                        <h4>@lang('role.settings')</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="business_settings.access"
                                    class="input-icheck"
                                    {{ in_array('business_settings.access', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.business_settings.access') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="barcode_settings.access"
                                    class="input-icheck"
                                    {{ in_array('barcode_settings.access', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.barcode_settings.access') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="invoice_settings.access"
                                    class="input-icheck"
                                    {{ in_array('invoice_settings.access', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('role.invoice_settings.access') }}
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="permissions[]" value="access_printers" class="input-icheck"
                                    {{ in_array('access_printers', old('permissions', [])) ? 'checked' : '' }}>
                                {{ __('lang_v1.access_printers') }}
                            </label>
                        </div>

                    </div>
                </div>
                @if (in_array('expenses', $enabled_modules))
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4>@lang('lang_v1.expense')</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="radio_option[expense_view]" value="all_expense.access"
                                        class="input-icheck"
                                        {{ old('radio_option.expense_view') == 'all_expense.access' ? 'checked' : '' }}>
                                    {{ __('lang_v1.access_all_expense') }}
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="radio_option[expense_view]" value="view_own_expense"
                                        class="input-icheck"
                                        {{ old('radio_option.expense_view') == 'view_own_expense' ? 'checked' : '' }}>
                                    {{ __('lang_v1.view_own_expense') }}
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="expense.add" class="input-icheck"
                                        {{ in_array('expense.add', old('permissions', [])) ? 'checked' : '' }}>
                                    {{ __('expense.add_expense') }}
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="expense.edit" class="input-icheck"
                                        {{ in_array('expense.edit', old('permissions', [])) ? 'checked' : '' }}>
                                    {{ __('expense.edit_expense') }}
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="expense.delete" class="input-icheck"
                                        {{ in_array('expense.delete', old('permissions', [])) ? 'checked' : '' }}>
                                    {{ __('lang_v1.delete_expense') }}
                                </label>
                            </div>

                        </div>
                    </div>
                @endif
                <hr>
                <div class="row check_group">
                    <div class="col-md-3">
                        <h4>@lang('role.dashboard') @show_tooltip(__('tooltip.dashboard_permission'))</h4>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="dashboard.data" class="input-icheck"
                                        checked>
                                    {{ __('role.dashboard.data') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row check_group">
                    <div class="col-md-3">
                        <h4>@lang('account.account')</h4>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="account.access" class="input-icheck">
                                    {{ __('lang_v1.access_accounts') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @if (in_array('booking', $enabled_modules))
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4>@lang('restaurant.bookings')</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="check_all input-icheck"> {{ __('role.select_all') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[bookings_view]" value="crud_all_bookings"
                                            class="input-icheck">
                                        {{ __('restaurant.add_edit_view_all_booking') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="radio_option[bookings_view]" value="crud_own_bookings"
                                            class="input-icheck">
                                        {{ __('restaurant.add_edit_view_own_booking') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <h4>@lang('lang_v1.access_selling_price_groups')</h4>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="access_default_selling_price"
                                        class="input-icheck" checked>
                                    {{ __('lang_v1.default_selling_price') }}
                                </label>
                            </div>
                        </div>
                        @if (count($selling_price_groups) > 0)
                            @foreach ($selling_price_groups as $selling_price_group)
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="spg_permissions[]"
                                                value="selling_price_group.{{ $selling_price_group->id }}"
                                                class="input-icheck">
                                            {{ $selling_price_group->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @if (in_array('tables', $enabled_modules))
                    <div class="row">
                        <div class="col-md-3">
                            <h4>@lang('restaurant.restaurant')</h4>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="access_tables"
                                            class="input-icheck">
                                        {{ __('lang_v1.access_tables') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @include('role.partials.module_permissions')
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
                    </div>
                </div>

            </form>
        @endcomponent
    </section>
    <!-- /.content -->
@endsection
