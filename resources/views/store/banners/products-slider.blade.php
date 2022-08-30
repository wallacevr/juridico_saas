<div class="max-w-full py-16 sm:py-24  ">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('PROMOÇÕES') }}</h2>
    <div class="swiper productsFeatured">
        <div class="swiper-wrapper">
            @foreach ($productsFeatured as $productFeatured)
                <div class="swiper-slide">
                    <div
                        class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                        <a href="{{ url($productFeatured->slug) }}"><img src="{{ $productFeatured->getImage() }}"
                                alt="{{ $productFeatured->name }}"
                                class="w-full h-full object-center object-cover group-hover:opacity-75"></a>
                    </div>
                    <a href="{{ url($productFeatured->slug) }}"
                        class="inline-flex mt-2 text-lg title-primary">{{ $productFeatured->name }}</a>
                    <p
                        class="mt-1 text-lg font-medium text-price {{ $productFeatured->special_price ? 'line-through' : '' }}">
                        {{ $productFeatured->formattedPrice() }}</p>
                    @if ($productFeatured->special_price)
                        <p class="mt-0 text-lg font-medium text-special-price  ">
                            {{ $productFeatured->formattedSpecialPrice() }}</p>
                    @else
                        <p class="mt-0 text-lg font-medium ">&nbsp;</p>
                    @endif
                    <a href="{{ route('store.add.to.cart', $productFeatured->id) }}"
                        class="add-tocart inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
                        alt="{{ __('Add to cart') }}">{{ __('Add to cart') }}</a>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>



@push('js')
    <script>
        var swiper = new Swiper('.productsFeatured', {
            spaceBetween: 30,
            slidesPerView: 1,
            centeredSlides: false,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 50,
                },
            },
            navigation: {
                nextEl: '.productsFeatured .swiper-button-next',
                prevEl: '.productsFeatured .swiper-button-prev',
            },
        });
    </script>
@endpush
