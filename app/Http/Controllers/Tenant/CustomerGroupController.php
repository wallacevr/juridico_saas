<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\CustomerGroup;

class CustomerGroupController extends Controller
{
    public function index(){

       $groups = CustomerGroup::all();
       
       return view('tenant.customers_group.index')->with('groups',$groups);
    }

    public function create(){

        return view('tenant.customers_group.create');
    }

    public function store(Request $request){
        dd('store');
    }
    
    public function update(Request $request,$id){

        CustomerGroup::where('id',$id)
        ->update(['name'=>$request->name]);
        
        return redirect()->route('tenant.groups.edit',$id);
    }

    public function show($id){
        dd('show');
    }

    public function edit($id){
        $group  =   CustomerGroup::find($id);
        return view('tenant.customers_group.edit')->with('group',$group);
    }

    public function destroy($id){

        CustomerGroup::destroy($id);
        return redirect()->route('tenant.groups.index');
    }
}
