@extends('layouts.store', ['title' => 'Home'])

@section('content')


@includeWhen(isset($productsFeatured),'store.product.slider', $productsFeatured)

<div class="min-h-full  py-16  sm:py-24  ">
    <h2 class="mb-6 text-3xl leading-9 text-center title-primary ">PRODUTOS EM DESTAQUE</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
      @foreach($productsFeatured as $key => $product)
      <div class="group mb-6">
        @include('store.product.product', ['product' => $product])
      </div>
      @endforeach

      <!-- More products... -->
    </div>
  </div>
@endsection
