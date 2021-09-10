<?php

namespace App\Http\Controllers\Tenant;

use App\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    // Return all Collections
    public function index()
    {
        return view('tenant.collections.index', [
            'collections' => Collection::cursor(),
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

    // Update a Collection
    // TODO - Criar o delete da imagem antiga e validação de erro
    // TODO -  Gerar as imagem em uma pasta única para cada tenant?
    public function update(Request $request, Collection $collection)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_title' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'slug' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateSlug($data['slug']);

        if (!empty($data['image_url'])) {
            if ($data['image_url'] !== $collection->image_url && $image = $request->file('image_url')) {
                $destinationPath = public_path() . '/images';
                $microtime = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
                $profileImage = Str::random(15) . $microtime . "." . $image->getClientOriginalExtension();

                $image->move($destinationPath, $profileImage);
                $data['image_url'] = "$profileImage";
            }
        }

        $collection->update($data);

        return redirect()
            ->route('tenant.collections.index')
            ->with('success', 'Collection updated successfully');
    }

    // Store a Collection
    // TODO -  Criar a validação de erro
    // TODO -  Gerar as imagem em uma pasta única para cada tenant?
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_title' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'slug' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateSlug($data['slug']);

        if ($image = $request->file('image_url')) {
            $destinationPath = public_path() . '/images';
            $microtime = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
            $profileImage = Str::random(15) . $microtime . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);
            $data['image_url'] = "$profileImage";
        }

        $collection = Collection::create($data);

        $collection->save();

        return redirect()
            ->route('tenant.collections.index')
            ->with('success', 'Collection created successfully!');
    }

    // Delete a Collection
    // TODO -  Criar o delete da imagem e validação de erro
    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()
            ->route('tenant.collections.index')
            ->with('success', 'Collection deleted successfully!');
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
}
