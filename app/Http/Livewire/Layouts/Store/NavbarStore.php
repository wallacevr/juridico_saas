<?php

namespace App\Http\Livewire\Layouts\Store;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Cart;
use App\CartProduct;
use Auth;
class NavbarStore extends Component
{
    public $listeners =['UpdateCart'=>'render'];
    public $cartproducts=[];
    public function render()
    {
        
        $cart = Session::get('cart', []);
       
        if(isset($cart->id)){
            if(count($cart->products)>0){
                $this->cartproducts =  CartProduct::where('id_cart',$cart->id)->get();
            }else{
                $this->cartproducts=[];
            }
        }else{
            $this->cartproducts=[];
        }

            

        
        return view('livewire.layouts.store.navbar-store');
    }
}
