<div class="product-item">
    <div class="w-full  bg-gray-200 rounded-lg overflow-hidden ">
        @php
            
            
        @endphp
        <a href="{{ url($product->slug) }}"><img src="{{ isset($imgFile)?$destination:$product->getImage() }}" alt="{{ $product->name }}"
                class="w-full object-center group-hover:opacity-75"></a>
    </div>
    <div class="product-info">
        <a href="{{ url($product->slug) }}" class="mt-2 text-lg title-primary text-center block">{{ $product->name }}</a>
        @include('store.product.price', ['product' => $product])
    </div>

    <div class="actions text-center mt-3 hidden">
        <a href="{{ route('store.add.to.cart', $product->id) }}"
            class="inline-block  ml-auto flex-shrink-0 rounded-full border border-gray-300 bg-white p-3 title-primary "
            alt="{{ __('Add to cart') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ">
                <path
                    d="M1 1.75A.75.75 0 011.75 1h1.628a1.75 1.75 0 011.734 1.51L5.18 3a65.25 65.25 0 0113.36 1.412.75.75 0 01.58.875 48.645 48.645 0 01-1.618 6.2.75.75 0 01-.712.513H6a2.503 2.503 0 00-2.292 1.5H17.25a.75.75 0 010 1.5H2.76a.75.75 0 01-.748-.807 4.002 4.002 0 012.716-3.486L3.626 2.716a.25.25 0 00-.248-.216H1.75A.75.75 0 011 1.75zM6 17.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15.5 19a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>

        </a>

        <a href="#"
            class="inline-block ml-auto flex-shrink-0 rounded-full border border-gray-300 bg-white p-3 title-primary ">
            <span class="sr-only">View notifications</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path
                    d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
            </svg>
        </a>
    </div>

</div>
