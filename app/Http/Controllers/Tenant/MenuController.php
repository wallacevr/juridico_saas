<?php

namespace App\Http\Controllers\Tenant;

use App\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // Return all Menus
    public function index()
    {

        return redirect()->route('tenant.menus.edit', ['menu' => 1]);
        //disable view
        return view('tenant.menus.index', [
            'menus' => Menu::getMainMenusWithChildrens(),
        ]);
    }

    // Show the Menus create form
    public function create()
    {

        return redirect()->route('tenant.menus.edit', ['menu' => 1]);
        //disable view
        return view('tenant.menus.create');
    }

    // Show the Menu edit form
    public function edit(Menu $menu)
    {

        return view('tenant.menus.edit', [
            'menu' => Menu::getMainMenuWithChildrens($menu->id),
        ]);
    }

    // Store a Menu
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Menu created successfully!",
        ];

        $data = $request->all();

        $menuStatus = isset($data['status']) ? $data['status'] : '0';

        $mainMenu = Menu::create([
            'title' => $data['title'],
            'slug' => generateSlug($data['title'], 'menus'),
            'status' => $menuStatus,
        ]);

        $mainMenu->save();

        if (isset($data['menu-items'])) {

            $subMenus = json_decode($data['menu-items'])[0];
            // Loop to insert the submenus from the MAIN Menu
            foreach ($subMenus as $subMenu) {

                $currentSubMenu = Menu::create([
                    'title' => $subMenu->name,
                    'slug' => generateSlug($subMenu->name, 'menus'),
                    'status' => $menuStatus,
                    'is_parent' => 0,
                    'parent_id' => $mainMenu->id,
                    'url' => $subMenu->url,
                ]);

                $currentSubMenu->save();

                $subMenuChilds = $subMenu->children[0];

                $this->storeSubMenus($subMenuChilds, $currentSubMenu->id, $menuStatus);
            }
        }

        return redirect()->route('tenant.menus.edit', ['menu' => 1])->with($response['status'], $response['message']);
    }

    // Update a Menu
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $response = [
            "status" => "success",
            "message" => "Menu updated successfully!",
        ];

        $data = $request->all();

        $data['slug'] = generateSlug($data['title'], 'menus', $menu->id);
        $data['status'] = isset($data['status']) ? '1' : '0';

        // Caso haja alguma alteração nas subcategorias, é realizada a atualização
        if (isset($data['menu-items'])) {
            $subMenus = json_decode($data['menu-items'])[0];

            foreach ($subMenus as $sort => $subMenu) {

                $this->insertOrUpdateMenu($subMenu, $menu->id, $sort);

                if ($subMenu->children[0]) {
                    $this->updateSubMenus($subMenu->children[0], $subMenu->id, $sort);
                }
            }
        }

        // Remove as categorias excluídas na tela de edição
        if (isset($data['menu-items-delete'])) {
            $deletedSubmenus = explode(',', $data['menu-items-delete']);
            Menu::destroy($deletedSubmenus);
        }

        if (!$menu->update($data)) {
            $response['status'] = "error";
            $response['message'] = "Error updating Menu.";
        }

        return redirect()->route('tenant.menus.index')->with($response['status'], $response['message']);
    }

    // Delete a Menu
    public function destroy(Menu $menu)
    {
        if ($menu->delete()) {
            return redirect()->route('tenant.menus.index')->with('success', 'Menu deleted successfully!');
        } else {
            return redirect()->route('tenant.menus.index')->with('error', 'Error deleting Menu.');
        }
    }

    // This function inserts the submenus recursively given a main menu
    public function storeSubMenus($subMenus, $parentId, $menuStatus)
    {
        // Loop to insert the submenus childs from the submenu
        foreach ($subMenus as $sort => $subMenuChild) {
            $currentsubMenuChild = Menu::create([
                'title' => $subMenuChild->name,
                'slug' => generateSlug($subMenuChild->name, 'menus'),
                'status' => $menuStatus,
                'is_parent' => 1,
                'sort' => $sort,
                'parent_id' => $parentId,
                'url' => $subMenuChild->url,
            ]);

            $currentsubMenuChild->save();

            $subMenusFromChilds = $subMenuChild->children[0];

            if ($subMenusFromChilds) {
                $this->storeSubMenus($subMenusFromChilds, $currentsubMenuChild->id, $menuStatus);
            }
        }
    }

    public function updateSubMenus($subMenus, $parentId)
    {
        $sort = 0;
        foreach ($subMenus as $subMenu) {
            $this->insertOrUpdateMenu($subMenu, $parentId, $sort);

            if ($subMenu->children[0]) {
                $this->updateSubMenus($subMenu->children[0], $subMenu->id, $sort);
            }
            $sort++;
        }
    }

    public function insertOrUpdateMenu(&$subMenu, $parentId, $sort)
    {
        if (isset($subMenu->id)) {
            DB::table('menus')->where('id', $subMenu->id)->update([
                'title' => $subMenu->name,
                'url' => $subMenu->url,
                'sort' => $sort,
                'parent_id' => $parentId,
            ]);
        } else {
            DB::table('menus')->insert([
                'title' => $subMenu->name,
                'url' => $subMenu->url,
                'sort' => $sort,
                'parent_id' => $parentId,
                'slug' => generateSlug($subMenu->name, 'menus'),
            ]);

            $subMenu->id = DB::getPdo()->lastInsertId();
        }
    }

    public function getUrl()
    {
        $pages[] =  (object)[
            'text'=>'',
            'children' => [['id'=>'#','text'=>"#"]],
        ];

        $pages[] = (object)[
            'text'=>'Pages',
            'children' => [['id'=>"https://www.google.com",'text'=>"filho Pages"]],
        ];
        $pages[] = (object)[
            'text'=>'Produtos',
            'children' => [['id'=>"https://www.maxcommerce.com",'text'=>"filho Produtos"]],
        ];
        return response()->json($pages);
    }
}
