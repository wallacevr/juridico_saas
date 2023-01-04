<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login()
    {
      
        if(View::exists('store.auth.login'))
        {
            return view('store.auth.login');
        }
        abort(Response::HTTP_NOT_FOUND);
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->except(['_token']);

        
            if(Auth::guard('customers')->attempt($credentials))
            {
                return redirect()->intended();
                //return redirect(RouteServiceProvider::HOME);
            }elseif(Auth::guard('admin')->attempt($credentials)){
                return redirect()->route('admin.dashboad');
            }
       
        return redirect()->action([
            LoginController::class,
            'login'
        ])->with('message','Credentials not matced in our records!');

    }
}
