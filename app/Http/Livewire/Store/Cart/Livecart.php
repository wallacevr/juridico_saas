<?php

namespace App\Http\Livewire\Store\Cart;

use Livewire\Component;
use App\CartProduct;
use App\Cart;
use App\Ticket;
use App\Plugin;
use App\Models\Address;
use MelhorEnvio; 
use MelhorEnvio\Shipment;
use MelhorEnvio\Resources\Shipment\Package;
use MelhorEnvio\Enums\Service;
use MelhorEnvio\Enums\Environment;
use MelhorEnvio\Resources\Shipment\Product;
use Auth;
class Livecart extends Component
{
    public $cartproducts = [];
    public $ticket;
    public $cart;
    public $paymentplugin;
    public $shippingaddress;
    public $shippingaddressid;
    public $calculator;
    public  $quotations;
    public $shippingid;

    public function save(){
        $this->validate([
            'shippingaddressid' => 'required',
            'shippingid' =>'required'
        ]);
        try {

            $cart = Cart::find($this->cart[0]->id);
            $cart->id_address_delivery = $this->shippingaddressid;
           
            $cart->id_shipping = $this->shippingid;
         
            $cart->update();
          
            return redirect()->route('store.checkout');
        } catch (\Throwable $th) {
            //throw $th;
           
        }
    }
    public function render()
    {
        $this->shippingaddress = Address::where('customer_id',Auth::guard('customers')->user()->id)->get();
        $cart = Cart::where('id_customer',Auth::guard('customers')->user()->id)->where('open',1)->get();
       
        if(count($cart)>0){
            $this->cart = $cart;
            $this->cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
            $this->paymentplugin = Plugin::where('plugin_group_id',1)->limit(1)->get();
            if($cart[0]->id_address_delivery!=null){
                $this->shippingaddressid=$cart[0]->id_address_delivery;
                $this->shippingcalculator();
            }
            if($cart[0]->id_shipping!=null){
                $this->shippingid=$cart[0]->id_shipping;
            }
           

           
        }
    
        return view('livewire.store.cart.livecart');
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

    public function shippingcalculator(){
        try {
         $shipment = new Shipment( get_config('plugins/shipping/melhorenvio/token'), Environment::SANDBOX);
         $calculator = $shipment->calculator();
        
     
             $shippingaddress = Address::find($this->shippingaddress);
        
              $calculator->postalCode( str_replace('-','',get_config('general/store/postalcode')),str_replace('-','',$shippingaddress[0]->postalcode ));
       
         
         $cartproducts = CartProduct::where('id_cart',$this->cart[0]->id)->get();
 
         foreach($cartproducts as $cartproduct){
           
             $calculator->addProducts(
                 new Product(uniqid(), 40, 30, 50, 10.00, $cartproduct->FinalPrice(),intval($cartproduct->quantity))
             );
         }
        
         $calculator->addServices(
             Service::CORREIOS_PAC, 
             Service::CORREIOS_SEDEX,
             Service::CORREIOS_MINI,
             Service::JADLOG_PACKAGE, 
             Service::JADLOG_COM, 
             Service::AZULCARGO_AMANHA,
             Service::AZULCARGO_ECOMMERCE,
             Service::LATAMCARGO_JUNTOS,
             Service::VIABRASIL_RODOVIARIO
         );
         
         $this->quotations = $calculator->calculate();
     
        } catch (\Throwable $th) {
         //throw $th;
            
        }
      
     }
 

}
