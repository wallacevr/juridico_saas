<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageBanners = DB::table('banners')->where([
            ['status', '=', '1'],
            ['type', '=', 'FULL'],
        ])->select('image_url', 'url', 'name')->get();

        return view('store.home')->with('pageBanners', $pageBanners);
    }
}
