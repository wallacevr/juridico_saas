<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Page;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    // Return all Pages
    public function index()
    {
        return view('tenant.pages.index', [
            'pages' => Page::paginate(5),
        ]);
    }

    // Return a single Page
    public function show(Page $page)
    {
        return view('tenant.pages.show', [
            'page' => $page,
        ]);
    }

    // Show the Page create form
    public function create()
    {
        return view('tenant.pages.create');
    }

    // Show the Page edit form
    public function edit(Page $page)
    {
        return view('tenant.pages.edit')->with(['page' => $page]);
    }

    // Store a Page
    public function store(Request $request)
    {
        //$request->merge(['url' => url("/pages/{$request->url}")]);

        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'title' => 'required',
            'url' => 'required|unique:urls',
        ]);

        $data = $request->all();

        $data['keywords'] = isset($data['keywords']) && !empty($data['keywords']) ? implode(',', $data['keywords']) : null;

        $page = Page::create($data);

        if (!$page->save()) {
            return back()->withInput()->with("error", "Error creating page.");
        }

        URL::create([
            'url' => 'pagina/'.$page->url,
            'entity' => 'PAGE',
            'entity_id' => $page->id,
        ])->save();

        return redirect()->route('tenant.pages.index')->with("success", "Page created successfully!");
    }

    // Update a Page
    public function update(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'title' => 'required',
            'url' => [
                'required',
                Rule::unique('urls')->ignore($page->id, 'entity_id'),
            ],
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $data = $request->all();
        $data['status'] = isset($data['status']) ? '1' : '0';
        $data['keywords'] = isset($data['keywords']) && !empty($data['keywords']) ? implode(',', $data['keywords']) : null;

        $page->update($data);


        return redirect()->route('tenant.pages.index')->with("success", "Page updated successfully!");
    }

    // Delete a Page
    public function destroy(Page $page)
    {
        try {
            DB::beginTransaction();

            $page->delete();

            $url = URL::firstWhere('url', $page->url);

            $url->delete();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();

            return redirect()->route('tenant.pages.index')->with("error", "Error deleting page.");
        }

        return redirect()->route('tenant.pages.index')->with("success", "Page deleted successfully!");
    }

}
