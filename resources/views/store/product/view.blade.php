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
            margin: 0;
        }

        .swiper-thumbs {
            margin-top: 20px;
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4">
            <div class=" flex-initial product-image ">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">

                        @foreach ($product->images as $image)
                            <div class="swiper-slide">
                                <div class="swiper-zoom-container">
                                    <img src="{{ productImage($image->image_url) }}" />
                                </div>
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
            <div class="product-info">
                <h2 class="mb-2 text-5xl leading-9 font-extrabold title-primary  divide-y  divide-gray-300">
                    {{ $product->name }}</h2>
                <!-- rating-->
                <ul class="flex items-center gap-x-1 mb-6">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300 fill-current" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300 fill-current" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300 fill-current" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300 fill-current" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </li>
                </ul>
                <!-- rating end-->
                <div class="mb-6 text-3xl leading-9  title-primary ">{{ $product->formattedPrice() }}</div>
                <div class="product-description text-xl mb-6">
                    {!! $product->description !!}
                </div>
                <a href="{{ url($product->slug) }}"
                    class="add-tocart inline-flex items-center justify-center w-40 h-13 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
                    alt="{{ __('Add to cart') }}">{{ __('Add to cart') }}</a>
            </div>

        </div>

        <div class="max-w-full py-16 sm:py-24 sm:px-6  ">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Customers also purchased') }}</h2>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 p-4 lg:grid-cols-4 bg-white">
                @foreach($similarCategory as $similar)
             
                <div class="group relative">
                    <div
                        class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <a  href="{{url($similar->slug)}}"><img src="{{$similar->getImage()}}" alt="{{ $similar->name}}" class="w-full h-full object-center object-cover group-hover:opacity-75"></a>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="#">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $similar->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Black</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ $similar->formattedPrice() }}</p>
                    </div>
                </div>
       
                @endforeach

                
            </div>
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
