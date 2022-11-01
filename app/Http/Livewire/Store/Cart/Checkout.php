<?php

namespace App\Http\Livewire\Store\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Cart;
use App\Cartproduct;
use App\Models\Address;
use Auth;
use PagSeguro; 
use PagSeguroPix; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class Checkout extends Component
{
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
    protected $listener=['render'];
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
       
            $paymentSettings = [
                'paymentMethod'                 => $this->paymentmethod,
                'creditCardToken'               => $this->creditcardtoken,
                'installmentQuantity'           => $this->installments,
                'installmentValue'              => $this->installmentamount,
                'noInterestInstallmentQuantity' => 5,
            ];
           
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
                  
            $shippingaddress = Address::find($this->deliveryaddress);
            
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
          
            $paymentSettings = [
                'paymentMethod'                 => 'boleto',

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
        try {
           

            $billingaddress = Address::find($this->invoiceaddresspix);
                  
            $shippingaddress = Address::find($this->deliveryaddresspix);
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
      
      } catch (\Throwable $th) {
        //throw $th;
      
      }
     
    }





}
