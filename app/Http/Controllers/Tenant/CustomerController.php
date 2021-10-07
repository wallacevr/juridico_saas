<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
class CustomerController extends Controller
{
    public function index(){
        $customers  =   Customer::all();
        return view('tenant.customers.index')->with('customers',$customers);
    }
    
    public function show($id){
        $customer   =   Customer::findOrFail($id);
        return view('tenant.customers.show')->with('customer',$customer);
    }
    public function edit($id){
        $customer   =   Customer::findOrFail($id);
        return view('tenant.customers.edit')->with('customer',$customer);
    }
    public function _update( $id, Request $request){
        $customer   =   Customer::findOrFail($id);
        $customer->name    =  $request->name;
        $customer->email   =  $request->email;
        $customer->password=  Hash::make($request->password);
        $customer->save();
        return view('tenant.customers.edit')->with('customer',$customer);
        
    }
}
