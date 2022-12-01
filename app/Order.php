<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Models\Customer;
use App\Models\Address;
class Order extends Model
{
    //


    public function products(){
        return $this->belongsToMany(Product::class, 'order_products', 'id_order', 'id_product')->withPivot(["quantity", "price"]);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    public function addressdelivery(){
        return $this->belongsTo(Address::class, 'id_address_delivery');
    }
    public function addressinvoice(){
        return $this->belongsTo(Address::class, 'id_address_invoice');
    }
}
