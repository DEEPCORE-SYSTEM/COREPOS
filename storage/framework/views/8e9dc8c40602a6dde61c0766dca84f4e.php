<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <a href="<?php echo e(route('home'), false); ?>" class="logo">
            <span class="logo-lg"><?php echo e(Session::get('business.name'), false); ?></span>
        </a>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <!-- menu modulo superadmin -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                <li class="treeview">
                    <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index']), false); ?>">
                        <i class="fa fas fa-users-cog"></i> <span><?php echo e(__('superadmin::lang.superadmin'), false); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- Home -->
            <li class="nav-item">
                <a href="<?php echo e(action([App\Http\Controllers\HomeController::class, 'index']), false); ?>">
                    <i class="fa fas fa-tachometer-alt"></i> <span><?php echo e(__('home.home'), false); ?></span>
                </a>
            </li>

            <!-- User Management -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any('user.view', 'user.create', 'roles.view')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-users"></i> <span><?php echo e(__('user.user_management'), false); ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="nav-item">
                            <a href="/users">
                                <i class="fa fas fa-user"></i> <span><?php echo e(__('user.users'), false); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(action([App\Http\Controllers\RoleController::class, 'index']), false); ?>">
                                <i class="fa fas fa-briefcase"></i> <span><?php echo e(__('user.roles'), false); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(action([App\Http\Controllers\SalesCommissionAgentController::class, 'index']), false); ?>">
                                <i class="fa fas fa-handshake"></i>
                                <span><?php echo e(__('lang_v1.sales_commission_agents'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <!-- Menu contactos -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-address-book"></i> <span><?php echo e(__('contact.contacts'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Proveedores -->
                    <li class="nav-item">
                        <a
                            href="<?php echo e(action([App\Http\Controllers\ContactController::class, 'index'], ['type' => 'supplier']), false); ?>">
                            <i class="fa fas fa-star"></i> <span><?php echo e(__('report.supplier'), false); ?></span>
                        </a>
                    </li>

                    <!-- Clientes -->
                    <li class="nav-item">
                        <a
                            href="<?php echo e(action([App\Http\Controllers\ContactController::class, 'index'], ['type' => 'customer']), false); ?>">
                            <i class="fa fas fa-star"></i> <span><?php echo e(__('report.customer'), false); ?></span>
                        </a>
                    </li>

                    <!-- Grupos de Clientes -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\CustomerGroupController::class, 'index']), false); ?>">
                            <i class="fa fas fa-users"></i> <span><?php echo e(__('lang_v1.customer_groups'), false); ?></span>
                        </a>
                    </li>

                    <!-- Importar Contactos -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\ContactController::class, 'getImportContacts']), false); ?>">
                            <i class="fa fas fa-download"></i> <span><?php echo e(__('lang_v1.import_contacts'), false); ?></span>
                        </a>
                    </li>

                    <!-- Mapa (solo si hay clave API de Google Maps) -->
                    <?php if(!empty(env('GOOGLE_MAP_API_KEY'))): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(action([App\Http\Controllers\ContactController::class, 'contactMap']), false); ?>">
                                <i class="fa fas fa-map-marker-alt"></i> <span><?php echo e(__('lang_v1.map'), false); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            <!-- Menu Productos -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-cubes"></i> <span><?php echo e(__('sale.products'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar productos -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\ProductController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('lang_v1.list_products'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar producto -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\ProductController::class, 'create']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('product.add_product'), false); ?></span>
                        </a>
                    </li>

                    <!-- Imprimir etiquetas -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\LabelsController::class, 'show']), false); ?>">
                            <i class="fa fas fa-barcode"></i> <span><?php echo e(__('barcode.print_labels'), false); ?></span>
                        </a>
                    </li>

                    <!-- Variaciones -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\VariationTemplateController::class, 'index']), false); ?>">
                            <i class="fa fas fa-circle"></i> <span><?php echo e(__('product.variations'), false); ?></span>
                        </a>
                    </li>

                    <!-- Importar productos -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\ImportProductsController::class, 'index']), false); ?>">
                            <i class="fa fas fa-download"></i> <span><?php echo e(__('product.import_products'), false); ?></span>
                        </a>
                    </li>

                    <!-- Importar stock inicial -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\ImportOpeningStockController::class, 'index']), false); ?>">
                            <i class="fa fas fa-download"></i> <span><?php echo e(__('lang_v1.import_opening_stock'), false); ?></span>
                        </a>
                    </li>

                    <!-- Grupos de precios de venta -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\SellingPriceGroupController::class, 'index']), false); ?>">
                            <i class="fa fas fa-circle"></i> <span><?php echo e(__('lang_v1.selling_price_group'), false); ?></span>
                        </a>
                    </li>

                    <!-- Unidades -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\UnitController::class, 'index']), false); ?>">
                            <i class="fa fas fa-balance-scale"></i> <span><?php echo e(__('unit.units'), false); ?></span>
                        </a>
                    </li>

                    <!-- Categorías -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\TaxonomyController::class, 'index']), false); ?>?type=product">
                            <i class="fa fas fa-tags"></i> <span><?php echo e(__('category.categories'), false); ?></span>
                        </a>
                    </li>

                    <!-- Marcas -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\BrandController::class, 'index']), false); ?>">
                            <i class="fa fas fa-gem"></i> <span><?php echo e(__('brand.brands'), false); ?></span>
                        </a>
                    </li>

                    <!-- Garantías -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\WarrantyController::class, 'index']), false); ?>">
                            <i class="fa fas fa-shield-alt"></i> <span><?php echo e(__('lang_v1.warranties'), false); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Menu Compras -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-down"></i> <span><?php echo e(__('purchase.purchases'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Ordenes de compra -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\PurchaseOrderController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('lang_v1.purchase_order'), false); ?></span>
                        </a>
                    </li>

                    <!-- Lista de compras -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\PurchaseController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('purchase.list_purchase'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar compra -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\PurchaseController::class, 'create']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('purchase.add_purchase'), false); ?></span>
                        </a>
                    </li>

                    <!-- Devoluciones de compra -->
                    <li class="nav-item">
                        <a href="<?php echo e(action([App\Http\Controllers\PurchaseReturnController::class, 'index']), false); ?>">
                            <i class="fa fas fa-undo"></i> <span><?php echo e(__('lang_v1.list_purchase_return'), false); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sell submenu -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-up"></i> <span><?php echo e(__('sale.sale'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Órdenes de Venta -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SalesOrderController::class, 'index']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('lang_v1.sales_order'), false); ?></span>
                        </a>
                    </li>

                    <!-- Todas las Ventas -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('lang_v1.all_sales'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar Venta -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellController::class, 'create']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('sale.add_sale'), false); ?></span>
                        </a>
                    </li>

                    <!-- Lista de POS -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellPosController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('sale.list_pos'), false); ?></span>
                        </a>
                    </li>

                    <!-- Nueva Venta POS -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellPosController::class, 'create']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('sale.pos_sale'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar Borrador -->
                    <li>
                        <a
                            href="<?php echo e(action([App\Http\Controllers\SellController::class, 'create'], ['status' => 'draft']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('lang_v1.add_draft'), false); ?></span>
                        </a>
                    </li>

                    <!-- Listar Borradores -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellController::class, 'getDrafts']), false); ?>">
                            <i class="fa fas fa-pen-square"></i> <span><?php echo e(__('lang_v1.list_drafts'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar Cotización -->
                    <li>
                        <a
                            href="<?php echo e(action([App\Http\Controllers\SellController::class, 'create'], ['status' => 'quotation']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('lang_v1.add_quotation'), false); ?></span>
                        </a>
                    </li>

                    <!-- Lista de Cotizaciones -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellController::class, 'getQuotations']), false); ?>">
                            <i class="fa fas fa-pen-square"></i> <span><?php echo e(__('lang_v1.list_quotations'), false); ?></span>
                        </a>
                    </li>

                    <!-- Devoluciones de Venta -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellReturnController::class, 'index']), false); ?>">
                            <i class="fa fas fa-undo"></i> <span><?php echo e(__('lang_v1.list_sell_return'), false); ?></span>
                        </a>
                    </li>

                    <!-- Envíos -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellController::class, 'shipments']), false); ?>">
                            <i class="fa fas fa-truck"></i> <span><?php echo e(__('lang_v1.shipments'), false); ?></span>
                        </a>
                    </li>

                    <!-- Descuentos -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\DiscountController::class, 'index']), false); ?>">
                            <i class="fa fas fa-percent"></i> <span><?php echo e(__('lang_v1.discounts'), false); ?></span>
                        </a>
                    </li>

                    <!-- Suscripciones -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\SellPosController::class, 'listSubscriptions']), false); ?>">
                            <i class="fa fas fa-recycle"></i> <span><?php echo e(__('lang_v1.subscriptions'), false); ?></span>
                        </a>
                    </li>

                    <!-- Importar Ventas -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\ImportSalesController::class, 'index']), false); ?>">
                            <i class="fa fas fa-file-import"></i> <span><?php echo e(__('lang_v1.import_sales'), false); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Menu stock_transferencias -->

            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-truck"></i> <span><?php echo e(__('lang_v1.stock_transfers'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar Transferencias de Stock -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\StockTransferController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('lang_v1.list_stock_transfers'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar Transferencia de Stock -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\StockTransferController::class, 'create']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('lang_v1.add_stock_transfer'), false); ?></span>
                        </a>
                    </li>
                </ul>
            </li>


            <!-- Menu stock_ajustes -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-database"></i> <span><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar Ajustes de Stock -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\StockAdjustmentController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('stock_adjustment.list'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar Ajuste de Stock -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\StockAdjustmentController::class, 'create']), false); ?>">
                            <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('stock_adjustment.add'), false); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Expense submenu -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-minus-circle"></i> <span><?php echo e(__('expense.expenses'), false); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Listar Gastos -->
                    <li>
                        <a href="<?php echo e(action([App\Http\Controllers\ExpenseController::class, 'index']), false); ?>">
                            <i class="fa fas fa-list"></i> <span><?php echo e(__('lang_v1.list_expenses'), false); ?></span>
                        </a>
                    </li>

                    <!-- Agregar Gasto -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense.add')): ?>
                        <li>
                            <a href="<?php echo e(action([App\Http\Controllers\ExpenseController::class, 'create']), false); ?>">
                                <i class="fa fas fa-plus-circle"></i> <span><?php echo e(__('expense.add_expense'), false); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Categorías de Gastos -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['expense.add', 'expense.edit'])): ?>
                        <li>
                            <a href="<?php echo e(action([App\Http\Controllers\ExpenseCategoryController::class, 'index']), false); ?>">
                                <i class="fa fas fa-circle"></i> <span><?php echo e(__('expense.expense_categories'), false); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            <!-- Accounts submenu -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account.access')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-money-check-alt"></i> <span><?php echo e(__('lang_v1.payment_accounts'), false); ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- Lista de Cuentas -->
                        <li>
                            <a href="<?php echo e(action([App\Http\Controllers\AccountController::class, 'index']), false); ?>">
                                <i class="fa fas fa-list"></i> <span><?php echo e(__('account.list_accounts'), false); ?></span>
                            </a>
                        </li>

                        <!-- Balance General -->
                        <li>
                            <a
                                href="<?php echo e(action([App\Http\Controllers\AccountReportsController::class, 'balanceSheet']), false); ?>">
                                <i class="fa fas fa-book"></i> <span><?php echo e(__('account.balance_sheet'), false); ?></span>
                            </a>
                        </li>

                        <!-- Balance de Prueba -->
                        <li>
                            <a
                                href="<?php echo e(action([App\Http\Controllers\AccountReportsController::class, 'trialBalance']), false); ?>">
                                <i class="fa fas fa-balance-scale"></i> <span><?php echo e(__('account.trial_balance'), false); ?></span>
                            </a>
                        </li>

                        <!-- Flujo de Caja -->
                        <li>
                            <a href="<?php echo e(action([App\Http\Controllers\AccountController::class, 'cashFlow']), false); ?>">
                                <i class="fa fas fa-exchange-alt"></i> <span><?php echo e(__('lang_v1.cash_flow'), false); ?></span>
                            </a>
                        </li>

                        <!-- Reporte de Cuentas de Pago -->
                        <li>
                            <a
                                href="<?php echo e(action([App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']), false); ?>">
                                <i class="fa fas fa-file-alt"></i>
                                <span><?php echo e(__('account.payment_account_report'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- Purchase submenu -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['purchase_n_sell_report.view', 'contacts_report.view', 'stock_report.view', 'tax_report.view',
                'trending_product_report.view', 'sales_representative.view', 'register_report.view', 'expense_report.view'])): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-chart-bar"></i> <span><?php echo e(__('report.reports'), false); ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- Reporte de Ganancias y Pérdidas -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profit_loss_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getProfitLoss']), false); ?>">
                                    <i class="fa fas fa-file-invoice-dollar"></i> <span><?php echo e(__('report.profit_loss'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reportes 606 y 607 -->
                        <?php if(config('constants.show_report_606')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'purchaseReport']), false); ?>">
                                    <i class="fa fas fa-arrow-circle-down"></i> <span>Report 606
                                        (<?php echo e(__('lang_v1.purchase'), false); ?>)</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(config('constants.show_report_607')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'saleReport']), false); ?>">
                                    <i class="fa fas fa-arrow-circle-up"></i> <span>Report 607
                                        (<?php echo e(__('business.sale'), false); ?>)</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Compras y Ventas -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase_n_sell_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getPurchaseSell']), false); ?>">
                                    <i class="fa fas fa-exchange-alt"></i>
                                    <span><?php echo e(__('report.purchase_sell_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Impuestos -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getTaxReport']), false); ?>">
                                    <i class="fa fas fa-percent"></i> <span><?php echo e(__('report.tax_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Clientes y Proveedores -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contacts_report.view')): ?>
                            <li>
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getCustomerSuppliers']), false); ?>">
                                    <i class="fa fas fa-address-book"></i> <span><?php echo e(__('report.contacts'), false); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getCustomerGroup']), false); ?>">
                                    <i class="fa fas fa-users"></i> <span><?php echo e(__('lang_v1.customer_groups_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reportes de Inventario -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getStockReport']), false); ?>">
                                    <i class="fa fas fa-hourglass-half"></i> <span><?php echo e(__('report.stock_report'), false); ?></span>
                                </a>
                            </li>
                            <?php if(session('business.enable_product_expiry')): ?>
                                <li>
                                    <a
                                        href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getStockExpiryReport']), false); ?>">
                                        <i class="fa fas fa-calendar-times"></i>
                                        <span><?php echo e(__('report.stock_expiry_report'), false); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(session('business.enable_lot_number')): ?>
                                <li>
                                    <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getLotReport']), false); ?>">
                                        <i class="fa fas fa-hourglass-half"></i> <span><?php echo e(__('lang_v1.lot_report'), false); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Reporte de Productos Más Vendidos -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('trending_product_report.view')): ?>
                            <li>
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getTrendingProducts']), false); ?>">
                                    <i class="fa fas fa-chart-line"></i> <span><?php echo e(__('report.trending_products'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reportes de Pagos -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase_n_sell_report.view')): ?>
                            <li>
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'purchasePaymentReport']), false); ?>">
                                    <i class="fa fas fa-search-dollar"></i>
                                    <span><?php echo e(__('lang_v1.purchase_payment_report'), false); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'sellPaymentReport']), false); ?>">
                                    <i class="fa fas fa-search-dollar"></i>
                                    <span><?php echo e(__('lang_v1.sell_payment_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Gastos -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getExpenseReport']), false); ?>">
                                    <i class="fa fas fa-search-minus"></i> <span><?php echo e(__('report.expense_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Cajas Registradoras -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('register_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getRegisterReport']), false); ?>">
                                    <i class="fa fas fa-briefcase"></i> <span><?php echo e(__('report.register_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Vendedores -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sales_representative.view')): ?>
                            <li>
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getSalesRepresentativeReport']), false); ?>">
                                    <i class="fa fas fa-user"></i> <span><?php echo e(__('report.sales_representative'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Mesas (Si hay módulo de restaurantes) -->
                        <?php if(in_array('tables', $enabled_modules) && auth()->user()->can('purchase_n_sell_report.view')): ?>
                            <li>
                                <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getTableReport']), false); ?>">
                                    <i class="fa fas fa-table"></i> <span><?php echo e(__('restaurant.table_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Reporte de Personal de Servicio (Si hay módulo de restaurantes) -->
                        <?php if(in_array('service_staff', $enabled_modules) && auth()->user()->can('sales_representative.view')): ?>
                            <li>
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'getServiceStaffReport']), false); ?>">
                                    <i class="fa fas fa-user-secret"></i>
                                    <span><?php echo e(__('restaurant.service_staff_report'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Registro de Actividad (Solo para Admin) -->

                        <li>
                            <a href="<?php echo e(action([App\Http\Controllers\ReportController::class, 'activityLog']), false); ?>">
                                <i class="fa fas fa-user-secret"></i> <span><?php echo e(__('lang_v1.activity_log'), false); ?></span>
                            </a>
                        </li>


                    </ul>
                </li>
            <?php endif; ?>
            <!-- Backup -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backup')): ?>
                <li class="<?php echo e(request()->segment(1) == 'backup' ? 'active' : '', false); ?>">
                    <a href="<?php echo e(action([App\Http\Controllers\BackUpController::class, 'index']), false); ?>">
                        <i class="fa fas fa-hdd"></i> <span><?php echo e(__('lang_v1.backup'), false); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- Gestión de Módulos -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_modules')): ?>
                <li class="<?php echo e(request()->segment(1) == 'manage-modules' ? 'active' : '', false); ?>">
                    <a href="<?php echo e(action([App\Http\Controllers\Install\ModulesController::class, 'index']), false); ?>">
                        <i class="fa fas fa-plug"></i> <span><?php echo e(__('lang_v1.modules'), false); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- Reservaciones -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['crud_all_bookings', 'crud_own_bookings'])): ?>
                <?php if(in_array('booking', $enabled_modules)): ?>
                    <li class="<?php echo e(request()->segment(1) == 'bookings' ? 'active' : '', false); ?>">
                        <a href="<?php echo e(action([App\Http\Controllers\Restaurant\BookingController::class, 'index']), false); ?>">
                            <i class="fas fa-calendar-check"></i> <span><?php echo e(__('restaurant.bookings'), false); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Cocina -->
            <?php if(in_array('kitchen', $enabled_modules)): ?>
                <li
                    class="<?php echo e(request()->segment(1) == 'modules' && request()->segment(2) == 'kitchen' ? 'active' : '', false); ?>">
                    <a href="<?php echo e(action([App\Http\Controllers\Restaurant\KitchenController::class, 'index']), false); ?>">
                        <i class="fa fas fa-fire"></i> <span><?php echo e(__('restaurant.kitchen'), false); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Órdenes -->
            <?php if(in_array('service_staff', $enabled_modules)): ?>
                <li
                    class="<?php echo e(request()->segment(1) == 'modules' && request()->segment(2) == 'orders' ? 'active' : '', false); ?>">
                    <a href="<?php echo e(action([App\Http\Controllers\Restaurant\OrderController::class, 'index']), false); ?>">
                        <i class="fa fas fa-list-alt"></i> <span><?php echo e(__('restaurant.orders'), false); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Plantillas de Notificación -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send_notifications')): ?>
                <li class="<?php echo e(request()->segment(1) == 'notification-templates' ? 'active' : '', false); ?>">
                    <a href="<?php echo e(action([App\Http\Controllers\NotificationTemplateController::class, 'index']), false); ?>">
                        <i class="fa fas fa-envelope"></i> <span><?php echo e(__('lang_v1.notification_templates'), false); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- Configuración -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['business_settings.access', 'barcode_settings.access', 'invoice_settings.access', 'tax_rate.view',
                'tax_rate.create', 'access_package_subscriptions'])): ?>
                <li
                    class="treeview <?php echo e(in_array(request()->segment(1), ['business', 'business-location', 'invoice-schemes', 'invoice-layouts', 'barcodes', 'printers', 'tax-rates', 'modules', 'types-of-service']) ? 'active' : '', false); ?>">
                    <a href="#">
                        <i class="fa fas fa-cog"></i> <span><?php echo e(__('business.settings'), false); ?></span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('business_settings.access')): ?>
                            <li class="<?php echo e(request()->segment(1) == 'business' ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\BusinessController::class, 'getBusinessSettings']), false); ?>"
                                    id="tour_step2">
                                    <i class="fa fas fa-cogs"></i> <?php echo e(__('business.business_settings'), false); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(request()->segment(1) == 'business-location' ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\BusinessLocationController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-map-marker"></i> <?php echo e(__('business.business_locations'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice_settings.access')): ?>
                            <li
                                class="<?php echo e(in_array(request()->segment(1), ['invoice-schemes', 'invoice-layouts']) ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\InvoiceSchemeController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-file"></i> <?php echo e(__('invoice.invoice_settings'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('barcode_settings.access')): ?>
                            <li class="<?php echo e(request()->segment(1) == 'barcodes' ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\BarcodeController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-barcode"></i> <?php echo e(__('barcode.barcode_settings'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_printers')): ?>
                            <li class="<?php echo e(request()->segment(1) == 'printers' ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\PrinterController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-share-alt"></i> <?php echo e(__('printer.receipt_printers'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['tax_rate.view', 'tax_rate.create'])): ?>
                            <li class="<?php echo e(request()->segment(1) == 'tax-rates' ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\TaxRateController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-bolt"></i> <?php echo e(__('tax_rate.tax_rates'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(in_array('tables', $enabled_modules) && auth()->user()->can('access_tables')): ?>
                            <li
                                class="<?php echo e(request()->segment(1) == 'modules' && request()->segment(2) == 'tables' ? 'active' : '', false); ?>">
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\Restaurant\TableController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-table"></i> <?php echo e(__('restaurant.tables'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(in_array('modifiers', $enabled_modules) &&
                                (auth()->user()->can('product.view') || auth()->user()->can('product.create'))): ?>
                            <li
                                class="<?php echo e(request()->segment(1) == 'modules' && request()->segment(2) == 'modifiers' ? 'active' : '', false); ?>">
                                <a
                                    href="<?php echo e(action([App\Http\Controllers\Restaurant\ModifierSetsController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-pizza-slice"></i> <?php echo e(__('restaurant.modifiers'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(in_array('types_of_service', $enabled_modules) && auth()->user()->can('access_types_of_service')): ?>
                            <li class="<?php echo e(request()->segment(1) == 'types-of-service' ? 'active' : '', false); ?>">
                                <a href="<?php echo e(action([App\Http\Controllers\TypesOfServiceController::class, 'index']), false); ?>">
                                    <i class="fa fas fa-user-circle"></i> <?php echo e(__('lang_v1.types_of_service'), false); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-plug"></i> <span><?php echo e(__('connector::lang.connector'), false); ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="background-color: #2dce89 !important;">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                            <li>
                                <a href="<?php echo e(action('\Modules\Connector\Http\Controllers\ClientController@index'), false); ?>">
                                    <i class="fa fas fa-network-wired"></i>
                                    <span><?php echo e(__('connector::lang.clients'), false); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(url('docs'), false); ?>">
                                <i class="fa fas fa-book"></i> <span><?php echo e(__('connector::lang.documentation'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-users"></i> <span><?php echo e(__('essentials::lang.hrm'), false); ?></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(action('\Modules\Essentials\Http\Controllers\DashboardController@hrmDashboard'), false); ?>"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #605ca8 !important;' : '', false); ?>">
                                <i class="fa fas fa-users"></i> <span><?php echo e(__('essentials::lang.hrm'), false); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(action('\Modules\Essentials\Http\Controllers\ToDoController@index'), false); ?>"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #001f3f !important;' : '', false); ?>">
                                <i class="fa fas fa-check-circle"></i>
                                <span><?php echo e(__('essentials::lang.essentials'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-industry"></i> <span><?php echo e(__('manufacturing::lang.manufacturing'), false); ?></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(action('\Modules\Manufacturing\Http\Controllers\RecipeController@index'), false); ?>"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #ff851b !important;' : '', false); ?>">
                                <i class="fa fas fa-industry"></i>
                                <span><?php echo e(__('manufacturing::lang.manufacturing'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-qrcode"></i> <span><?php echo e(__('productcatalogue::lang.catalogue_qr'), false); ?></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(action('\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController@generateQr'), false); ?>"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #ff851b !important;' : '', false); ?>">
                                <i class="fa fas fa-qrcode"></i>
                                <span><?php echo e(__('productcatalogue::lang.catalogue_qr'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-project-diagram"></i> <span><?php echo e(__('project::lang.project'), false); ?></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(action('\Modules\Project\Http\Controllers\ProjectController@index'), false); ?>?project_view=list_view"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #e4186d !important;' : '', false); ?>">
                                <i class="fa fa-project-diagram"></i> <span><?php echo e(__('project::lang.project'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fab fa-wordpress"></i> <span><?php echo e(__('woocommerce::lang.woocommerce'), false); ?></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(action('\Modules\Woocommerce\Http\Controllers\WoocommerceController@index'), false); ?>"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #9E458B !important;' : '', false); ?>">
                                <i class="fab fa-wordpress"></i>
                                <span><?php echo e(__('woocommerce::lang.woocommerce'), false); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fas fa-wrench"></i> <span><?php echo e(__('repair::lang.repair'), false); ?></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo e(action('\Modules\Repair\Http\Controllers\DashboardController@index'), false); ?>"
                                style="<?php echo e(config('app.env') == 'demo' ? 'background-color: #bc8f8f !important;' : '', false); ?>">
                                <i class="fa fas fa-wrench"></i> <span><?php echo e(__('repair::lang.repair'), false); ?></span>
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
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>