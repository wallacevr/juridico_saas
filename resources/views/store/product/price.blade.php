<div class="price text-center">
    <span class="mt-1  {{ $product->special_price ? 'line-through text-sm text-price-with-special' : 'text-2xl text-price' }}">
        {{ $product->formattedPrice() }}</span>
    @if ($product->special_price)
        <span class="mt-0 text-2xl font-medium text-special-price  ">
            {{ $product->formattedSpecialPrice() }}</span>
    
    @endif
    
</div>
