@extends('layouts.store', ['title' => $product->name])

@section('content')
    <style>
        .swiper {
            margin: 0;
        }

        .swiper-thumbs {
            margin-top: 20px;
        }

        .mySwiper .swiper-slide {
            opacity: 0.4;
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
                                <img src="{{ imageCache($image->image_url,'small') }}" />
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="product-info">
                <h2 class="mb-2 text-5xl leading-9  title-primary  divide-y  divide-gray-300">
                    {{ $product->name }}</h2>
                <!-- rating-->
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">4.95 out of 5</p>
                </div>
                <!-- rating end-->
                <div class="mb-6 text-3xl leading-9  title-primary ">{{ $product->formattedPrice() }}</div>
                <div class="product-description text-xl mb-6">
                    {!! $product->description !!}
                </div>
                <a href="{{ route('store.add.to.cart', $product->id) }}"
                    class="add-tocart inline-flex items-center justify-center w-40 h-13 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
                    alt="{{ __('Add to cart') }}">{{ __('Add to cart') }}</a>
            </div>

        </div>

        <div class="max-w-full py-16 sm:py-24  ">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Customers also purchased') }}</h2>
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2  lg:grid-cols-4 ">
                @foreach ($similarCategory as $similar)
                    <div class="group mb-6">
                        <div
                            class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                            <a href="{{ url($similar->slug) }}"><img src="{{ $similar->getImage() }}"
                                    alt="{{ $similar->name }}"
                                    class="w-full h-full object-center object-cover group-hover:opacity-75"></a>
                        </div>
                        <a href="{{ url($similar->slug) }}"
                            class="inline-flex mt-2 text-lg title-primary">{{ $similar->name }}</a>
                        <p class="mt-1 text-lg font-medium text-price {{ $similar->special_price ? 'line-through' : '' }}">
                            {{ $similar->formattedPrice() }}</p>
                        @if ($similar->special_price)
                            <p class="mt-0 text-lg font-medium text-special-price  ">
                                {{ $similar->formattedSpecialPrice() }}</p>
                        @else
                            <p class="mt-0 text-lg font-medium ">&nbsp;</p>
                        @endif
                        <a href="{{ url($similar->slug) }}"
                            class="add-tocart inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none"
                            alt="{{ __('Add to cart') }}">{{ __('Add to cart') }}</a>
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
