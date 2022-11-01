
<div>


              
<h1 class="text-center my-4">PAYMENT</h1>
@if($cart)         
        @php 
            $total = 0 ;
            $discount =0;
        @endphp
        @if ($cartproducts)

            @foreach ($cartproducts as $cartproduct)
            
                @php 
                    $total += $cartproduct->advancedPrice() * $cartproduct['quantity']; 
                    $discount += $cartproduct->DiscountTicket(); 
                @endphp
            @endforeach
        @endif




        <div class="flex items-start" >
        <ul class="nav nav-pills flex flex-col flex-wrap list-none pl-0 mr-4" id="pills-tabVertical" role="tablist" >
            <li class="nav-item flex-grow text-center mb-2" role="presentation">
                @if($tab==1)
                        <a href="#pills-homeVertical" class="
                            nav-link
                            block
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            px-6
                            py-3
                            focus:outline-none focus:ring-0
                            active
                            " id="pills-home-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-homeVertical" role="tab"
                            aria-controls="pills-homeVertical"
                            aria-selected="true" wire:click="tabactive(1)">
                @else
                <a href="#pills-homeVertical" class="
                            nav-link
                            block
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            px-6
                            py-3
                            focus:outline-none focus:ring-0
                          
                            " id="pills-home-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-homeVertical" role="tab"
                            aria-controls="pills-homeVertical"
                            aria-selected="false" wire:click="tabactive(1)">
                

                @endif
                <div class="grid grid-cols-2 gap-2 w-10 px-0">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/>
                        </svg>
                    </div>
                    <div><h6>Credit Card</h6></div>
                </div>

            </a>
            </li>
            <li class="nav-item flex-grow text-center my-2" role="presentation">
              @if($tab==2)
                        <a href="#pills-profileVertical" class="
                                nav-link
                                block
                                font-medium
                                text-xs
                                leading-tight
                                uppercase
                                rounded
                                px-6
                                py-3
                                focus:outline-none focus:ring-0
                                active
                                " id="pills-profile-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-profileVertical" role="tab"
                                aria-controls="pills-profileVertical" aria-selected="true" wire:click="tabactive(2)">
                @else
                <a href="#pills-profileVertical" class="
                                nav-link
                                block
                                font-medium
                                text-xs
                                leading-tight
                                uppercase
                                rounded
                                px-6
                                py-3
                                focus:outline-none focus:ring-0
                                " id="pills-profile-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-profileVertical" role="tab"
                                aria-controls="pills-profileVertical" aria-selected="false" wire:click="tabactive(2)">
                
                @endif
                <div>
            
                </div>
                <div><h6>Boleto</h6></div>
            </a>
            </li>
            <li class="nav-item flex-grow text-center my-2" role="presentation">
            @if($tab==3)
            <a href="#pills-contactVertical" class="
                nav-link
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                rounded
                px-6
                py-3
                focus:outline-none focus:ring-0
                active
                " id="pills-contact-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-contactVertical" role="tab"
                aria-controls="pills-contactVertical" aria-selected="true" wire:click="tabactive(3)">PIX</a>
              @else
                <a href="#pills-contactVertical" class="
                    nav-link
                    block
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    rounded
                    px-6
                    py-3
                    focus:outline-none focus:ring-0
           
                    " id="pills-contact-tabVertical" data-bs-toggle="pill" data-bs-target="#pills-contactVertical" role="tab"
                    aria-controls="pills-contactVertical" aria-selected="false" wire:click="tabactive(3)">PIX</a>
              

              @endif
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContentVertical" wire:ignore.self>
            @if($tab==1)
                <div class="tab-pane fade show active" id="pills-homeVertical" role="tabpanel"
                aria-labelledby="pills-home-tabVertical">
            @else
            <div class="tab-pane fade  " id="pills-homeVertical" role="tabpanel"
            aria-labelledby="pills-home-tabVertical">
            @endif
    
            @if($cart)
                <div class="grid grid-cols-4 gap-4 px-4 py-4">

                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="senderhash"  wire:model="senderhash" id="senderhash"  >
                        <input type="hidden" name="creditcardtoken" wire:model="creditcardtoken" id="creditcardtoken"  wire:model="creditcardtoken">
                        <input type="hidden" name="brand" class="form-control" wire:model="brand" id="brand"  wire:model="brand">
                        <input type="hidden" name="paymentmethod" wire:model="paymentmethod" id="paymentmethod" value="creditCard" >
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Credit Card Number', 'placeholder'=>'Credit Card Number', 'name'=>'cardnumber', 'wiremodel'=>'cardnumber', 'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Name Printed on Card', 'placeholder'=>'Name Printed on Card', 'name'=>'creditcardholdername','wiremodel'=>'creditcardholdername', 'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Expiration Month', 'placeholder'=>'Expiration Month', 'name'=>'expirationmonth','wiremodel'=>'expirationmonth', 'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Expiration Year', 'placeholder'=>'Expiration Year', 'name'=>'expirationyear','wiremodel'=>'expirationyear', 'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'CVV', 'placeholder'=>'Validity','wiremodel'=>'cvv', 'name'=>'cvv', 'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Titular Taxvat', 'placeholder'=>'Titular Taxvat', 'name'=>'creditcardholdercpf','wiremodel'=>'creditcardholdercpf', 'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'date', 'label'=>'Credit Card Holder Birthdate', 'placeholder'=>'Credit Card Holder Birthdate', 'name'=>'creditcardholderbirthdate','wiremodel'=>'creditcardholderbirthdate' ,'value'=> '','require'=>true])
                    </div>
                    <div>
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Credit Card Holder Phone', 'placeholder'=>'Credit Card Holder Phone', 'name'=>'creditcardholderphone', 'value'=> '','wiremodel'=>'creditcardholderphone','require'=>true])
                    </div>
                    <div>
                    <label for="billingaddress" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Billing Address')}}<span  class="red">*</span>
                    </label>
                        <select name="billingaddress" wire:model="billingaddress" class="form-select block w-full sm:text-sm sm:leading-5 border my-1">
                        <option value="">{{__('Select an address')}}</option>
                            @foreach($addresses as $address)
                                <option value="{{$address->id}}"
                                    >
                                    {{$address->name}}
                                </option>
                            @endforeach
                
                        </select>
                    </div>
                    <div>
                    <label for="shippingaddress" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Shipping Address')}}<span  class="red">*</span>
                    </label>
                        <select name="shippingaddress" wire:model="shippingaddress" class="form-select block w-full sm:text-sm sm:leading-5 border my-1">
                            <option value="">{{__('Select an address')}}</option>
                            @foreach($addresses as $address)
                                <option value="{{$address->id}}"
                                    >
                                    {{$address->name}}
                                </option>
                            @endforeach
                
                        </select>
                    </div>
                    <div>
                    <label for="installments"  class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Installments')}}<span  class="red">*</span>
                    </label>
                        <select name="installments" wire:ignore id="installments" wire:model="installments"  class="form-select block w-full sm:text-sm sm:leading-5 border my-1">
                
                
                        </select>
                        <input type="hidden" name="installmentamount" wire:model="installmentamount" id="installmentamount" >
                        <input type="hidden" name="interestFree" wire:model="interestFree" class="form-control" id="interestFree">
                    </div>
                    @if($cart->open)
                        <div class="py-5 px-4 "><button  id="btnpay" class="my-3 bg-blue-500 px-3 rounded">{{__('Payment')}}</button></div>
                    @endif

                </div>
                @if(!$cart->open)   
                <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
                    {{__('Order Completed')}}
                </div>
                @else
                    @if($pagseguroerror)
                        <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                            
                                {{ $pagseguroerror }}
                            
                        </div>
                    @endif
                @endif
            @endif
            </div>
            @if($tab==2)
                <div class="tab-pane fade show active" id="pills-profileVertical" role="tabpanel"
                aria-labelledby="pills-profile-tabVertical">
            @else
                <div class="tab-pane fade" id="pills-profileVertical" role="tabpanel"
                aria-labelledby="pills-profile-tabVertical">
            @endif
                <h1 class="bg-gray-500 rounded px-3 text-center">Pay with Boleto</h1>
                    <div class="grid grid-cols-4 gap-4 px-4 py-4">
            
                    
                    <div>
                            <p>
                            The Boleto Bancário will be displayed after confirmation of purchase and can be printed for payment at any bank branch, or have the number noted for payment by phone or internet.
                            </p>
                    </div>
                        <div class="form-group">
                        <input type="hidden" name="senderhash" id="senderhash"  >
                        <input type="hidden" name="paymentmethod" id="paymentmethod" value="boleto" >
                        <div>
                    <div>

                        
                    <div>
                        <label for="invoiceaddress" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Billing Address')}}<span  class="red">*</span>
                        </label>
                            <select name="invoiceaddress" wire:model="invoiceaddress" class="form-select block w-full sm:text-sm sm:leading-5 border my-1" >
                                 <option value="">{{__('Select an address')}}</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}"
                                        >
                                        {{$address->name}}
                                    </option>
                                @endforeach
                    
                            </select>
                            @error('invoiceaddress')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>
                    <div>
                        <label for="deliveryaddress" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Shipping Address')}}<span  class="red">*</span>
                        </label>
                            <select name="deliveryaddress" wire:model="deliveryaddress" class="form-select block w-full sm:text-sm sm:leading-5 border my-1" >
                                <option value="">{{__('Select an address')}}</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}"
                                        >
                                        {{$address->name}}
                                    </option>
                                @endforeach
                    
                            </select>
                            @error('deliveryaddress')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>
                    <div><h1 class="text-lg font-semibold leading-snug sm:pr-8">Total R${{ number_format($total-$discount,2,',','.') }}</h1></div>
                    @if($cart->paymentlink==null)
                        <div class="py-5 px-4 "><button id="btnpayboleto" class="my-3 bg-blue-500 px-3 rounded">{{__('Payment')}}</button></div>
                    @else
                        <div class="py-5 px-4 "><a href="{{$cart->paymentlink}}" target="_bla"> <button  class="my-3 bg-blue-500 px-3 rounded">{{__('Download Boleto')}}</button></a></div>
                    @endif
                    @if(!$cart->open)   
                        <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
                            {{__('Order Completed')}}
                        </div>
                    @else
                        @if($pagseguroerror)
                            <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                                
                                    {{ $pagseguroerror }}
                                
                            </div>
                        @endif
                    @endif
                </div>
            

            </div>

            
                
            </div>
        
        </div>
    </div>
    
        @if($tab==3)
            <div class="tab-pane fade show active" id="pills-homeVertical" role="tabpanel"
                aria-labelledby="pills-home-tabVertical">
            @else
            <div class="tab-pane fade  " id="pills-homeVertical" role="tabpanel"
            aria-labelledby="pills-home-tabVertical">
            @endif
            <div class="grid grid-cols-12 gap-12 px-4 py-4">
                    <div class=" col-span-12  rounded bg-white px-3">
                       
                        @if($cart->open)
                            <h1 class="text-center text-lg font-semibold my-3">PIX </h1>
                   
                            <p>{{__('Click on Checkout to generate the QR code')}}</p>
                            <p>{{__("Check the data and make the payment through your bank's app")}}</p>

                            <div class="py-5 px-4 "><button  id="btnpay" class="my-3 bg-blue-500 px-3 rounded" wire:click="pix">{{__('Checkout')}}</button></div>
                        @else
                            <div class="card p-5">
                                <div class="row pb-3 pt-5">
                                    <div class="col-12 text-center">
                                        <h2>PAGAR COM PIX</h2>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p>Você pode scannear o QRCODE ou copiar e colar o código abaixo em seu banco.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 w-48 text-center items-center">
                                        @if($cart['paymentqrcode']!=null)
                                        <img src="{{$cart['paymentqrcode']}}" alt="QRCODE" class="qrcode">
                                        @elseif($pix['qrcorde']!=null)
                                        <img src="{{$cart['paymentqrcode']}}"alt="QRCODE" class="qrcode">
                                        @endif
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p>PIX COPIA E COLA: {{$cart['paymentpixcopiaecola']}} 
                                        
                                        <a href="#" id="btncopiar" >
                                            <svg xmlns="http://www.w3.org/2000/svg" id="svgcopiar"  width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path id="s3" d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM4 20V10h10l.002 10H4zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10z"></path></svg>
                                        
                                        
                                        </a>
                                        
                                        </p>

                                    </div>
                                </div>
                                @if(!$cart->open)   
                                    <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
                                        {{__('Order Completed')}}
                                    </div>
                                @else
                                    @if($pagseguroerror)
                                        <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                                            
                                                {{ $pagseguroerror }}
                                            
                                        </div>
                                    @endif
                                @endif
                            </div>
                        
                        @endif

                    </div>
            </div>

            </div>
    </div>
        @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>

   function copyToClickBoard(){
     

      navigator.clipboard.writeText("{{$cart['pixCopiaECola']}} ")
       document.getElementById('s3').setAttribute('d','M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z')
  
   
   }



  function copyTextToClipboard(text) {
  var textArea = document.createElement("textarea");

  textArea.style.position = 'fixed';
  textArea.style.top = 0;
  textArea.style.left = 0;
  textArea.style.width = '2em';
  textArea.style.height = '2em';
  textArea.style.padding = 0;
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.boxShadow = 'none';
  textArea.style.background = 'transparent';
  textArea.value = text;

  document.body.appendChild(textArea);
  textArea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
    window.prompt("Copie para área de transferência: Ctrl+C e tecle Enter", text);
  }

  document.body.removeChild(textArea);
}

