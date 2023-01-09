<?php

namespace App\Http\Livewire\Tenant\Order;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Customer;
use App\CartProduct;
use App\Cart;
use App\ProductOption;
use App\ProductOptionsImage;
use App\Models\Address;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\Option;
class EditOrder extends Component
{
    public $customers=[];
    public $customerid;
    public $carts=[];
    public $cartid;
    public $status;
    public $cartproducts=[];
    public $carrinho;
    public $cart;
    public $addresses;
    public $id_address_delivery;
    public $id_address_invoice;
    public $products;
    public $productid;
    public $productshow;
    public $variations=[];
    public $maxnivel=0;
    public $optionselected;
    public $optionprice;
    public $optionimages =[];
    public $hasoptions;
    public $optioncart;
    public $paymentmethod;
    public $statusorder;
    public $orderid;
    public $order;
    public function render()
    {
        try {
          
            if($this->customerid!=null){
                $this->carts=Cart::where('id_customer',$this->customerid)->where('open',1)->get();
                $this->addresses = Address::where('customer_id',$this->customerid)->get();
            }
            
            if($this->cartid!=null){
                $this->cartproducts = CartProduct::where('id_cart','=',$this->cartid)->get();
                $this->carrinho = Cart::find($this->cartid);
                
            }
            if($this->productid!=null){
                $this->productshow = Product::find($this->productid);
                if(count($this->productshow->options)>0){
                    $this->hasoptions=true;
        
                    $this->maxnivel= max(ProductOption::Where('id_product',$this->productshow->id)->get()->pluck('nivel')->toArray());
        
                     $variations= array_unique(ProductOption::Where('id_product',$this->productshow->id)->where('nivel',0)->get()->pluck('id_options')->toArray());
                    $this->variations[0] = Option::whereIn('id', $variations)->get();
                 }else{
                    $this->hasoptions=false;
                 }
            }
            return view('livewire.tenant.order.edit-order');
        } catch (\Throwable $th) {
            //throw $th;
           
        }

    }
    public function mount(Order $order){
      
        $this->customers=Customer::where('status',1)->get();
        $this->products = Product::all();
        $this->order = $order;
        $this->id_address_invoice =$order->id_address_invoice;
        $this->id_address_delivery =$order->id_address_delivery;
        $this->method =$order->id_address_delivery;
        $this->addresses = Address::where('customer_id',$order->id_customer)->get();
        $this->paymentmethod= $order->id_payment_method;
        $this->statusorder = $order->status;
        $this->cartid=$order->id_cart;
        if($this->cartid!=null){
            $this->cartproducts = CartProduct::where('id_cart','=',$this->cartid)->get();
            $this->carrinho = Cart::find($this->cartid);
            
        }
        if($this->productid!=null){
            $this->productshow = Product::find($this->productid);
            if(count($this->productshow->options)>0){
                $this->hasoptions=true;
    
                $this->maxnivel= max(ProductOption::Where('id_product',$this->productshow->id)->get()->pluck('nivel')->toArray());
    
                 $variations= array_unique(ProductOption::Where('id_product',$this->productshow->id)->where('nivel',0)->get()->pluck('id_options')->toArray());
                $this->variations[0] = Option::whereIn('id', $variations)->get();
             }else{
                $this->hasoptions=false;
             }
        }
    }

