<?php

namespace App\Http\Livewire\Store\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Cart;
use App\Cartproduct;
use App\Models\Address;
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
    public $tab=1;
    public $pagseguroerror;
    public $calculator;
    public  $quotations;
    public $shippingid;
    public $shippingprice=0;

    protected $listener=['render','refreshshippingprice'];
    public function render()
    {
        
        return view('livewire.store.cart.checkout');
    }

    public function mount(){
      
        if(get_config('payments/plataform/creditcard')==1){

       
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


        $cart = Cart::where('id_customer',Auth::guard('customers')->user()->id)->where('open',1)->get();
  
       if(count($cart)>0){ 
        $this->addresses = Address::where('customer_id',Auth::guard('customers')->user()->id)->get();
        $cartproducts = CartProduct::where('id_cart',$cart[0]->id)->get();
        $this->cart=Cart::find($cart[0]->id);
        $this->cartproducts=$cartproducts;
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

    public function tabactive($tab){
        $this->tab=$tab;
    }

    public function pagsegurocreditcard(){
        try {
            $billingaddress = Address::find($this->billingaddress);
                  
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
            array_push($itens, [
                'itemId' => 'ID '. 0,
                'itemDescription' => 'Shipping',
                'itemAmount' =>  number_format($this->shippingprice, 2, '.', ','),
                'itemQuantity' => 1,
            ]);
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
            $cartclosed->paymentstatus = 'PENDING';
            $cartclosed->open =0;
            $cartclosed->paymenttype = $this->paymentmethod;
 
            $cartclosed->update();

                
                $this->cart = $cartclosed;
            session()->flash('success', 'Order completed successfully!');
        }
        catch(\Maxcommerce\PagSeguro\PagSeguroException $e) {
            $e->getCode(); //codigo do erro
            $e->getMessage(); //mensagem do erro
            session()->flash('error', $e->getMessage().'Tente Novamente');
    
        }

        


    }

    public function pagseguroboleto(){
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
            array_push($itens, [
                'itemId' => 'ID '. 0,
                'itemDescription' => 'Shipping',
                'itemAmount' =>  number_format($this->shippingprice, 2, '.', ','),
                'itemQuantity' => 1,
            ]);
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
            $cartclosed->paymentstatus = 'PENDING';
            $cartclosed->open =0;
            $cartclosed->paymenttype = 'boleto';
            $cartclosed->paymentlink =$pagseguro->paymentLink;
            $cartclosed->update();

       
                $this->cart = $cartclosed;
            session()->flash('success', 'Order completed successfully!');
        }
        catch(\Maxcommerce\PagSeguro\PagSeguroException $e) {
            $e->getCode(); //codigo do erro
            $e->getMessage(); //mensagem do erro
            session()->flash('error', $e->getMessage().'Tente Novamente');
           
        }

        


    }

    public function pix(){
   
        if(get_config('payments/plataform/pix')==1){ 
            $this->validate([
                'shippingaddress' => 'required',
                'invoiceaddresspix' =>'required'
            ]);
        try {
           

            $billingaddress = Address::find($this->invoiceaddresspix);
                  
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
            array_push($itens, [
                'itemId' => 'ID '. 0,
                'itemDescription' => 'Shipping',
                'itemAmount' =>  number_format($this->shippingprice, 2, '.', ','),
                'itemQuantity' => 1,
            ]);
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
            $cartclosed->paymentstatus = 'PENDING';
            $cartclosed->transactioncode = $pagseguro->txid;
            $cartclosed->open =0;
            $cartclosed->paymenttype = 'pix';
            $cartclosed->paymentqrcode =$pagseguro->urlImagemQrCode;
            $cartclosed->paymentpixcopiaecola =$pagseguro->pixCopiaECola;
            $cartclosed->update();

       
                $this->cart = $cartclosed;
            
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
       
       } catch (\Throwable $th) {
        //throw $th;
       
       }
     
    }


    public function shippingselect(){
        try {
           
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
        } catch (\Throwable $th) {
         //throw $th;
            dd($th);
        }
      
     }



}
