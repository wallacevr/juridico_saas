@extends('layouts.tenant', ['title' => __('Whatsapp Checkout Configuration')])

@section('content')
    <form action="{{route('tenant.whatsstoreconfig')}}" method="POST" id="storeSettings" enctype="multipart/form-data">
        @csrf

        <!-- Block 1 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Whatsapp Checkout Configuration') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('Configure your store with the option to send the order by whatsapp at checkout.') }}
                    </p>
                </div>
            </div>

            <!-- body -->
            <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                @if (session('success'))
                    <div class="col-span-8 mx-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <span class="font-medium">{{ session('success') }}</span> 
                    </div>

                @endif
                
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap grid grid-cols-1 gap-1">
                            <div class="w-48 md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'Whatsapp',
                                        'placeholder' => 'Whatsapp to Checkout',
                                        'name' => 'whatsapp',
                                        'value' => get_config('plugins/commnunication/whatsapppcheckout/whatsapp'),
                                    ])
                                </div>
                            </div>
                            <div class="w-5">
                                <div class="mt-4  pr-2">
                   

                                    <label for="enabled" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Enabled')}}
                                    </label>
                                    <div class="mt-1 rounded-md ">

                                        <input id="enabled" type="checkbox" name="enabled" class="form-input block w-full sm:text-sm sm:leading-5 border " 
                                        @if(get_config('plugins/commnunication/whatsapppcheckout/enabled')=='on')
                                            checked

                                        @endif
                                        />
                                    </div>

                                    @error('enabled')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>


                        <div class="mx-2 my-2">
                            <button type="submit" 
                                class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>
                               
                        </div>
                    </div>

                  


                </div>
            </div>
        </div>

        @include('layouts.snippets.divide')


    </form>
@endsection
@push('js')
    <script src="{{ URL::to('/') . '/js/cep-api.js' }}"></script>
    <script>
        $(document).ready(function() {

            $('#whatsapp').mask('(00) 00000-0000');
   
            $("#storeSettings").validate({
                rules: {
                  
                    whatsapp: {
                        required: true,
                        minlength: 10
                    }
                   
                }
            });
        });
    </script>
@endpush