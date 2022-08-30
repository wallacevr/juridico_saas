@extends('layouts.central')

@section('content')


<div class="flex justify-center mt-4">
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
          <h1 class="inline text-3xl font-bold tracking-tight text-indigo-600 sm:block sm:text-4xl">Monte a sua loja virtual sem pagar nada</h1>
          <p class="inline text-1xl font-bold tracking-tight text-gray-900  sm:block sm:text-2xl">Seu e-commerce do seu jeito e com todas funcionalidades que você precisa de graça.</p>
          <form class="mt-8 sm:flex" action="{{ route('central.tenants.step-1') }}" method="post" id="step-form">
            @csrf
            @include('layouts.snippets.fields', ['type'=>'email', 'class'=>'w-full px-5','label'=>'Write the email you use the most', 'placeholder'=>'Write the email you use the most', 'name'=>'email', 'value'=> '' ,'classLabel'=>'sr-only'])
            <div class="mt-3  sm:mt-0 sm:ml-3 sm:flex-shrink-0">
              <button type="submit" class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> {{__('Register')}}</button>
            </div>
          </form>
        </div>
      </div>
        <a  href="{{ route('central.tenants.register') }}" class="hidden ml-2 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
       
    </a>
</div>

@endsection