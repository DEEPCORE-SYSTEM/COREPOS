<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <a href="{{ route('home') }}" class="logo">
            <span class="logo-lg">{{ Session::get('business.name') }}</span>
        </a>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <!-- menu modulo superadmin -->
            @can('superadmin')
                <li class="treeview">
                    <a href="{{ action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index']) }}">
                        <i class="fa fas fa-users-cog"></i> <span>{{ __('superadmin::lang.superadmin') }}</span>
                    </a>
                </li>
            @endcan
            <!-- Home -->
            <li class="nav-item">
                <a href="{{ action([App\Http\Controllers\HomeController::class, 'index']) }}">
                    <i class="fa fas fa-tachometer-alt"></i> <span>{{ __('home.home') }}</span>
                </a>
            </li>

            <!-- User Management -->
            @canany('user.view', 'user.create', 'roles.view')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-users"></i> <span>{{ __('user.user_management') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="nav-item">
                            <a href="/users">
                                <i class="fa fas fa-user"></i> <span>{{ __('user.users') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action([App\Http\Controllers\RoleController::class, 'index']) }}">
                                <i class="fa fas fa-briefcase"></i> <span>{{ __('user.roles') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action([App\Http\Controllers\SalesCommissionAgentController::class, 'index']) }}">
                                <i class="fa fas fa-handshake"></i>
                                <span>{{ __('lang_v1.sales_commission_agents') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcanany

            <!-- Menu contactos -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-address-book"></i> <span>{{ __('contact.contacts') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Proveedores -->
                    <li class="nav-item">
                        <a
                            href="{{ action([App\Http\Controllers\ContactController::class, 'index'], ['type' => 'supplier']) }}">
                            <i class="fa fas fa-star"></i> <span>{{ __('report.supplier') }}</span>
                        </a>
                    </li>

                    <!-- Clientes -->
                    <li class="nav-item">
                        <a
                            href="{{ action([App\Http\Controllers\ContactController::class, 'index'], ['type' => 'customer']) }}">
                            <i class="fa fas fa-star"></i> <span>{{ __('report.customer') }}</span>
                        </a>
                    </li>

                    <!-- Grupos de Clientes -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\CustomerGroupController::class, 'index']) }}">
                            <i class="fa fas fa-users"></i> <span>{{ __('lang_v1.customer_groups') }}</span>
                        </a>
                    </li>

                    <!-- Importar Contactos -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\ContactController::class, 'getImportContacts']) }}">
                            <i class="fa fas fa-download"></i> <span>{{ __('lang_v1.import_contacts') }}</span>
                        </a>
                    </li>

                    <!-- Mapa (solo si hay clave API de Google Maps) -->
                    @if (!empty(env('GOOGLE_MAP_API_KEY')))
                        <li class="nav-item">
                            <a href="{{ action([App\Http\Controllers\ContactController::class, 'contactMap']) }}">
                                <i class="fa fas fa-map-marker-alt"></i> <span>{{ __('lang_v1.map') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <!-- Menu Productos -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-cubes"></i> <span>{{ __('sale.products') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar productos -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\ProductController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('lang_v1.list_products') }}</span>
                        </a>
                    </li>

                    <!-- Agregar producto -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\ProductController::class, 'create']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('product.add_product') }}</span>
                        </a>
                    </li>

                    <!-- Imprimir etiquetas -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\LabelsController::class, 'show']) }}">
                            <i class="fa fas fa-barcode"></i> <span>{{ __('barcode.print_labels') }}</span>
                        </a>
                    </li>

                    <!-- Variaciones -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\VariationTemplateController::class, 'index']) }}">
                            <i class="fa fas fa-circle"></i> <span>{{ __('product.variations') }}</span>
                        </a>
                    </li>

                    <!-- Importar productos -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\ImportProductsController::class, 'index']) }}">
                            <i class="fa fas fa-download"></i> <span>{{ __('product.import_products') }}</span>
                        </a>
                    </li>

                    <!-- Importar stock inicial -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\ImportOpeningStockController::class, 'index']) }}">
                            <i class="fa fas fa-download"></i> <span>{{ __('lang_v1.import_opening_stock') }}</span>
                        </a>
                    </li>

                    <!-- Grupos de precios de venta -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\SellingPriceGroupController::class, 'index']) }}">
                            <i class="fa fas fa-circle"></i> <span>{{ __('lang_v1.selling_price_group') }}</span>
                        </a>
                    </li>

                    <!-- Unidades -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\UnitController::class, 'index']) }}">
                            <i class="fa fas fa-balance-scale"></i> <span>{{ __('unit.units') }}</span>
                        </a>
                    </li>

                    <!-- Categorías -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\TaxonomyController::class, 'index']) }}?type=product">
                            <i class="fa fas fa-tags"></i> <span>{{ __('category.categories') }}</span>
                        </a>
                    </li>

                    <!-- Marcas -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\BrandController::class, 'index']) }}">
                            <i class="fa fas fa-gem"></i> <span>{{ __('brand.brands') }}</span>
                        </a>
                    </li>

                    <!-- Garantías -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\WarrantyController::class, 'index']) }}">
                            <i class="fa fas fa-shield-alt"></i> <span>{{ __('lang_v1.warranties') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Menu Compras -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-down"></i> <span>{{ __('purchase.purchases') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Ordenes de compra -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\PurchaseOrderController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('lang_v1.purchase_order') }}</span>
                        </a>
                    </li>

                    <!-- Lista de compras -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\PurchaseController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('purchase.list_purchase') }}</span>
                        </a>
                    </li>

                    <!-- Agregar compra -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\PurchaseController::class, 'create']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('purchase.add_purchase') }}</span>
                        </a>
                    </li>

                    <!-- Devoluciones de compra -->
                    <li class="nav-item">
                        <a href="{{ action([App\Http\Controllers\PurchaseReturnController::class, 'index']) }}">
                            <i class="fa fas fa-undo"></i> <span>{{ __('lang_v1.list_purchase_return') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sell submenu -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-up"></i> <span>{{ __('sale.sale') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Órdenes de Venta -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SalesOrderController::class, 'index']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('lang_v1.sales_order') }}</span>
                        </a>
                    </li>

                    <!-- Todas las Ventas -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('lang_v1.all_sales') }}</span>
                        </a>
                    </li>

                    <!-- Agregar Venta -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellController::class, 'create']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('sale.add_sale') }}</span>
                        </a>
                    </li>

                    <!-- Lista de POS -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellPosController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('sale.list_pos') }}</span>
                        </a>
                    </li>

                    <!-- Nueva Venta POS -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellPosController::class, 'create']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('sale.pos_sale') }}</span>
                        </a>
                    </li>

                    <!-- Agregar Borrador -->
                    <li>
                        <a
                            href="{{ action([App\Http\Controllers\SellController::class, 'create'], ['status' => 'draft']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('lang_v1.add_draft') }}</span>
                        </a>
                    </li>

                    <!-- Listar Borradores -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellController::class, 'getDrafts']) }}">
                            <i class="fa fas fa-pen-square"></i> <span>{{ __('lang_v1.list_drafts') }}</span>
                        </a>
                    </li>

                    <!-- Agregar Cotización -->
                    <li>
                        <a
                            href="{{ action([App\Http\Controllers\SellController::class, 'create'], ['status' => 'quotation']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('lang_v1.add_quotation') }}</span>
                        </a>
                    </li>

                    <!-- Lista de Cotizaciones -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellController::class, 'getQuotations']) }}">
                            <i class="fa fas fa-pen-square"></i> <span>{{ __('lang_v1.list_quotations') }}</span>
                        </a>
                    </li>

                    <!-- Devoluciones de Venta -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellReturnController::class, 'index']) }}">
                            <i class="fa fas fa-undo"></i> <span>{{ __('lang_v1.list_sell_return') }}</span>
                        </a>
                    </li>

                    <!-- Envíos -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellController::class, 'shipments']) }}">
                            <i class="fa fas fa-truck"></i> <span>{{ __('lang_v1.shipments') }}</span>
                        </a>
                    </li>

                    <!-- Descuentos -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\DiscountController::class, 'index']) }}">
                            <i class="fa fas fa-percent"></i> <span>{{ __('lang_v1.discounts') }}</span>
                        </a>
                    </li>

                    <!-- Suscripciones -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\SellPosController::class, 'listSubscriptions']) }}">
                            <i class="fa fas fa-recycle"></i> <span>{{ __('lang_v1.subscriptions') }}</span>
                        </a>
                    </li>

                    <!-- Importar Ventas -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\ImportSalesController::class, 'index']) }}">
                            <i class="fa fas fa-file-import"></i> <span>{{ __('lang_v1.import_sales') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Menu stock_transferencias -->

            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-truck"></i> <span>{{ __('lang_v1.stock_transfers') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar Transferencias de Stock -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\StockTransferController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('lang_v1.list_stock_transfers') }}</span>
                        </a>
                    </li>

                    <!-- Agregar Transferencia de Stock -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\StockTransferController::class, 'create']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('lang_v1.add_stock_transfer') }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <!-- Menu stock_ajustes -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-database"></i> <span>{{ __('stock_adjustment.stock_adjustment') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar Ajustes de Stock -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\StockAdjustmentController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('stock_adjustment.list') }}</span>
                        </a>
                    </li>

                    <!-- Agregar Ajuste de Stock -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\StockAdjustmentController::class, 'create']) }}">
                            <i class="fa fas fa-plus-circle"></i> <span>{{ __('stock_adjustment.add') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Expense submenu -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-minus-circle"></i> <span>{{ __('expense.expenses') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar Gastos -->
                    <li>
                        <a href="{{ action([App\Http\Controllers\ExpenseController::class, 'index']) }}">
                            <i class="fa fas fa-list"></i> <span>{{ __('lang_v1.list_expenses') }}</span>
                        </a>
                    </li>

                    <!-- Agregar Gasto -->
                    @can('expense.add')
                        <li>
                            <a href="{{ action([App\Http\Controllers\ExpenseController::class, 'create']) }}">
                                <i class="fa fas fa-plus-circle"></i> <span>{{ __('expense.add_expense') }}</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Categorías de Gastos -->
                    @canany(['expense.add', 'expense.edit'])
                        <li>
                            <a href="{{ action([App\Http\Controllers\ExpenseCategoryController::class, 'index']) }}">
                                <i class="fa fas fa-circle"></i> <span>{{ __('expense.expense_categories') }}</span>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>

            <!-- Accounts submenu -->
            @can('account.access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-money-check-alt"></i> <span>{{ __('lang_v1.payment_accounts') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- Lista de Cuentas -->
                        <li>
                            <a href="{{ action([App\Http\Controllers\AccountController::class, 'index']) }}">
                                <i class="fa fas fa-list"></i> <span>{{ __('account.list_accounts') }}</span>
                            </a>
                        </li>

                        <!-- Balance General -->
                        <li>
                            <a
                                href="{{ action([App\Http\Controllers\AccountReportsController::class, 'balanceSheet']) }}">
                                <i class="fa fas fa-book"></i> <span>{{ __('account.balance_sheet') }}</span>
                            </a>
                        </li>

                        <!-- Balance de Prueba -->
                        <li>
                            <a
                                href="{{ action([App\Http\Controllers\AccountReportsController::class, 'trialBalance']) }}">
                                <i class="fa fas fa-balance-scale"></i> <span>{{ __('account.trial_balance') }}</span>
                            </a>
                        </li>

                        <!-- Flujo de Caja -->
                        <li>
                            <a href="{{ action([App\Http\Controllers\AccountController::class, 'cashFlow']) }}">
                                <i class="fa fas fa-exchange-alt"></i> <span>{{ __('lang_v1.cash_flow') }}</span>
                            </a>
                        </li>

                        <!-- Reporte de Cuentas de Pago -->
                        <li>
                            <a
                                href="{{ action([App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']) }}">
                                <i class="fa fas fa-file-alt"></i>
                                <span>{{ __('account.payment_account_report') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <!-- Purchase submenu -->
            @canany(['purchase_n_sell_report.view', 'contacts_report.view', 'stock_report.view', 'tax_report.view',
                'trending_product_report.view', 'sales_representative.view', 'register_report.view', 'expense_report.view'])
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-chart-bar"></i> <span>{{ __('report.reports') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- Reporte de Ganancias y Pérdidas -->
                        @can('profit_loss_report.view')
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getProfitLoss']) }}">
                                    <i class="fa fas fa-file-invoice-dollar"></i> <span>{{ __('report.profit_loss') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reportes 606 y 607 -->
                        @if (config('constants.show_report_606'))
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'purchaseReport']) }}">
                                    <i class="fa fas fa-arrow-circle-down"></i> <span>Report 606
                                        ({{ __('lang_v1.purchase') }})</span>
                                </a>
                            </li>
                        @endif
                        @if (config('constants.show_report_607'))
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'saleReport']) }}">
                                    <i class="fa fas fa-arrow-circle-up"></i> <span>Report 607
                                        ({{ __('business.sale') }})</span>
                                </a>
                            </li>
                        @endif

                        <!-- Reporte de Compras y Ventas -->
                        @can('purchase_n_sell_report.view')
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getPurchaseSell']) }}">
                                    <i class="fa fas fa-exchange-alt"></i>
                                    <span>{{ __('report.purchase_sell_report') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reporte de Impuestos -->
                        @can('tax_report.view')
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getTaxReport']) }}">
                                    <i class="fa fas fa-percent"></i> <span>{{ __('report.tax_report') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reporte de Clientes y Proveedores -->
                        @can('contacts_report.view')
                            <li>
                                <a
                                    href="{{ action([App\Http\Controllers\ReportController::class, 'getCustomerSuppliers']) }}">
                                    <i class="fa fas fa-address-book"></i> <span>{{ __('report.contacts') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getCustomerGroup']) }}">
                                    <i class="fa fas fa-users"></i> <span>{{ __('lang_v1.customer_groups_report') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reportes de Inventario -->
                        @can('stock_report.view')
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getStockReport']) }}">
                                    <i class="fa fas fa-hourglass-half"></i> <span>{{ __('report.stock_report') }}</span>
                                </a>
                            </li>
                            @if (session('business.enable_product_expiry'))
                                <li>
                                    <a
                                        href="{{ action([App\Http\Controllers\ReportController::class, 'getStockExpiryReport']) }}">
                                        <i class="fa fas fa-calendar-times"></i>
                                        <span>{{ __('report.stock_expiry_report') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (session('business.enable_lot_number'))
                                <li>
                                    <a href="{{ action([App\Http\Controllers\ReportController::class, 'getLotReport']) }}">
                                        <i class="fa fas fa-hourglass-half"></i> <span>{{ __('lang_v1.lot_report') }}</span>
                                    </a>
                                </li>
                            @endif
                        @endcan

                        <!-- Reporte de Productos Más Vendidos -->
                        @can('trending_product_report.view')
                            <li>
                                <a
                                    href="{{ action([App\Http\Controllers\ReportController::class, 'getTrendingProducts']) }}">
                                    <i class="fa fas fa-chart-line"></i> <span>{{ __('report.trending_products') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reportes de Pagos -->
                        @can('purchase_n_sell_report.view')
                            <li>
                                <a
                                    href="{{ action([App\Http\Controllers\ReportController::class, 'purchasePaymentReport']) }}">
                                    <i class="fa fas fa-search-dollar"></i>
                                    <span>{{ __('lang_v1.purchase_payment_report') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'sellPaymentReport']) }}">
                                    <i class="fa fas fa-search-dollar"></i>
                                    <span>{{ __('lang_v1.sell_payment_report') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reporte de Gastos -->
                        @can('expense_report.view')
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getExpenseReport']) }}">
                                    <i class="fa fas fa-search-minus"></i> <span>{{ __('report.expense_report') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reporte de Cajas Registradoras -->
                        @can('register_report.view')
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getRegisterReport']) }}">
                                    <i class="fa fas fa-briefcase"></i> <span>{{ __('report.register_report') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reporte de Vendedores -->
                        @can('sales_representative.view')
                            <li>
                                <a
                                    href="{{ action([App\Http\Controllers\ReportController::class, 'getSalesRepresentativeReport']) }}">
                                    <i class="fa fas fa-user"></i> <span>{{ __('report.sales_representative') }}</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Reporte de Mesas (Si hay módulo de restaurantes) -->
                        @if (in_array('tables', $enabled_modules) && auth()->user()->can('purchase_n_sell_report.view'))
                            <li>
                                <a href="{{ action([App\Http\Controllers\ReportController::class, 'getTableReport']) }}">
                                    <i class="fa fas fa-table"></i> <span>{{ __('restaurant.table_report') }}</span>
                                </a>
                            </li>
                        @endif

                        <!-- Reporte de Personal de Servicio (Si hay módulo de restaurantes) -->
                        @if (in_array('service_staff', $enabled_modules) && auth()->user()->can('sales_representative.view'))
                            <li>
                                <a
                                    href="{{ action([App\Http\Controllers\ReportController::class, 'getServiceStaffReport']) }}">
                                    <i class="fa fas fa-user-secret"></i>
                                    <span>{{ __('restaurant.service_staff_report') }}</span>
                                </a>
                            </li>
                        @endif

                        <!-- Registro de Actividad (Solo para Admin) -->

                        <li>
                            <a href="{{ action([App\Http\Controllers\ReportController::class, 'activityLog']) }}">
                                <i class="fa fas fa-user-secret"></i> <span>{{ __('lang_v1.activity_log') }}</span>
                            </a>
                        </li>


                    </ul>
                </li>
            @endcanany
            <!-- Backup -->
            @can('backup')
                <li class="{{ request()->segment(1) == 'backup' ? 'active' : '' }}">
                    <a href="{{ action([App\Http\Controllers\BackUpController::class, 'index']) }}">
                        <i class="fa fas fa-hdd"></i> <span>{{ __('lang_v1.backup') }}</span>
                    </a>
                </li>
            @endcan
            <!-- Gestión de Módulos -->
            @can('manage_modules')
                <li class="{{ request()->segment(1) == 'manage-modules' ? 'active' : '' }}">
                    <a href="{{ action([App\Http\Controllers\Install\ModulesController::class, 'index']) }}">
                        <i class="fa fas fa-plug"></i> <span>{{ __('lang_v1.modules') }}</span>
                    </a>
                </li>
            @endcan
            <!-- Reservaciones -->
            @canany(['crud_all_bookings', 'crud_own_bookings'])
                @if (in_array('booking', $enabled_modules))
                    <li class="{{ request()->segment(1) == 'bookings' ? 'active' : '' }}">
                        <a href="{{ action([App\Http\Controllers\Restaurant\BookingController::class, 'index']) }}">
                            <i class="fas fa-calendar-check"></i> <span>{{ __('restaurant.bookings') }}</span>
                        </a>
                    </li>
                @endif
            @endcanany

            <!-- Cocina -->
            @if (in_array('kitchen', $enabled_modules))
                <li
                    class="{{ request()->segment(1) == 'modules' && request()->segment(2) == 'kitchen' ? 'active' : '' }}">
                    <a href="{{ action([App\Http\Controllers\Restaurant\KitchenController::class, 'index']) }}">
                        <i class="fa fas fa-fire"></i> <span>{{ __('restaurant.kitchen') }}</span>
                    </a>
                </li>
            @endif

            <!-- Órdenes -->
            @if (in_array('service_staff', $enabled_modules))
                <li
                    class="{{ request()->segment(1) == 'modules' && request()->segment(2) == 'orders' ? 'active' : '' }}">
                    <a href="{{ action([App\Http\Controllers\Restaurant\OrderController::class, 'index']) }}">
                        <i class="fa fas fa-list-alt"></i> <span>{{ __('restaurant.orders') }}</span>
                    </a>
                </li>
            @endif

            <!-- Plantillas de Notificación -->
            @can('send_notifications')
                <li class="{{ request()->segment(1) == 'notification-templates' ? 'active' : '' }}">
                    <a href="{{ action([App\Http\Controllers\NotificationTemplateController::class, 'index']) }}">
                        <i class="fa fas fa-envelope"></i> <span>{{ __('lang_v1.notification_templates') }}</span>
                    </a>
                </li>
            @endcan
            <!-- Configuración -->
            @canany(['business_settings.access', 'barcode_settings.access', 'invoice_settings.access', 'tax_rate.view',
                'tax_rate.create', 'access_package_subscriptions'])
                <li
                    class="treeview {{ in_array(request()->segment(1), ['business', 'business-location', 'invoice-schemes', 'invoice-layouts', 'barcodes', 'printers', 'tax-rates', 'modules', 'types-of-service']) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fas fa-cog"></i> <span>{{ __('business.settings') }}</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('business_settings.access')
                            <li class="{{ request()->segment(1) == 'business' ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\BusinessController::class, 'getBusinessSettings']) }}"
                                    id="tour_step2">
                                    <i class="fa fas fa-cogs"></i> {{ __('business.business_settings') }}
                                </a>
                            </li>
                            <li class="{{ request()->segment(1) == 'business-location' ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\BusinessLocationController::class, 'index']) }}">
                                    <i class="fa fas fa-map-marker"></i> {{ __('business.business_locations') }}
                                </a>
                            </li>
                        @endcan

                        @can('invoice_settings.access')
                            <li
                                class="{{ in_array(request()->segment(1), ['invoice-schemes', 'invoice-layouts']) ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\InvoiceSchemeController::class, 'index']) }}">
                                    <i class="fa fas fa-file"></i> {{ __('invoice.invoice_settings') }}
                                </a>
                            </li>
                        @endcan

                        @can('barcode_settings.access')
                            <li class="{{ request()->segment(1) == 'barcodes' ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\BarcodeController::class, 'index']) }}">
                                    <i class="fa fas fa-barcode"></i> {{ __('barcode.barcode_settings') }}
                                </a>
                            </li>
                        @endcan

                        @can('access_printers')
                            <li class="{{ request()->segment(1) == 'printers' ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\PrinterController::class, 'index']) }}">
                                    <i class="fa fas fa-share-alt"></i> {{ __('printer.receipt_printers') }}
                                </a>
                            </li>
                        @endcan

                        @canany(['tax_rate.view', 'tax_rate.create'])
                            <li class="{{ request()->segment(1) == 'tax-rates' ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\TaxRateController::class, 'index']) }}">
                                    <i class="fa fas fa-bolt"></i> {{ __('tax_rate.tax_rates') }}
                                </a>
                            </li>
                        @endcanany

                        @if (in_array('tables', $enabled_modules) && auth()->user()->can('access_tables'))
                            <li
                                class="{{ request()->segment(1) == 'modules' && request()->segment(2) == 'tables' ? 'active' : '' }}">
                                <a
                                    href="{{ action([App\Http\Controllers\Restaurant\TableController::class, 'index']) }}">
                                    <i class="fa fas fa-table"></i> {{ __('restaurant.tables') }}
                                </a>
                            </li>
                        @endif

                        @if (in_array('modifiers', $enabled_modules) &&
                                (auth()->user()->can('product.view') || auth()->user()->can('product.create')))
                            <li
                                class="{{ request()->segment(1) == 'modules' && request()->segment(2) == 'modifiers' ? 'active' : '' }}">
                                <a
                                    href="{{ action([App\Http\Controllers\Restaurant\ModifierSetsController::class, 'index']) }}">
                                    <i class="fa fas fa-pizza-slice"></i> {{ __('restaurant.modifiers') }}
                                </a>
                            </li>
                        @endif

                        @if (in_array('types_of_service', $enabled_modules) && auth()->user()->can('access_types_of_service'))
                            <li class="{{ request()->segment(1) == 'types-of-service' ? 'active' : '' }}">
                                <a href="{{ action([App\Http\Controllers\TypesOfServiceController::class, 'index']) }}">
                                    <i class="fa fas fa-user-circle"></i> {{ __('lang_v1.types_of_service') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endcanany

            
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-plug"></i> <span>{{ __('connector::lang.connector') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="background-color: #2dce89 !important;">
                        @can('superadmin')
                            <li>
                                <a href="{{ action('\Modules\Connector\Http\Controllers\ClientController@index') }}">
                                    <i class="fa fas fa-network-wired"></i>
                                    <span>{{ __('connector::lang.clients') }}</span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ url('docs') }}">
                                <i class="fa fas fa-book"></i> <span>{{ __('connector::lang.documentation') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-users"></i> <span>{{ __('essentials::lang.hrm') }}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('\Modules\Essentials\Http\Controllers\DashboardController@hrmDashboard') }}"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #605ca8 !important;' : '' }}">
                                <i class="fa fas fa-users"></i> <span>{{ __('essentials::lang.hrm') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@index') }}"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #001f3f !important;' : '' }}">
                                <i class="fa fas fa-check-circle"></i>
                                <span>{{ __('essentials::lang.essentials') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-industry"></i> <span>{{ __('manufacturing::lang.manufacturing') }}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('\Modules\Manufacturing\Http\Controllers\RecipeController@index') }}"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #ff851b !important;' : '' }}">
                                <i class="fa fas fa-industry"></i>
                                <span>{{ __('manufacturing::lang.manufacturing') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-qrcode"></i> <span>{{ __('productcatalogue::lang.catalogue_qr') }}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController@generateQr') }}"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #ff851b !important;' : '' }}">
                                <i class="fa fas fa-qrcode"></i>
                                <span>{{ __('productcatalogue::lang.catalogue_qr') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-project-diagram"></i> <span>{{ __('project::lang.project') }}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('\Modules\Project\Http\Controllers\ProjectController@index') }}?project_view=list_view"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #e4186d !important;' : '' }}">
                                <i class="fa fa-project-diagram"></i> <span>{{ __('project::lang.project') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fab fa-wordpress"></i> <span>{{ __('woocommerce::lang.woocommerce') }}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('\Modules\Woocommerce\Http\Controllers\WoocommerceController@index') }}"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #9E458B !important;' : '' }}">
                                <i class="fab fa-wordpress"></i>
                                <span>{{ __('woocommerce::lang.woocommerce') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-wrench"></i> <span>{{ __('repair::lang.repair') }}</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('\Modules\Repair\Http\Controllers\DashboardController@index') }}"
                                style="{{ config('app.env') == 'demo' ? 'background-color: #bc8f8f !important;' : '' }}">
                                <i class="fa fas fa-wrench"></i> <span>{{ __('repair::lang.repair') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>


        </ul>





        <!-- /.sidebar-menu -->
    </section>

    <!-- /.sidebar -->
</aside>
