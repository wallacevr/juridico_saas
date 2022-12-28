<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeCustomer;
class CustomerController extends Controller
{
    public function index()
    {
    }

    public function submit(Request $request)
    {
        $this->validator($request->all())->validate();

        DB::beginTransaction();

        $user = $this->create($request->all());

        if (empty($user)) {
            DB::rollBack();
        }

        DB::commit();

        $auth = auth()->guard('customers');
        $auth->login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function create(array $data)
    {
       try {
                $customer = Customer::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => preg_replace("/[^0-9]/", "", $data['phone']),
                    'telephone' => !empty($data['telephone']) ? preg_replace("/[^0-9]/", "", $data['telephone']) : null,
                    'dob' => !empty($data['dob']) ? $data['dob'] : null,
                    'taxvat' => preg_replace("/[^0-9]/", "", $data['taxvat']),
                    'ip' => \Request::ip(),
                    'newsletter' => $data['newsletter'],
                    'accepts_terms_of_use' => $data['terms'],
                    'password' => Hash::make($data['password']),
                ]);

                $address = Address::create([
                    'name' => $customer->name,
                    'postalcode' => preg_replace("/[^0-9]/", "", $data['postalcode']),
                    'address' => $data['address'],
                    'neighborhood' => $data['neighborhood'],
                    'complement' => !empty($data['complement']) ? $data['complement'] : null,
                    'number' => !empty($data['number']) ? $data['number'] : null,
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                    'customer_id' => $customer->id,
                ]);
                Mail::to($customer->email)->send(new WelcomeCustomer($customer));
                return $customer;
       } catch (\Throwable $th) {
        //throw $th;
      
       }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // User data
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required'],
            'taxvat' => ['required', 'unique:customers'],
            'newsletter' => ['required'],
            'terms' => ['accepted'],
            // Address
            'postalcode' => ['required'],
            'address' => ['required'],
            'neighborhood' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
        ]);
    }

    public function show()
    {
        return view('store.auth.register');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function customerDashboard()
    {
        return view('store.customers.dashboard');
    }

    public function customerAddresses()
    {
        return view('store.customers.addresses', [
            'addresses' => Customer::find(Auth::user()->id)->addresses,
        ]);
    }


}
