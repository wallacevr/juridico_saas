@extends('layouts.store', ['title' => 'My account'])

@section('content')

@include('layouts.snippets.customer-header')

<div class="container mx-auto m-15">
  <div class="text-2xl text-gray-800 mb-5">{{ __('Account information') }}</div>
  <p><a href="{{ route('store.customer.addresses')}}">{{ __('My addresses') }}</a></p>
  <p>{{ __('Change password') }}</p>
  <p>{{ __('Wishlist') }}</p>

  <div class="text-2xl text-gray-800 mb-5 mt-5">{{ __('My orders') }}</div>
  <p>{{ __('Order history') }}</p>
  <p>{{ __('Returns') }}</p>
  <p>{{ __('Transactions') }}</p>
</div>

@endsection
