@extends('layouts.central')

@section('content')
    <div>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                Monte a sua loja virtual sem pagar nada
            </h2>
            <p>Seu e-commerce do seu jeito e com todas funcionalidades que você precisa de graça.</p>


        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form action="{{ route('central.tenants.register.submit') }}" method="POST" id="register-form">
                    @csrf
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 leading-5">
                            {{__('Company name')}}
                        </label>

                        <div class="mt-1 rounded-md">
                            <input autocomplete="off" value="{{ old('company', '') }}" name="company" id="company" placeholder="{{__('Company name')}}"
                                type="text" required autofocus
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('company') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                        </div>

                        @error('company')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mt-6">
                        <div class="mt-1 rounded-md">
                            @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Taxvat','class'=>'cpfcnpj', 'placeholder'=>'___.___.___-__', 'name'=>'taxvat', 'value'=> '' ])
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                            {{__('Full name')}}
                        </label>

                        <div class="mt-1 rounded-md">
                            <input autocomplete="off" value="{{ old('name', '') }}" name="name" id="name"
                                type="text" required autofocus placeholder=" {{__('Full name')}}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                        </div>

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="domain" class="block text-sm font-medium text-gray-700 leading-5">
                            {{__('Domain')}}
                        </label>

                        <div class="mt-1 flex rounded-md">
                            <input autocomplete="off" value="{{ old('domain', '') }}" name="domain" id="domain"
                                type="text" required autofocus
                                class="appearance-none block rounded-l-md w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('domain') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                            <span
                                class="flex items-center px-3 rounded-r-md border-t border-b border-r border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                <span>
                                    .{{ config('tenancy.central_domains')[0] }}
                                </span>
                            </span>
                        </div>

                        <p class="mt-2 text-xs text-gray-600">{{__("You'll be able to add a custom branded domain after you sign up.")}}</p>

                        @error('domain')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Email') }}
                        </label>

                        <div class="mt-1 rounded-md">
                            <input placeholder="{{ __('Write the email you use the most') }}" autocomplete="off"
                                value="{{ old('email', session()->get('step')->email) }}" name="email" id="email"
                                type="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                        </div>

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                            {{__('Password')}}
                        </label>

                        <div class="mt-1 rounded-md">
                            <input autocomplete="off" value="{{ old('password', '') }}" name="password" id="password"
                                type="password" required placeholder="{{__('Password')}}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                        </div>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">

                            {{__('Confirm Password')}}
                        </label>

                        <div class="mt-1 rounded-md">
                            <input autocomplete="off" value="{{ old('password_confirmation', '') }}"
                                name="password_confirmation" id="password_confirmation" type="password" required placeholder="{{__('Confirm Password')}}"
                                class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 appearance-none rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md">
                            <button type="submit"
                                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                {{__('Register')}}
                            </button>
                        </span>
                        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                            <a href="{{ route('central.tenants.login') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                {{ __('sign in to your account') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
