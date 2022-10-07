<div>
<div class="max-w-3xl mt-10">
        <h2 class="mb-6 text-3xl leading-9 font-extrabold title-primary ">Carrinho de compras</h2>
        @php $total = 0 @endphp
        @if ($cartproducts)
       
            @foreach ($cartproducts as $cartproduct)
               
                @php $total += $cartproduct['price'] * $cartproduct['quantity'] @endphp
                <div class="flex flex-col py-6 sm:flex-row sm:justify-between product-item" data-id="{{ $cartproduct['id_product'] }}">
                    <div class="flex w-full space-x-2 sm:space-x-4">
                        @if(count($cartproduct->option->images))
                        
                            <img class="flex-shrink-0  dark:border-transparent rounded outline-none dark:bg-gray-500 h-20"
                                src="{{ productImage($cartproduct->id_product .'/'. $cartproduct->product_options_id .'/'. $cartproduct->option->images[0]->image_url) }}" alt="{{ $cartproduct->product->name }}">
                               
                        @else
                        <img class="flex-shrink-0  dark:border-transparent rounded outline-none dark:bg-gray-500 h-20"
                                src="{{ productImage($cartproduct->id_product .'/'. $cartproduct->product->images[0]->image_url) }}" alt="{{ $cartproduct->product->name }}">
                        @endif
                        <div class="flex flex-col justify-between w-full p-4 ">
                            <div class="flex justify-between w-full pb-2 space-x-2">
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold leading-snug sm:pr-8">{{ $cartproduct->product['name'] }}</h3>

                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold">{{ round($cartproduct->quantity,0) }}</p>
                              
                                        <p class="text-sm  dark:text-gray-600">R$ {{$cartproduct->advancedPrice()}}
                                        </p>
                                 
                                </div>
                            </div>
                            <div class="flex text-sm divide-x">
                                <button type="button" class="flex items-center px-2 py-1 pl-0 space-x-1 remove-from-cart">
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
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
