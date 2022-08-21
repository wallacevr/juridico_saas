@extends('layouts.store', ['title' => $product->name])

@section('content')
    <style>
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }



        .swiper {
            width: 600px;
            height: 600px;
            margin:0;
        }
        .swiper-thumbs{
          margin-top:20px;
        }

        .mySwiper .swiper-slide {
            opacity: 0.4;
            height: 150px;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }
    </style>
    
    <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24  lg:px-8">
        <h2 class="mb-6 text-3xl leading-9 font-extrabold title-primary ">{{ $product->name }}</h2>

        <div class="flex flex-col lg:flex-row">
            <div class="basis-6/12 flex-initial ">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">

                        @foreach ($product->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ productImage($image->image_url) }}" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiper mt-2">
                    <div class="swiper-wrapper">
                        @foreach ($product->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ productImage($image->image_url) }}" />
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="basis-6/12 ">d</div>

        </div>
    </div>
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
            zoom: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endpush
