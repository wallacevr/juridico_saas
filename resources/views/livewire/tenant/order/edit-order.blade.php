<div>

<div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <!-- LEFT FORM -->
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-8">
            <form id="productForm" action="{{ route('tenant.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden shadow-indigo-200">
                    <div class="px-4 py-5 sm:px-6 ">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('Basic information') }}</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                    </div>
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                     @if($orderid==null)   
                        <div class="grid grid-cols-2 gap-6">
                        <div wire:ignore class="w-full">
                                        <label for="customer">{{__('Customer')}}</label>
                                        <select class="form-control js-basic-single w-full" name="customer" id="customer"  >
                                            <option value="null">{{ __('Select a customer') }}</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                @if($customer->id==$order->id_customer)
                                                    selected
                                                @endif
                                                >{{ $customer->name }}</option>
                                            @endforeach 
                                        </select>
                                        @error('customerid')
                                            <p class="mt-2 text-sm text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                        <script>
                                                $(document).ready(function () {
                                        
                                                    $('#customer').select2({
                                                        placeholder: 'seletec the customer ',
                                                        allowClear: true   // Shows an X to allow the user to clear the value.
                                                    });
                                                    $('#customer').on('change', function (e) {
                                                      
                                                        var data = $('#customer').select2("val");
                                                        @this.set('customerid', data);
                                                        
                                                         
                                                    });
                            
                                                });

                                        </script>
                            </div>
                       
                            @if(count($carts)>0)
                                <div class="w-full">
                                <label for="cart" class="block mb-2 leading-5 text-gray-700">{{__('Cart')}}
                                        </label>
                                        <div class="mt-1 rounded-md ">

                            
                                            <select name="cart" id="cart" wire:model="cartid" wire:change="refreshaddress"  class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded">
                                                <option value="null">{{__('Select a cart')}}</option>
                                                    @foreach($carts as $cart)
                                                        <option value="{{$cart->id}}"
                                                        @if($cart->id==$order->id_cart)
                                                            selected
                                                        @endif
                                                        
                                                        >{{$cart->id}}</option>
                                                    @endforeach
                                            </select>
                                            @error('cartid')
                                            <p class="mt-2 text-sm text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                        </div>
                                </div>

                           @endif
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                           @if($addresses!=null)
                                    <div  class="w-full">
                                            <label for="id_address_delivery">{{__('Address Delivery')}}</label>
                                         
                                            <div class="mt-1 rounded-md ">
                                                <select class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded" name="customer"  wire:model="id_address_delivery">
                                                    <option value="null"   
                                                     
                                                    
                                                    >{{ __('Select an Address') }}</option>
                                                    @foreach($addresses as $address)
                                                        <option value="{{ $address->id }}"
                                                        @if($address->id == $order->id_address_delivery)
                                                            selected
                                                        @endif
                                                        >{{ $address->name }}</option>
                                                    @endforeach 
                                                </select>
                                                @error('id_address_delivery')
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                    </div>
                         @endif
                         @if($addresses!=null)
                                    <div  class="w-full">
                                            <label for="id_address_delivery">{{__('Address Invoice')}}</label>
                                            <div class="mt-1 rounded-md ">
                                                <select class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded" name="customer"  wire:model="id_address_invoice">
                                                    <option value="null"
                                                        @if(null == $order->id_address_invoice)
                                                            selected
                                                        @endif
                                                    
                                                    
                                                    >{{ __('Select an Address') }}</option>
                                                    @foreach($addresses as $address)
                                                        <option value="{{ $address->id }}"
                                                        @if($address->id == $order->id_address_invoice)
                                                            selected
                                                        @endif
                                                        >{{ $address->name }}</option>
                                                    @endforeach 
                                                </select>
                                                @error('id_address_invoice')
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                    </div>
                         @endif
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                                    <div    >
                                            <label for="id_address_delivery">{{__('Payment Method')}}</label>
                                            <div class="mt-1 rounded-md ">
                                                <select class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded" name="paymentmethod"  wire:model="paymentmethod">
                                                    <option value="null">{{ __('Select a Payment Method') }}</option>
                                                    <option value="1"
                                                    @if($paymentmethod=='1')
                                                        selected

                                                    @endif
                                                    >{{ __('Money') }}</option>
                                                    <option value="2"
                                                    @if($paymentmethod==2)
                                                        selected

                                                    @endif
                                                    >{{ __('Pix') }}</option>
                                                    <option value="3"
                                                    @if($paymentmethod==3)
                                                        selected

                                                    @endif
                                                    >{{ __('Credit Card') }}</option>
                                                    <option value="4"
                                                    @if($paymentmethod==4)
                                                        selected

                                                    @endif
                                                    >{{ __('Billet') }}</option>
                                                    <option value="5"
                                                    @if($paymentmethod==5)
                                                        selected

                                                    @endif
                                                    >{{ __('Bank transfer') }}</option>
                                                </select>
                                                @error('paymentmethod')
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                    </div>
                                    <div  >
                                            <label for="id_address_delivery">{{__('Status order')}}</label>
                                        
                                  
                                            <div class="mt-1 rounded-md ">
                                                <select class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded" name="statusorder"  wire:model="statusorder">
                                                    <option value="null">{{ __('Select the status') }}</option>
                                                    <option value="Awaiting Payment"
                                                    @if($statusorder=="Awaiting Payment")
                                                        selected

                                                    @endif
                                                    >{{ __('Awayting Payment') }}</option>
                                                    <option value="Pay" 
                                                    @if($statusorder=="Pay")
                                                        selected

                                                    @endif
                                                    >{{ __('Pay') }}</option>
                                                    <option value="Sent"
                                                    @if($statusorder=="Sent")
                                                        selected

                                                    @endif
                                                    
                                                    >{{ __('Sent') }}</option>
               
                                                </select>
                                                @error('statusorder')
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                    </div>
                        
                        
                         @if($products!=null)
                                    <div wire:ignore class="w-full">
                                            <label for="id_address_delivery">{{__('Product')}}</label>
                                            <div class="mt-1 rounded-md ">
                                                <select class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded" name="productid" id="productid" wire:model="productid">
                                                    <option value="null">{{ __('Select a Product') }}</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}"
                                                        @if($product->id == $productid)
                                                            selected
                                                        @endif
                                                        >{{ $product->name }}</option>
                                                    @endforeach 
                                                </select>
                                                <script>
                                                $(document).ready(function () {
                                        
                                                    $('#productid').select2({
                                                        placeholder: 'seletec the product',
                                                        allowClear: true   // Shows an X to allow the user to clear the value.
                                                    });
                                                    $('#productid').on('change', function (e) {
                                                      
                                                        var data = $('#productid').select2("val");
                                                        @this.set('productid', data);
                                                        
                                                         
                                                    });
                            
                                                });

                                        </script>
                                            </div>

                                    </div>
                         @endif
            @else
                <div class="grid grid-cols-2 gap-6">
                    <div><span>{{__('Order')}}:</span>{{$orderid}}</div>
                </div>
            @endif              
        </div>
     
                @if($productid!=null)
                <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24  lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4">
                    
                    <div class=" flex-initial product-image ">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                            @if(!$optionimages)  
                        
                                    @foreach ($productshow->images as $image)
                                        <div class="swiper-slide">
                                            <div class="swiper-zoom-container">
                                                <img src="{{ productImage($productshow->id .'/'. $image->image_url,'thumb') }}" />
                                            </div> 
                                        </div>
                                    @endforeach
                                @else
                                    @foreach ($optionimages as $image)

                                        <div class="swiper-slide">
                                            <div class="swiper-zoom-container">
                                                <img src="{{ productImage($productshow->id .'/'. $image->product_options_id .'/'.$image->image_url,'thumb') }}" />
                                            </div> 
                                        </div>
                                    @endforeach

                                @endif
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div thumbsSlider="" class="swiper mySwiper mt-2">
                            <div class="swiper-wrapper">
                                @if(!$optionimages)
                                    @foreach ($productshow->images as $image)
                                        <div class="swiper-slide">
                                        <img src="{{ imageCache($productshow->id .'/'.$image->image_url,'thumb') }}" />
                                        </div>
                                    @endforeach
                                @else
                                    @foreach ($optionimages as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ imageCache($productshow->id .'/'. $image->product_options_id .'/'.$image->image_url,'thumb') }}" />
                                        </div>
                                    @endforeach

                                @endif
                            </div>
                        </div>
                
                    </div>
                    <div class="product-info">
                        <h5 class="mb-2 text-5xl leading-9  title-primary  divide-y  divide-gray-300">
                            {{ $productshow->name }}</h5>
                        <!-- rating-->
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">4.95 out of 5</p>
                        </div>
                        <!-- rating end-->
                        <div class="mb-6 text-3xl leading-9  title-primary ">
                            @if($optionprice=="" )
                                {{ $productshow->formattedPrice() }}
                            @else
                                {{$optionprice }}
                            @endif
                            </div>
                        <div class="product-description text-sm mb-6">
                            @foreach($variations as $key=>$variation)
                                <div class="grid grid-cols-3">
                                        @foreach($variation as $option)
                                            @if($key < $maxnivel)
                                                <div >
                                                    
                                                        @switch($option['type']) 
                                                            @case('NONE')
                                                            <input type="radio" name="opt{{$key}}"  value="{{ $option['id'] }}" wire:click="optionslist({{($key+1)}},{{$option['id']}})">
                                                                <label for="opt1">{{ $option['name'] }}</label>
                                                                @break
                                                            @case('COLOR')
                                                            <input type="radio" name="opt{{$key}}"  value="{{ $option['id'] }}" wire:click="optionslist({{($key+1)}},{{$option['id']}})">
                                                                <input type="color" value="{{$option['value']}}" id="" disabled>
                                                                @break
                                                            @case('IMAGE')
                                                                <div class="grid grid-cols-2">
                                                                    <div class="w-1/6">
                                                                        <input type="radio" name="opt{{$key}}"  value="{{ $option['id'] }}" wire:click="optionslist({{($key+1)}},{{$option['id']}})">
                                                                    </div>
                                                                    <div>
                                                                        <img  class="h-10 w-10" src="{{ tenant_public_path() . '/images/options/' . $option['value']}}">
                                                                    </div>
                                                                    

                                                                </div>
                                                                @break
                                                            @default
                                                        
                                                        @endswitch
                                                </div>
                                            @else
                                            
                                                <div>
                                                
                                                    <input type="radio" name="opt{{$key}}"  value="{{ $option['id'] }}"  wire:click="showoptionsproperty({{$option['id']}})"
                                                            @if($option['qty_stock'] <=0)
                                                                disabled
                                                            @endif                            
                                                        > <label for="opt1">
                                                            @if(isset($option['options']['name']))
                                                                {{ $option['options']['name'] }}
                                                            
                                                            @else
                                                                {{ $option['name'] }}
                                                            @endif
                                                            </label>
                                                    </div>
                                            @endif
                                        @endforeach
                                </div>
                            @endforeach
                        </div>
                    
                            @if($hasoptions==false)
                                <a href="#" wire:click="addcart({{$productid}},null)"
                                    class="add-tocart inline-flex items-center justify-center w-40 h-13 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
                                    alt="{{ __('Add to cart') }}">{{ __('Add to order') }}</a>
                            @else
                                @if(($optioncart!="")||$optioncart!=null)
                                    
                                        <a href="#" wire:click="addcart({{$productid}},{{$optioncart}})"
                                            class="add-tocart inline-flex items-center justify-center w-40 h-13 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
                                            alt="{{ __('Add to cart') }}">{{ __('Add to order') }}</a>

                                @else
                                        <button type="button"
                                            class="add-tocart inline-flex items-center justify-center w-40 h-13 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none disabled:opacity-25 " disabled
                                            alt="{{ __('Add to cart') }}" >{{ __('Add to order') }}</button>

                                @endif
                            @endif
                            <div>
                                @if (session()->has('success'))
                                    <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                        </div>
                    </div>

                </div>


                @endif
        <div class="overflow-x-auto relative my-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th colspan="4" class="text-center">Itens</th>
            </tr>
            <tr>
                <th scope="col" class="py-3 px-6">
                    {{__('Product Name')}}
                </th>
                <th scope="col" class="py-3 px-6">
                    {{__('Variations')}}
                </th>
                <th scope="col" class="py-3 px-6">
                    {{__('Qty')}}
                </th>
                <th scope="col" class="py-3 px-6">
                    {{__('Price')}}
                </th>
            </tr>
        </thead>
        <tbody>
        @if(count($cartproducts)>0)
        @php
            $total=0;
            $finalvalue=0;
         @endphp
          @foreach($cartproducts as $product)
            @php
                $total += $product->quantity* $product->product->price;
                $finalvalue += $product->quantity* $product->FinalPrice();

            @endphp
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $product->name}}
                </th>
                <td class="py-4 px-6">
                  {{$product->optiondescription()}}
                </td>
                <td class="py-4 px-6">
                 {{ number_format($product->quantity,0,',','.')}}
                </td>
                <td class="py-4 px-6">
                {{__('R$'. number_format($product->product->price,2,',','.')) }}
                </td>
            </tr>
            @endforeach
           @endif
        </tbody>
    </table>


    @if($carrinho!=null)
            <div class="grid grid-cols-1 gap-1 my-4">
                <div>    
                    @if(isset($cart))
                        @if($cart->id_ticket!=null)
                        
                                <h2 class="text-left font-bold ">{{__('Applied Ticket')}}:<span class="text-green-400 font-bold">{{$cart->ticket->validator}}</span> </h2>
                        @endif
                    @endif
                 </div>
                <div class="font-bold">{{__('Total')}}: R${{$total}}</div>
                <div class="font-bold">{{__('Discount')}}: R${{($total-$finalvalue)}}</div>
                <div class="font-bold">{{__('Final Value')}}: R${{$finalvalue}}</div>
            </div>
        <div class="grid grid-cols-1 gap-1 md:grid-cols-2">
        @if($carrinho->id_address_delivery!=null)  
            <div>{{__('Address')}}{{':'. $carrinho->deliveryaddress->address}}</div>

            <div>{{__('Number')}}{{':'. $carrinho->deliveryaddress->number}}</div>
            <div>{{__('Complement')}}:{{ $carrinho->deliveryaddress->complement}}</div>
            <div>{{__('Neighborhood')}}:{{ $carrinho->deliveryaddress->neighborhood}}</div>
            <div>{{__('Postalcode')}}:{{$carrinho->deliveryaddress->postalcode}}</div>
            <div>{{__('City')}}:{{$carrinho->deliveryaddress->city}}</div>
            <div>{{__('State')}}:{{$carrinho->deliveryaddress->state}}</div>
            <div>{{__('Country')}}:{{$carrinho->deliveryaddress->country}}</div>
        @endif  
        </div>
        <div class="grid grid-cols-2 gap-2 my-4">

            <div class="font-bold">{{__('Address Invoice')}}</div>

        
        </div>
        <div class="grid grid-cols-1 gap-1 md:grid-cols-2">
        @if($carrinho->id_address_invoice!=null)    
        <div>{{__('Address')}}{{':'. $carrinho->invoiceaddress->address}}</div>

            <div>{{__('Number')}}{{':'. $carrinho->invoiceaddress->number}}</div>
            <div>{{__('Complement')}}:{{ $carrinho->invoiceaddress->complement}}</div>
            <div>{{__('Neighborhood')}}:{{ $carrinho->invoiceaddress->neighborhood}}</div>
            <div>{{__('Postalcode')}}:{{$carrinho->invoiceaddress->postalcode}}</div>
            <div>{{__('City')}}:{{$carrinho->invoiceaddress->city}}</div>
            <div>{{__('State')}}:{{$carrinho->invoiceaddress->state}}</div>
            <div>{{__('Country')}}:{{$carrinho->invoiceaddress->country}}</div>
        @endif 
        </div>
    @endif
</div>
      
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('tenant.products.index') }}"
                            class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="button" wire:click="update"
                            class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                            {{ __('Save') }}
                        </button>
                    </span>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
