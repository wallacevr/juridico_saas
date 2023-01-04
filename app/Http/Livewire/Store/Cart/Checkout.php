<?php

namespace App\Http\Livewire\Store\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Cart;
use App\Cartproduct;
use App\Order;
use App\OrderProduct;
use App\Plugin;
use App\Models\Address;
use App\Product as Productstore;
use App\ProductOption;
use Auth;
use PagSeguro; 
use MelhorEnvio; 
use PagSeguroPix; 
use MelhorEnvio\Shipment;
use MelhorEnvio\Resources\Shipment\Package;
use MelhorEnvio\Enums\Service;
use MelhorEnvio\Enums\Environment;
use MelhorEnvio\Resources\Shipment\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Checkout extends Component
{
    use LivewireAlert;
    public $cardtoken;
    public $cartproducts;
    public $expirationmonth;
    public $expirationyear;
    public $cvv;
    public $cart;
    public $adresses;
    public $creditcardholdername;
    public $creditcardholderphone;
    public $cardnumber;
    public $senderhash;
    public $senderhashboleto;
    public $creditcardholdercpf;
    public $creditcardholderbirthdate;
    public $address_id;
    public $creditcardtoken;
    public $billingaddress;
    public $shippingaddress;
    public $paymentmethod;
    public $installments;
    public $installmentamount;
    public $interestFree;
    public $invoiceaddress;
    public $deliveryaddress;
    public $invoiceaddresspix;
    public $deliveryaddresspix;
    public $tab=4;
    public $pagseguroerror;
    public $calculator;
    public  $quotations;
    public $shippingid;
    public $shippingprice=0;
    public $orderid;
    public $pagseguroid;
    public $whatstext;
    public $pluginspayment=[];
    public $enablesend;
    
    protected $listener=['render','refreshshippingprice'];
    public function render()
    {
        if($this->tab==4){
            $cart = Cart::find($this->cart->id);
            $this->whatstext="";
            $this->whatstext= $this->whatstext . "Olá ". get_config('general/store/name')  .", segue abaixo meu pedido de compra: \n\n";
            $this->whatstext= $this->whatstext . " *Cart ID*:  ". $cart->id  ." \n";
            $this->whatstext= $this->whatstext . " *Customer*:  ". $cart->customer->name  ." \n";
            $this->whatstext= $this->whatstext . " *Taxvat*:  ". $cart->customer->taxvat  ." \n";
            if($cart->id_address_delivery!=null){
                $this->whatstext= $this->whatstext . " *Address Delivery*:  ". $cart->deliveryaddress->address  ." Nº:". $cart->deliveryaddress->number  ." Compl.:". $cart->deliveryaddress->complement  ." Neighborhood:". $cart->deliveryaddress->neighborhood  ." Postal Code:". $cart->deliveryaddress->postalcode  ." city:". $cart->deliveryaddress->city  ."  State:". $cart->deliveryaddress->state  ."  Country:". $cart->deliveryaddress->country  ."  \n";
            }
            if($cart->id_address_invoice!=null){
                $this->whatstext= $this->whatstext . " *Address Invoice*:  ". $cart->invoiceaddress->address  ." Nº:". $cart->invoiceaddress->number  ." Compl.:". $cart->invoiceaddress->complement  ." Neighborhood:". $cart->invoiceaddress->neighborhood  ." Postal Code:". $cart->invoiceaddress->postalcode  ." city:". $cart->invoiceaddress->city  ."  State:". $cart->invoiceaddress->state  ."  Country:". $cart->invoiceaddress->country  ."  \n";
            }  
            
           
            $itens="";
            foreach($cart->products as $product){
             
                if($product->pivot->product_options_id==null){
                    $itens= $itens . " *Product ID*:  ". $product->id  ."   *Product*:  ". $product->name  ."   *Qty*:". number_format($product->pivot->quantity,0,".",',') ."\n";
                }else{
                    $option = ProductOption::find($product->pivot->product_options_id);
                    $itens= $itens . " *Product ID*:  ". $product->id  ."   *Product*:  ". $product->name  ."   *Variation*:  ". rtrim($option->descricao(),'/') ."   *Qty*:". number_format($product->pivot->quantity,0,".",',') ."\n";
                }
                $this->whatstext= $this->whatstext . " *ITENS*:  \n".$itens;

            }
        }
        return view('livewire.store.cart.checkout');
    }

    public function mount(){
        $pluginspayment = Plugin::where('plugin_group_id',2)->where('active',1)->get();
        if($pluginspayment==null){
            $this->$pluginspayment=[];
        }else{
            $this->$pluginspayment=$pluginspayment;
        }
       $pagseguro = Plugin::where('name','PagSeguro')->where('active',1)->first();
       if($pagseguro!=null){
        $this->pagseguroid = $pagseguro->id;
       }
        if((get_config('payments/plataform/creditcard')==$this->pagseguroid)&&(get_config('payments/plataform/creditcard')!=null)){

       
            if(get_config('plugins/payments/pagseguro/sandbox')){
                $urlpagseguro="https://ws.sandbox.pagseguro.uol.com.br/";
            }else{
                $urlpagseguro="https://ws.pagseguro.uol.com.br/";
            }
        
            $response = Http::withHeaders([
            
                'Contente-Type'=>'application/xml'
            ])->post(
                $urlpagseguro.'v2/sessions?email='. get_config('plugins/payments/pagseguro/email') .'&token='. get_config('plugins/payments/pagseguro/token'),
                
            ); 
        
            $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $response);
            $cxml = simplexml_load_string($clean_xml);
            $json = json_encode($cxml);
            $array = json_decode($json,TRUE);
        
            $this->cardtoken=$array['id'];
          
        }

        $cartsession = Session::get('cart', []);
      
        $cart = Cart::where('id',$cartsession->id)->where('open',1)->get();
  
       if(count($cart)>0){ 
        $this->addresses = Address::where('customer_id',Auth::guard('customers')->user()->id)->get();
        $cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
        $this->cart=Cart::find($cart[0]->id);
        $this->cart->id_customer =Auth::guard('customers')->user()->id;
        $this->cart->update();
        $this->cartproducts=$cartproducts;
        $melhorenvio = Plugin::where('name','Melhor Envio')->where('active',1)->first();
        if($melhorenvio!=null){
                if($cart[0]->id_address_delivery!=null){
                    $this->shippingaddress =$this->cart->id_address_delivery;
                    $this->shippingcalculator();
                }
        
                if($cart[0]->id_shipping!=null){
                    $this->shippingid = $cart[0]->id_shipping;
                  
                    foreach ($this->quotations as $quotation) {
                        # code...
                        if($quotation['id'] == $cart[0]->id_shipping){
                           
                            $this->shippingprice = $quotation['price'];
                        }
                    }
                    
                }
            }
       }
      
      
    }

    public function tabactive($tab){
        $this->tab=$tab;
    }

    public function pagsegurocreditcard(){
        $melhorenvio = Plugin::where('name','Melhor Envio')->where('active',1)->first();
        if($melhorenvio!=null){
            $this->validate([
                'shippingid' =>'required',
                'shippingaddress' => 'required',
                'invoiceaddress' => 'required',
            
            ]);
        }else{
            $this->validate([
               
                'shippingaddress' => 'required',
                'invoiceaddress' => 'required',
            
            ]);  
        }
        try {
            
            $billingaddress = Address::find($this->invoiceaddress);
                  
            $shippingaddress = Address::find($this->shippingaddress);
            
            $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();
            $itens=[];
           
            foreach($cartproducts as $cartproduct){
                    array_push($itens, [
                        'itemId' => 'ID '. $cartproduct->id_product,
                        'itemDescription' => $cartproduct->product->name,
                        'itemAmount' =>  number_format($cartproduct->FinalPrice(), 2, '.', ','),
                        'itemQuantity' => round($cartproduct->quantity,0),
                    ]);
                    
            }
            if($melhorenvio!=null){
                array_push($itens, [
                    'itemId' => 'ID '. 0,
                    'itemDescription' => 'Shipping',
                    'itemAmount' =>  number_format($this->shippingprice, 2, '.', ','),
                    'itemQuantity' => 1,
                ]);
            }
            if($this->installments==1){
                $paymentSettings = [
                    'paymentMethod'                 => $this->paymentmethod,
                    'creditCardToken'               => $this->creditcardtoken,
                    'installmentQuantity'           => $this->installments,
                    'installmentValue'              => $this->installmentamount,
            
                    'notificationURL'               =>  URL::to('/notification/'.$this->cart->id)
                ];
            }else{
                $paymentSettings = [
                    'paymentMethod'                 => $this->paymentmethod,
                    'creditCardToken'               => $this->creditcardtoken,
                    'installmentQuantity'           => $this->installments,
                    'installmentValue'              => $this->installmentamount,
                    'noInterestInstallmentQuantity' => $this->installments,
                    'notificationURL'               =>  URL::to('/notification/'.$this->cart->id)
                ];
            }

         
            $pagseguro = PagSeguro::setReference($this->cart->id)
            ->setSenderInfo([
               'senderName' =>  Auth::guard('customers')->user()->name, //Deve conter nome e sobrenome
               'senderPhone' =>  Auth::guard('customers')->user()->phone, //Código de área enviado junto com o telefone
               'senderEmail' => Auth::guard('customers')->user()->email,
               'senderHash' => $this->senderhash,
               'senderCPF' => Auth::guard('customers')->user()->taxvat //Ou CPF se for Pessoa Física
            ])
            ->setShippingAddress([
               'shippingAddressStreet' => $shippingaddress->address,
               'shippingAddressNumber' => $shippingaddress->number,
               'shippingAddressDistrict' => $shippingaddress->neighborhood,
               'shippingAddressPostalCode' => $shippingaddress->postalcode,
               'shippingAddressCity' => $shippingaddress->city,
               'shippingAddressState' => $shippingaddress->state
             ])
             ->setBillingAddress([
                'billingAddressStreet' => $billingaddress->address,
                'billingAddressNumber' => $billingaddress->number,
                'billingAddressDistrict' => $billingaddress->neighborhood,
                'billingAddressPostalCode' => $billingaddress->postalcode,
                'billingAddressCity' => $billingaddress->city,
                'billingAddressState' => $billingaddress->state
              ])
              ->setCreditCardHolder([
                'creditCardHolderName'          => $this->creditcardholdername,
                'creditCardHolderAreaCode'      => '(011)',
                'creditCardHolderPhone'         => '1197820-1602',
                'creditCardHolderCPF'           => preg_replace('/[^0-9]/', '', $this->creditcardholdercpf),
                'creditCardHolderBirthDate'     => date('d/m/Y', strtotime($this->creditcardholderbirthdate)),
              ])
             ->setItems($itens)
          
            ->send($paymentSettings);
               
            $cartclosed = Cart::find($this->cart->id);
            
            $cartclosed->id_address_delivery = $shippingaddress->id;
            $cartclosed->id_address_invoice = $billingaddress->id;
            $cartclosed->transactioncode = $pagseguro;
            $cartclosed->paymentstatus = 'Awaiting Payment';
            $cartclosed->open =0;
            $cartclosed->paymenttype = $this->paymentmethod;
            $cartclosed->price_shipping = $this->shippingprice;
            $cartclosed->update();
            $order = new Order;
            $order->id_cart=$cartclosed->id;
            $order->id_currency=0;
            $order->id_customer=$cartclosed->id_customer;
            $order->id_address_delivery = $shippingaddress->id;
            $order->id_address_invoice = $billingaddress->id;
            $order->id_shipping = $cartclosed->id_shipping;
            $order->price_shipping = $cartclosed->price_shipping;
            $order->status = 'Awaiting Payment';
            $order->save();
            foreach($cartproducts as $cartproduct){
                $orderproduct = new OrderProduct;
                $orderproduct->id_order = $order->id;
                $orderproduct->id_product =  $cartproduct->id_product;
                $orderproduct->quantity = $cartproduct->quantity;
                $orderproduct->price = number_format($cartproduct->FinalPrice(), 2, '.', ',');
                $orderproduct->base = $cartproduct->base;
                $orderproduct->discount_amount = $cartproduct->discount_amount;
                $orderproduct->discount_percent = $cartproduct->discount_percent;
                $orderproduct->product_options_id = $cartproduct->product_options_id;
                $orderproduct->save();
              
                $this->managestock($cartproduct->id_product, $cartproduct->product_options_id,$cartproduct->quantity);  
        }
            
                
                $this->cart = $cartclosed;
                $this->orderid = $order->id;
                Session::put('cart', []);
                Session::save();
            session()->flash('success', 'Order completed successfully!');
        }
        catch(\Maxcommerce\PagSeguro\PagSeguroException $e) {
           
            $e->getCode(); //codigo do erro
            $e->getMessage(); //mensagem do erro
            session()->flash('error', $e->getMessage().'Tente Novamente');
         
        }

        


    }

    public function pagseguroboleto(){
        $this->validate([
            'shippingid' =>'required',
            'shippingaddress' => 'required',
            'invoiceaddress' => 'required',
         
        ]);
        try {
           
            $billingaddress = Address::find($this->invoiceaddress);
                  
            $shippingaddress = Address::find($this->shippingaddress);
            
            $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();
            $itens=[];
        
            foreach($cartproducts as $cartproduct){
                    array_push($itens, [
                        'itemId' => 'ID '. $cartproduct->id_product,
                        'itemDescription' => $cartproduct->product->name,
                        'itemAmount' =>  number_format($cartproduct->FinalPrice(), 2, '.', ','),
                        'itemQuantity' => round($cartproduct->quantity,0),
                    ]);
                  
                    
            }
            if($melhorenvio!=null){
                array_push($itens, [
                    'itemId' => 'ID '. 0,
                    'itemDescription' => 'Shipping',
                    'itemAmount' =>  number_format($this->shippingprice, 2, '.', ','),
                    'itemQuantity' => 1,
                ]);
            }
            $paymentSettings = [
                'paymentMethod'                 => 'boleto',
                'notificationURL'               =>  URL::to('/notification/'.$this->cart->id)

            ];
         
            $pagseguro = PagSeguro::setReference($this->cart->id)
            ->setSenderInfo([
               'senderName' =>  Auth::guard('customers')->user()->name, //Deve conter nome e sobrenome
               'senderPhone' =>  Auth::guard('customers')->user()->phone, //Código de área enviado junto com o telefone
               'senderEmail' => Auth::guard('customers')->user()->email,
               'senderHash' => $this->senderhashboleto,
               'senderCPF' => Auth::guard('customers')->user()->taxvat //Ou CPF se for Pessoa Física
            ])
            ->setShippingAddress([
               'shippingAddressStreet' => $shippingaddress->address,
               'shippingAddressNumber' => $shippingaddress->number,
               'shippingAddressDistrict' => $shippingaddress->neighborhood,
               'shippingAddressPostalCode' => $shippingaddress->postalcode,
               'shippingAddressCity' => $shippingaddress->city,
               'shippingAddressState' => $shippingaddress->state
             ])
             ->setBillingAddress([
                'billingAddressStreet' => $billingaddress->address,
                'billingAddressNumber' => $billingaddress->number,
                'billingAddressDistrict' => $billingaddress->neighborhood,
                'billingAddressPostalCode' => $billingaddress->postalcode,
                'billingAddressCity' => $billingaddress->city,
                'billingAddressState' => $billingaddress->state
              ])
              ->setCreditCardHolder([
                'creditCardHolderName'          => $this->creditcardholdername,
                'creditCardHolderAreaCode'      => '(011)',
                'creditCardHolderPhone'         => '1197820-1602',
                'creditCardHolderCPF'           => preg_replace('/[^0-9]/', '', $this->creditcardholdercpf),
                'creditCardHolderBirthDate'     => date('d/m/Y', strtotime($this->creditcardholderbirthdate)),
              ])
             ->setItems($itens)
            ->send($paymentSettings);
            
            $cartclosed = Cart::find($this->cart->id);
            $cartclosed->id_address_delivery = $shippingaddress->id;
            $cartclosed->id_address_invoice = $billingaddress->id;
            $cartclosed->transactioncode = $pagseguro->code;
            $cartclosed->paymentstatus = 'Awaiting Payment';
            $cartclosed->open =0;
            $cartclosed->paymenttype = 'boleto';
            $cartclosed->price_shipping = $this->shippingprice;
            $cartclosed->paymentlink =$pagseguro->paymentLink;
            $cartclosed->update();

       
            $order = new Order;
            $order->id_cart=$cartclosed->id;
            $order->id_currency=0;
            $order->id_customer=$cartclosed->id_customer;
            $order->id_address_delivery = $shippingaddress->id;
            $order->id_address_invoice = $billingaddress->id;
            $order->id_shipping = $cartclosed->id_shipping;
            $order->price_shipping = $cartclosed->price_shipping;
            $order->status = 'Awaiting Payment';
            $order->save();
            foreach($cartproducts as $cartproduct){
                $orderproduct = new OrderProduct;
                $orderproduct->id_order = $order->id;
                $orderproduct->id_product =  $cartproduct->id_product;
                $orderproduct->quantity = $cartproduct->quantity;
                $orderproduct->price = number_format($cartproduct->FinalPrice(), 2, '.', ',');
                $orderproduct->base = $cartproduct->base;
                $orderproduct->discount_amount = $cartproduct->discount_amount;
                $orderproduct->discount_percent = $cartproduct->discount_percent;
                $orderproduct->product_options_id = $cartproduct->product_options_id;
                $orderproduct->save();
                $this->managestock($cartproduct->id_product, $cartproduct->product_options_id,$cartproduct->quantity);  
                
        }
            
                
                $this->cart = $cartclosed;
                $this->orderid = $order->id;
                Session::put('cart', []);
                Session::save();
            session()->flash('success', 'Order completed successfully!');
            $this->render();
        }
        catch(\Maxcommerce\PagSeguro\PagSeguroException $e) {
            $e->getCode(); //codigo do erro
            $e->getMessage(); //mensagem do erro
            session()->flash('error', $e->getMessage().'Tente Novamente');
           dd($e);
        }

        


    }

    public function pix(){
   
        if(get_config('payments/plataform/pix')==$this->pagseguroid){ 
            $this->validate([
                'shippingid' =>'required',
                'shippingaddress' => 'required',
                'invoiceaddress' => 'required',
             
            ]);
        try {
           

            $billingaddress = Address::find($this->invoiceaddress);
                  
            $shippingaddress = Address::find($this->shippingaddress);
            $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();
            $itens=[];
            $total=0;
            foreach($cartproducts as $cartproduct){
                    array_push($itens, [
                        'itemId' => 'ID '. $cartproduct->id_product,
                        'itemDescription' => $cartproduct->product->name,
                        'itemAmount' =>  number_format($cartproduct->FinalPrice(), 2, '.', ','),
                        'itemQuantity' => round($cartproduct->quantity,0),
                    ]);
                    $total = $total+ ($cartproduct->quantity*$cartproduct->FinalPrice());    
            }
            if($melhorenvio!=null){
                array_push($itens, [
                    'itemId' => 'ID '. 0,
                    'itemDescription' => 'Shipping',
                    'itemAmount' =>  number_format($this->shippingprice, 2, '.', ','),
                    'itemQuantity' => 1,
                ]);
            }
            $total=$total+$this->shippingprice;
            $paymentSettings = [
                'paymentMethod'                 => 'pix',

            ];
           
            $pagseguro = PagSeguroPix::setReference($this->cart->id)
            ->setSenderInfoPix([
               'senderName' =>  Auth::guard('customers')->user()->name, //Deve conter nome e sobrenome
               'senderPhone' =>  Auth::guard('customers')->user()->phone, //Código de área enviado junto com o telefone
               'senderEmail' => Auth::guard('customers')->user()->email,
               'senderCPF' => Auth::guard('customers')->user()->taxvat //Ou CPF se for Pessoa Física
            ])
           
             ->setItems($itens)
             ->setAmount($total)
            ->send($paymentSettings);
  
          
            $cartclosed = Cart::find($this->cart->id);
            $cartclosed->id_address_delivery = $shippingaddress->id;
            $cartclosed->id_address_invoice = $billingaddress->id;
            $cartclosed->transactioncode = $pagseguro->chave;
            $cartclosed->paymentstatus = 'Awaiting Payment';
            $cartclosed->transactioncode = $pagseguro->txid;
            $cartclosed->open =0;
            $cartclosed->paymenttype = 'pix';
            $cartclosed->paymentqrcode =$pagseguro->urlImagemQrCode;
            $cartclosed->price_shipping = $this->shippingprice;
            $cartclosed->paymentpixcopiaecola =$pagseguro->pixCopiaECola;
            $cartclosed->update();

            $order = new Order;
            $order->id_cart=$cartclosed->id;
            $order->id_currency=0;
            $order->id_customer=$cartclosed->id_customer;
            $order->id_address_delivery = $shippingaddress->id;
            $order->id_address_invoice = $billingaddress->id;
            $order->id_shipping = $cartclosed->id_shipping;
            $order->price_shipping = $cartclosed->price_shipping;
            $order->status = 'Awaiting Payment';
            $order->save();
            foreach($cartproducts as $cartproduct){
                $orderproduct = new OrderProduct;
                $orderproduct->id_order = $order->id;
                $orderproduct->id_product =  $cartproduct->id_product;
                $orderproduct->quantity = $cartproduct->quantity;
                $orderproduct->price = number_format($cartproduct->FinalPrice(), 2, '.', ',');
                $orderproduct->base = $cartproduct->base;
                $orderproduct->discount_amount = $cartproduct->discount_amount;
                $orderproduct->discount_percent = $cartproduct->discount_percent;
                $orderproduct->product_options_id = $cartproduct->product_options_id;
                $orderproduct->save();
                $this->managestock($cartproduct->id_product, $cartproduct->product_options_id,$cartproduct->quantity);  
                
        }
            
                
                $this->cart = $cartclosed;
                $this->orderid = $order->id;
                Session::put('cart', []);
                Session::save();
              
            session()->flash('success', 'Order completed successfully!');
        }
        catch(\Maxcommerce\PagSeguro\PagSeguroException $e) {
            $e->getCode(); //codigo do erro
            $e->getMessage(); //mensagem do erro
            session()->flash('error', $e->getMessage().'Tente Novamente');
   
     
        }
    }
        


    }

    public function consultar($txid){
      try {
        $transacao = PagseguroPix::consultapix($txid);
        $consulta= json_decode($transacao,TRUE);
      
        $cart = Cart::where('transactioncode',$txid)->first();
      
        if($consulta['status']=='ATIVA'){
            $cart->paymentstatus = 'PENDING';
        }elseif($consulta['status']=='CONCLUIDA'){
     
            $cart->paymentstatus = 'Pay';
      
            $this->alert('success', 'Order pay successfully!');
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Order pay successfully!!', 
                'text' => 'Order pay successfully!.'
            ]);
            return redirect()->route('store.home');
          
        }
        $cart->update();
      } catch (\Throwable $th) {
        //throw $th;
      
      }
     
    }

    public function shippingcalculator(){
       try {
        $melhorenvio = Plugin::where('name','Melhor Envio')->where('active',1)->first();
        if($melhorenvio!=null){
                $shipment = new Shipment( get_config('plugins/shipping/melhorenvio/token'), Environment::SANDBOX);
                $calculator = $shipment->calculator();

            
                        $shippingaddress = Address::find($this->shippingaddress);
                        
                        $calculator->postalCode(str_replace('-','',get_config('general/store/postalcode')) ,str_replace('-','',$shippingaddress->postalcode) );
                    
                        
                $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();

                foreach($cartproducts as $cartproduct){

                    $calculator->addProducts(
                        new Product(uniqid(), 40, 30, 50, 10.00, $cartproduct->FinalPrice(),1)
                    );
                }
                $calculator->addServices(
                    Service::CORREIOS_PAC, 
                    Service::CORREIOS_SEDEX,
                    Service::CORREIOS_MINI,
                    Service::JADLOG_PACKAGE, 
                    Service::JADLOG_COM, 
                    Service::AZULCARGO_AMANHA,
                    Service::AZULCARGO_ECOMMERCE,
                    Service::LATAMCARGO_JUNTOS,
                    Service::VIABRASIL_RODOVIARIO
                );
                
                $this->quotations = $calculator->calculate();
            }else{
                $this->quotations =[];
            }
        } catch (\Throwable $th) {
        //throw $th;
        
       }
     
    }

    public function invoiceselect(){
        try {
            if(($this->invoiceaddress!=null)&&($this->shippingaddress!=null)){
                $this->enablesend = true;
            }else{
                $this->enablesend = false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function shippingselect(){
        try {
            if(($this->invoiceaddress!=null)&&($this->shippingaddress!=null)){
                $this->enablesend = true;
            }else{
                $this->enablesend = false;
            }
            $melhorenvio = Plugin::where('name','Melhor Envio')->where('active',1)->first();
            if($melhorenvio!=null){
                    $shipment = new Shipment( get_config('plugins/shipping/melhorenvio/token'), Environment::SANDBOX);
                    $calculator = $shipment->calculator();
            
                    
                            $shippingaddress = Address::find($this->shippingaddress);
                        
                            $calculator->postalCode('01010010',$shippingaddress->postalcode );
                            
                    
                    $cartproducts = CartProduct::where('id_cart',$this->cart->id)->get();
            
                    foreach($cartproducts as $cartproduct){
            
                        $calculator->addProducts(
                            new Product(uniqid(), 40, 30, 50, 10.00, $cartproduct->FinalPrice(),1)
                        );
                    }
                    $calculator->addServices(
                        Service::CORREIOS_PAC, 
                        Service::CORREIOS_SEDEX,
                        Service::CORREIOS_MINI,
                        Service::JADLOG_PACKAGE, 
                        Service::JADLOG_COM, 
                        Service::AZULCARGO_AMANHA,
                        Service::AZULCARGO_ECOMMERCE,
                        Service::LATAMCARGO_JUNTOS,
                        Service::VIABRASIL_RODOVIARIO
                    );
                    $this->quotations = $calculator->calculate();
                    if($this->shippingid!=null){
                    
                        foreach ($this->quotations as $quotation) {
                            # code...
                            if($quotation['id'] == $this->shippingid){
                                $this->shippingprice = $quotation['price'];
                            }
                        }
                        
                
                        $this->dispatchBrowserEvent('refreshshippingprice', []);
                    }
                }
        } catch (\Throwable $th) {
         //throw $th;
           
        }
      
     }

     public function managestock($productid,$productoptionid,$qty){
        $product=Productstore::find($productid);
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

     public function closecart(){

        try {
            $cart = Cart::find($this->cart->id);
            $cart->id_address_delivery =$this->shippingaddress;
            $cart->id_address_invoice =$this->invoiceaddress;
            $cart->id_Shipping=$this->shippingid;
           
            $cart->update();
            $this->cart = $cart;
            
            Session::put('cart', []);
            Session::save();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

}
