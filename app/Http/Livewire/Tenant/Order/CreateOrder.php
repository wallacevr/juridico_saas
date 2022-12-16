<?php

namespace App\Http\Livewire\Tenant\Order;

use Livewire\Component;
use App\Models\Customer;
use App\CartProduct;
use App\Cart;
class CreateOrder extends Component
{
    public $customers=[];
    public $customerid;
    public $carts=[];
    public $cartid;
    public $status;
    public $cartproducts=[];
    public $carrinho;
    public $cart;
    public function render()
    {
        try {
            $this->carts=Cart::where('id_customer',$this->customerid)->where('open',1)->get();
            
            if($this->cartid!=null){
                $this->cartproducts = CartProduct::where('id_cart','=',$this->cartid)->get();
                $this->carrinho = Cart::find($this->cartid);
                
            }
          
            return view('livewire.tenant.order.create-order');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }
    public function mount(){
        $this->customers=Customer::where('status',1)->get();
    }

 
}
