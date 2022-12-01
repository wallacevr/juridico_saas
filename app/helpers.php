<?php

use App\PloiManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Config;
use App\Menu;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;


include('Icons.php');

function ploi(): PloiManager
{
    return app(PloiManager::class);
}

if (!function_exists("tenant_public_path")) {

    function tenant_public_path()
    {
        return URL::to('/') . '/tenant/' . tenant('id');
    }
}
if (!function_exists("get_config")) {

    function get_config($path)
    {
        $config = Config::where('path', $path)->first();
        return $config['value'] ?? null;
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
if (!function_exists("productImage")) {
    /**
     *
     * @param mixed $imageName
     * @param mixed $folderName
     * @return string
     */
    function productImage($image_url)
    {
        $image = tenant_public_path() . '/images/catalog/' . $image_url;
        $image_path = public_path() . '/tenant/' . tenant('id') . '/images/catalog/' . $image_url;
        if (!is_file($image_path)) {
            $image = '/images/no-image.jpg';
        }

        return $image;
    }
}
if (!function_exists("deleteImage")) {
    /**
     *
     * @param mixed $imageName
     * @param mixed $folderName
     * @return string
     */
    function deleteImage($imageName, $folderName)
    {
        $imageFullPath = public_path() . '/tenant/' . tenant('id') . '/images/' . $folderName . '/' . $imageName;
        return File::delete($imageFullPath);
    }
}
if (!function_exists("imageCache")) {
    /**
     *
     * @param mixed $imageName
     * @param mixed $size
     * @return string
     * @throws BindingResolutionException
     */
    function imageCache($imageName=null,$size)
    {

        $width = 254;
        $height = 364;

        switch($size){
            case 'thumb':
                $width = get_config('general/layout/thumb_width');
                $height = get_config('general/layout/thumb_height');
                break;
            case 'small':
                $width = get_config('general/layout/small_width');
                $height = get_config('general/layout/small_height');

                break;
            case 'medium':
                $width = get_config('general/layout/medium_width');
                $height = get_config('general/layout/medium_height');
                break;
            case 'big':
                $width = get_config('general/layout/big_width');
                $height = get_config('general/layout/big_height');
                break;
        }

        $tenantPath = 'tenant/' . tenant('id') . '/images/catalog/';
        $imagePath = public_path($tenantPath . $imageName);

        $resize = $width.'x'.$height;

        if (!is_file($imagePath)) {
            $imagePath = public_path('/images/no-image.jpg');
            $imageName = 'no-image.jpg';
        }
        getStoreImagePath('catalog/cache');
        $destination = $tenantPath . 'cache/' . $resize .'/'. $imageName;
        $imagedir=explode("/",$destination ,-1);

        if(!file_exists(public_path(implode("\\",$imagedir)))){
            mkdir(public_path(implode("\\",$imagedir)), 0777, true);

        }
        if(!is_file($destination)){
            $imgFile = Image::make($imagePath);

            $imgFile
                ->resize($width, $height)
                ->save($destination);

        }


        return $destination;
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
    function getFileUniqueName($destinationFolder, $name, $extension)
    {
        $filename = $destinationFolder . '/' . $name . '.' . $extension;
        if (is_file($filename)) {
            $name = $name . "-1";
            $name = getFileUniqueName($destinationFolder, $name, $extension);
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
        $destinationPath = public_path() . '/tenant/' . tenant('id') . $destinationFolder;

        File::ensureDirectoryExists($destinationPath);
        $file_name = preg_replace('/\..+$/', '', $image->getClientOriginalName());
        $imageUrl = getFileUniqueName($destinationPath, $file_name, $image->getClientOriginalExtension());
        $imageUrl .= '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageUrl);

        return $imageUrl;
    }
}

if (!function_exists("getStoreImagePath")) {
    /**
     * return a image path from tenant
     *
     * @return string
     */
    function getStoreImagePath($destinationPath = null)
    {

        $destinationPath = public_path() . '/tenant/' . tenant('id') . '/images/' . $destinationPath . '/';
        File::ensureDirectoryExists($destinationPath);

        return $destinationPath;
    }
}
if (!function_exists("getStoragerImagePath")) {
    /**
     * return a image path from tenant
     *
     * @return string
     */
    function getStoragerImagePath($destinationPath = null)
    {
        $destinationPath = storage_path($destinationPath);
        File::ensureDirectoryExists($destinationPath);

        return $destinationPath . DIRECTORY_SEPARATOR;
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
    function deleteImage($imageName, $folderName)
    {
        $imageFullPath = public_path() . '/tenant/' . tenant('id') . '/images/' . $folderName . '/' . $imageName;
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
                'href' => '#'
                // 'children' => [
                //     ['name' => __('menu.See All'), 'href' => '#'],
                //     ['name' => __('menu.Groups'), 'href' => '#'],
                //     ['name' => __('menu.Newsletter'), 'href' => '#']
                // ],
            ],
            [
                'name' => __('My Store'),
                'icon' => 'StoreIcon',
                'href' => route('store.home')
                // 'children' => [
                //     ['name' => __('menu.See All'), 'href' => '#'],
                //     ['name' => __('menu.Groups'), 'href' => '#'],
                //     ['name' => __('menu.Newsletter'), 'href' => '#']
                // ],
            ],
            [
                'name' => __('menu.Products'),
                'icon' => 'ProductsIcon',
                'children' => [
                    // ['name' => __('menu.See All'), 'href' => '#'],
                    // ['name' => __('menu.Reviews'), 'href' => '#'],
                    // ['name' => __('menu.Stock Notification'), 'href' => '#'],

                    ['name' => __('menu.Products'), 'href' => route('tenant.products.index')],
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
                    // ['name' => __('menu.Groups'), 'href' => '#'],
                    // ['name' => __('menu.Newsletter'), 'href' => '#']
                ],
            ],
            [
                'name' => __('Tickets'),
                'icon' => 'TicketIcon',
                'children' => [
                    ['name' => __('See All'), 'href' => route('tenant.tickets.index')],

                ],
            ],
            // [
            //     'name' => __('menu.Marketing'),
            //     'icon' => 'MarketingIcon',
            //     'children' => [
            //         ['name' => __('menu.Banners'), 'href' => '#'],
            //         ['name' => __('menu.Promo Codes'), 'href' => '#'],
            //         ['name' => __('menu.Bundles'), 'href' => '#'],
            //         ['name' => __('menu.Pixel'), 'href' => '#'],
            //         ['name' => __('menu.Promotions'), 'href' => '#'],
            //         ['name' => __('menu.Upsell'), 'href' => '#'],
            //     ],
            // ],
            // [
            //     'name' => __('menu.Reports'),
            //     'icon' => 'ReportsIcon',
            //     'children' => [
            //         ['name' => __('menu.Sale by product'), 'href' => '#'],
            //         ['name' => __('menu.Sale by Coupon'), 'href' => '#'],
            //         ['name' => __('menu.Sale by Billet Product'), 'href' => '#'],
            //         ['name' => __('menu.Sale by UpSeel'), 'href' => '#'],
            //     ],
            // ],
            [
                'name' => __('menu.Visual'),
                'icon' => 'VisualIcon',
                'children' => [
                    ['name' => __('menu.Menu'), 'href' => route('tenant.menus.edit', 1)],
                    // ['name' => __('menu.logo'), 'href' => '#'],
                    ['name' => __('menu.Layout'), 'href' => route('tenant.layout.colors.index')],
                    ['name' => __('menu.Imagens'), 'href' => route('tenant.layout.image.index')],
                    ['name' => __('menu.Banners'), 'href' => route('tenant.banners.index')],
                    ['name' => __('menu.Blocks'), 'href' => route('tenant.blocks.index')],
                    // ['name' => __('menu.Embed Html Code'), 'href' => '#'],
                    // ['name' => __('menu.Social Network'), 'href' => '#'],
                    ['name' => __('menu.Pages'), 'href' => route('tenant.pages.index')],

                ],
            ],
            [
                'name' => __('Plugins'),
                'icon' => 'PluginIcon',
                'children' => [
                    ['name' => __('Payments'), 'href' => route('tenant.plugins.index',['group'=>1])],
                    ['name' => __('Shipping'), 'href' => route('tenant.plugins.index',['group'=>2])],


                ],
            ],
            [
                'name' => __('menu.Configurations'),
                'icon' => 'ConfigIcon',
                'children' => [
                    ['name' => __('menu.General'), 'href' => route('tenant.settings.store')],
                    // ['name' => __('menu.Transaction Email'), 'href' => '#'],
                    // ['name' => __('menu.Checkout'), 'href' => '#'],

                    // ['name' => __('menu.Integrations'), 'href' => '#'],
                    // ['name' => __('menu.Redirects'), 'href' => '#'],
                    // ['name' => __('menu.Users'), 'href' => '#'],
                ],
            ],
            // [
            //     'name' => __('menu.Apps'),
            //     'icon' => 'AppIcon',
            //     'href' => '#'
            // ]
        ];
    }
}

if (!function_exists('buildMainMenu')) {
    function buildMainMenu($id_mainmenu, $parent = 0, $indent = 0){
        $arrmain = Menu::find($id_mainmenu);
        
        if(count($arrmain->children)>0){
        echo'<nav class="px-2 bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">';
             echo'<div class="container flex flex-wrap justify-between items-center mx-auto">';
                 echo'  <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">';
                      echo'<ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">';
                      foreach($arrmain->children as $mainmenu){
                            if(count($mainmenu->children)==0){
                                echo'<li>
                                        <a href="'. geturlmenu($mainmenu->url) .'" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-white dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">'. $mainmenu->title .'</a>
                                    </li>';

                            }else{
                                echo'<button id="dropdownNavbarLink" data-dropdown-toggle="'. $mainmenu->slug .'" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">'. $mainmenu->title .'<svg class="ml-1 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="'. $mainmenu->slug .'" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                        <li aria-labelledby="dropdownNavbarLink">';
                                             buildMenu($mainmenu->id);



                                echo'</li></ul></div></button>';
                            }
                      }

        echo'</ul><div></div></nav>';
        }
    }
}

if (!function_exists('buildMenu')) {

    function buildMenu($id_menu)
    {
        $arr = Menu::find($id_menu);

        if(count($arr->children)>0){
            foreach($arr->children as $menu){

                if(count($menu->children)==0){
                    echo'<li>
                            <a href="'. geturlmenu($menu->url) .'" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-white dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">'. $menu->title .'</a>
                        </li>';

                }else{
                    echo'<button id="doubleDropdownButton" data-dropdown-toggle="'. $menu->slug .'" class="flex justify-between items-center w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">'. $menu->title .'<svg aria-hidden="true" class="ml-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                        <!-- Dropdown menu -->
                        <div id="'. $menu->slug .'" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li aria-labelledby="dropdownNavbarLink">';

                                     buildMenu($menu->id);


                    echo'</li></ul></div></button>';
                }
            }

        }


        }



}

if (!function_exists('geturlmenu')) {
    function geturlmenu($url){
        $path=explode("|",$url);
        $newpath='';
        switch ($path[1]) {
            case 'product':
                $newpath=$path[0];
                break;
            case 'brand':
                $newpath='/brand'.$path[0];
                break;
            case 'collection':
                $newpath='/collections'.$path[0];
                break;
            case 'page':
                $newpath=$path[0];
                break;


        }
        return $newpath;
    }

}
