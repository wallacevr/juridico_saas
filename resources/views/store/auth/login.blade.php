@extends('layouts.login')

@section('content')

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Login') }}
    </h2>
    @if (Route::has('store.customer.register'))
    <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
        {{__('Or')}}
        <a href="{{ route('store.customer.register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
            {{__('register a new account')}}.
        </a>
    </p>
    @endif
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        @if(session()->has('message'))
        <div  x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

            <span class="block sm:inline">{{ __(session()->get('message')) }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3"  @click="show = false">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
        @endif
        <form method="POST" action="{{ route('store.customer.login') }}">
       @CSRF
            <div>
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Email address') }}:
                </label>
                <div class="mt-1 rounded-md">
                    <input name="email" id="email" type="email" required class="shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" name="email" value="{{ old('email', request()->query('email')) }}" autofocus />

                    @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ __($message) }}
                    </p>
                    @enderror
                </div>
            </div>

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

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="form-checkbox h-4 w-4 border text-indigo-600 transition duration-150 ease-in-out" />
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                        {{ __('Remember me') }}
                    </label>
                </div>

                @if (Route::has('store.customer.password.request'))
                <div class="text-sm leading-5">
                    <a href="{{ route('store.customer.password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            </div>
            @endif

            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        {{ __('Login') }}
                    </button>
                </span>
            </div>
        </form>

    </div>
</div>
@endsection