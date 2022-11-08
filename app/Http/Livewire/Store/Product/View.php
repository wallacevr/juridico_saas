<?php

namespace App\Http\Livewire\Store\Product;

use Livewire\Component;
use App\Product;
use App\ProductOption;
use App\Option;
use App\Cart;
use App\CartProduct;
use App\ProductOptionsImage;
use Auth;
class View extends Component
{
    public $idsCollection;
    public $similarCategory;
    public $product;
    public $variations=[];
    public $maxnivel=0;
    public $optionselected;
    public $optionprice;
    public $optionimages =[];
    public $hasoptions;
    public $optioncart;
    public function render()
    {

        return view('livewire.store.product.view');
    }


    public function mount(Product $product){
        $idsCollection = $product->collections()->pluck('collections.id')->all();

        $this->similarCategory = (Product::with(["collections" => function($q) use($idsCollection) {
            $q->whereIn('collections.id',$idsCollection);
        }])->where('status',1)->inRandomOrder()->limit(4))->get();
        $this->product = $product;
       // $this->$idsCollection = $idsCollection;
       $this->maxnivel= max(ProductOption::Where('id_product',$product->id)->get()->pluck('nivel')->toArray());
      
         $variations= array_unique(ProductOption::Where('id_product',$product->id)->where('nivel',0)->get()->pluck('id_options')->toArray());
         $this->variations[0] = Option::whereIn('id', $variations)->get(); 
         if(count($product->options)>0){
            $this->hasoptions=true;
         }else{
            $this->hasoptions=false;
         }
        
    }


    public function optionslist($nivel,$selected){
        if($nivel<$this->maxnivel){
          
            $variations = array_unique(ProductOption::Where('id_product',$this->product->id)->where('nivel',$nivel)->get()->pluck('id_options')->toArray());
            $this->variations[$nivel] = Option::whereIn('id', $variations)->get(); 
            $this->optionprice = "";
            $this->optionimages = [];
            $this->optioncart = "";
        }else{

            $variations = array_unique(ProductOption::Where('id_product',$this->product->id)->where('nivel',($nivel-1))->where('id_options',$selected)->get()->pluck('id')->toArray());
        
            $this->variations[$nivel] =ProductOption::Where('id_product',$this->product->id)->where('nivel',$nivel)->whereIn('id_product_options',$variations)->get();
            
        }
       
    }

    public function showoptionsproperty(ProductOption $option){
            $this->optionprice = $option->formattedPrice();
            $this->optionimages = ProductOptionsImage::where('product_options_id',$option->id)->get();
            $this->optioncart = $option->id;
        
    }

    public function addcart(Product $product,$optionid){
      
        if(Auth::guard('customers')->check()){
         
            $cart = Cart::where('id_customer',Auth::guard('customers')->user()->id)->where('open',1)->get();
            if(count($cart)==0){
                $cart = new Cart;
                $cart->id_carrier           = 0;      #incluir id do metodo de envio
                $cart->id_customer          = Auth::guard('customers')->user()->id;
                $cart->id_address_delivery  = Auth::guard('customers')->user()->addresses()->first()->id;
                $cart->id_address_invoice   = Auth::guard('customers')->user()->addresses()->first()->id;
                $cart->id_currency          = 0;      #incluir id da moeda
                $cart->secure_key            =0;
                $cart->open                  =1;
                $cart->save();

                    $cartproduct                     = new CartProduct;
                    $cartproduct->id_cart            =$cart->id;
                    $cartproduct->id_product         =$product->id;
                    $cartproduct->name               =$product->name;
                    $cartproduct->sku                =$product->sku;
                    $cartproduct->quantity           =1;
                    $cartproduct->base               =0 ;
                    $cartproduct->discount_amount    =0 ;
                    $cartproduct->discount_percent   =0 ;
                    if($optionid!=null){
                         $option = ProductOption::findOrFail($optionid);
                        $cartproduct->price                      =$option->price;
                        $cartproduct->product_options_id         =$option->id;
                    }else{
                        $cartproduct->price          =$product->price;
                    }
                    $cartproduct->save();
            }else{
           
                $cartproduct = CartProduct::where('id_cart',$cart[0]->id)
                ->where('id_product',$product->id)
                ->where('product_options_id',$optionid)
                ->get();
                if(count($cartproduct)==0){
                    $cartproduct                     = new CartProduct;
                    $cartproduct->id_cart            =$cart[0]->id;
                    $cartproduct->id_product         =$product->id;
                    $cartproduct->name               =$product->name;
                    $cartproduct->sku                =$product->sku;
                    $cartproduct->quantity           =1;
                    $cartproduct->base               =0 ;
                    $cartproduct->discount_amount    =0 ;
                    $cartproduct->discount_percent   =0 ;
                    if($optionid!=null){
                         $option = ProductOption::findOrFail($optionid);
                        $cartproduct->price                      =$option->price;
                        $cartproduct->product_options_id         =$option->id;
                    }else{
                        $cartproduct->price          =$product->price;
                    }
                    $cartproduct->save();
                }else{
                    CartProduct::where('id',$cartproduct[0]->id)
                    ->update(['quantity'=>$cartproduct[0]->quantity+1]);
                }
                $cartcustomer = Auth::guard('customers')->user()->opencarts()->get();
                $cartproducts = CartProduct::where('id_cart',$cartcustomer[0]->id)->get();
                session()->put('cart', $cartproducts);
                $this->emit('UpdateCart');
               
            }
            session()->flash('success', 'Product added to cart successfully!');
        }else{
          
                
            $cart = session()->get('cart', []);
        
          
            if(isset($cart[$product->id])) {
                if(count($product->options)==0){
                    $cart[$product->id]['quantity']+=1;
                }else{
                    if(isset($cart[$product->id][$optionid])){
                        $cart[$product->id][$optionid]['quantity']+=1;
                    }else{
                        $cart[$product->id][$optionid]= [
                            "name" => $product->name,
                            "quantity" => 1,
                            "price" => $product->price,
                            "special_price" => $product->special_price,
                            "final_price" => $product->finalPrice(),
                            "formated_price" => $product->formattedPrice(),
                            "formated_specialprice" => $product->formattedSpecialPrice(),
                            "formated_finalprice" => $product->formattedFinalPrice(),
                            "image" => $product->getImage('thumb')
                        ];
                    }
                }
                   
              
            } else {

             if($optionid!=null){
                    $option = ProductOption::findOrFail($optionid);
                    $cartproduct->price                      =$option->price;
                    $cartproduct->product_options_id         =$option->id;
                    $cart[$id][$option] = [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $option->price,
                        "special_price" => $option->price,
                        "final_price" => $option->price,
                        "formated_price" => $option->price,
                        "formated_specialprice" => $option->price,
                        "formated_finalprice" => $option->price,
                        "image" => $option->getImage('thumb')
                    ];
               }else{
                $cart[$product->id] = [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "special_price" => $product->special_price,
                    "final_price" => $product->finalPrice(),
                    "formated_price" => $product->formattedPrice(),
                    "formated_specialprice" => $product->formattedSpecialPrice(),
                    "formated_finalprice" => $product->formattedFinalPrice(),
                    "image" => $product->getImage('thumb')
                ];
               }
              
            }
            
            session()->put('cart', $cart);
            session()->keep('cart');
           
        }
    }


}
