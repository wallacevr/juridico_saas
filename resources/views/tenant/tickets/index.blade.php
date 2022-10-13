@extends('layouts.tenant', ['title' => 'Tickets'])

@section('content')
<header class="relative z-20 flex flex-none items-center justify-between border-b border-gray-200 py-4 px-6 bg-white">
        <div>
            <h1 class="text-lg font-semibold leading-6 text-gray-900">
                {{__('Filter')}}
            </h1>
            <form class="mt-5 sm:flex sm:items-center" method="get" action="{{route('tenant.tickets.index')}}">
                <div class="w-full sm:max-w-xs">
                @include('layouts.snippets.fields', ['type'=>'text','label'=>null,'placeholder'=>'Search tickets','name'=>'q','value'=> $q,'require'=>false ])
                </div>
                <button type="submit" class="btn-action-primary">{{__("Find")}}</button>
            </form>
        </div>
        <div class="flex items-center">

            <div class="relative">
                <a href="{{ route('tenant.tickets.create') }}"
                   class="btn-action-primary">
                    {{ __('New ticket') }}
                </a>
            </div>
        </div>
    </header>
<div class="">
	<div class="max-w-7xl mx-auto">

		<div class="block mt-8">
			<div class="flex flex-col">
				<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class=" py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
						<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
							<table class="min-w-full divide-y divide-gray-200 ">
								@if ($tickets->count() >= 1)
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Name') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Ticket') }}
										</th>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Registration date') }}
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
									@foreach($tickets as $ticket)
									<tr>
										<td class="px-6 py-4 whitespace-nowrap"> {{$ticket->name}} </td>
										<td class="px-6 py-4 whitespace-nowrap"> {{$ticket->validator}} </td>
										<td class="px-6 py-4 whitespace-nowrap"> {{date("d/m/Y", strtotime($ticket->created_at) )}} </td>
										<td class="px-6 py-4 whitespace-nowrap">
											@if ($ticket->active)
											<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
												{{ __('Active') }}
											</span>
											@else
											<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
												{{ __('Inactive') }}
											</span>
											@endif
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<a href="{{ route('tenant.tickets.edit', ['ticket' => $ticket->id]) }}">
													<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
													</svg>
												</a>
												<form action="{{ route('tenant.tickets.destroy', ['ticket' => $ticket->id]) }}" method="post" style="margin-top: 4px;">
													@csrf
													@method('DELETE')
													<button type="submit" class="delete-resource-button">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
														</svg>
													</button>
												</form>
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
					{{ $tickets->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

@include('layouts.snippets.delete-modal', ['entity' => 'ticket'])

@endsection
