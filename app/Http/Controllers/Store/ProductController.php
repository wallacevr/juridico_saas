<?php

namespace App\Http\Controllers\Store;


use App\Http\Controllers\Controller;
use App\Page;


class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        die("product");
        $page = Page::where('url', $url)->firstOrFail();
        return view('store.pages.page', ['page' => $page]);
    }

}
