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
