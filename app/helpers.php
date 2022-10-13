<?php

use App\PloiManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Config;
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

if (!function_exists('buildMenu')) {
    function buildMenu($id_menu, $parent = 0, $indent = 0)
    {
        $arr = Menu::find($id_menu);
    
        foreach($arr->allChildren as $menu)
        {
            
        echo '<div class="py-5" x-data="{menu_<?='. $menu->id .' ?>:false}" @mouseover="menu_<?= '. $menu->id .' ?> = true" @mouseleave="menu_<?= '. $menu->id .'?> = false">
            <div class="relative items-center cursor-pointer text-sm font-medium">
                <a href="'. $menu->url .'" class=" px-6  inline-flex items-center font-medium">
                    '. $menu->title .'';
                    if (count($menu->children)>0){
                        echo '<svg class="secundary-text ml-2 h-5 w-5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>';
                    }

                 
               echo '</a>';
        
            if (count($menu->allChildren)==0 )
            {
             
                    echo '<div x-show="menu_<?= $menu->id ?>" x-cloak class="absolute z-10 -ml-4 mt-3 transform px-2 w-32   sm:px-0 lg:ml-0 " style="min-width: 150px;">
                    <div class="rounded-lg shadow-lg w-48">
                        <div class=" grid bg-white px-5 py-2 ">
                        
                            <a href="'.$menu->url .'" class=" py-2  text-secundary px-5  ">
                                '. $menu->title .'
                            </a>
                     
                        </div>
                    </div>
                </div>';
                
               
            }else{
             
                foreach($menu->allChildren as $submenu){
                    
                    buildMenu($submenu->id, $menu['parent_id'], $menu['sort_id'] + 1);
                }
              
               
            }
            echo '</div>
            </div>';
        }
    }
}