    public function refreshaddress(){
        $cart = Cart::find($this->cartid);
        if($cart!=null){
            $this->id_address_delivery = $cart->id_address_delivery;
            $this->id_address_invoice =  $cart->id_address_invoice;
        }else{
            $this->id_address_delivery = null;
            $this->id_address_invoice =  null;
        }

    }
    public function showoptionsproperty(ProductOption $option){
        $this->optionprice = $option->formattedPrice();
        $this->optionimages = ProductOptionsImage::where('product_options_id',$option->id)->get();
        $this->optioncart = $option->id;

}

public function optionslist($nivel,$selected){
    if($nivel<$this->maxnivel){

        $variations = array_unique(ProductOption::Where('id_product',$this->productshow->id)->where('nivel',$nivel)->get()->pluck('id_options')->toArray());
        $this->variations[$nivel] = Option::whereIn('id', $variations)->get();
        $this->optionprice = "";
        $this->optionimages = [];
        $this->optioncart = "";
    }else{

        $variations = array_unique(ProductOption::Where('id_product',$this->productshow->id)->where('nivel',($nivel-1))->where('id_options',$selected)->get()->pluck('id')->toArray());

        $this->variations[$nivel] =ProductOption::Where('id_product',$this->productshow->id)->where('nivel',$nivel)->whereIn('id_product_options',$variations)->get();

    }

}

public function addcart(Product $product,$optionid){

        try {

              

                if($this->cartid==null){
                    $cart = new Cart;
                    $cart->id_carrier           = 0;      #incluir id do metodo de envio
                  
                    $cart->id_customer          = $this->customerid;
                   
                    $product = Product::find($this->productid);

                    $cart->id_currency          = 0;      #incluir id da moeda
                    $cart->secure_key            =0;
                    $cart->open                  =1;
                    $cart->save();
                    $this->cartid=$cart->id;
                        $cartproduct                     = new CartProduct;
                        $cartproduct->id_cart            =$cart->id;
                        $cartproduct->id_product         =$this->productid;
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
                      
                        $this->managestock($cartproduct->id_product, $cartproduct->product_options_id,$cartproduct->quantity);  
                        $this->emit('UpdateCart');
                        session()->flash('success', 'Product added to cart successfully!');
                }else{
                    $product = Product::find($this->productid);
                    $cartproduct = CartProduct::where('id_cart',$this->cartid)
                    ->where('id_product',$this->productid)
                    ->where('product_options_id',$optionid)
                    ->first();
                    
                    $orderproduct = OrderProduct::where('id_order',$this->order->id)
                    ->where('id_product',$this->productid)
                    ->where('product_options_id',$optionid)
                    ->first();
                   
                    if($cartproduct==null){
                       
                        $cartproduct                     = new CartProduct;
                        $cartproduct->id_cart            =$this->cartid;
                        $cartproduct->id_product         =$this->productid;
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
                        $this->managestock($cartproduct->id_product, $cartproduct->product_options_id,$cartproduct->quantity);  
                        $orderproduct                     = new OrderProduct;
                        $orderproduct->id_order           =$this->order->id;
                        $orderproduct->id_product         =$this->productid;
                    
                   
                        $orderproduct->quantity           =1;
                        $orderproduct->base               =0 ;
                        $orderproduct->discount_amount    =0 ;
                        $orderproduct->discount_percent   =0 ;
                        if($optionid!=null){
                            $option = ProductOption::findOrFail($optionid);
                            $orderproduct->price                      =$option->price;
                            $orderproduct->product_options_id         =$option->id;
                        }else{
                            $orderproduct->price          =$product->price;
                        }
                        $orderproduct->save();


                    }else{
                        CartProduct::where('id',$cartproduct->id)
                        ->update(['quantity'=>$cartproduct->quantity+1]);
                        $this->managestock($cartproduct->id_product, $cartproduct->product_options_id,$cartproduct->quantity);  
                        OrderProduct::where('id',$orderproduct->id)
                        ->update(['quantity'=>$orderproduct->quantity+1]);
                        $this->managestock($orderproduct->id_product, $orderproduct->product_options_id,$orderproduct->quantity);  
                    }

                    
                  

                    session()->flash('success', 'Product added to cart successfully!');
                }
            } catch (\Throwable $th) {
                //throw $th;
              dd($th);
            }
        }
public function update(){
                 
                $this->validate([
                    'customerid' =>'required',
                  'cartid'=>'required',
                    'id_address_delivery' => 'required',
                    'id_address_invoice' => 'required',
                    'paymentmethod' => 'required',
                    'statusorder' =>'required'

                
                ],[
                    'customerid.required'=>'Selecione um Cliente'
                ]);
              
            try {
            

                $billingaddress = Address::find($this->id_address_invoice);
                    
                $shippingaddress = Address::find($this->id_address_delivery);
                $cartproducts = CartProduct::where('id_cart',$this->cartid)->get();
                $itens=[];
                $total=0;
               
              
            
               
            
                $cartclosed = Cart::find($this->cartid);
                $cartclosed->id_address_delivery = $shippingaddress->id;
                $cartclosed->id_address_invoice = $billingaddress->id;
                $cartclosed->id_shipping =0;
                $cartclosed->paymentstatus = $this->statusorder;
            
                $cartclosed->open =0;
                $cartclosed->paymenttype = $this->paymentmethod;
                $cartclosed->update();

                
                $this->order->id_cart=$cartclosed->id;
                $this->order->id_currency=0;
                $this->order->id_customer=$cartclosed->id_customer;
                $this->order->id_address_delivery = $shippingaddress->id;
                $this->order->id_address_invoice = $billingaddress->id;
                $this->order->id_shipping = $cartclosed->id_shipping;
                $this->order->price_shipping = $cartclosed->price_shipping;
                $this->order->status = 'Awaiting Payment';
                $this->order->update();
                
          
                
                session()->flash('success', 'Order completed successfully!');
                return redirect()->route('tenant.orders.show', ['order' => $this->orderid]);
            }
            catch(\Maxcommerce\PagSeguro\PagSeguroException $e) {
                $e->getCode(); //codigo do erro
                $e->getMessage(); //mensagem do erro
                session()->flash('error', $e->getMessage().'Tente Novamente');

               
            }
        
    
    }


    public function managestock($productid,$productoptionid,$qty){
        $product=Product::find($productid);
         if($product->manage_stock){
            if($productoptionid!=null){
                $productoption = ProductOption::find($productoptionid);
                $productoption->qty_stock=$productoption->qty_stock-$qty;
                $productoption->update();
            }else{
                $product->qty=$product->qty-$qty;
                $product->update();
            }
         }
     }
}
