<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        :root {
            --primary: {{ get_config('general/layout/primary_color') ?? 'rgb(28 58 77 / 1)' }};
            --secundary: {{ get_config('general/layout/secundary_color') ?? '#FFFFFF' }};
            --title-primary: {{ get_config('general/layout/title_primary_color') ?? '#000000' }};
            --title-secundary: {{ get_config('general/layout/title_secundary_color') ?? 'rgb(55 65 81 / 1)' }};
            --title-primary-hover: {{ get_config('general/layout/title_primary_color_hover') ?? '#000000' }};
            --title-secundary-hover: {{ get_config('general/layout/title_secundary_color_hover') ?? 'rgb(55 65 81 / 1)' }};
            --background-footer: {{ get_config('general/layout/background_footer') ?? '#000000' }};
            --text-footer: {{ get_config('general/layout/text_footer') ?? '#FFFFFF' }};
            --text-price: {{ get_config('general/layout/text_price') ?? 'rgb(28 58 77 / 1)' }};
            --text-price-with-special: {{ get_config('general/layout/text_price_with_special') ?? 'rgb(28 58 77 / 1)' }};
            --text-special-price: {{ get_config('general/layout/text_special_price') ?? 'rgb(28 58 77 / 1)' }};
            --bg-addtocart: {{ get_config('general/layout/background_add_cart') ?? 'rgb(28 58 77 / 1)' }};
            --bg-addtocart-hover: {{ get_config('general/layout/background_add_cart_hover') ?? 'rgb(55 109 144)' }};
            --text-addtocart: {{ get_config('general/layout/text_add_cart') ?? '#FFFFFF' }};
            --text-addtocart-hover:{{ get_config('general/layout/text_add_cart_hover') ?? '#FFFFFF' }};
        }
    </style>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
        },
      }
    }
  }
</script>
    @stack('head')
    @livewireStyles
</head>

<body class="bg-gray-100 h-screen antialiased w-full">

    <div id="app" class="w-full">
        <div class="bg-white w-full">
       
            @livewire('layouts.store.navbar-store')
          
        </div>
        @if (!empty($pageBanners))
            @includeWhen(isset($pageBanners), 'store.banners.full-banners', $pageBanners)
        @endif
        <main class="w-full max-w-7xl mx-auto px-3 xl:px-0">
            @include('partials.alerts')
            @yield('content')
        </main>


    </div>

    <div class="w-full bg-primary">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:py-8 lg:px-8 bg-primary">
    
            <div class="pb-8 xl:grid xl:grid-cols-2 xl:gap-2">
                <div>
                    <h3 class="text-2xl font-medium text-primary">Cadastre-se em nossa newsletter</h3>
                    <p class="mt-2 text-base text-secundary">Receba novidades e ofertas exclusivas em seu e-mail</p>
                </div>
                <div>
                    <form class="mt-4 sm:flex sm:max-w-md lg:mt-0">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input type="email" name="email-address" id="email-address" autocomplete="email" required
                            class="appearance-none min-w-0 w-full bg-white border border-transparent rounded-md py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white focus:border-white focus:placeholder-gray-400 sm:max-w-xs"
                            placeholder="Seu email">
                        <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button type="submit"
                                class="w-full bg-secundary title-secundary border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-base font-medium ">Cadastrar</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    </div>
    <footer aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="pb-8 xl:grid xl:grid-cols-4 xl:gap-8">
                <div class="grid grid-cols-2 gap-8 xl:col-span-4">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-base font-medium text-footer">A MARCA</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-footer"> Sobre Nós </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-footer"> Loja </a>
                                </li>

                                <li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-base font-medium text-footer">POLÍTICAS</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-footer"> Política de Entrega </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-footer"> Troca e Devolução </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-footer"> Privacidade e Segurança </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-base font-medium text-footer">MINHA CONTA</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-footer"> Minha Conta </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-footer"> Meus Pedidos </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-footer"> Lista de Desejos </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-base font-medium text-footer">ATENDIMENTO</h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-footer"> Seg a Sex de 9h às 17h </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-footer"> Sab de 9h às 12h </a>
                                </li>

                            </ul>
                            <h3 class="text-base mt-6 font-medium text-footer">SIGA-NOS</h3>
                            <div class="mt-2  md:flex md:items-center md:justify-between">

                                <div class="flex space-x-6 md:order-2">
                                    <a href="#" class="text-footer">
                                        <span class="sr-only">Facebook</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <a href="#" class="text-footer">
                                        <span class="sr-only">Instagram</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <a href="#" class="text-footer">
                                        <span class="sr-only">Twitter</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path
                                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg>
                                    </a>

                                    <a href="#" class="text-footer">
                                        <span class="sr-only">GitHub</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <a href="#" class="text-footer">
                                        <span class="sr-only">Dribbble</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="w-full text-center">
                <p class="text-footer">{{ get_config('general/store/registred_company_name') }}</p>
                <p class="text-footer">
                    {{ __('Central de Atendimento ') . ': ' . get_config('general/store/phone') . ' - ' . get_config('general/store/company_email') }}
                </p>
                <p class="text-footer">{{ get_config('general/store/address') }},
                    {{ get_config('general/store/number') }} {{ get_config('general/store/complement') }} -
                    {{ get_config('general/store/neighborhood') }} -
                    {{ get_config('general/store/city') }}/{{ get_config('general/store/state') }} -
                    {{ get_config('general/store/postalcode') }} - {{ get_config('general/store/taxvat') }}</p>
            </div>
        </div>
    </footer>

    @stack('body')
    @livewireScripts    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    @stack('js')
</body>

</html>
