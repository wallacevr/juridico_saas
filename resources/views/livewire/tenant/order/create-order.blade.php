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
                        <div class="grid grid-cols-3 gap-6">
                        <div wire:ignore class="w-full">
                                        <label for="customer">{{__('Customer')}}</label>
                                        <select class="form-control js-basic-single w-full" name="customer" id="customer"  >
                                            <option value="null">{{ __('Select a cart') }}</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach 
                                        </select>
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

                            
                                            <select name="cart" id="cart" wire:model="cartid" class="form-select block w-full sm:text-sm sm:leading-5 border px-4 py-3 rounded">
                                                <option value="null">{{__('Select a cart')}}</option>
                                                    @foreach($carts as $cart)
                                                        <option value="{{$cart->id}}">{{$cart->id}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div>









                           @endif
                        
        </div>
        <div class="overflow-x-auto relative my-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th colspan="4" class="text-center">Itens</th>
            </tr>
            <tr>
                <th scope="col" class="py-3 px-6">
                    Product name
                </th>
                <th scope="col" class="py-3 px-6">
                    Variations
                </th>
                <th scope="col" class="py-3 px-6">
                    Qty
                </th>
                <th scope="col" class="py-3 px-6">
                    Price
                </th>
            </tr>
        </thead>
        <tbody>
        @if(count($cartproducts)>0)
          @foreach($cartproducts as $product)
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
                {{__('R$'. number_format($product->advancedPrice(),2,',','.')) }}
                </td>
            </tr>
            @endforeach
           @endif
        </tbody>
    </table>

    @if($carrinho!=null)
            <div class="grid grid-cols-2 gap-2 my-4">

                <div class="font-bold">{{__('Address Delivery')}}</div>

            
            </div>
        <div class="grid grid-cols-1 gap-1 md:grid-cols-2">
        @if($carrinho->id_address_delivery!=null)  
            <div>{{__('Address:'. $carrinho->deliveryaddress->address)}}</div>

            <div>{{__('Number:'. $carrinho->deliveryaddress->number)}}</div>
            <div>{{__('Complement:'. $carrinho->deliveryaddress->complement)}}</div>
            <div>{{__('Neighborhood:'. $carrinho->deliveryaddress->neighborhood)}}</div>
            <div>{{__('Postalcode:'. $carrinho->deliveryaddress->postalcode)}}</div>
            <div>{{__('City:'. $carrinho->deliveryaddress->city)}}</div>
            <div>{{__('State:'. $carrinho->deliveryaddress->state)}}</div>
            <div>{{__('Country:'. $carrinho->deliveryaddress->country)}}</div>
        @endif  
        </div>
        <div class="grid grid-cols-2 gap-2 my-4">

            <div class="font-bold">{{__('Address Invoice')}}</div>

        
        </div>
        <div class="grid grid-cols-1 gap-1 md:grid-cols-2">
        @if($carrinho->id_address_invoice!=null)    
            <div>{{__('Address:'. $carrinho->invoiceaddress->address)}}</div>

            <div>{{__('Number:'. $carrinho->invoiceaddress->number)}}</div>
            <div>{{__('Complement:'. $carrinho->invoiceaddress->complement)}}</div>
            <div>{{__('Neighborhood:'. $carrinho->invoiceaddress->neighborhood)}}</div>
            <div>{{__('Postalcode:'. $carrinho->invoiceaddress->postalcode)}}</div>
            <div>{{__('City:'. $carrinho->invoiceaddress->city)}}</div>
            <div>{{__('State:'. $carrinho->invoiceaddress->state)}}</div>
            <div>{{__('Country:'. $carrinho->invoiceaddress->country)}}</div>
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
                        <button type="button" wire:click="store"
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
