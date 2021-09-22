<?php

namespace App\Http\Controllers\Tenant;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Return all Categories
    public function index()
    {
        return view('tenant.categories.index', [
            'categories' => Category::getMainCategoriesWithChildrens(),
        ]);
    }

    // Return a single Category
    public function show(Category $category)
    {
        //TBD
    }

    // Show the Categories create form
    public function create()
    {
        return view('tenant.categories.create');
    }

    // Show the Category edit form
    public function edit(Brand $brand)
    {
        //TBD
    }

    // Store a Category
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Category created successfully!",
        ];

        $data = $request->all();

        $categoryStatus = isset($data['status']) ? $data['status'] : '0';

        $mainCategory = Category::create([
            'title' => $data['title'],
            'slug' => generateSlug($data['title'], 'categories'),
            'status' => $categoryStatus,
        ]);

        $mainCategory->save();

        if (isset($data['menu-items'])) {

            $subCategories = json_decode($data['menu-items'])[0];

            $this->storeSubCategories($subCategories, $mainCategory->id, $categoryStatus);

        }

        return redirect()
            ->route('tenant.categories.index')
            ->with($response['status'], $response['message']);
    }

    // Update a Category
    public function update(Request $request, Category $category)
    {
        //TDB
    }

    // Delete a Category
    public function destroy(Category $category)
    {
        $response = [
            "status" => "success",
            "message" => "Category deleted successfully!",
        ];

        if (!$category->delete()) {
            $response['status'] = "error";
            $response['message'] = "Error deleting Category.";
        }

        return redirect()
            ->route('tenant.categories.index')
            ->with($response['status'], $response['message']);
    }

    // This function inserts the subcategories recursively given a main category
    public function storeSubCategories($subCategories, $parentId, $categoryStatus)
    {
        foreach ($subCategories as $subCategory) {

            $currentSubCategory = Category::create([
                'title' => $subCategory->name,
                'slug' => generateSlug($subCategory->name, 'categories'),
                'status' => $categoryStatus,
                'is_parent' => 1,
                'parent_id' => $parentId,
            ]);

            $currentSubCategory->save();

            $subCategoryChilds = $subCategory->children[0];

            if (!empty($subCategoryChilds)) {

                $this->storeSubCategories($subCategoryChilds, $currentSubCategory->id, $categoryStatus);

            }
        }
    }

}
