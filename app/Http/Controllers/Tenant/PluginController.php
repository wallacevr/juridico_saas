<?php

namespace App\Http\Controllers\Tenant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plugin;

class PluginController extends Controller
{
    public function index()
    {
        $search = request('q');
        $installedplugins=Plugin::all();
        if (!empty($search)) {

            $plugins = DB::connection('central')->table('plugins')->where('name', 'like', '%' . $search . '%')->where('active',1)->paginate(25);
         

        } else {
            $plugins = DB::connection('central')->table('plugins')->where('active',1)->paginate(25);
         
        }  
       
        return view('tenant.plugins.index', [
            'plugins' => $plugins,'q'=>$search,'installedplugins'=>$installedplugins
        ]);
    }

    public function install($id){
        $plugins = DB::connection('central')->table('plugins')->where('active',1)->where('id',$id)->get();
  
        $plugin = new Plugin;
        $plugin->plugin_id = $plugins[0]->id;
        $plugin->plugin_group_id = $plugins[0]->plugin_group_id;
        $plugin->save();
        return redirect()->back()->with('success','Plugin installed successfully!');
    }
}
