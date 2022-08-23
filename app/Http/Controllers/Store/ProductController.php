<?php

namespace App\Http\Controllers\Store;

use App\Collection;
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
        $idsCollection = $product->collections()->pluck('collections.id')->all();

        $similarCategory = (Product::with(["collections" => function($q) use($idsCollection) {
            $q->whereIn('collections.id',$idsCollection);
        }])->where('status',1)->inRandomOrder()->limit(4))->get();

        return view('store.product.view', ['product' => $product,'similarCategory'=>$similarCategory]);
    }

}
