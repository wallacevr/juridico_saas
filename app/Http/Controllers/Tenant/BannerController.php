<?php

namespace App\Http\Controllers\Tenant;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    // Return all Banners
    public function index()
    {
        return view('tenant.banners.index', [
            'stripeBanners' => Banner::where('type', 'STRIPE')->paginate(3, ['*'], 'stripeBanners'),
            'fullBanners' => Banner::where('type', 'FULL')->paginate(3, ['*'], 'fullBanners'),
            'showcaseBanners' => Banner::where('type', 'SHOWCASE')->paginate(3, ['*'], 'showcaseBanners'),
            'sideBanners' => Banner::where('type', 'SIDE')->paginate(3, ['*'], 'sideBanners'),
            'miniBanners' => Banner::where('type', 'MINI')->paginate(3, ['*'], 'miniBanners'),
        ]);
    }

    // Show the Banner create form
    public function create()
    {
        return view('tenant.banners.create');
    }

    // Show the Banner edit form
    public function edit(Banner $banner)
    {
        return view('tenant.banners.edit')->with(['banner' => $banner]);
    }

    // Store a Banner
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        $response = [
            "status" => "success",
            "message" => "Banner created successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');

        if ($imageUrl = storeImage($image, '/images/banners')) {
            $data['image_url'] = $imageUrl;

            $banner = Banner::create($data);

            if (!$banner->save()) {
                $response['status'] = "error";
                $response['message'] = "Error creating banner.";
            }
        }

        return redirect()->route('tenant.banners.index')->with($response['status'], $response['message']);
    }

    // Update a Banner
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        $response = [
            "status" => "success",
            "message" => "Banner updated successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');
        $data['status'] = isset($data['status']) ? '1' : '0';

        if (!empty($data['image_url']) && $data['image_url'] !== $banner->image_url) {
            if ($imageUrl = storeImage($image, '/images/banners')) {
                $data['image_url'] = $imageUrl;

                $oldImage = public_path() . '/images/banners/' . $banner->image_url;

                File::exists($oldImage) ? File::delete($oldImage) : '';
            }
        }

        if (!$banner->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating Banner.";
        }

        return redirect()->route('tenant.banners.index')->with('success', 'Banner updated successfully');
    }

    // Delete a Banner
    public function destroy(Banner $banner)
    {
        $response = [
            "status" => "success",
            "message" => "Banner deleted successfully!",
        ];

        $imageUrl = public_path() . '/images/banners/' . $banner->image_url;

        if ($banner->delete()) {
            File::exists($imageUrl) ? File::delete($imageUrl) : '';
        } else {
            $response['status'] = "error";
            $response['message'] = "Error deleting Banner.";
        }

        return redirect()
            ->route('tenant.banners.index')
            ->with($response['status'], $response['message']);
    }
}
