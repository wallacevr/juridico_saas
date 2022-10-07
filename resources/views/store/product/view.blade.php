@extends('layouts.store', ['title' => $product->name])

@section('content')
@livewire('store.product.view',['product'=>$product->id])
@endsection

@push('js')
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            centeredSlides: true,
            zoom: true,
            thumbs: {
                swiper: swiper,
            },
            zoom: {
                maxRatio: 2,
                minRation: 1
            },
        });
        // Use built in zoom.in() and zoom.out() function to scale images
        // When slide starts to change slideChangeTransitionStart event fires and we use it to scale down the image. 
        swiper.on("slideChangeTransitionStart", swiper.zoom.out);
        // And when transition has finished scale it up.
        swiper.on("slideChangeTransitionEnd", swiper.zoom.in);
    </script>
@endpush
