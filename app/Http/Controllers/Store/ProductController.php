<?php

namespace App\Http\Controllers\Store;


use App\Http\Controllers\Controller;
use App\Page;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('store.product.view', ['product' => $product]);
    }

}
