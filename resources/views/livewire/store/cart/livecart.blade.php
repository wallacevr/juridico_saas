<div>
    @if($cart)         
        <div class="w-full mt-10">
                <h2 class="mb-6 text-2xl leading-9 font-extrabold title-primary text-center">Carrinho de compras</h2>
          
                @php 
                    $total = 0 ;
                    $discount =0;
                @endphp
                @if ($cartproducts)




                    @foreach ($cartproducts as $cartproduct)
                    
                    @php 
                        $total += $cartproduct->price * $cartproduct['quantity']; 
                        $discount += $cartproduct->Discount(); 
                    @endphp
                    <div class="grid grid-cols-2 gap-1 md:grid-cols-4">
                        <div class="py-3 px-4 ">
                            @if($cartproduct->option!=null)
                                @if(count($cartproduct->option->images))
                                    <img class="flex-shrink-0  dark:border-transparent rounded outline-none dark:bg-gray-500 h-20"
                                        src="{{ productImage($cartproduct->id_product .'/'. $cartproduct->product_options_id .'/'. $cartproduct->option->images[0]->image_url) }}" alt="{{ $cartproduct->product->name }}">
                                @else
                                    <img class="flex-shrink-0  dark:border-transparent rounded outline-none dark:bg-gray-500 h-20"
                                        src="{{ productImage($cartproduct->id_product .'/'. $cartproduct->product->images[0]->image_url) }}" alt="{{ $cartproduct->product->name }}">
                                @endif
                            @else
                                    <img class="flex-shrink-0  dark:border-transparent rounded outline-none dark:bg-gray-500 h-20"
                                    src="{{ productImage($cartproduct->id_product .'/'. $cartproduct->product->images[0]->image_url) }}" alt="{{ $cartproduct->product->name }}">
                            @endif
                        </div>
                        <div>
                                <h3 class="text-lg font-semibold leading-snug sm:pr-8">{{ $cartproduct->product['name'] }} <br> 
                                    @if($cartproduct->option!=null)
                                        {{rtrim($cartproduct->option->descricao(),'/')}}
                                    @endif
                                </h3>
                        </div>
                        <div class="py-3 px-2 ">
                        <button class="py-0" wire:click="removecart({{$cartproduct->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                           
                            <input type="text" class="w-14  text-center"  value="{{ round($cartproduct->quantity,0) }}" disabled>
                            <button class="py-0 " wire:click="addcart({{$cartproduct->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                </button>
                        </div>
                        <div class="text-right w-36">

                            @php 
                                if($cartproduct->Discount()>0){
                                    $classdiscount ="line-through";
                                }else{
                                    $classdiscount ="";
                                }    

                            @endphp

                            <h3 class="text-lg font-semibold leading-snug {{$classdiscount}} sm:pr-8">R$ {{number_format(round($cartproduct->quantity,0)*($cartproduct->price),2,",",".")}}</h3>
                            @if($cartproduct->Discount()>0)
                                <h3 class="text-lg font-semibold leading-snug sm:pr-8">R$ {{number_format((round($cartproduct->quantity,0)*($cartproduct->FinalPrice())),2,",",".")}}</h3>
                            @endif
                        </div>
                        <div class="flex text-sm divide-x pl-12">
                                    <button type="button" class="flex items-center px-2 py-1 pl-0 space-x-1 remove-from-cart" wire:click="removeall({{$cartproduct->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                            class="w-4 h-4 fill-current">
                                            <path
                                                d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z">
                                            </path>
                                            <rect width="32" height="200" x="168" y="216"></rect>
                                            <rect width="32" height="200" x="240" y="216"></rect>
                                            <rect width="32" height="200" x="312" y="216"></rect>
                                            <path
                                                d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z">
                                            </path>
                                        </svg>
                                        <span>Remove</span>
                                    </button>
                                    <button type="button" class="flex items-center px-2 py-1 space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                            class="w-4 h-4 fill-current">
                                            <path
                                                d="M453.122,79.012a128,128,0,0,0-181.087.068l-15.511,15.7L241.142,79.114l-.1-.1a128,128,0,0,0-181.02,0l-6.91,6.91a128,128,0,0,0,0,181.019L235.485,449.314l20.595,21.578.491-.492.533.533L276.4,450.574,460.032,266.94a128.147,128.147,0,0,0,0-181.019ZM437.4,244.313,256.571,425.146,75.738,244.313a96,96,0,0,1,0-135.764l6.911-6.91a96,96,0,0,1,135.713-.051l38.093,38.787,38.274-38.736a96,96,0,0,1,135.765,0l6.91,6.909A96.11,96.11,0,0,1,437.4,244.313Z">
                                            </path>
                                        </svg>
                                        <span>Add to favorites</span>
                                    </button>
                        </div>
                    </div>      
      
                @endforeach


                @endif
              
            </div>
            <div class="w-full  text-right bg-gray-500 rounded mb-10 py-3 px-3" style="margin-bottom:10px">
                 <h1 class="text-right font-bold ">Resumo do Pedido </h1>
                <h2 class="text-right font-bold ">Total {{count($cartproducts)}} 
                    @if(count($cartproducts)>1)
                        items
                    @else
                        item
                    @endif
                    <span class="text-green-400 font-bold">R${{number_format($total,2,",",".")}}</span>
                    @if($discount>0)
                        <br>
                      {{__('Discount:')}}  <span class="text-green-400 font-bold">R${{number_format($discount,2,",",".")}}</span> 
                      <br>
                      {{__('Final Value:')}}  <span class="text-green-400 font-bold">R${{number_format($total-$discount,2,",",".")}}</span> 
                    @endif
                </h2>
                <hr>
                 
                    <div class="text-end  my-3">
                    @if(count($shippingaddress)>0 )
                            <label for="shippingaddress">Shipping Address</label>
                            <select name="shippingaddress" class="form-select my-2" wire:change="shippingcalculator" wire:model="shippingaddressid">
                               <option value="">Select</option>
                                @foreach($shippingaddress as $shippingaddress)
                                    <option value="{{$shippingaddress->id}}" 
                                       
                                    >{{$shippingaddress->name}}</option>

                                @endforeach
                            </select>
                            
                            @error('shippingaddressid') <br><span class="error bg-red-100 rounded-lg py-1 px-6  text-base text-red-700 my-2">{{ $message }}</span> @enderror
                            <br>
                    @else
                    <div class="grid justify-items-end">
                        <div class="lg:w-32 justify-items-end">
                             @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Postalcode', 'placeholder'=>'_____-___', 'name'=>'postalcode', 'value'=> '' ,'wiremodel'=>'postalcode','wirechange'=>'shippingcalculator'])        
                        </div>
                    </div>
                       
                    @endif
                            @isset($quotations)
                        <div class="grid grid-cols-12 justify-items-end py-3">     
                        @foreach($quotations as $quotation)

                           @isset($quotation['price'])
                                @php
                                    $company = $quotation['company']
                                @endphp
                        

                                <div class="text-end col-span-11">
                                    <label for="shippingmethod" class="ml-2 text-start text-sm font-medium text-gray-900 dark:text-gray-300" > {{$quotation['name']}} -  {{$quotation['currency']}}{{ number_format($quotation['price'],2,',','.') }}({{$quotation['delivery_time']}} days after payment confirmed)</label>
                                     <input type="radio"  name="shippingmethod" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" value="{{$quotation['id']}}" wire:model="shippingid"
                                     @if($shippingid == $quotation['id'])
                                     checked="checked"
                                     @endif
                                     >
                                </div>
                                <div class="grid justify-items-end w-20 px-2 mx-2">
                                   <img src="{{$company['picture']}}"  class="w-20 mx-0">
                                </div>
                          
                            @endisset
                        @endforeach
                        @error('shippingid')
                                 <div class="text-end col-span-11 my-2">
                                     <span class="error bg-red-100 rounded-lg py-1 px-6  text-base text-red-700 my-2">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid justify-items-end w-20 px-2 mx-2">
                                 
                                </div>
                        
                    @endisset
                    </div>
                    

                <hr>
                    <div class="grid justify-items-end">
                        <div class="w-1/5 my-3">
                            @include('layouts.snippets.fields', ['type'=>'text','label'=>'Do you have a Ticket?','placeholder'=>'Ticket','name'=>'ticket','value'=> '','require'=>'false','wiremodel'=>'ticket' ])
                            <button class="bg-blue-500 px-2 py-1 my-2  rounded font-bold" wire:click="validaticket"> Valid Ticket</button>
                        </div>
                        @if($cart->id_ticket!=null)
                    
                            <h2 class="text-right font-bold ">Applied Ticket:<span class="text-green-400 font-bold">{{$cart->ticket->validator}}</span> </h2>
                        @endif
                        @if (session('invalidcoupon'))
                            <div class="w-1/5 my-3 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                    <span class="font-medium">{{ session('invalidcoupon') }}</span> 
                            </div>

                        @endif
                        
                    </div>
                  <hr>
              <a href="#" wire:click="save" class="my-3">
                <button class="bg-blue-500 px-2 py-1 my-3 rounded font-bold"> Finalizar</button>
             </a>
            </div>
        </div>
    @else
    <div class="w-full mt-10">
                <h2 class="mb-6 text-2xl leading-9 font-extrabold title-primary text-center">Carrinho de compras</h2>

        
    </div>
    <div class="w-full mt-10">
                <h2 class="mb-6 text-2xl leading-9 font-extrabold title-primary text-center">{{__('0 itens in your cart!')}}</h2>

        
    </div>
    @endif
</div>
