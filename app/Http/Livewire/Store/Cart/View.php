<?php

namespace App\Http\Livewire\Store\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\CartProduct;
use App\Cart;
use App\Ticket;
use Auth;
class View extends Component
{
    public $cartproducts = [];
    public $ticket;
    public $cart;
    public function render()
    {
        $cart = Cart::where('id_customer',Auth::guard('customers')->user()->id)->where('open',1)->get();
        $this->cart = $cart;
        $this->cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
       
        return view('livewire.store.cart.view');
    }

    public function addcart(CartProduct $cartproduct,$optionid=null){
      
      
            dd(1);
    
               
                    CartProduct::where('id',$cartproduct->id)
                    ->update(['quantity'=>$cartproduct->quantity+1]);
              
                    $cart =  Cart::find($this->cart[0]->id);
                    dd($cart);
                    Session::put('cart', $cart);
                  
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
    public function validaticket(){
        try {
                   
        $ticket = Ticket::where('validator',$this->ticket)->get();
     
        if(count($ticket)>0){
          
            $product = CartProduct::where('id_cart',$this->cart[0]->id)
            ->whereIn('id_product',$ticket[0]->products->pluck('id'))->get();
           
            $cartproducts = CartProduct::where('id_cart',$this->cart[0]->id)->get();
       
            $prodvalido = false;
            
            foreach($cartproducts  as $cartprod){
               
                if($ticket[0]->products->pluck('id_product')->contains($cartprod->id_product)){
                    $prodvalido = true;
                    break;
                }
                foreach($cartprod->product->collections as $coll){
                    $col= $cartprod->product->collections;
                   
                  if(count($col)>0){
                   
                        if($ticket[0]->collections->pluck('id')->contains($coll->id)){
                            $prodvalido = true;
                            break 2;
                        }
                    }
                }
            }
          
            if($prodvalido){
             
                $cart = Cart::find($this->cart[0]->id);
                $cart->id_ticket = $ticket[0]->id;
              
                $cart->update();
                session()->flash('success', 'coupon successfully applied!!!');
            }else{
                session()->flash('erro', 'coupon successfully applied!!!');
            }
            
        }else{
            session()->flash('erro', 'Coupon is not valid for products in your cart!!');  
        }
        } catch (\Throwable $th) {
            //throw $th;
          
           
        }
    }   
}
