<?php

namespace App\Http\Livewire\Store\Cart;
use Illuminate\Support\Facades\Session;
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
    public $postalcode;

    public function mount(){
       ;
    }

    public function save(){
        if(Auth::guard('customers')->check()){
            $this->validate([
                'shippingaddressid' => 'required',
                'shippingid' =>'required'
            ]);
        }else{
            $this->validate([
                'postalcode' => 'required',
                'shippingid' =>'required'
            ]);
        }
        
        try {

            $cart = Cart::find($this->cart->id);
            if($this->shippingaddressid!=null){
                $cart->id_address_delivery = $this->shippingaddressid;
            }
               
           
            $cart->id_shipping = $this->shippingid;
         
            $cart->update();
         
            return redirect()->route('store.checkout');
        } catch (\Throwable $th) {
            //throw $th;
           
        }
    }
    public function render()
    {
       
        if(Auth::guard('customers')->check()){
            $this->shippingaddress = Address::where('customer_id',Auth::guard('customers')->user()->id)->get();
        }else{
            $this->shippingaddress =[];
        }
      
        $cart = Session::get('cart', []);
    
        if(isset($cart->id)){
          
            $this->cart = Cart::find($cart->id);
            $this->cartproducts = CartProduct::where('id_cart',$cart->id)->get();
          
            if($cart->id_address_delivery!=null){
                $this->shippingaddressid=$cart->id_address_delivery;
                $this->shippingcalculator();
            }
            if($cart->id_shipping!=null){
                $this->shippingid=$cart->id_shipping;
            }
           

           
        }
    
        return view('livewire.store.cart.livecart');
    }

    public function addcart(CartProduct $cartproduct){
            $cart = Session::get('cart', []);
      
         
    
              
                    CartProduct::where('id',$cartproduct->id)
                    ->update(['quantity'=>$cartproduct->quantity+1]);
              
               
                $cartproducts = CartProduct::where('id_cart',$cart->id)->get();
               
                $cart=Cart::find($cartproducts[0]->id_cart);
                Session::put('cart', $cart);
                $this->emit('UpdateCart');
               
           
            session()->flash('success', 'Product added to cart successfully!');
      
    }

    public function removecart(CartProduct $cartproduct){
      
       
        
         
    
      if($cartproduct->quantity >1){
        CartProduct::where('id',$cartproduct->id)
        ->update(['quantity'=>$cartproduct->quantity-1]);
        $cart=Cart::find($cartproduct->id_cart);
      }else{
        $cartproduct->delete();
      }         

      $cart=Cart::find($cartproduct->id_cart);
        
        Session::put('cart', $cart);
        
        $this->emit('UpdateCart');

    session()->flash('success', 'Product removed to cart successfully!');

    }   

    public function removeall(CartProduct $cartproduct){
      
      
         
        $cart = Session::get('cart', []);
               
        $cartproduct->delete();
  
 
    $cart =  Cart::find($cart->id);
    Session::put('cart', $cart);
    $this->emit('UpdateCart');
   

    session()->flash('success', 'Product removed to cart successfully!');

    }
    public function validaticket(){
        try {
                   
        $ticket = Ticket::where('validator',$this->ticket)->get();
     
        if(count($ticket)>0){
          
            $product = CartProduct::where('id_cart',$this->cart->id)
            ->whereIn('id_product',$ticket[0]->products->pluck('id'))->get();
           
            $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();
       
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
             
                $cart = Cart::find($this->cart->id);
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
        if($this->shippingaddressid==null){
            $this->validate([
                'postalcode'=>'required'
            ]);
        }
        try {
           
         $shipment = new Shipment( get_config('plugins/shipping/melhorenvio/token'), Environment::SANDBOX);
         $calculator = $shipment->calculator();
        
     
             $shippingaddress = Address::find($this->shippingaddress);
        if($this->shippingaddressid==null){
              $calculator->postalCode( str_replace('-','',get_config('general/store/postalcode')),str_replace('-','',$this->postalcode ));
        }else{
            $calculator->postalCode( str_replace('-','',get_config('general/store/postalcode')),str_replace('-','',$shippingaddress[0]->postalcode ));
        }
       
         $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();
 
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
