<?php

namespace App\Http\Livewire\Store\Customers;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Address;
use App\Order;
use Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class Myaccount extends Component
{
  
    public $name;
    public $mail;
    public $taxvat;
    public $phone;
    public $telephone;
    public $addresses=[];
    public $postalcode;
    public $address;
    public $number;
    public $neighborhood;
    public $complement;
    public $city;
    public $country;
    public $state;
    public $dob;
    public $id_address;
    public $tabh = 'profile';
    public $tabv = 'profile';
    public $password;
    public $password_confirmation;
    public $current_password;
    public $newaddress = false;
    public $wishlistproducts = [];
   
   

    protected function validatorprofile()
    {
        return Validator::make($this, [
            // User data
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email,'. Auth::guard('customers')->user()->id],
            'telephone' => [],
            'phone' => ['required'],
            'taxvat' => ['required', 'unique:customers,taxvat,'. Auth::guard('customers')->user()->id],

        ]);
    }
    public function render()
    {
        return view('livewire.store.customers.myaccount',[
            'orders' => Order::where('id_customer',Auth::guard('customers')->user()->id)->paginate(5)
        ]);
    }

    public function mount($tabvertical=null){
      
       $customer = Customer::find(Auth::guard('customers')->user()->id);
       
       $this->name = $customer->name;
       $this->email = $customer->email;
       $this->taxvat = $customer->taxvat;
       $this->phone = $customer->phone;
       $this->telephone = $customer->telephone;
       $this->dob = $customer->dob->format('Y-m-d');
       $this->addresses = $customer->addresses;
       $this->id_address = $customer->addresses[0]->id;
       $this->addressname = $customer->addresses[0]->name;
       $this->postalcode =$this->addresses[0]->postalcode;
       $this->address = $this->addresses[0]->address;
       $this->number = $this->addresses[0]->number;
       $this->neighborhood = $this->addresses[0]->neighborhood;
       $this->complement = $this->addresses[0]->complement;
       $this->city = $this->addresses[0]->city;
       $this->state = $this->addresses[0]->state;
       $this->country = $this->addresses[0]->country;
       $this->wishlistproducts = $customer->wishlist;
      $this->tabv=$tabvertical;
        
    }
    public function setaddress(){
        $address = Address::find($this->id_address);
      
        $this->postalcode = $address->postalcode;
        $this->address = $address->address;
        $this->number = $address->number;
        $this->neighborhood = $address->neighborhood;
        $this->complement = $address->complement;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->country = $address->country;
    }
    public function refreshaddress(){
        $response = Http::get("http://viacep.com.br/ws/".  $this->postalcode ."/json/");
        $response = json_decode($response);
   
        $this->address = $response->logradouro;

        $this->neighborhood = $response->bairro;
     
        $this->city = $response->localidade;
        $this->state = $response->uf;
        $this->country = "BR";
    }

    public function storeprofile(){
        $this->validate([
            // User data
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email,'. Auth::guard('customers')->user()->id],
            'telephone' => [],
            'phone' => ['required'],
            'taxvat' => ['required', 'unique:customers,taxvat,'. Auth::guard('customers')->user()->id],

        ]);
        try {
       

            $customer = Customer::find(Auth::guard('customers')->user()->id);
            $customer->name = $this->name;
            $customer->email = $this->email;
            $customer->phone = $this->phone;
            $customer->telephone = $this->telephone;
            $customer->taxvat = $this->taxvat;
            $customer->update();
            session()->flash('success', 'Profile update successfully!');

        }
 
        catch(\Throwable $Error)
        {
            session()->flash('error', $Error->getMessage());
     
        }
    }


    public function settabv($tab){
        $this->tabv = $tab;
     
    }
    public function settabh($tab){
        $this->tabh = $tab;
    }
    public function createnewadress(){
        $this->newaddress = true;
        $this->postalcode = "";
        $this->address = "";
        $this->number = "";
        $this->neighborhood = "";
        $this->complement = "";
        $this->city = "";
        $this->state = "";
        $this->country = "BR";
    }

    public function storeaddress(){
        $this->validate([
            'postalcode' => ['required'],
            'address' => ['required'],
            'neighborhood' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
        ]);
        $address = new Address;
        $address->name = $this->addressname;
        $address->postalcode = $this->postalcode;
        $address->Address= $this->address;
        $address->neighborhood = $this->neighborhood;
        $address->customer_id = Auth::guard('customers')->user()->id;
        $address->city = $this->city;
        $address->state= $this->state;
        $address->country= $this->country;
        $address->number= $this->number;
        $address->complement= $this->complement;
        $address->save();
        session()->flash('success', 'Address saved successfully!');
        $customer = Customer::find(Auth::guard('customers')->user()->id);
        $this->addresses = $customer->addresses;
    }

    public function updateaddress(){
        $this->validate([
            'postalcode' => ['required'],
            'address' => ['required'],
            'neighborhood' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
        ]);
        try {
            
            $address = Address::find($this->id_address);
            $address->name = $this->addressname;
            $address->postalcode = $this->postalcode;
           
            $address->neighborhood = $this->neighborhood;
            $address->Address= $this->address;
            $address->city = $this->city;
            $address->state= $this->state;
            $address->country= $this->country;
            $address->number= $this->number;
            $address->complement= $this->complement;
        
            $address->update();
            session()->flash('success', 'Address update successfully!');
            $customer = Customer::find(Auth::guard('customers')->user()->id);
            $this->addresses = $customer->addresses;
        }catch(\Throwable $Error)
            {
                session()->flash('error', $Error->getMessage());
         
            }

    }

    public function changepassword(){
        
        $this->validate([
            'password' => ['required','min:6','confirmed'],
            'password_confirmation' => ['required','min:6']

        ]);
       
        try {
           
            $customer = Customer::find(Auth::guard('customers')->user()->id);
            $customer->password = Hash::make($this->password);
            $customer->update();
            session()->flash('success', 'Password change successfully!');
        }

        catch(\Throwable $Error)
        {
            session()->flash('error', $Error->getMessage());
     
        }
    }
}
