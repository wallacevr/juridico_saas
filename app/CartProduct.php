<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Product;
use App\ProductOption;
use App\ProductCustomersGroup;
use App\Cart;
class CartProduct extends Model
{
    //
  
    public function product(){
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function option(){
        return $this->belongsTo(ProductOption::class, 'product_options_id');
    }

    public function advancedPrice(){
        $cart = Cart::find($this->id_cart);
        $customer = Customer::find($cart->id_customer);
        $product = Product::find($this->id_product);
    
        $prodcustgrp = ProductCustomersGroup::where('id_product',$this->id_product)
        ->where('id_customer_group',$customer->id_customer_group)
        ->where('qty','<',$this->quantity)
        ->orderBy('qty','Desc')
        ->limit(1)->get();
       
     
        $specialprice=$product->price;
        
        if(($product->special_price!=null)&&($product->special_price!=0)){
            if($specialprice > $product->special_price){
                 $specialprice=$product->special_price;
            }
        }
        if($this->product_options_id!=null){
          
            $option = ProductOption::find($this->product_options_id);
            if($specialprice > $option->price){
                 $specialprice=$option->price;
             }
        }
        if(count($prodcustgrp)>0){
            if($specialprice > $prodcustgrp[0]->price){
              $specialprice=$prodcustgrp[0]->price;
            }
        }
       
        return $specialprice;
    }

    public function DiscountTicket(){
    try {
        $cart = Cart::find($this->id_cart);
        $qtdprod=0;
        $discount=0;
     
        foreach($cart->products as $prod){
     
            
          
         
            if(($cart->ticket->products()->pluck('products.id')->contains($prod->id))||($this->collectioninticket($prod->id))){
                $qtdprod = $qtdprod+1;
            }
        }

        
        if($cart->id_ticket!=null){
           
            if(($cart->ticket->products->pluck('id')->contains($this->product->id))||($this->collectioninticket($this->product->id))){
                
              if($cart->ticket->discount_method_id==2){
                $discount=$cart->ticket->discount/$qtdprod;
               
              }
              if($cart->ticket->discount_method_id==1){
               
                $discount=$this->advancedPrice()*$this->quantity * $cart->ticket->discount/100;
             
              }   
            }
        }
      
        return $discount;
    } catch (\Throwable $th) {
        //throw $th;
       dd($th);
    }
       
    }

    public function collectioninticket($id){
        $product = Product::find($id);
        $cart = Cart::find($this->id_cart);
        $collinticket =false;
      
        if(count($cart->ticket->collections)>0){
            foreach($product->collections as $collection){
                if($cart->ticket->collections->pluck('id')->contains($collection->id)){
                    $collinticket =true;
                    break;
                }
            }
        }

        return $collinticket;
    }

}
