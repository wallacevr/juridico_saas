<div>

<header class="relative bg-white" wire:poll.750ms>
                <p
                    class="bg-primary title-primary h-10 flex items-center justify-center text-sm font-medium px-4 sm:px-6 lg:px-8">
                    FRETE GRÁTIS PARA TODO O BRASIL
                </p>

                <nav aria-label="Top" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="border-b border-gray-200">
                        <div class="h-17 flex items-center">
                            <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                            <button type="button" class="bg-white p-2 rounded-md text-gray-400 lg:hidden">
                                <span class="sr-only">Open menu</span>
                                <!-- Heroicon name: outline/menu -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                                <!-- Logo -->
                            @if(get_config('general/store/logo/desktop')!=null)    
                                <div class="ml-4 flex lg:ml-0">
                                    <a href="{{ url('/') }}">
                                        <span class="sr-only">Maxcommerce</span>
                                        <img class="object-contain h-12 w-96 p-0 m-0" src="{{publicImage(get_config('general/store/logo/desktop') ) }}" alt="">
                                    </a>
                                </div>
                            @endif
                            <!-- Flyout menus -->
                            <div class=" xl:ml-8 xl:self-stretch hidden lg:block">
                                @include('layouts.menu.store_menu')
                            </div>

                            <div class="ml-auto flex items-center">
                                <div class=" lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                    <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>

                                    @guest('customers')
                                        <a href="{{ route('store.customer.login') }}"
                                            class="text-sm font-medium ">Entrar</a>

                                        <a href="{{ route('store.customer.register') }}"
                                            class="text-sm font-medium ">Cadastra-se</a>
                                    @else
                                        <div class="flex items-center relative">
                                            <div class="ml-3 relative" x-data="{ showProfileTop: false }">
                                                <div>
                                                    <button @click="showProfileTop = !showProfileTop" type="button"
                                                        class="max-w-xs bg-white flex items-center text-sm rounded-full "
                                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                        <h6>{{ Auth::guard('customers')->user()->name }}</h6>
                                                    </button>
                                                </div>
                                                <div x-show="showProfileTop"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in-out duration-300 transform"
                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                    x-transition:leave-end="transform opacity-0 scale-95"
                                                    class="z-10 absolute origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="user-menu-button" tabindex="-1">
                                                    <div class="py-1" role="none">
                                                        <a href="{{ route('store.customer.dashboard') }}"
                                                            class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                                            tabindex="-1"
                                                            id="options-menu-item-2">{{ __('My account') }}</a>
                                                    </div>
                                                    <div class="py-1" role="none">
                                                        <a href="{{ route('store.logout') }}"
                                                            class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ route('store.logout') }}"
                                                            method="POST" class="hidden">
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
                                    <a href="{{route('store.product.search')}}" class="p-2 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Search</span>
                                        <!-- Heroicon name: outline/search -->
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </a>
                                </div>

                                <!-- Cart -->
                                <div class="ml-4 flow-root lg:ml-6">
                                    <a href="{{ route('store.cart') }}" class="group -m-2 p-2 flex items-center">
                                        <!-- Heroicon name: outline/shopping-bag -->
                                        <svg class="flex-shink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                 
                                       
                                        @if( count($cartproducts)>0)
                                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ count($cartproducts) }}</span>
                                       @else
                                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                                       @endif     
                                        <span class="sr-only">items in cart, view bag</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
</div>
