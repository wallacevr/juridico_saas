<?php
namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Product;
use App\Cart;
use App\Order;
use App\CartProduct;
use App\ProductOption;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('store.checkout.cart');
    }
    public function checkout()
    {
        
        return view('store.checkout.checkout');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        try {
         
           
            $product = Product::findOrFail($id);
                
            $cart = Session::get('cart', []);
           
       
            if(isset($cart->id)){
                if(Auth::guard('customers')->check()){
                    $cart->id_customer = Auth::guard('customers')->user()->id; 
                    $cart->save(); 
                 }
                $cartproduct = CartProduct::where('id_cart',$cart->id)->where('id_product',$product->id)->get();
                if(count($cartproduct)==0){
                    $cartproduct = new CartProduct;
                    $cartproduct->id_cart = $cart->id;
                    $cartproduct->id_product = $product->id;
                    $cartproduct->name= $product->name;
                    $cartproduct->quantity= 1;
                    $cartproduct->price= $product->price;
                    $cartproduct->sku= $product->sku;
                    $cartproduct->base =0;
                    $cartproduct->discount_amount =0;
                    $cartproduct->discount_percent =0;
                    $cartproduct->save();
                }else{
                    $cartproduct = CartProduct::find($cartproduct[0]->id);
                    $cartproduct->quantity = $cartproduct->quantity+1;
                    $cartproduct->update();
                  
                }
           
                Session::put('cart', $cart);
                Session::save();
              
            }else{
               
                $newcart = new Cart;
                if(Auth::guard('customers')->check()){
                   $newcart->id_customer = Auth::guard('customers')->user()->id;  
                }
                $newcart->id_carrier =0;
                $newcart->id_currency =0;
                $newcart->secure_key =0;
                $newcart->save();
                $cartproduct = new CartProduct;
                $cartproduct->id_cart = $newcart->id;
                $cartproduct->id_product= $product->id;
                $cartproduct->name= $product->name;
                $cartproduct->quantity= 1;
                $cartproduct->price= $product->price;
                $cartproduct->sku= $product->sku;
                $cartproduct->base =0;
                $cartproduct->discount_amount =0;
                $cartproduct->discount_percent =0;
                $cartproduct->save();
             
       
                Session::put('cart', $newcart);
                Session::save();
                
               
            }
          

            $cart = Session::get('cart', []);
           
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } catch (\Throwable $th) {
            //throw $th;
           
        }
        
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function receivenotification(Cart $cart,Request $request){
        try {
            //code...
            header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
            Storage::disk('local')->put('jsonenvio.txt',  json_encode($request));
            $notification = $request->notificationCode;
           
            if(get_config('plugins/payments/pagseguro/sandbox')){
                $urlpagseguro='https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'. $notification .'/?email='. get_config('plugins/payments/pagseguro/email') .'&token='. get_config('plugins/payments/pagseguro/token');
            }else{
                $urlpagseguro='https://ws.pagseguro.uol.com.br/v3/transactions/notifications/'. $notification .'/?email='. get_config('plugins/payments/pagseguro/email') .'&token='. get_config('plugins/payments/pagseguro/token');
            }
            $cart->paymentstatus = $request->notificationCode;
            $response = Http::get($urlpagseguro); 
             
            $json = json_encode($response);
            $array = json_decode($json,TRUE);
            $xml= simplexml_load_string($response);
              

             
                   switch($xml->status) {
                       case('1'):
            
                            $cart->paymentstatus= "Awaiting Payment";
                           break;
            
                       case('2'):
                            
                             $cart->paymentstatus= "Payment In Analysis";
            
                           break;
                       case('3'):
                            
                            $cart->paymentstatus= "Pay";
           
                          break;
                        case('4'):
                            
                            $cart->paymentstatus= "Pay";
           
                          break;
                        case('5'):
                            
                            $cart->paymentstatus= "Payment In dispute";
           
                          break;
                        case('6'):
                            
                            $cart->paymentstatus= "Payment Returned";
           
                          break;
                          case('7'):
                            
                            $cart->paymentstatus= "Payment Cancelled";
                            $this->returnstock($cart->id);
                          break;
                          case('8'):
                            
                            $cart->paymentstatus= "Payment Returned";
                            $this->returnstock($cart->id);
                          break;
                          case('9'):
                            
                            $cart->paymentstatus= "Temporary Retention Payment";
           
                          break;
            
                   }
                   $cart->update();
                   $order = Order::where('id_cart',$cart->id)->first();
                   $order->status =   $cart->paymentstatus;


        } catch (\Throwable $th) {
            //throw $th;
             
        }
    }



    public function returnstock($cartid)
        {
            $cartproducts = CartProduct::where('id_cart',$cartid)->get();
            foreach($cartproducts as $cartproduct){
                $product=Product::find($cartproduct->id_product);
            if($product->manage_stock){
                if($productoptionid!=null){
                    $productoption = ProductOption::find($productoptionid);
                    $productoption->qty_stock=$productoption->qty_stock+$qty;
                    $productoption->update();
                }else{
                    $product->qty=$product->qty+$qty;
                    $product->update();
                }
            }
            }    
        
     }




}