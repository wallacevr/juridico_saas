@extends('layouts.store', ['title' => $brand->page_title])

@section('content')

  <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24  ">
    <h2 class="mb-6 text-3xl leading-9 title-primary ">{{ $brand->name }}</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
      @foreach($brand->products as $key => $product)
      <div class="group mb-6">
        @include('store.product.product', ['product' => $product])
      </div>
      @endforeach

      <!-- More products... -->
    </div>
  </div>
@endsection