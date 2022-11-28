@extends('layouts.login')

@section('content')

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Sign up') }}
    </h2>
    <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
        {{ __('Already have an account?') }}
        <a href="{{ route('store.customer.login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
            {{ __('Sign in.') }}
        </a>
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-3xl">
    <form id="costumerForm" method="POST" action="{{ route('store.customer.register.submit') }}">
        @csrf
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <h3 class="text-xl leading-6 font-medium text-gray-900 mb-6">
                {{ __('Your contact details') }}
            </h3>

            <div>
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Full name', 'placeholder'=>'', 'name'=>'name', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Email address', 'placeholder'=>'', 'name'=>'email', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Taxvat', 'placeholder'=>'___.___.___-__', 'name'=>'taxvat', 'value'=> '' ])
            </div>

            <div class="mt-6">
                <label for="dob" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Birth Date') }}
                </label>
                <div class="mt-1 rounded-md">
                    <input name="dob" id="dob" type="date" class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />

                    @error('dob')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Phone', 'placeholder'=>'(__)_____-____', 'name'=>'phone', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Telephone', 'placeholder'=>'(__)____-____', 'name'=>'telephone', 'value'=> '' ,'require'=>false])
            </div>
        </div>

        <div class="bg-white py-8 px-4 shadow mt-8 sm:rounded-lg sm:px-10">
            <h3 class="text-xl leading-6 font-medium text-gray-900 mb-6">
                {{ __('Your address') }}
            </h3>

            <div>
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Postalcode', 'placeholder'=>'_____-___', 'name'=>'postalcode', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Address', 'placeholder'=>'', 'name'=>'address', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Number', 'placeholder'=>'', 'name'=>'number', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Neighborhood', 'placeholder'=>'', 'name'=>'neighborhood', 'value'=> '' ])
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Complement', 'placeholder'=>'', 'name'=>'complement', 'value'=> '' ,'require'=>false])
            </div>



            <div class="col-span-12 sm:col-span-3 mt-6">
                <label for="country" class="block text-sm font-medium text-gray-700">
                    {{ __('Country') }}
                </label>
                <select name="country" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option selected disabled>{{ __('Select one of the options') }}</option>
                    <option value="BR">
                        {{ __('Brazil') }}
                    </option>
                </select>
                @error('country')
                <p class="mt-2 text-sm text-red-500">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mt-6">
                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'State', 'placeholder'=>'', 'name'=>'state', 'value'=> '' ])
            </div>
          
                <div class="mt-6">
                  @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'City', 'placeholder'=>'', 'name'=>'city', 'value'=> '' ])
                </div>
 
            </div>


        </div>
                    
        <div class="bg-white py-8 px-4 mt-8 shadow sm:rounded-lg lg:mx-60 sm:px-10">
            <h3 class="text-xl leading-6 font-medium text-gray-900 mb-6">
                {{ __('Your password') }}
            </h3>

            <div class="mt-6">
                <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Password') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input id="password" type="password" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-500 @enderror" name="password" />

                    @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Confirm password') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input id="password_confirmation" type="password" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password_confirmation') border-red-500 @enderror" name="password_confirmation" />
                </div>
            </div>
        </div>

        <div class="bg-white py-8 px-4 mt-8 shadow sm:rounded-lg lg:mx-60 sm:px-10">
            <h3 class="text-xl leading-6 font-medium text-gray-900 mb-6">
                {{ __('Other information') }}
            </h3>

            <div class="mt-6">
                <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Do you want to receive news, offers and promotions by email?') }}
                </label>

                <div class="flex items-center mt-2">
                    <input value="1" name="newsletter" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                    <label class="ml-3 mr-3">
                        <span class="block text-sm font-medium text-gray-700">{{ __('Yes') }}</span>
                    </label>

                    <input value="0" name="newsletter" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                    <label class="ml-3">
                        <span class="block text-sm font-medium text-gray-700">{{ __('No') }}</span>
                    </label>
                </div>

                <div class="flex items-center mt-6">
                    <label for="status" class="mr-5">
                        <span class="block text-sm font-medium font-bold text-gray-700">{{ __('I have read and agree to the terms of Privacy and Security') }}</span>
                    </label>

                    <input name="terms" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1" />
                </div>
            </div>

            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        {{ __('Sign up') }}
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script src="{{ URL::to('/') . '/js/cep-api.js' }}"></script>
<script>
    $(document).ready(function() {
        $('#postalcode').mask('00000-000');
       
        $('#phone').mask('(00) 00000-0000');
        $('#telephone').mask('(00) 0000-0000');

        $("#costumerForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255
                },
                taxvat: {
                    required: true,
                    
                },
                phone: {
                    required: true,
                    minlength: 10
                },
                postalcode: {
                    required: true,
                    minlength:8
                },
                address: {
                    required: true,
                    minlength: 10
                },
                neighborhood: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },

                terms: {
                    required: true
                },
            }
        });
  });
</script>
@endpush
