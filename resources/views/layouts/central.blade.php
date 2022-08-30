<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/central.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/central.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased font-sans">
    <nav class="bg-gray-50 py-2">
        <div class="container mx-auto flex justify-between">
            <div>
                 <a href="{{url('/')}}">
                  <span class="sr-only">Maxcommerce</span>
                  <img class="h-8 w-auto" src="/images/logo_max_commerce.png" alt="">
                </a>
            </div>
            <div class="flex">
                <a href="{{ route('central.tenants.login') }}" class="block py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                    Login
                </a>
            </div>
        </div>
    </nav>
    <div class="min-h-screen bg-gray-100">
        <div class="py-10">
            <main class="container mx-auto">
                <div class="max-w-7xl sm:px-6 lg:px-8">
                    @include('partials.alerts')
                    @yield('content')
                </div>
            </main>
        </div>
  </div>
</body>
</html>
