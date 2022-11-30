<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Plugin;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    //
        // Return all Customers
        public function index()
        {
           
            return view('store.orders.index', [
                'orders' => Order::where('id_customer',Auth::guard('customers')->user()->id)->paginate(5)
            ]);
        }

        public function show(Order $order)
        {
            if($order->id_customer==Auth::guard('customers')->user()->id){
                $melhorenvio=Plugin::where('name','Melhor Envio')->where('active',1)->first();
                return view('store.orders.show')->with([
                    'order' => $order,
                    'melhorenvio'=>$melhorenvio
                ]);
            }else{
                abort(404,'Page not Found!');
            }
         
        }
}
