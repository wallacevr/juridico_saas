<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Models\Customer;
use App\Models\Address;
use App\Plugin;
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

    public function methodshipping(){
        $melhorenvio = Plugin::where('name','MelhorEnvio')->where('active',1)->first();
        $description=null;
        if($melhorenvio!=null){
            switch($this->id_shipping) {
                case('1'):
     
                    $description= "CORREIOS PAC";
                    break;
     
                case('2'):
                     
                    $description= "CORREIOS SEDEX";
     
                    break;
                case('3'):
                     
                    $description= "JADLOG PACKAGE";
    
                   break;
                 case('4'):
                     
                    $description= "JADLOG .COM";
    
                   break;
                 case('8'):
                     
                    $description= "VIA BRASIL AÉREO";
    
                   break;
                 case('9'):
                     
                    $description= "VIA BRASIL AÉREO";
    
                   break;
                   case('10'):
                     
                    $description= "LATAM CARGO PRÓXIMO DIA";
    
                   break;
                   case('11'):
                     
                    $description= "LATAM CARGO PRÓXIMO VOO";
    
                   break;
                   case('12'):
                     
                    $description= "LATAM CARGO JUNTOS";
    
                   break;
                   case('15'):
                     
                    $description= "AZUL CARGO AMANHÃ";
    
                   break;
                   case('16'):
                     
                    $description== "AZUL CARGO E-COMMERCE";
    
                   break;
     
            }
        }
        return $description;
    }


}
