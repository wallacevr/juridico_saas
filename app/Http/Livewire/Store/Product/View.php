<?php

namespace App\Http\Livewire\Store\Product;
use Illuminate\Support\Facades\Session;
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
    public $selectedoption;
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

         if(count($product->options)>0){
            $this->hasoptions=true;

            $this->maxnivel= max(ProductOption::Where('id_product',$product->id)->get()->pluck('nivel')->toArray());

             $variations= array_unique(ProductOption::Where('id_product',$product->id)->where('nivel',0)->get()->pluck('id_options')->toArray());
            $this->variations[0] = Option::whereIn('id', $variations)->get();
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
            if( $option->price !=null){
                $this->selectedoption = $option->id;
            }

    }

    public function addcart(Product $product,$optionid){
        try {

            $cart = Session::get('cart', []);

            if(!isset($cart->id)){
                $cart = new Cart;
                $cart->id_carrier           = 0;      #incluir id do metodo de envio
                if(Auth::guard('customers')->check()){
                    $cart->id_customer          = Auth::guard('customers')->user()->id;
                }


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
                    $cart= Cart::find($cart->id);
                    Session::put('cart', $cart);

                    $this->emit('UpdateCart');
                    $this->mount();
                    session()->flash('success', 'Product added to cart successfully!');
            }else{

                $cartproduct = CartProduct::where('id_cart',$cart->id)
                ->where('id_product',$product->id)
                ->where('product_options_id',$optionid)
                ->get();
                if(count($cartproduct)==0){
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
                    CartProduct::where('id',$cartproduct[0]->id)
                    ->update(['quantity'=>$cartproduct[0]->quantity+1]);
                }

                $cart= Cart::find($cart->id);
                Session::put('cart', $cart);

                $this->emit('UpdateCart');
                session()->flash('success', 'Product added to cart successfully!');
            }
        } catch (\Throwable $th) {
            //throw $th;
            
        }






    }


}
