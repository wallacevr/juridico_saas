<?php

namespace App\Http\Controllers\Tenant;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Return all Brands
    public function index()
    {
        return view('tenant.brands.index', [
            'brands' => Brand::paginate(5),
        ]);
    }


    public function getAll()
    {
       $brands= Brand::all()->reject(function ($brand) {
           return $brand->status === 0;
       })->map(function ($brand) {
           return ['id'=>$brand->id,'text'=>$brand->name];
       
       });
        return response()->json(['results'=>$brands]);
    }





    // Return a single Brand
    public function show(Brand $brand)
    {
        return view('tenant.brands.show', [
            'brand' => $brand,
        ]);
    }

    // Show the Brand create form
    public function create()
    {
        return view('tenant.brands.create');
    }

    // Show the Brand edit form
    public function edit(Brand $brand)
    {
        return view('tenant.brands.edit')->with(['brand' => $brand]);
    }

    // Store a Brand
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_title' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'slug' => 'required',
        ]);

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = generateSlug($data['slug'], 'brands');

        if ($imageUrl = storeImage($image, '/images/brands')) {
            $data['image_url'] = $imageUrl;

            $brand = Brand::create($data);

            if (!$brand->save()) {
                deleteImage($imageUrl, 'brands');

                return back()->withInput()->with("error", "Error creating brand.");
            }
        }

        return redirect()->route('tenant.brands.index')->with("success", "Brand created successfully!");
    }

    // Update a Brand
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_title' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'slug' => 'required',
        ]);

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = generateSlug($data['slug'], 'brands', $brand->id);
        $data['status'] = isset($data['status']) ? '1' : '0';

        if (!empty($data['image_url']) && $data['image_url'] !== $brand->image_url) {
            if ($imageUrl = storeImage($image, '/images/brands')) {
                $data['image_url'] = $imageUrl;

                deleteImage($brand->image_url, 'brands');
            }
        }

        if (!$brand->update($data)) {
            return back()->withInput()->with("error", "Error updating brand.");
        }

        return redirect()->route('tenant.brands.index')->with("success", "Brand updated successfully");
    }

    // Delete a Brand
    public function destroy(Brand $brand)
    {
        if (!$brand->delete()) {
            return redirect()->route('tenant.brands.index')->with("error", "Error deleting brand.");
        }

        deleteImage($brand->image_url, 'brands');

        return redirect()->route('tenant.brands.index')->with("success", "Brand deleted successfully");
    }

}
