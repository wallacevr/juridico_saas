<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Models\Address;
use App\Models\Customer;
class Cart extends Model
{
    //


    public function products(){
        return $this->belongsToMany(Product::class, 'cart_products', 'id_cart', 'id_product')->withPivot(["quantity","product_options_id","price"]);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    public function invoiceaddress(){
        return $this->belongsTo(Address::class, 'id_address_invoice');
    }
    public function deliveryaddress(){
        return $this->belongsTo(Address::class, 'id_address_delivery');
    }

}
