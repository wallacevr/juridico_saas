<?php

namespace App\Http\Controllers\Tenant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Plugin;
use App\Models\Config;

class PluginController extends Controller
{
    public function index($group)
    {
        $search = request('q');
        $installedplugins=Plugin::all();
        if (!empty($search)) {

            $plugins = DB::connection('central')->table('plugins')->where('plugin_group_id',$group)->where('name', 'like', '%' . $search . '%')->where('active',1)->paginate(25);
         

        } else {
            $plugins = DB::connection('central')->table('plugins')->where('plugin_group_id',$group)->where('active',1)->paginate(25);
         
        }  
       
        return view('tenant.plugins.index', [
            'plugins' => $plugins,'q'=>$search,'installedplugins'=>$installedplugins,'group'=>$group
        ]);
    }

    public function paymentplataformstore(Request $request){
        try {
         $request->validate([
            'creditcard' => 'required',
            'boleto' => 'required',
            'pix' => 'required'
         ]);
            
            //code...
            Config::createOrUpdate('payments/plataform/creditcard',$request->creditcard);
            Config::createOrUpdate('payments/plataform/boleto',$request->boleto);
            Config::createOrUpdate('payments/plataform/pix',$request->pix);
            return redirect()->back()->with('success','Payment settings save sucessfuly!');
        } catch (ValidationException $e) { 
            //throw $th;
          
            return redirect()->back()
            ->withErrors([
                'message' => [ $e->validator->messages()->messages() ]
            ]);
          
        } 
    }


    public function install($id){
        $plugins = DB::connection('central')->table('plugins')->where('active',1)->where('id',$id)->get();
  
        $plugin = new Plugin;
   
        $plugin->plugin_id = $plugins[0]->id;
        $plugin->plugin_group_id = $plugins[0]->plugin_group_id;
        $plugin->active=1;
   
        $plugin->name = $plugins[0]->name;
      
        $plugin->description = $plugins[0]->description;
        $plugin->settingsroute = $plugins[0]->settingsroute;
        $plugin->mainroute = $plugins[0]->mainroute;
        $plugin->image = $plugins[0]->image;
        $plugin->save();
        return redirect()->back()->with('success','Plugin installed successfully!');
    }
}
