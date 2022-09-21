@extends('layouts.tenant', ['title' => __('Products')])

@section('content')
    <header class="relative z-20 flex flex-none items-center justify-between border-b border-gray-200 py-4 px-6 bg-white">
        <div>
            <h1 class="text-lg font-semibold leading-6 text-gray-900">
                {{__('Filter')}}
            </h1>
            <form class="mt-5 sm:flex sm:items-center" method="get" action="{{route('tenant.products.index')}}">
                <div class="w-full sm:max-w-xs">
                @include('layouts.snippets.fields', ['type'=>'text','label'=>null,'placeholder'=>'Search products','name'=>'q','value'=> $q,'require'=>false ])
                </div>
                <button type="submit" class="btn-action-primary">{{__("Find")}}</button>
            </form>
        </div>
        <div class="flex items-center">

            <div class="relative">
                <a href="{{ route('tenant.products.create') }}"
                   class="btn-action-primary">
                    {{ __('New product') }}
                </a>
            </div>
        </div>
    </header>



    <div class="">

        <div class="">



            <div class="block mt-8">
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    @if ($products->count() >= 1)
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-right text-gray-500 uppercase tracking-wider"
                                width="20">

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                width="80">
                                <a href="" class="inline-flex items-center">{{ __('Id') }} @include('layouts.snippets.icons', ['icon'=>'chevron-down' ])</a>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="" class="inline-flex items-center">{{ __('Name') }} @include('layouts.snippets.icons', ['icon'=>'chevron-down' ])</a>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs text-center font-medium text-gray-500 uppercase tracking-wider  w-1/5"
                                width="20">
                                <a href="" class="inline-flex items-center">{{ __('Stock') }} @include('layouts.snippets.icons', ['icon'=>'chevron-down' ])</a>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                width="30">
                                <a href="" class="inline-flex items-center">{{ __('Status') }} @include('layouts.snippets.icons', ['icon'=>'chevron-down' ])</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                     
                            <tr class="hover:bg-gray-50 text-gray-500 text-201 font-normal">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="ids[]" value="{{$product->id}}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    {{$product->id}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                           {{--<img class="h-10 w-10 rounded-full"
                                                 src="{{ $product->getImage() }}"> --}} 
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('tenant.products.edit', ['product' => $product->id]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center w-2 font-medium">
                                    {{$product->qty}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    @if ($product->status)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ __('Active') }}
                                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        {{ __('Inactive') }}
                                                    </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    
                        </tbody>
                    @else
                        <h4 class="text-lg text-center text-gray-500 m-5">{{ __('No results found') }}</h4>
                    @endif
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    @include('layouts.snippets.delete-modal', ['entity' => 'product'])

@endsection
