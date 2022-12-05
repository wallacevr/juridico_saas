<?php

namespace App\Http\Controllers\Store;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        return view('store.brands.brands', ['brand' => $brand]);
    }

}
