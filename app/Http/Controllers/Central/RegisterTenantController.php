<?php

namespace App\Http\Controllers\Central;

use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Rules\DocumentId;
use App\Tenant;
use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    public function show()
    {
        if(empty(session()->get('step'))){
            return redirect(route('central.landing'));
        }
        return view('central.tenants.register');
    }

    public function step1(Request $request){

         $data = $this->validate($request, [
             'email' => 'required|email|max:255',
         ]);
        
        $stepModel = Step::where('email',$data['email'])->first();
        $tenant    = Tenant::where('email',$data['email'])->first();
        if(!empty($tenant)){
            $request->session()->forget('step');
            return back()->withInput()->with("error",__("There is a registered tenant with this email"));
        }
        if(empty($stepModel)){
            $stepModel = Step::create(['email'=>$data['email']]);
        }
        
        $request->session()->put('step',$stepModel);
        
        return redirect(route('central.tenants.register'));
    }
    public function submit(Request $request)
    {
        $data = $this->validate($request, [
            'domain' => 'required|string|unique:domains',
            'company' => 'required|string|max:255',
            'taxvat' => ['required',new DocumentId],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants',
            'password' => 'required|string|confirmed|max:255',
        ]);

        $data['password'] = bcrypt($data['password']);

        $domain = $data['domain'];
        unset($data['domain']);

        $tenant = (new CreateTenantAction)($data, $domain);

        // We impersonate user with id 1. This user will be created by the CreateTenantAdmin job.
        return redirect($tenant->impersonationUrl(1));
    }
}
