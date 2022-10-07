<?php

namespace App\Http\Livewire\Store\Cart;

use Livewire\Component;
use App\CartProduct;
use App\Cart;
use Auth;
class View extends Component
{
    public $cartproducts = [];
    public function render()
    {
        $cart = Cart::where('id_customer',Auth::user()->id)->where('open',1)->get();
        
        $this->cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
       
        return view('livewire.store.cart.view');
    }
}