// Teste
var copyTest = document.querySelector('#btncopiar');
copyTest.addEventListener('click', function(event) {
  copyTextToClipboard('{{$cart["pixCopiaECola"]}} ');
  document.getElementById('s3').setAttribute('d','M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z')
});
</script>
        @if((get_config('payments/plataform/creditcard')==1)||(get_config('payments/plataform/boleto')==1))
            <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

        @endif
        @if(get_config('payments/plataform/creditcard')==1)
    
            <script>
            PagSeguroDirectPayment.setSessionId("{{$cardtoken}}");
            </script>
        <script>
            

                $(document).ready(function() {

                    $('#cardnumber').change(function() {

                        PagSeguroDirectPayment.getBrand({
                            cardBin: getCardNumber().substr(0, 6),
                            success: function({ brand }) {
                                if(brand != undefined && brand.name != '')
                                {
                                    $('#brand').val(brand.name);
                            
                                    const installmentsSelect = document.getElementById("installments");
                                    PagSeguroDirectPayment.getInstallments({
                                        amount: {{$total-$discount}},
                                        maxInstallmentNoInterest: 5,
                                        brand: brand.name,
                                        success: function(response){
                                            // Retorna as opções de parcelamento disponíveis
                                        
                                            var retorno_bandeira = response.installments[brand.name];
                                
                                            for( var i = 0; i < retorno_bandeira.length; i++ ) {
                                
                                                if(retorno_bandeira[i].interestFree){
                                                option = new Option(retorno_bandeira[i].quantity +'x de R$'+ (retorno_bandeira[i].installmentAmount.toFixed(2)).replace(".", ",") +' sem juros' , retorno_bandeira[i].quantity );

                                                        $('#installments')
                                                        .append($('<option />')  // Create new <option> element
                                                            .val(retorno_bandeira[i].quantity)            // Set value as "Hello"
                                                            .text(retorno_bandeira[i].quantity +'x de R$'+ (retorno_bandeira[i].installmentAmount.toFixed(2)).replace(".", ",") +' sem juros')           // Set textContent as "Hello"
                                                        //  .prop('selected', true)  // Mark it selected
                                                        .attr({"interestfree": retorno_bandeira[i].interestFree, "amount": retorno_bandeira[i].installmentAmount.toFixed(2) ,'id':'installments'+retorno_bandeira[i].quantity})
                                                    
                                                        );

                                                }else{
                                                    $('#installments')
                                                        .append($('<option />')  // Create new <option> element
                                                            .val(retorno_bandeira[i].quantity)            // Set value as "Hello"
                                                            .text(retorno_bandeira[i].quantity +'x de R$'+ (retorno_bandeira[i].installmentAmount.toFixed(2)).replace(".", ",") +' com juros')           // Set textContent as "Hello"
                                                            .attr({"interestfree": retorno_bandeira[i].interestFree, "amount": retorno_bandeira[i].installmentAmount.toFixed(2) ,'id':'installments'+retorno_bandeira[i].quantity})
                                                        );
                                                }
                                            
                                            
                                                    // aqui você usa os valores definidos pra montar o select
                                            }
                                            
                                            
                                        },
                                        error: function(response) {
                                            // callback para chamadas que falharam.
                                        
                                        },
                                        complete: function(response){
                                            // Callback para todas chamadas.
                                        
                                    
                                        }
                                });

                                }
                            }
                        });

                    });
                    $('#installments').on('change', function() {
                    
                    
                        $('#installmentamount').val($('#installments'+$('#installments').val()).attr("amount"));
                        $('#interestFree').val($('#installments'+$('#installments').val()).attr("interestfree"));
                    
                    });
                    $('#cvv').mask('0009');
                    $('#expirationmonth').mask('00');
                    $('#expirationyear').mask('0000');
                    $('#billingaddressnumber').mask('099999');
                    $('#cardnumber').mask('0000 0000 0000 0000');
                    $('#creditcardholdercpf').mask('000.000.000-00');
                    $('#billingaddresspostalcode').mask('00000-000');
                    var SPMaskBehavior = function (val) {
                        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                    };

                    spOptions = {
                        onKeyPress: function(val, e, field, options) {
                            field.mask(SPMaskBehavior.apply({}, arguments), options);
                        }
                    };

                    $('#creditcardholderphone').mask(SPMaskBehavior, spOptions);
                    let getCardNumber = function() {
                        return $('#cardnumber').val().replace(/\D/g, "");
                    };

                    let getCardValues = function() {
                        return {
                            cardnumber: getCardNumber(),
                            brand: $('#brand').val(),
                            cvv: $('#cvv').val(),
                            expirationmonth: $('#expirationmonth').val(),
                            expirationyear: $('#expirationyear').val(),
                        };
                    };

                    let getErrorCreditCard = function(code) {

                        let $error = '';
                        switch(code)
                        {
                            case "5003" : $error = "Falha de comunicação com a instituição financeira"; break;
                            case "10000": $error = "Marca de cartão de crédito inválida"; break;
                            case "10001": $error = "Número do cartão de crédito com comprimento inválido"; break;
                            case "10002": $error = "Mês / Ano Expiração inválido"; break;
                            case "10003": $error = "Campo de segurança CVV inválido"; break;
                            case "10004": $error = "Código de verificação CVV é obrigatório"; break;
                            case "10006": $error = "Campo de segurança CVV com comprimento inválido"; break;
                            case "30400": $error = "As informações do cartão, são inválidas"; break;
                            case "53004": $error = "Quantidade inválida de itens"; break;
                            case "53005": $error = "É necessário informar a moeda"; break;
                            case "53006": $error = "Valor inválido para especificação da moeda"; break;
                            case "53007": $error = "Referência inválida comprimento: {0}"; break;
                            case "53008": $error = "URL de notificação inválida"; break;
                            case "53009": $error = "URL de notificação com valor inválido"; break;
                            case "53010": $error = "O e-mail do remetente é obrigatório"; break;
                            case "53011": $error = "Email do remetente com comprimento inválido"; break;
                            case "53012": $error = "Email do remetente está com valor inválido"; break;
                            case "53013": $error = "O nome do remetente é obrigatório"; break;
                            case "53014": $error = "Nome do remetente está com comprimento inválido"; break;
                            case "53015": $error = "Nome do remetente está com valor inválido"; break;
                            case "53017": $error = "Foi detectado algum erro nos dados do seu CPF"; break;
                            case "53018": $error = "O código de área do remetente é obrigatório"; break;
                            case "53019": $error = "Há um conflito com o código de área informado, em relação a outros dados seus"; break;
                            case "53020": $error = "É necessário um telefone do remetente"; break;
                            case "53021": $error = "Valor inválido do telefone do remetente"; break;
                            case "53022": $error = "É necessário o código postal do endereço de entrega"; break;
                            case "53023": $error = "Código postal está com valor inválido"; break;
                            case "53024": $error = "O endereço de entrega é obrigatório"; break;
                            case "53025": $error = "Endereço de entrega rua comprimento inválido: {0}"; break;
                            case "53026": $error = "É necessário o número de endereço de entrega"; break;
                            case "53027": $error = "Número de endereço de remessa está com comprimento inválido"; break;
                            case "53028": $error = "No endereço de entrega há um comprimento inválido"; break;
                            case "53029": $error = "O endereço de entrega é obrigatório"; break;
                            case "53030": $error = "Endereço de entrega está com o distrito em comprimento inválido"; break;
                            case "53031": $error = "É obrigatório descrever a cidade no endereço de entrega"; break;
                            case "53032": $error = "O endereço de envio está com um comprimento inválido da cidade"; break;
                            case "53033": $error = "É necessário descrever o Estado, no endereço de remessa"; break;
                            case "53034": $error = "Endereço de envio está com valor inválido"; break;
                            case "53035": $error = "O endereço do remetente é obrigatório"; break;
                            case "53036": $error = "O endereço de envio está com o país em um comprimento inválido"; break;
                            case "53037": $error = "O token do cartão de crédito é necessário"; break;
                            case "53038": $error = "A quantidade da parcela é necessária"; break;
                            case "53039": $error = "Quantidade inválida no valor da parcela"; break;
                            case "53040": $error = "O valor da parcela é obrigatório."; break;
                            case "53041": $error = "Conteúdo inválido no valor da parcela"; break;
                            case "53042": $error = "O nome do titular do cartão de crédito é obrigatório"; break;
                            case "53043": $error = "Nome do titular do cartão de crédito está com o comprimento inválido"; break;
                            case "53044": $error = "O nome informado no formulário do cartão de Crédito precisa ser escrito exatamente da mesma forma que consta no seu cartão obedecendo inclusive, abreviaturas e grafia errada"; break;
                            case "53045": $error = "O CPF do titular do cartão de crédito é obrigatório"; break;
                            case "53046": $error = "O CPF do titular do cartão de crédito está com valor inválido"; break;
                            case "53047": $error = "A data de nascimento do titular do cartão de crédito é necessária"; break;
                            case "53048": $error = "TA data de nascimento do itular do cartão de crédito está com valor inválido"; break;
                            case "53049": $error = "O código de área do titular do cartão de crédito é obrigatório"; break;
                            case "53050": $error = "Código de área de suporte do cartão de crédito está com valor inválido"; break;
                            case "53051": $error = "O telefone do titular do cartão de crédito é obrigatório"; break;
                            case "53052": $error = "O número de Telefone do titular do cartão de crédito está com valor inválido"; break;
                            case "53053": $error = "É necessário o código postal do endereço de cobrança"; break;
                            case "53054": $error = "O código postal do endereço de cobrança está com valor inválido"; break;
                            case "53055": $error = "O endereço de cobrança é obrigatório"; break;
                            case "53056": $error = "A rua, no endereço de cobrança está com comprimento inválido"; break;
                            case "53057": $error = "É necessário o número no endereço de cobrança"; break;
                            case "53058": $error = "Número de endereço de cobrança está com comprimento inválido"; break;
                            case "53059": $error = "Endereço de cobrança complementar está com comprimento inválido"; break;
                            case "53060": $error = "O endereço de cobrança é obrigatório"; break;
                            case "53061": $error = "O endereço de cobrança está com tamanho inválido"; break;
                            case "53062": $error = "É necessário informar a cidade no endereço de cobrança"; break;
                            case "53063": $error = "O item Cidade, está com o comprimento inválido no endereço de cobrança"; break;
                            case "53064": $error = "O estado, no endereço de cobrança é obrigatório"; break;
                            case "53065": $error = "No endereço de cobrança, o estado está com algum valor inválido"; break;
                            case "53066": $error = "O endereço de cobrança do país é obrigatório"; break;
                            case "53067": $error = "No endereço de cobrança, o país está com um comprimento inválido"; break;
                            case "53068": $error = "O email do destinatário está com tamanho inválido"; break;
                            case "53069": $error = "Valor inválido do e-mail do destinatário"; break;
                            case "53070": $error = "A identificação do item é necessária"; break;
                            case "53071": $error = "O ID do ítem está inválido"; break;
                            case "53072": $error = "A descrição do item é necessária"; break;
                            case "53073": $error = "Descrição do item está com um comprimento inválido"; break;
                            case "53074": $error = "É necessária quantidade do item"; break;
                            case "53075": $error = "Quantidade do item está irregular"; break;
                            case "53076": $error = "Há um valor inválido na quantidade do item"; break;
                            case "53077": $error = "O valor do item é necessário"; break;
                            case "53078": $error = "O Padrão do valor do item está inválido"; break;
                            case "53079": $error = "Valor do item está irregular"; break;
                            case "53081": $error = "O remetente está relacionado ao receptor! Esse é um erro comum que só o lojista pode cometer ao testar como compras. O erro surge quando uma compra é realizada com os mesmos dados cadastrados para receber os pagamentos da loja ou com um e-mail que é administrador da loja"; break;
                            case "53084": $error = "Receptor inválido! Esse erro decorre de quando o lojista usa dados relacionados com uma loja ou um conta do PagSeguro, como e-mail principal da loja ou o e-mail de acesso à sua conta não PagSeguro"; break;
                            case "53085": $error = "Método de pagamento indisponível"; break;
                            case "53086": $error = "A quantidade total do carrinho está inválida"; break;
                            case "53087": $error = "Dados inválidos do cartão de crédito"; break;
                            case "53091": $error = "O Hash do remetente está inválido"; break;
                            case "53092": $error = "A Bandeira do cartão de crédito não é aceita"; break;
                            case "53095": $error = "Tipo de transporte está com padrão inválido"; break;
                            case "53096": $error = "Padrão inválido no custo de transporte"; break;
                            case "53097": $error = "Custo de envio irregular"; break;
                            case "53098": $error = "O valor total do carrinho não pode ser negativo"; break;
                            case "53099": $error = "Montante extra inválido"; break;
                            case "53101": $error = "Valor inválido do modo de pagamento. O correto seria algo do tipo default e gateway"; break;
                            case "53102": $error = "Valor inválido do método de pagamento. O correto seria algo do tipo Credicard, Boleto, etc."; break;
                            case "53104": $error = "O custo de envio foi fornecido, então o endereço de envio deve estar completo"; break;
                            case "53105": $error = "As informações do remetente foram fornecidas, portanto o e-mail também deve ser informado"; break;
                            case "53106": $error = "O titular do cartão de crédito está incompleto"; break;
                            case "53109": $error = "As informações do endereço de remessa foram fornecidas, portanto o e-mail do remetente também deve ser informado"; break;
                            case "53110": $error = "Banco EFT é obrigatório"; break;
                            case "53111": $error = "Banco EFT não é aceito"; break;
                            case "53115": $error = "Valor inválido da data de nascimento do remetente"; break;
                            case "53117": $error = "Valor inválido do cnpj do remetente"; break;
                            case "53122": $error = "O domínio do email do comprador está inválido. Você deve usar algo do tipo @sandbox.pagseguro.com.br"; break;
                            case "53140": $error = "Quantidade de parcelas fora do limite. O valor deve ser maior que zero"; break;
                            case "53141": $error = "Este remetente está bloqueado"; break;
                            case "53142": $error = "O cartão de crédito está com o token inválido"; break;
                        }

                        return $error;
                    }


                    
                    $('#btnpay').click(function(event) {
                
                    
                        event.preventDefault();
                        $('#senderhash').val(PagSeguroDirectPayment.getSenderHash());
                        @this.senderhash=PagSeguroDirectPayment.getSenderHash();
                        let card = getCardValues();

                        PagSeguroDirectPayment.createCardToken({
                            cardNumber: card.cardnumber,
                            brand: card.brand,
                            cvv: card.cvv,
                            expirationMonth: card.expirationmonth,
                            expirationYear: card.expirationyear,
                            success: function (response) {
                                // Retorna o cartão tokenizado.
                              
                                    $('#creditcardtoken').val(response.card.token);
                                     @this.creditcardtoken=response.card.token;
                              

                          
                               
                            },
                            error: function (response) {
                                // Callback para chamadas que falharam.
                                // console.log(response);
                                let { errors } = response;

                                let code = Object.keys(errors)[0];
                                let text = getErrorCreditCard(code);

                                console.log(errors);

                                swal({
                                    text,
                                    icon: 'error',
                                });
                            },
                            complete: function (response) {
                                // Callback para todas chamadas.
                            }
                        });
                        setTimeout(function(){
                            @this.paymentmethod ='creditCard';
                             @this.installmentamount =$('#installments'+$('#installments').val()).attr("amount");
                             @this.interestFree =$('#installments'+$('#installments').val()).attr("interestFree");
                             @this.senderhash=PagSeguroDirectPayment.getSenderHash();
                             @this.call('pagsegurocreditcard');
                            
                        }, 2000);

                        
                    });
                
            


                });

            </script>





        @endif
        @if(get_config('payments/plataform/boleto')==1)
        <script>
            
        $('#btnpayboleto').click(function(event) {
                
                    
                event.preventDefault();
            
                @this.senderhashboleto=PagSeguroDirectPayment.getSenderHash();
                @this.call('pagseguroboleto');


                
            });
            </script>
        @endif
        @endpush
   @else

   <div class="w-full mt-10">
                <h2 class="mb-6 text-2xl leading-9 font-extrabold title-primary text-center">{{__('There are 0 itens in your checkout cart !')}}</h2>

        
    </div>
   @endif
</div>
