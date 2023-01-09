<?php

namespace App\Http\Controllers\Store;

use App\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $collection = Collection::where('slug', $slug)->where('status',1)->firstOrFail();

        return view('store.collections.collection', ['collection' => $collection]);
    }

}
