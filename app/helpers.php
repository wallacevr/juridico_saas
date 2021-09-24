<?php

use App\PloiManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

function ploi(): PloiManager
{
    return app(PloiManager::class);
}

if (!function_exists("generateSlug")) {
    /**
     * Receive a string and convert into a valid slug URL based in her entity
     *
     * @return string
     */
    function generateSlug($slugString, $entity)
    {
        $originalSlug = Str::of($slugString)->slug('-');
        $newSlug = $originalSlug;
        $cont = 1;

        while (DB::table($entity)->where('slug', $newSlug)->exists()) {
            $newSlug = "{$originalSlug}-{$cont}";

            $cont++;
        }

        return $newSlug;
    }
}

if (!function_exists("storeImage")) {
    /**
     * Receive a image, generate a random name, move to the destinantion folder and returns the new image name
     *
     * @return string
     */
    function storeImage($image, $destinationFolder)
    {
        $destinationPath = public_path() . $destinationFolder;

        File::ensureDirectoryExists($destinationPath);

        $microtime = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
        $imageUrl = Str::random(15) . $microtime . "." . $image->getClientOriginalExtension();

        $image->move($destinationPath, $imageUrl);

        return $imageUrl;
    }
}

if (!function_exists('create_menu')) {
    function create_menu()
    {
        return [
            ['name' => 'Dashboard', 'icon' => 'DashboardIcon', 'href' => route('tenant.admin.dashboad')],
            [
                'name' => __('menu.Products'),
                'icon' => 'ProductsIcon',
                'children' => [
                    ['name' => __('menu.See All'), 'href' => '#'],
                    ['name' => __('menu.Reviews'), 'href' => '#'],
                    ['name' => __('menu.Stock Notification'), 'href' => '#'],
                    ['name' => __('menu.Categories'), 'href' => '#'],
                    ['name' => __('menu.Brands'), 'href' => '#'],
                    ['name' => __('menu.Collections'), 'href' => '#'],
                    ['name' => __('menu.Options'), 'href' => '#'],
                ],
            ],
            [
                'name' => __('menu.Orders'),
                'icon' => 'OrdersIcon',
                'children' => [
                    ['name' => __('menu.See All'), 'href' => '#'],
                    ['name' => __('menu.Groups'), 'href' => '#'],
                    ['name' => __('menu.Newsletter'), 'href' => '#']
                ],
            ],
            [
                'name' => __('menu.Clients'),
                'icon' => 'UsersIcon',
                'children' => [
                    ['name' => __('menu.See All'), 'href' => '#'],
                    ['name' => __('menu.Groups'), 'href' => '#'],
                    ['name' => __('menu.Newsletter'), 'href' => '#']
                ],
            ],
            [
                'name' => __('menu.Marketing'),
                'icon' => 'MarketingIcon',
                'children' => [
                    ['name' => __('menu.Promo Codes'), 'href' => '#'],
                    ['name' => __('menu.bundles'), 'href' => '#'],
                    ['name' => __('menu.Pixel'), 'href' => '#'],
                    ['name' => __('menu.Promotions'), 'href' => '#'],
                    ['name' => __('menu.Upsell'), 'href' => '#'],
                ],
            ],
            [
                'name' => __('menu.Reports'),
                'icon' => 'ReportsIcon',
                'children' => [
                    ['name' => __('menu.Sale by product'), 'href' => '#'],
                    ['name' => __('menu.Sale by Coupon'), 'href' => '#'],
                    ['name' => __('menu.Sale by Billet Product'), 'href' => '#'],
                    ['name' => __('menu.Sale by UpSeel'), 'href' => '#'],
                ],
            ]
        ];
    }
}
