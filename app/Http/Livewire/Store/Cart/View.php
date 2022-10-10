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
        $cart = Cart::where('id_customer',Auth::guard('customers')->user()->id)->where('open',1)->get();
        
        $this->cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
       
        return view('livewire.store.cart.view');
    }

    public function addcart(CartProduct $cartproduct){
      
      
         
    
               
                    CartProduct::where('id',$cartproduct->id)
                    ->update(['quantity'=>$cartproduct->quantity+1]);
              
                $cartcustomer = Auth::guard('customers')->user()->opencarts()->get();
                $cartproducts = CartProduct::where('id_cart',$cartcustomer[0]->id)->get();
                session()->put('cart', $cartproducts);
                $this->emit('UpdateCart');
               
           
            session()->flash('success', 'Product added to cart successfully!');
      
    }

    public function removecart(CartProduct $cartproduct){
      
      
         
    
               
        CartProduct::where('id',$cartproduct->id)
        ->update(['quantity'=>$cartproduct->quantity-1]);
  
    $cartcustomer = Auth::guard('customers')->user()->opencarts()->get();
    $cartproducts = CartProduct::where('id_cart',$cartcustomer[0]->id)->get();
    session()->put('cart', $cartproducts);
    $this->emit('UpdateCart');
   

    session()->flash('success', 'Product removed to cart successfully!');

    }   

    public function removeall(CartProduct $cartproduct){
      
      
         
    
               
        $cartproduct->delete();
  
    $cartcustomer = Auth::guard('customers')->user()->opencarts()->get();
    $cartproducts = CartProduct::where('id_cart',$cartcustomer[0]->id)->get();
    session()->put('cart', $cartproducts);
    $this->emit('UpdateCart');
   

    session()->flash('success', 'Product removed to cart successfully!');

    }   
}
