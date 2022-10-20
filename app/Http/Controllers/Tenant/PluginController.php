<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plugin;

class PluginController extends Controller
{
    public function index()
    {
        $search = request('q');
        if (!empty($search)) {

            $plugins = Plugin::where('active',1)->where([
                ['name', 'like', '%' . $search . '%']
            ]);

        } else {
            $plugins = Plugin::where('active',1)->get();
            
        }
        return view('tenant.plugins.index', [
            'plugins' => $plugins->paginate(25),'q'=>$search
        ]);
    }
}
