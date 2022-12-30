@extends('layouts.tenant', ['title' => __('applicationSettings.Store settings')])

@push('head')
@livewireStyles
@endpush

@push('body')
@livewireScripts
@endpush

@section('content')

<div>
  <div class="flex flex-row flex-wrap">
    <div class="w-full md:w-1/3">
      <div class="px-4 md:px-0">
     
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{__('applicationSettings.Configurations')}}
        </h3>
        <p class="mt-1 text-sm leading-5 text-gray-600">
      
          {{__('applicationSettings.Settings for your store')}}
        </p>
      </div>
    </div>
    <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
      <form action="{{ route('tenant.settings.application.configuration') }}" method="POST">
        @csrf
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div>
              <label for="company" class="block text-sm font-medium leading-5 text-gray-700">{{__('applicationSettings.Company name')}}
              </label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <input id="company" name="company" value="{{ old('company', tenant('company')) }}" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="{{__('applicationSettings.My company')}}" />
              </div>
            </div>
            
            @error('company')
            <p class="text-red-500 text-xs mt-4">
              {{ $message }}
            </p>
            @enderror
          </div>
          <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
            <button class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
            {{__('actions.Save')}}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="py-4 md:py-10">
  <div class="border-t border-transparent md:border-gray-200"></div>
</div>

<div>
  <div class="flex flex-row flex-wrap">
    <div class="w-full md:w-1/3">
      <div class="px-4 md:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{__('applicationSettings.Domains')}}
        </h3>
        <p class="mt-1 text-sm leading-5 text-gray-600">          
          {{__("applicationSettings.Manage your store's domains")}}
        </p>
      </div>
    </div>
    <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
  
      @livewire('domains')
      @livewire('new-domain')
      
      @livewire('fallback-domain')
      
    </div>
  </div>
</div>

<div class="py-4 md:py-10">
  <div class="border-t border-transparent md:border-gray-200"></div>
</div>

<div>
  <div class="flex flex-row flex-wrap">
    <div class="w-full md:w-1/3">
      <div class="px-4 md:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{__('applicationSettings.Billing')}}
        </h3>
        <p class="mt-1 text-sm leading-5 text-gray-600">
        {{__('applicationSettings.Manage your subscription and payment methods')}}.
        </p>
      </div>
    </div>
    <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
    
      @livewire('subscription-banner')
      @livewire('upcoming-payment')
      @livewire('billing-address')
      @livewire('invoices')
      @livewire('subscription-plan')
    
      @livewire('payment-method')
  
    </div>
  </div>
</div>
@endsection
