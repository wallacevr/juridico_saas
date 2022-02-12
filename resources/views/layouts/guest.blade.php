<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <script src="{{ mix('js/tenant.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/tenant.css') }}" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @stack('head')
</head>
<body class="bg-gray-100 h-screen antialiased">
    <div id="app">
        <nav class="">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                  
    
                </div>
            </div>
        </div>
    </div>
</nav>

@if(isset($title))
<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-gray-900">
            {{ $title }}
        </h1>
    </div>
</header>
@endif

<main>
@yield('content')
</main>
</div>

@stack('body')
</body>
</html>
