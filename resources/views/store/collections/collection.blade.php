@extends('layouts.store', ['title' => $collection->page_title])

@section('content')

  <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24  lg:px-8">
    <h2 class="mb-6 text-3xl leading-9 font-extrabold title-primary ">{{ $collection->name }}</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-4">
      @foreach($collection->products as $key => $product)
      <div class="group mb-6">
        <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
          <a  href="{{url($product->slug)}}"><img src="{{$product->getImage()}}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="w-full h-full object-center object-cover group-hover:opacity-75"></a>
        </div>
        <a  href="{{url($product->slug)}}" class="inline-flex mt-2 text-lg title-primary">{{ $product->name }}</a>
        <p class="mt-1 text-lg font-medium text-price {{$product->special_price?'line-through':''}}">{{$product->formattedPrice()}}</p>
        @if($product->special_price)
        <p class="mt-0 text-lg font-medium text-special-price  ">{{$product->formattedSpecialPrice()}}</p>
        @else
        <p class="mt-0 text-lg font-medium ">&nbsp;</p>
        @endif
        <a href="{{url($product->slug)}}" class="add-tocart inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide transition duration-200 rounded shadow-md  focus:shadow-outline focus:outline-none" alt="{{__("Add to cart")}}">{{__("Add to cart")}}</a>
      </div>
      @endforeach

      <!-- More products... -->
    </div>
  </div>
@endsection