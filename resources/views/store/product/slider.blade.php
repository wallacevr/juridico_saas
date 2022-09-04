<div class="block-productsFeatured mt-6">
    <h2 class="mb-6 text-3xl leading-9  title-primary text-center">{{ __('PROMOÇÕES') }}</h2>
    <div class="swiper productsFeatured">
        <div class="swiper-wrapper">
            @foreach ($productsFeatured as $productFeatured)
                <div class="swiper-slide">
                    @include('store.product.product', ['product' => $productFeatured])
                </div>
            @endforeach
        </div>

    </div>
    <div class="productsFeatured swiper-button-next"></div>
    <div class="productsFeatured swiper-button-prev"></div>
</div>



@push('js')
    <script>
        var swiper = new Swiper('.productsFeatured', {
            spaceBetween: 5,
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
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
            },
            navigation: {
                nextEl: '.productsFeatured.swiper-button-next',
                prevEl: '.productsFeatured.swiper-button-prev',
            },
        });
    </script>
@endpush
