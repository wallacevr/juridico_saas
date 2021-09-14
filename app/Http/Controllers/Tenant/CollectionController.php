<?php

namespace App\Http\Controllers\Tenant;

use App\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CollectionController extends Controller
{
    // Return all Collections
    public function index()
    {
        return view('tenant.collections.index', [
            'collections' => Collection::paginate(5),
        ]);
    }

    // Return a single Collection
    public function show(Collection $collection)
    {
        return view('tenant.collections.show', [
            'collection' => $collection,
        ]);
    }

    // Show the Collection create form
    public function create()
    {
        return view('tenant.collections.create');
    }

    // Show the Collection edit form
    public function edit(Collection $collection)
    {
        return view('tenant.collections.edit')->with(['collection' => $collection]);
    }

    // Store a Collection
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
            "message" => "Collection created successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = generateSlug($data['slug'], 'collections');

        if ($imageUrl = storeImage($image, '/images/collections')) {
            $data['image_url'] = $imageUrl;

            $collection = Collection::create($data);

            if (!$collection->save()) {
                $response['status'] = "error";
                $response['message'] = "Error creating collection.";
            }
        }

        return redirect()
            ->route('tenant.collections.index')
            ->with($response['status'], $response['message']);
    }

    // Update a Collection
    public function update(Request $request, Collection $collection)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_title' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'slug' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Collection updated successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = generateSlug($data['slug'], 'collections');

        if (!empty($data['image_url']) && $data['image_url'] !== $collection->image_url) {
            if ($imageUrl = storeImage($image, '/images/collections')) {
                $data['image_url'] = $imageUrl;

                $oldImage = public_path() . '/images/collections/' . $collection->image_url;

                File::exists($oldImage) ? File::delete($oldImage) : '';
            }
        }

        if (!$collection->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating collection.";
        }

        return redirect()
            ->route('tenant.collections.index')
            ->with('success', 'Collection updated successfully');
    }

    // Delete a Collection
    public function destroy(Collection $collection)
    {
        $response = [
            "status" => "success",
            "message" => "Collection deleted successfully!",
        ];

        $imageUrl = public_path() . '/images/collections/' . $collection->image_url;

        if ($collection->delete()) {
            File::exists($imageUrl) ? File::delete($imageUrl) : '';
        } else {
            $response['status'] = "error";
            $response['message'] = "Error deleting collection.";
        }

        return redirect()
            ->route('tenant.collections.index')
            ->with($response['status'], $response['message']);
    }

}
