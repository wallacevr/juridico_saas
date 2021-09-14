<?php

namespace App\Http\Controllers\Tenant;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    // Return all Brands
    public function index()
    {
        return view('tenant.brands.index', [
            'brands' => Brand::paginate(5),
        ]);
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
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'slug' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Brand created successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = generateSlug($data['slug'], 'brands');

        if ($imageUrl = storeImage($image, '/images/brands')) {
            $data['image_url'] = $imageUrl;

            $brand = Brand::create($data);

            if (!$brand->save()) {
                $response['status'] = "error";
                $response['message'] = "Error creating brand.";
            }
        }

        return redirect()
            ->route('tenant.brands.index')
            ->with($response['status'], $response['message']);
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

        $response = [
            "status" => "success",
            "message" => "Brand updated successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = generateSlug($data['slug'], 'brands');

        if (!empty($data['image_url']) && $data['image_url'] !== $brand->image_url) {
            if ($imageUrl = storeImage($image, '/images/brands')) {
                $data['image_url'] = $imageUrl;

                $oldImage = public_path() . '/images/brands/' . $brand->image_url;

                File::exists($oldImage) ? File::delete($oldImage) : '';
            }
        }

        if (!$brand->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating Brand.";
        }

        return redirect()
            ->route('tenant.brands.index')
            ->with('success', 'Brand updated successfully');
    }

    // Delete a Brand
    public function destroy(Brand $brand)
    {
        $response = [
            "status" => "success",
            "message" => "Brand deleted successfully!",
        ];

        $imageUrl = public_path() . '/images/brands/' . $brand->image_url;

        if ($brand->delete()) {
            File::exists($imageUrl) ? File::delete($imageUrl) : '';
        } else {
            $response['status'] = "error";
            $response['message'] = "Error deleting Brand.";
        }

        return redirect()
            ->route('tenant.brands.index')
            ->with($response['status'], $response['message']);
    }

}
