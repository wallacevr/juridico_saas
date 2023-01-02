@extends('layouts.store', ['title' =>__('Search')])

@section('content')

  <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24  ">
      @livewire('store.product.search')

      <!-- More products... -->
    </div>
  </div>
@endsection