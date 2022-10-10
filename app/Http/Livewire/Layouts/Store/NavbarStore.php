<?php

namespace App\Http\Livewire\Layouts\Store;

use Livewire\Component;
use App\Cart;
use App\CartProduct;
use Auth;
class NavbarStore extends Component
{
    public $listeners =['UpdateCart'=>'render'];
    public $cartproducts;
    public function render()
    {
        $cart = Cart::where('id_customer',Auth::guard('customers')->user()->id)->where('open',1)->get();
        
        $this->cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
        return view('livewire.layouts.store.navbar-store');
    }
}
