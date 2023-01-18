@extends('layouts.store', ['title' => 'Orders'])

@section('content')

<div class="">
	<div class="max-w-7xl mx-auto my-6">
		{{-- <a href="{{ route('tenant.order.create') }}" class="px-5 py-2 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
			{{ __('New Order') }}
		</a> --}}
		<h1 class="text-center font-bold">{{__('My orders')}}</h1>
		<div class="block mt-8">
			<div class="flex flex-col">
				<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class=" py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
						<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
							<table class="min-w-full divide-y divide-gray-200 ">
								@if ($orders->count() >= 1)
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('ID') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Customer') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Itens') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Created At') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Status') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Actions') }}
										</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach($orders as $order)
									<tr>
										<td class="px-6 py-4 whitespace-nowrap"> {{$order->id}} </td>
										<td class="px-6 py-4 whitespace-nowrap"> {{$order->customer->name}} </td>
										<td class="px-6 py-4 whitespace-nowrap"> 
										@if(count($order->products)==1)	
											{{$order->products[0]->name}}
										@else
											{{__($order->products[0]->name .'+'. (count($order->products)-1).'Item(s)' )}}
											  

										@endif
										{{$order->resumeitens}} </td>
										<td class="px-6 py-4 whitespace-nowrap"> {{date("d/m/Y", strtotime($order->created_at) )}} </td>
										
										<td class="px-6 py-4 whitespace-nowrap">
											@if ($order->status=='Pay' || $order->status=='Sent')
											<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
												{{ __($order->status) }}
											</span>
											@else
											<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
												{{ __($order->status) }}
											</span>
											@endif
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<a href="{{ route('store.orders.show', ['order' => $order->id]) }}">
													<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
													</svg>
												</a>
												
												{{--
													<form action="{{ route('tenant.orders.destroy', ['order' => $order->id]) }}" method="post" style="margin-top: 4px;">
													@csrf
													@method('DELETE')
													<button type="submit" class="delete-resource-button">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
														</svg>
													</button>
												</form>
												--}}
												
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
								@else
								<h4 class="text-lg text-center text-gray-500 m-5">{{ __('No results found') }}</h4>
								@endif
							</table>
						</div>
					</div>
					{{ $orders->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

@include('layouts.snippets.delete-modal', ['entity' => 'order'])

@endsection

