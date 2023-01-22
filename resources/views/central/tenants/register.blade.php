@extends('layouts.central')

@section('content')
<div class="my-5 py-5">
        <div class="my-1 py-1">
            <h2 class="mt-5 text-3xl font-extrabold text-center text-gray-900 leading-9">
                Cresça sua empresa com investimento zero!
            </h2>
            <p class="text-center">Crie sua conta agora  e experimente grátis nosso sistema com todas funcionalidades que você precisa.</p>


        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form action="{{ route('central.tenants.register.submit') }}" method="POST" id="register-form">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-lg-2 py-1">
                            <div class="mt-1 w-75 rounded-md">
                                @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Taxvat','class'=>'cpfcnpj', 'placeholder'=>'___.___.___-__', 'name'=>'taxvat', 'value'=> '' ])
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 py-1">
                            <label for="company" class="block text-sm font-medium text-gray-700 leading-5">
                                {{__('Company name')}}
                            </label>

                            <div class="mt-1 rounded-md">
                                <input autocomplete="off" value="{{ old('company', '') }}" name="company" id="company" placeholder="{{__('Company name')}}"
                                    type="text" required autofocus
                                    class="appearance-none block w-100 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('company') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                            </div>

                            @error('company')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-4 py-1">
                                <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                                    {{__('Full name')}}
                                </label>

                                <div class="mt-1 rounded-md">
                                    <input autocomplete="off" value="{{ old('name', '') }}" name="name" id="name"
                                        type="text" required autofocus placeholder=" {{__('Full name')}}"
                                        class="appearance-none block w-100 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                </div>

                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="col-12 col-lg-2 py-1">
                            @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Phone', 'placeholder'=>'(__)_____-____', 'name'=>'phone', 'value'=> '' ])
                        </div>

                        <div class="col-12 col-lg-2 py-1">
                                <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                                    {{ __('Email') }}
                                </label>

                                <div class="mt-1 rounded-md">
                                    <input placeholder="{{ __('Write the email you use the most') }}" autocomplete="off"
                                        value="{{ old('email', session()->get('step')->email) }}" name="email" id="email"
                                        type="email" required
                                        class="appearance-none block w-75 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                </div>

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="col-12 col-lg-4 py-1">
                            <label for="domain" class="block text-sm font-medium text-gray-700 leading-5">
                                {{__('Domain')}}
                            </label>

                            <div class="mt-1 flex rounded-md">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" autocomplete="off" value="{{ old('domain', '') }}" name="domain" id="domain">
                                    <span class="input-group-text" id="basic-addon2">.{{ config('tenancy.central_domains')[0] }}</span>
                                </div>
                            </div>

                            <p class="mt-2 text-xs text-gray-600">{{__("You'll be able to add a custom domain after you sign up.")}}</p>

                            @error('domain')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-2 py-1">
                            <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                                {{__('Password')}}
                            </label>

                            <div class="mt-1 rounded-md">
                                <input autocomplete="off" value="{{ old('password', '') }}" name="password" id="password"
                                    type="password" required placeholder="{{__('Password')}}"
                                    class="form-control appearance-none block w-100 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-2 py-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">

                                {{__('Confirm Password')}}
                            </label>

                            <div class="mt-1 rounded-md">
                                <input autocomplete="off" value="{{ old('password_confirmation', '') }}"
                                    name="password_confirmation" id="password_confirmation" type="password" required placeholder="{{__('Confirm Password')}}"
                                    class="block w-100 px-3 py-2 placeholder-gray-400 border border-gray-300 appearance-none rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 py-4">
                            <span class="block w-full rounded-md ">
                                <button type="submit"
                                    class="mt-3 flex justify-center  px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent ">
                                    {{__('Register')}}
                                </button>
                            </span>
               
                        </div>

                    </div>
                        




                    











                </form>
            </div>
        </div>
    </div>
@endsection
