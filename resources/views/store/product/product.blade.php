<div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden ">
    <a href="{{ url($product->slug) }}"><img src="{{ $product->getImage() }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-center object-cover group-hover:opacity-75"></a>
</div>
<a href="{{ url($product->slug) }}"
    class="mt-2 text-lg title-primary text-center block">{{ $product->name }}</a>
@include('store.product.price', ['product' => $product])
<a href="{{ route('store.add.to.cart', $product->id) }}"
    class="add-tocart inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
    alt="{{ __('Add to cart') }}">{{ __('Add to cart') }}</a>
