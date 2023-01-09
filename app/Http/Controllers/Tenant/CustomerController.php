<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{

    // Return all Customers
    public function index()
    {
        return view('tenant.customers.index', [
            'customers' => Customer::paginate(5),
        ]);
    }

    // Show the Customer edit form
    public function edit(Customer $customer)
    {
        $groups = CustomerGroup::all()->sortBy('name');
        return view('tenant.customers.edit')->with([
            'customer' => $customer,
            'addresses' => $customer->addresses,
            'groups' =>$groups
        ]);
    }

    // Update a Customer
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('customers')->ignore($customer->id, 'id'),
            ],
            'taxvat' => [
                'required',
                Rule::unique('customers')->ignore($customer->id, 'id'),
            ],
            'phone' => ['required'],
            'newsletter' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'taxvat' => preg_replace("/[^0-9]/", "", $request['taxvat']),
            'phone' => preg_replace("/[^0-9]/", "", $request['phone']),
            'telephone' => !empty($request['telephone']) ? preg_replace("/[^0-9]/", "", $request['telephone']) : null,
            'id_customer_group' =>!empty($request['customergroup']) ?  $request['customergroup'] : null,
            'password' => !empty($request['password']) ? Hash::make($request['password']) : $customer->password,
            'newsletter' => $request['newsletter'],
            'status' => !empty($request['status']) ? $request['status'] : 0,
        ];
        
        if (!$customer->update($data)) {
            return back()->withInput()->with("error", "Error updating customer.");
        }

        return redirect()->route('tenant.customers.index')->with("success", "Customer updated successfully");
    }

    public function updateCustomerAddress(Request $request, Address $address)
    {

        $this->validate($request, [
            'name' => 'required',
            'postalcode' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
        ]);

        $data = [
            'name' => $request['name'],
            'postalcode' => preg_replace("/[^0-9]/", "", $request['postalcode']),
            'address' => $request['address'],
            'neighborhood' => $request['neighborhood'],
            'complement' => !empty($request['complement']) ? $request['complement'] : $address->complement,
            'number' => !empty($request['number']) ? $request['number'] : $address->number,
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
        ];

        if (!$address->update($data)) {
            return back()->withInput()->with("error", "Error updating customer.");
        }
    }

    // Delete a Customer
    public function destroy(Customer $customer)
    {
        if (!$customer->delete()) {
            return redirect()->route('tenant.customers.index')->with("error", "Error deleting customer.");
        }

        return redirect()->route('tenant.customers.index')->with("success", "Customer deleted successfully");
    }
    public function show(Customer $customer){

    }
}
