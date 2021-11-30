<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ get_config('general/store/name') }}</title>

  <!-- Scripts -->
  <script src="{{ mix('js/store.js') }}"></script>

  <!-- Styles -->
  <link href="{{ mix('css/store.css') }}" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  @stack('head')
</head>

<body class="bg-gray-100 h-screen antialiased">
  <div id="app">
    <div class="bg-white">
      <div class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>
        <div class="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto">
          <div class="px-4 pt-5 pb-2 flex">
            <button type="button" class="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400">
              <span class="sr-only">Close menu</span>
              <!-- Heroicon name: outline/x -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Links -->
          <div class="mt-2">
            <div class="border-b border-gray-200">
              <div class="-mb-px flex px-4 space-x-8" aria-orientation="horizontal" role="tablist">
                <!-- Selected: "text-indigo-600 border-indigo-600", Not Selected: "text-gray-900 border-transparent" -->
                <button id="tabs-1-tab-1" class="text-gray-900 border-transparent flex-1 whitespace-nowrap py-4 px-1 border-b-2 text-base font-medium" aria-controls="tabs-1-panel-1" role="tab" type="button">
                  Women
                </button>

                <!-- Selected: "text-indigo-600 border-indigo-600", Not Selected: "text-gray-900 border-transparent" -->
                <button id="tabs-1-tab-2" class="text-gray-900 border-transparent flex-1 whitespace-nowrap py-4 px-1 border-b-2 text-base font-medium" aria-controls="tabs-1-panel-2" role="tab" type="button">
                  Men
                </button>
              </div>
            </div>

          </div>

          <div class="border-t border-gray-200 py-6 px-4 space-y-6">
            <div class="flow-root">
              <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Company</a>
            </div>

            <div class="flow-root">
              <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Stores</a>
            </div>
          </div>

          <div class="border-t border-gray-200 py-6 px-4 space-y-6">
            <div class="flow-root">
              <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Sign in</a>
            </div>
            <div class="flow-root">
              <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Create account</a>
            </div>
          </div>

          <div class="border-t border-gray-200 py-6 px-4">
            <a href="#" class="-m-2 p-2 flex items-center">
              <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt="" class="w-5 h-auto block flex-shrink-0">
              <span class="ml-3 block text-base font-medium text-gray-900">
                CAD
              </span>
              <span class="sr-only">, change currency</span>
            </a>
          </div>
        </div>
      </div>

      <header class="relative bg-white">
        <p class="bg-indigo-600 h-10 flex items-center justify-center text-sm font-medium text-white px-4 sm:px-6 lg:px-8">
          Get free delivery on orders over $100
        </p>

        <nav aria-label="Top" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="border-b border-gray-200">
            <div class="h-16 flex items-center">
              <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
              <button type="button" class="bg-white p-2 rounded-md text-gray-400 lg:hidden">
                <span class="sr-only">Open menu</span>
                <!-- Heroicon name: outline/menu -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>

              <!-- Logo -->
              <div class="ml-4 flex lg:ml-0">
                <a href="#">
                  <span class="sr-only">Workflow</span>
                  <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                </a>
              </div>

              <!-- Flyout menus -->
              <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                <div class="h-full flex space-x-8">
                  <div class="flex">
                    <div class="relative flex">
                      <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                      <button type="button" class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px" aria-expanded="false">
                        Women
                      </button>
                    </div>
                    <div class="absolute top-full inset-x-0 text-sm text-gray-500">
                      <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                      <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

                      <div class="relative bg-white" style="display: none;">
                        <div class="max-w-7xl mx-auto px-8">
                          <div class="grid grid-cols-2 gap-y-10 gap-x-8 py-16">
                            <div class="col-start-2 grid grid-cols-2 gap-x-8">
                              <div class="group relative text-base sm:text-sm">
                                <div class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden group-hover:opacity-75">
                                  <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-center object-cover">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                  <span class="absolute z-10 inset-0" aria-hidden="true"></span>
                                  New Arrivals
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                              </div>

                              <div class="group relative text-base sm:text-sm">
                                <div class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden group-hover:opacity-75">
                                  <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg" alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees." class="object-center object-cover">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                  <span class="absolute z-10 inset-0" aria-hidden="true"></span>
                                  Basic Tees
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                              </div>
                            </div>
                            <div class="row-start-1 grid grid-cols-3 gap-y-10 gap-x-8 text-sm" style="display: none;">
                              <div>
                                <p id="Clothing-heading" class="font-medium text-gray-900">
                                  Clothing
                                </p>
                                <ul role="list" aria-labelledby="Clothing-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Tops
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Dresses
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Pants
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Denim
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Sweaters
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      T-Shirts
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Jackets
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Activewear
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Browse All
                                    </a>
                                  </li>
                                </ul>
                              </div>

                              <div>
                                <p id="Accessories-heading" class="font-medium text-gray-900">
                                  Accessories
                                </p>
                                <ul role="list" aria-labelledby="Accessories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Watches
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Wallets
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Bags
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Sunglasses
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Hats
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Belts
                                    </a>
                                  </li>
                                </ul>
                              </div>

                              <div>
                                <p id="Brands-heading" class="font-medium text-gray-900">
                                  Brands
                                </p>
                                <ul role="list" aria-labelledby="Brands-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Full Nelson
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      My Way
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Re-Arranged
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Counterfeit
                                    </a>
                                  </li>

                                  <li class="flex">
                                    <a href="#" class="hover:text-gray-800">
                                      Significant Other
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="flex">
                    <div class="relative flex">
                      <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                      <button type="button" class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px" aria-expanded="false">
                        Men
                      </button>
                    </div>
                  </div>

                  <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Company</a>

                  <a href="#" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Stores</a>
                </div>
              </div>

              <div class="ml-auto flex items-center">
                <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                  <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>

                  @guest('customers')
                  <a href="{{ route('store.customer.login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Login</a>

                  <a href="{{ route('store.customer.register') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Register</a>

                  @else
                  <div class="flex items-center">
                    <div class="ml-3 relative" x-data="{ showProfileTop: false }">
                      <div>
                        <button @click="showProfileTop = !showProfileTop" type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                          <h6>{{ Auth::guard('customers')->user()->name }}</h6>
                        </button>
                      </div>
                      <div x-show="showProfileTop" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                          <a href="{{ route('store.customer.dashboard') }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="options-menu-item-2">{{ __('My account') }}</a>
                        </div>
                        <div class="py-1" role="none">
                          <a href="{{ route('store.logout') }}" class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('store.logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endguest
                </div>
                <!-- Search -->
                <div class="flex lg:ml-6">
                  <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Search</span>
                    <!-- Heroicon name: outline/search -->
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                  </a>
                </div>

                <!-- Cart -->
                <div class="ml-4 flow-root lg:ml-6">
                  <a href="#" class="group -m-2 p-2 flex items-center">
                    <!-- Heroicon name: outline/shopping-bag -->
                    <svg class="flex-shink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                    <span class="sr-only">items in cart, view bag</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </header>
    </div>

    <main>
      @yield('content')
    </main>
  </div>

  @stack('body')
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  @stack('js')
</body>

</html>
