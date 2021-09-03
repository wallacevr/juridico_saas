<?php

namespace App\Http\Controllers\Tenant;

use App\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        // $validated = $this->validate($request, [
        //     'name' => 'required',
        //     'status' => 'required',
        //     'page-title' => 'required',
        //     'slug' => 'required',
        // ]);

        // return redirect(route('tenant.collections.show', [
        //     'collection' => $collection,
        // ]));
    }
}
