<?php

namespace App\Http\Controllers\Store;


use App\Http\Controllers\Controller;
use App\Page;


class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $page = Page::where('url', $url)->firstOrFail();
        return view('store.pages.page', ['page' => $page]);
    }

}
