<?php

namespace App\Http\Controllers\Tenant;

use App\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    // Return all Collections
    // Criar
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
    // TODO -  Gerar as imagem em uma pasta única para cada tenant?
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
        $data['slug'] = $this->generateSlug($data['slug']);

        if ($imageUrl = $this->storeImage($image)) {
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
    // TODO -  Gerar as imagem em uma pasta única para cada tenant?
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
            "message" => "Collection deleted successfully!",
        ];

        $data = $request->all();
        $image = $request->file('image_url');
        $data['slug'] = $this->generateSlug($data['slug']);

        if (!empty($data['image_url']) && $data['image_url'] !== $collection->image_url) {
            if ($imageUrl = $this->storeImage($image)) {
                $data['image_url'] = $imageUrl;

                $oldImage = public_path() . '/images/' . $collection->image_url;

                File::exists($oldImage) ? File::delete($oldImage) : '';

                if (!$collection->update($data)) {
                    $response['status'] = "error";
                    $response['message'] = "Error creating collection.";
                }
            }
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

        $imageUrl = public_path() . '/images/' . $collection->image_url;

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

    // Generate a slug after receiving an string as paramn
    public function generateSlug($slugString)
    {
        $originalSlug = Str::of($slugString)->slug('-');
        $newSlug = $originalSlug;
        $cont = 1;

        while (DB::table('collections')->where('slug', $newSlug)->exists()) {
            $newSlug = "{$originalSlug}-{$cont}";

            $cont++;
        }

        return $newSlug;
    }

    public function storeImage($image)
    {
        $destinationPath = public_path() . '/images';
        $microtime = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
        $imageUrl = Str::random(15) . $microtime . "." . $image->getClientOriginalExtension();

        $image->move($destinationPath, $imageUrl);

        return $imageUrl;
    }
}
