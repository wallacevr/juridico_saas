<?php

use App\PloiManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

function ploi(): PloiManager
{
    return app(PloiManager::class);
}

if (!function_exists("tenant_public_path")) {
    
    function tenant_public_path(){      
        return URL::to('/').'/tenant/'.tenant('id');
    }
    
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


if (!function_exists("getFileUniqueName")) {
    /**
     * 
     * @param mixed $destinationFolder 
     * @param mixed $name 
     * @param mixed $extension
     * @return string 
     */
    function getFileUniqueName($destinationFolder,$name,$extension){
        $filename = $destinationFolder.'/'.$name.'.'.$extension;
        if(is_file($filename)) {
            $name = $name."-1";
            $name = getFileUniqueName($destinationFolder,$name,$extension);
        }
        return $name;
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
        $destinationPath = public_path() .'/tenant/'.tenant('id'). $destinationFolder;

        File::ensureDirectoryExists($destinationPath);
        $file_name = preg_replace('/\..+$/', '', $image->getClientOriginalName());
        $imageUrl = getFileUniqueName($destinationPath,$file_name,$image->getClientOriginalExtension());
        $imageUrl .='.'.$image->getClientOriginalExtension();
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
                'name' => __('menu.Orders'),
                'icon' => 'OrdersIcon',
                'children' => [
                    ['name' => __('menu.See All'), 'href' => '#'],
                    ['name' => __('menu.Groups'), 'href' => '#'],
                    ['name' => __('menu.Newsletter'), 'href' => '#']
                ],
            ],
            [
                'name' => __('menu.Products'),
                'icon' => 'ProductsIcon',
                'children' => [
                    ['name' => __('menu.See All'), 'href' => '#'],
                    ['name' => __('menu.Reviews'), 'href' => '#'],
                    ['name' => __('menu.Stock Notification'), 'href' => '#'],
                    ['name' => __('menu.Categories'), 'href' => '#'],
                    ['name' => __('menu.Brands'), 'href' => route('tenant.brands.index')],
                    ['name' => __('menu.Collections'), 'href' => route('tenant.collections.index')],
                    ['name' => __('menu.Options'), 'href' => '#'],
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
                    ['name' => __('menu.Banners'), 'href' => '#'],
                    ['name' => __('menu.Promo Codes'), 'href' => '#'],
                    ['name' => __('menu.Bundles'), 'href' => '#'],
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
            ],
            [
                'name' => __('menu.Visual'),
                'icon' => 'VisualIcon',
                'children' => [
                    ['name' => __('menu.logo'), 'href' => '#'],
                    ['name' => __('menu.Layout'), 'href' => '#'],
                    ['name' => __('menu.Banners'), 'href' => '#'],
                    ['name' => __('menu.Embed Html Code'), 'href' => '#'],
                    ['name' => __('menu.Social Network'), 'href' => '#'],
                    ['name' => __('menu.Pages'), 'href' => '#'],
                ],
            ],
            [
                'name' => __('menu.Configurations'),
                'icon' => 'ConfigIcon',
                'children' => [
                    ['name' => __('menu.General'), 'href' => '#'],
                    ['name' => __('menu.Transaction Email'), 'href' => '#'],
                    ['name' => __('menu.Checkout'), 'href' => '#'],
                    ['name' => __('menu.Imagens'), 'href' => '#'],
                    ['name' => __('menu.Integrations'), 'href' => '#'],
                    ['name' => __('menu.Redirects'), 'href' => '#'],
                    ['name' => __('menu.Users'), 'href' => '#'],
                ],
            ],[
                'name' => __('menu.Apps'),
                'icon' => 'AppIcon',
                'href' => '#'
            ]
        ];
    }
}
