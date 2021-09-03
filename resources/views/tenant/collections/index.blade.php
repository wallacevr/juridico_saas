@extends('layouts.tenant', ['title' => 'Collections']) @section('content')

<div class="">
	<div class="max-w-7xl mx-auto">
		<a href="{{ route('tenant.collections.create') }}" class="
                px-5
                py-2
                text-base
                font-medium
                rounded-md
                text-white
                bg-indigo-600
                hover:bg-indigo-500
                focus:outline-none focus:border-indigo-700
                active:bg-indigo-700
                transition
                ease-in-out
                duration-150
            ">
			New collection
		</a>
		<div class="block mt-8">
			<!-- This example requires Tailwind CSS v2.0+ -->
			<div class="flex flex-col">
				<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
					<div class="
                            py-2
                            align-middle
                            inline-block
                            min-w-full
                            sm:px-6
                            lg:px-8
                        ">
						<div class="
                                shadow
                                overflow-hidden
                                border-b border-gray-200
                                sm:rounded-lg
                            ">
							<table class="min-w-full divide-y divide-gray-200 ">
								<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            ">
											Name
										</th>
										<th scope="col" class="
                                                px-6
                                                py-3
                                                text-left text-xs
                                                font-medium
                                                text-gray-500
                                                uppercase
                                                tracking-wider
                                            ">
											Status
										</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach ($collections as $collection)
									<tr>
										<td class="px-6 py-4 whitespace-nowrap">
											<div class="flex items-center">
												<div class="flex-shrink-0 h-10 w-10">
													<img class="h-10 w-10 rounded-full"
														src="{{ $collection->image_url }}" alt="">
												</div>
												<div class="ml-4">
													<div class="text-sm font-medium text-gray-900">
														{{ $collection->name }}
													</div>
												</div>
											</div>
										</td>
										<td class="px-6 py-4 whitespace-nowrap">
											@if ($collection->status)
											<span class="
															px-2
															inline-flex
															text-xs
															leading-5
															font-semibold
															rounded-full
															bg-green-100
															text-green-800
														">
												Active
											</span>
											@else
											<span class="
															px-2
															inline-flex
															text-xs
															leading-5
															font-semibold
															rounded-full
															bg-red-100
															text-red-800
														">
												Inactive
											</span>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
