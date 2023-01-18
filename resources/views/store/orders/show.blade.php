@extends('layouts.store', ['title' => __('Order'). __( ' ID #'. $order->id)])

@section('content')
<h1 class="text-center font-bold">{{__('Order')}}</h1>

<div class="grid grid-cols-1 gap-1 md:grid-cols-2 my-4">

    <div class="font-bold">{{__('Total: R$'. number_format( $order->products->sum('pivot.price'),2,',','.'))}}</div>

    <div class="font-bold">{{__('Status:')}}
             @if ($order->status=='Pay' || $order->status=='Sent')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ __($order->status) }}
                </span>
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    {{ __($order->status) }}
                </span>
            @endif
    </div>
</div>
<div class="grid grid-cols-1 gap-1 md:grid-cols-2 my-4">

    <div class="font-bold">{{__('Shipping Price')}}: {{__('R$'. number_format( $order->price_shipping,2,',','.'))}}</div>

    <div class="font-bold">{{__('Method Shipping')}}: {{$order->methodshipping()}}
       
    </div>
</div>
<div class="grid grid-cols-1 gap-1 md:grid-cols-2 my-4">

    <div>{{__('Customer')}}: {{__($order->customer->name)}}</div>

    <div>{{__('Taxvat')}}: {{__($order->customer->taxvat)}}</div>
</div>

<div class="overflow-x-auto relative my-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th colspan="4" class="text-center">Itens</th>
            </tr>
            <tr>
                <th scope="col" class="py-3 px-6">
                    {{__('Product name')}}
                </th>
                <th scope="col" class="py-3 px-6">
                    {{__('Variations')}}
                </th>
                <th scope="col" class="py-3 px-6">
                    {{__('Qty')}}
                </th>
                <th scope="col" class="py-3 px-6">
                   {{__('Price')}}
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach($order->products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $product->name}}
                </th>
                <td class="py-4 px-6">
                    
                </td>
                <td class="py-4 px-6">
                 {{ number_format($product->pivot->quantity,0,',','.')}}
                </td>
                <td class="py-4 px-6">
                {{__('R$'. number_format($product->pivot->price,2,',','.')) }}
                </td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>
<div class="grid grid-cols-2 gap-2 my-4">

    <div class="font-bold">{{__('Address Delivery')}}</div>

  
</div>
<div class="grid grid-cols-1 gap-1 md:grid-cols-4">
    
    <div>{{__('Address')}}: {{__($order->addressdelivery->address)}}</div>

    <div>{{__('Number')}}: {{__($order->addressdelivery->number)}}</div>
    <div>{{__('Complement')}}: {{__($order->addressdelivery->complement)}}</div>
    <div>{{__('Neighborhood')}}: {{__($order->addressdelivery->neighborhood)}}</div>
    <div>{{__('Postalcode')}}: {{__($order->addressdelivery->postalcode)}}</div>
    <div>{{__('City')}}: {{__($order->addressdelivery->city)}}</div>
    <div>{{__('State')}}: {{__($order->addressdelivery->state)}}</div>
    <div>{{__('Country')}}: {{__($order->addressdelivery->country)}}</div>
</div>
<div class="grid grid-cols-2 gap-2 my-4">

    <div class="font-bold">{{__('Address Invoice')}}</div>

  
</div>
<div class="grid grid-cols-1 gap-1 md:grid-cols-4">
    
    <div>{{__('Address')}}: {{__($order->addressinvoice->address)}}</div>

    <div>{{__('Number')}}: {{__( $order->addressinvoice->number)}}</div>
    <div>{{__('Complement')}}: {{__($order->addressinvoice->complement)}}</div>
    <div>{{__('Neighborhood')}}: {{__($order->addressinvoice->neighborhood)}}</div>
    <div>{{__('Postalcode')}}: {{__($order->addressinvoice->postalcode)}}</div>
    <div>{{__('City')}}: {{__($order->addressinvoice->city)}}</div>
    <div>{{__('State')}}: {{__($order->addressinvoice->state)}}</div>
    <div>{{__('Country')}}: {{__($order->addressinvoice->country)}}</div>
</div>


@endsection