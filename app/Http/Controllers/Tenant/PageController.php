<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'name' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Page created successfully!",
        ];

        $data = $request->all();

        $data['keywords'] = isset($data['keywords']) && !empty($data['keywords']) ? implode(',', $data['keywords']) : null;

        $page = Page::create($data);

        if (!$page->save()) {
            $response['status'] = "error";
            $response['message'] = "Error creating page.";
        }

        return redirect()->route('tenant.pages.index')->with($response['status'], $response['message']);
    }

    // Update a Page
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Page updated successfully!",
        ];

        $data = $request->all();
        $data['status'] = isset($data['status']) ? '1' : '0';
        $data['keywords'] = isset($data['keywords']) && !empty($data['keywords']) ? implode(',', $data['keywords']) : null;

        if (!$page->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating Page.";
        }

        return redirect()->route('tenant.pages.index')->with('success', 'Page updated successfully');
    }

    // Delete a Page
    public function destroy(Page $page)
    {
        $response = [
            "status" => "success",
            "message" => "Page deleted successfully!",
        ];

        if (!$page->delete()) {
            $response['status'] = "error";
            $response['message'] = "Error deleting Page.";
        }

        return redirect()->route('tenant.pages.index')->with($response['status'], $response['message']);
    }

}
