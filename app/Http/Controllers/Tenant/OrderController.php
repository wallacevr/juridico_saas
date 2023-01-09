<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
use App\Plugin;
class OrderController extends Controller
{
    //
        // Return all Customers
        public function index()
        {
           
            return view('tenant.orders.index', [
                'orders' => Order::paginate(5),
            ]);
        }

        public function show(Order $order)
        {
            $melhorenvio=Plugin::where('name','Melhor Envio')->where('active',1)->first();
            $orderproducts=OrderProduct::where('id_order',$order->id)->get();
            return view('tenant.orders.show')->with([
                'order' => $order,
                'melhorenvio'=>$melhorenvio,
                'orderproducts'=>$orderproducts
            ]);
        }
        public function edit(Order $order)
        {
             return view('tenant.orders.edit',compact('order'));
        }
        
        public function create()
        {
            
            return view('tenant.orders.create');
        }
}
