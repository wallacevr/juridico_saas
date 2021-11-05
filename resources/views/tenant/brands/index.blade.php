@extends('layouts.tenant', ['title' => __('Brands')])

@section('content')

<div class="">
	<div class="max-w-7xl mx-auto">
		<a href="{{ route('tenant.brands.create') }}" class="px-5 py-2 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
			{{ __('New brand') }}
		</a>
		<div class="block mt-8">
			<div class="flex flex-col">
				<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class=" py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
						<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
							<table class="min-w-full divide-y divide-gray-200 ">
								@if ($brands->count() >= 1)
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
											{{ __('Name') }}
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
									@foreach ($brands as $brand)
									<tr>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<div class="flex-shrink-0 h-10 w-10">
													<img class="h-10 w-10 rounded-full" src="{{ tenant_public_path() . '/images/brands/' .$brand->image_url }}">
												</div>
												<div class="ml-4">
													<div class="text-sm font-medium text-gray-900">
														{{ $brand->name }}
													</div>
												</div>
											</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											@if ($brand->status)
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
												<a href="{{ route('tenant.brands.edit', ['brand' => $brand->id]) }}">
													<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
													</svg>
												</a>

												<form action="{{ route('tenant.brands.destroy', ['brand' => $brand->id]) }}" method="post" style="margin-top: 4px;">
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
					{{ $brands->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

@include('layouts.snippets.delete-modal', ['entity' => 'brand'])

@endsection
