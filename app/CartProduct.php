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
}
