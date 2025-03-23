<?php

namespace Modules\Woocommerce\Http\Controllers;

use App\Utils\ModuleUtil;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;

class DataController extends Controller
{
    public function dummy_data()
    {
        Artisan::call('db:seed', ['--class' => 'Modules\Woocommerce\Database\Seeders\AddDummySyncLogTableSeeder']);
    }

    public function superadmin_package()
    {
        return [
            [
                'name' => 'woocommerce_module',
                'label' => __('woocommerce::lang.woocommerce_module'),
                'default' => false,
            ],
        ];
    }

    public function user_permissions()
    {
        return [
            ['value' => 'woocommerce.syc_categories', 'label' => __('woocommerce::lang.sync_product_categories'), 'default' => false],
            ['value' => 'woocommerce.sync_products', 'label' => __('woocommerce::lang.sync_products'), 'default' => false],
            ['value' => 'woocommerce.sync_orders', 'label' => __('woocommerce::lang.sync_orders'), 'default' => false],
            ['value' => 'woocommerce.map_tax_rates', 'label' => __('woocommerce::lang.map_tax_rates'), 'default' => false],
            ['value' => 'woocommerce.access_woocommerce_api_settings', 'label' => __('woocommerce::lang.access_woocommerce_api_settings'), 'default' => false],
        ];
    }

    public function parse_notification($notification)
    {
        $notification_data = [];
        if ($notification->type == 'Modules\Woocommerce\Notifications\SyncOrdersNotification') {
            $notification_data = [
                'msg' => __('woocommerce::lang.orders_sync_notification'),
                'icon_class' => 'fas fa-sync bg-light-blue',
                'link' => action('SellController@index'),
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at->diffForHumans(),
            ];
        }

        return $notification_data;
    }

    public function product_form_part()
    {
        $business_id = request()->session()->get('user.business_id');
        $module_util = new ModuleUtil;
        $is_woo_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'woocommerce_module', 'superadmin_package');

        return $is_woo_enabled ? ['template_path' => 'woocommerce::woocommerce.partials.product_form_part', 'template_data' => []] : [];
    }

    public function product_form_fields()
    {
        return ['woocommerce_disable_sync'];
    }

    public function modifyAdminMenu()
    {
        $module_util = new ModuleUtil;
        $business_id = session()->get('user.business_id');
        $is_woo_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'woocommerce_module', 'superadmin_package');

        if ($is_woo_enabled && (
            auth()->user()->can('woocommerce.syc_categories') ||
            auth()->user()->can('woocommerce.sync_products') ||
            auth()->user()->can('woocommerce.sync_orders') ||
            auth()->user()->can('woocommerce.map_tax_rates') ||
            auth()->user()->can('woocommerce.access_woocommerce_api_settings')
        )) {
            Menu::macro('adminSidebarMenu', function () {
                return Menu::new()
                    ->addClass('nav nav-pills nav-sidebar flex-column')
                    ->add(Link::to(
                        action([WoocommerceController::class, 'index']),
                        __('woocommerce::lang.woocommerce')
                    )->addParentClass('nav-item')
                    ->addClass('nav-link')
                    ->addIf(config('app.env') == 'demo', function (Link $link) {
                        $link->setAttribute('style', 'background-color: #9E458B !important;');
                    })
                    ->prepend('<i class="fab fa-wordpress"></i> ')
                    )->setActiveFromRequest();
            });
        }
    }
}