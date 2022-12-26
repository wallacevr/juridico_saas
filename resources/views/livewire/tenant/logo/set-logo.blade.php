<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="shadow sm:rounded-md sm:overflow-hidden" wire:ignore>
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                   
                        @foreach($initiallogos as $key=>$initiallogo)
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ __('Logo '. ucfirst($key)) }}
                                </h3>
                            </div>
                            <div class="">
                                    @php
                                        $this->initialkey = $key;
                                    @endphp
                                    <x-input.filepondlogos wire:model="{{$key}}" ></x-input>
                            
                                
     
                                @error($key)
                                    <p class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                             </div>
                        @endforeach
                </div>
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('tenant.admin.dashboad') }}"
                            class="py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm"  >
                        <a  href="#" wire:click="store"
                            class="button py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                            {{ __('Save') }}
                        </a>
                    </span>
                </div>
            </div>
        </div>
</div>
