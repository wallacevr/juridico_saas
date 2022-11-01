<?php
namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Product;
use App\Cart;
use Illuminate\Http\Request;

  
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
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
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
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        
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
                            
                             $cart->paymentstatus= "In Analysis";
            
                           break;
                       case('3'):
                            
                            $cart->paymentstatus= "Pay";
           
                          break;
                        case('4'):
                            
                            $cart->paymentstatus= "Pay";
           
                          break;
                        case('5'):
                            
                            $cart->paymentstatus= "In dispute";
           
                          break;
                        case('6'):
                            
                            $cart->paymentstatus= "Returned";
           
                          break;
                          case('7'):
                            
                            $cart->paymentstatus= "Cancelled";
           
                          break;
                          case('8'):
                            
                            $cart->paymentstatus= "Returned";
           
                          break;
                          case('9'):
                            
                            $cart->paymentstatus= "Temporary Retention";
           
                          break;
            
                   }
                   $cart->update();


        } catch (\Throwable $th) {
            //throw $th;
             
        }
    }
}