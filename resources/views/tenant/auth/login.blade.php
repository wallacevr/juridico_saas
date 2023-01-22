@extends('layouts.guest')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <img src="{{asset('img/LOGO.png')}}" alt="" class="w-25">
            </div>
            <div class="card">
                    <div class="card-header">
                            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                                {{ __('Login') }}
                            </h2>
                            @if (Route::has('tenant.register'))
                            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                                Or
                                <a href="{{ route('tenant.register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                    register a new account.
                                </a>
                            </p>
                            @endif
                    </div>

                <div class="card-body">
                <form method="POST" action="{{ route('tenant.login') }}">
                            @csrf
                            <div class="row justify-content-center my-4">
                                <div class="col-12">
                                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                            {{ __('Email address') }}:
                                        </label>
                                        <div class="mt-1 rounded-md">
                                                <input name="email" id="email" type="email" required class="shadow-sm appearance-none block w-50 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" name="email" value="{{ old('email', request()->query('email')) }}" autofocus />
                                                
                                                @error('email')
                                                <p class="text-red-500 text-xs italic mt-4">
                                                    {{ $message }}
                                                </p>
                                                @enderror
                                        </div>
                                 </div>
                                <div class="col-12">
                                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                                            {{ __('Password') }}:
                                        </label>
                                        <div class="mt-1 rounded-md">
                                            <input id="password" type="password" required class="shadow-sm appearance-none block w-50 px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-500 @enderror" name="password" />
                                            
                                            @error('password')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
          
                            </div>
                            
                            <div class="mt-6 flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember_me" name="remember" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                                
                                @if (Route::has('tenant.password.request'))
                                <div class="text-sm leading-5">
                                    <a href="{{ route('tenant.password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            <div class="mt-6">
                                <span class="block w-full rounded-md shadow-sm">
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary">
                                        {{ __('Login') }}
                                    </button>
                                </span>
                            </div>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>






@endsection
