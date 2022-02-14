<?php

namespace App\Http\Controllers\Store;


use App\Http\Controllers\Controller;
use App\Page;


class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        die("category");
        $page = Page::where('url', $url)->firstOrFail();
        return view('store.pages.page', ['page' => $page]);
    }

}
