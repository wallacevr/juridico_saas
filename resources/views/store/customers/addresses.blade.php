@extends('layouts.store', ['title' => 'My account'])

@section('content')

@include('layouts.snippets.customer-header')

<div class="container mx-auto m-15">
  <div class="text-2xl text-gray-800 mb-5">{{ __('Address list') }}</div>
  <span class=" rounded-md shadow-sm">
    <a href="" class="h-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
      {{ __('New address') }}
    </a>
  </span>
</div>

<div class="container mx-auto m-15">
  @foreach ($addresses as $address)
  {{ $address->name }}
  {{ $address->postalcode }}
  {{ $address->address }}
  {{ $address->neighborhood }}
  {{ $address->complement }}
  {{ $address->number }}
  {{ $address->city }}
  {{ $address->state }}
  {{ $address->country }}
  <br>
  @endforeach
</div>

@endsection
