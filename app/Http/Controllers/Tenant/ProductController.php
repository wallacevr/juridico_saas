<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('q');
        if (!empty($search)) {

            $products = Product::orWhere([
                ['name', 'like', '%' . $search . '%']
            ])->orWhere(
                [['sku', 'like', '%' . $search . '%']]);

        } else {
            $products = Product::query();
        }

        return view('tenant.products.index', [
            'products' => $products->paginate(25),'q'=>$search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenant.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = generateSlug($data['slug'], 'products');
        $product = Product::create($data);
        if (!$product->save()) {
            return back()->withInput()->with("error", "Error creating product.");
        }
        return redirect()->route('tenant.products.index')->with("success", "Product created successfully!");

        die;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
