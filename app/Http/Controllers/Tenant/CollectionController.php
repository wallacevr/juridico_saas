<?php

namespace App\Http\Controllers\Tenant;

use App\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        return view('tenant.collections.index', [
            'collections' => Collection::cursor(),
        ]);
    }

    public function show(Collection $collection)
    {
        return view('tenant.collections.show', [
            'collection' => $collection,
        ]);
    }

    public function create()
    {
        return view('tenant.collections.create');
    }

    public function edit(Collection $collection)
    {
        return view('tenant.collections.edit')->with(['collection' => $collection]);
    }

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

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()
            ->route('tenant.collections.index')
            ->with('success', 'Collection deleted successfully!');
    }

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
