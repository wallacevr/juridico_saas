<?php

namespace App\Http\Controllers\Tenant;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Return all Categories
    public function index()
    {

        return redirect()->route('tenant.categories.edit',['category' => 1]);
        //disable view
        return view('tenant.categories.index', [
            'categories' => Category::getMainCategoriesWithChildrens(),
        ]);
    }

    // Show the Categories create form
    public function create()
    {

        return redirect()->route('tenant.categories.edit',['category' => 1]);
        //disable view
        return view('tenant.categories.create');
    }

    // Show the Category edit form
    public function edit(Category $category)
    {
        
        return view('tenant.categories.edit', [
            'category' => Category::getMainCategoryWithChildrens($category->id),
        ]);
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
            // Loop to insert the subcategories from the MAIN Category
            foreach ($subCategories as $subCategory) {

                $currentSubCategory = Category::create([
                    'title' => $subCategory->name,
                    'slug' => generateSlug($subCategory->name, 'categories'),
                    'status' => $categoryStatus,
                    'is_parent' => 0,
                    'parent_id' => $mainCategory->id,
                    'url' => $subCategory->url,
                ]);

                $currentSubCategory->save();

                $subCategoryChilds = $subCategory->children[0];

                $this->storeSubCategories($subCategoryChilds, $currentSubCategory->id, $categoryStatus);

            }
        }

        return redirect()->route('tenant.categories.edit',['category' => 1])->with($response['status'], $response['message']);
    }

    // Update a Category
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Category updated successfully!",
        ];

        $data = $request->all();

        $data['slug'] = generateSlug($data['title'], 'categories', $category->id);
        $data['status'] = isset($data['status']) ? '1' : '0';

        // Caso haja alguma alteração nas subcategorias, é realizada a atualização
        if (isset($data['menu-items'])) {
            $subCategories = json_decode($data['menu-items'])[0];

            foreach ($subCategories as $sort=>$subCategory) {

                $this->insertOrUpdateCategory($subCategory, $category->id,$sort);

                if ($subCategory->children[0]) {
                    $this->updateSubCategories($subCategory->children[0], $subCategory->id,$sort);
                }
            }
        }

        // Remove as categorias excluídas na tela de edição
        if (isset($data['menu-items-delete'])) {
            $deletedSubcategories = explode(',', $data['menu-items-delete']);
            Category::destroy($deletedSubcategories);
        }

        if (!$category->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating Category.";
        }

        return redirect()->route('tenant.categories.index')->with($response['status'], $response['message']);
    }

    // Delete a Category
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('tenant.categories.index')->with('success', 'Category deleted successfully!');
        } else {
            return redirect()->route('tenant.categories.index')->with('error', 'Error deleting Category.');
        }
    }

    // This function inserts the subcategories recursively given a main category
    public function storeSubCategories($subCategories, $parentId, $categoryStatus)
    {
        // Loop to insert the subcategories childs from the subcategory
        foreach ($subCategories as $sort => $subCategoryChild) {
            $currentsubCategoryChild = Category::create([
                'title' => $subCategoryChild->name,
                'slug' => generateSlug($subCategoryChild->name, 'categories'),
                'status' => $categoryStatus,
                'is_parent' => 1,
                'sort' => $sort,
                'parent_id' => $parentId,
                'url' => $subCategoryChild->url,
            ]);

            $currentsubCategoryChild->save();

            $subCategoriesFromChilds = $subCategoryChild->children[0];

            if ($subCategoriesFromChilds) {
                $this->storeSubCategories($subCategoriesFromChilds, $currentsubCategoryChild->id, $categoryStatus);
            }
        }
    }

    public function updateSubCategories($subCategories, $parentId)
    {
        $sort=0;
        foreach ($subCategories as $subCategory) {
            $this->insertOrUpdateCategory($subCategory, $parentId,$sort);

            if ($subCategory->children[0]) {
                $this->updateSubCategories($subCategory->children[0], $subCategory->id,$sort);
            }
            $sort++;
        }
    }

    public function insertOrUpdateCategory(&$subCategory, $parentId,$sort)
    {
        if (isset($subCategory->id)) {
            DB::table('categories')->where('id', $subCategory->id)->update([
                'title' => $subCategory->name,
                'url' => $subCategory->url,
                'sort' => $sort,
                'parent_id' => $parentId,
            ]);
        } else {
            DB::table('categories')->insert([
                'title' => $subCategory->name,
                'url' => $subCategory->url,
                'sort' =>$sort,
                'parent_id' => $parentId,
                'slug' => generateSlug($subCategory->name, 'categories'),
            ]);

            $subCategory->id = DB::getPdo()->lastInsertId();
        }
    }

}
