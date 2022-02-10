<?php

use App\PloiManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;


include ('Icons.php');

function ploi(): PloiManager
{
    return app(PloiManager::class);
}

if (!function_exists("tenant_public_path")) {

    function tenant_public_path(){
        return URL::to('/').'/tenant/'.tenant('id');
    }

}
if (!function_exists("get_config")) {

    function get_config($path){
        $config = Config::where('path', $path)->firstOrFail();
        return $config['value'];
    }

}

if (!function_exists("generateSlug")) {
    /**
     * Receive a string and convert into a valid slug URL based in her entity
     *
     * @return string
     */
    function generateSlug($slugString, $entity, $entityId = null)
    {
        $originalSlug = Str::of($slugString)->slug('-');
        $newSlug = $originalSlug;
        $cont = 1;

        $query = DB::table($entity)->where('slug', $newSlug);

 		if ($entityId) {
            $query->where('id', '<>', $entityId);
        }

        while ($query->exists()) {
            $newSlug = "{$originalSlug}-{$cont}";
            $cont++;

            $query = DB::table($entity)->where('slug', $newSlug);
        }

        return $newSlug;
    }
}

if (!function_exists("deleteImage")) {
    /**
     *
     * @param mixed $imageName
     * @param mixed $folderName
     * @return string
     */
    function deleteImage($imageName, $folderName){
        $imageFullPath = public_path() .'/tenant/'.tenant('id'). '/images/'. $folderName .'/'. $imageName;
        return File::delete($imageFullPath);
    }
}

if (!function_exists("generateShortcode")) {
    /**
     * Receive a string and convert into a valid shortcode based in her entity
     *
     * @return string
     */
    function generateShortcode($shortcodeString, $entity, $entityId = null)
    {
        $originalShortcode = Str::of($shortcodeString)->slug('_');
        $newShortcode = $originalShortcode;
        $cont = 1;

        $query = DB::table($entity)->where('short_code', $newShortcode);

        if ($entityId) {
            $query->where('id', '<>', $entityId);
        }

        while ($query->exists()) {
            $newShortcode = "{$originalShortcode}-{$cont}";
            $cont++;

            $query = DB::table($entity)->where('short_code', $newShortcode);
        }

        return $newShortcode;
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

if (!function_exists("returnAllSubcategories")) {
    function returnAllSubcategories($mainCategory, $displayType)
    {
        // Simple and verbose

        if ($displayType === 'Admin') {
            $subCategories = loopThroughSubCategories($mainCategory);
        } else {
            $subCategories = loopThroughSubCategories($mainCategory);
        }

        return $subCategories;
    }
}

if (!function_exists("loopThroughSubCategories")) {
    function loopThroughSubCategories($currentSubCategory)
    {
        $data = '';

        foreach ($currentSubCategory as $subCategory) {
            $data .= $subCategory->title . ' | ';

            foreach ($subCategory->allChildren as $subCategoryChilds) {
                $data .= $subCategoryChilds->title . ' | ';

                foreach ($subCategoryChilds->allChildren as $lastCategory) {
                    $data .= $lastCategory->title . ' | ';
                }
            }
        }

        return $data;
    }
}

if (!function_exists("deleteImage")) {
    /**
     *
     * @param mixed $imageName
     * @param mixed $folderName
     * @return string
     */
    function deleteImage($imageName, $folderName){
        $imageFullPath = public_path() .'/tenant/'.tenant('id'). '/images/'. $folderName .'/'. $imageName;
        return File::delete($imageFullPath);
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
                    ['name' => __('menu.Variations'), 'href' => route('tenant.variations.index')],
                ],
            ],
            [
                'name' => __('menu.Clients'),
                'icon' => 'UsersIcon',
                'children' => [
                    ['name' => __('menu.See All'), 'href' => route('tenant.customers.index')],
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
                    ['name' => __('menu.Banners'), 'href' => route('tenant.banners.index')],
                    ['name' => __('menu.Banners'), 'href' => '#'],
                    ['name' => __('menu.Blocks'), 'href' => route('tenant.blocks.index')],
                    ['name' => __('menu.Embed Html Code'), 'href' => '#'],
                    ['name' => __('menu.Social Network'), 'href' => '#'],
                    ['name' => __('menu.Pages'), 'href' => route('tenant.pages.index')],
                ],
            ],
            [
                'name' => __('menu.Configurations'),
                'icon' => 'ConfigIcon',
                'children' => [
                    ['name' => __('menu.General'), 'href' => route('tenant.settings.store')],
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
