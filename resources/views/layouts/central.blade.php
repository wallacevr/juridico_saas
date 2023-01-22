<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <title>{{ config('app.name', 'IziSystem') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://izisystem.com.br/img/logo-whats.jpg" />
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="200" />
      
      <meta property="og:url"content="https://www.izisystem.com.br/" />
      <meta property="og:site_name"content="senhatop.com.br" />

      <meta property="og:title" content="Soluções em Gestão Empresarial" />
		<meta name="theme-color" content="#fff"/>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<meta name="revisit-after" content="7 day">
		<meta name="language" content="Portuguese">
		<meta name="generator" content="N/A">
		<meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
  		<!-- <link rel="icon" href="public/img/favicon.png" type="image/png" sizes="16x16"> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />


        <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/app1.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/appheader.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/banner.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/appfooter.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/principal.css')}}">
        <link href="{{ asset('css/quemsomos.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/planos.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/contato.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/login.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/pagamento.css') }}" rel="stylesheet">

     <link type="text/css" href="{{ asset('css/whatsapp.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/vantagens.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/comofunciona.css') }}" rel="stylesheet">
     <link type="text/css" href="{{ asset('css/responsivo.css') }}" rel="stylesheet">
    @stack('style_header')
    @stack('script_header')

@yield('head')
</head>

<!-- Global site tag (gtag.js) - Google Analytics -->


<body data-logo="{{asset('img/LOGO.png')}}">

</noscript>
<!-- End of Floodlight Tag: Please do not remove -->

<header>

            <div class="container">
            <nav class="navbar navbar-expand-xl navbar-light">
                <a href="#" id="home" class="navbar-brand">
                    <img
                        src="{{asset('img/LOGO.png')}}"
                        alt=""
                        class="img-fluid h"
                    />

                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbar-extend"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    id="navbar-extend"
                    class="collapse navbar-collapse"
                >

                    <ul class="navbar-nav ml-auto align-items-center">

                        <li class="nav-item">
                        <a href="#" class=" nav-link anchor">
                            Home
                        </a>
                        </li>
                   

                            <li class="nav-item">
                                <a href="#" class=" nav-link anchor">
                                    Contato
                                </a>
                            </li>

                    

                        <li class="nav-item" id="language-false">
                        <ul class="d-flex navbar-nav align-items-center">
                        @if(Auth::check())

                        <li class="nav-item">
                            <div class="btn-group">
                                <button type="button" class="btn btnUsuarioLogado"><i class="fas fa-user"></i> {{Auth::user()->name}}</button>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split btnUsuarioLogadoSpan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only"></span>
                                </button>
                                <div class="dropdown-menu dropdownUsuario">
                                        <a class="dropdown-item btnMeusPlanos" href="#"  style="padding: 10px 6px;">
                                            Acessar Sistema
                                        </a>
                  
                                                            
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Sair
                                        <form id="logout-form" action="#" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </li>

                        
                        @else

                            <li class="nav-item">
                                <a href="#" class="nav-link btnLogin px-3 py-1">
                                <i class="fa-solid fa-user"></i>
                                    Entrar
                                </a>
                            </li>

                        @endif
                        </ul>
                    </li>

                    </ul>
                </div>
            </nav>
            </div>
</header>


          @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   // window.cookieconsent.initialise({
   //   "palette": {
   //     "popup": {
   //       "background": "#f5f5f5",
   //       "text": "#000000"
   //     },
   //     "button": {
   //       "background": "#134179",
   //       "text": "#ffffff"
   //     }
   //   },
   //   "content": {
   //     "message": "Este site usa cookies para proporcionar uma experiência digital aprimorada. Você pode obter mais informações sobre os cookies que usamos e sobre como alterar as configurações de cookie <a href='politica-de-privacidade.html' style='color:#000;'>clicando aqui</a>. Se continuar a usar este site sem alterar as configurações, você está concordando com nosso uso de cookies.",
   //     "dismiss": "Concordar e fechar",
   //     "link": false,
   //   }
   // });


   </script>
   <footer
         class="pt-1"

         id="footer"
      >

         <div class="container" >
            <div class="row justify-content-center justify-content-lg-between align-items-center" >
               <div class="col-12 col-lg text-center text-lg-left ">
                  <img src="{{asset('img/LOGO.png')}}" alt="" class="my-4">

               </div>
             
               <div class="col-auto">
                  <p style="font-size: 13px;" class="text-left">
                     IziSystem<br>
                     Rua Bartholomeu do Canto Nº94<br>403B  CEP:02726-090 São Paulo-SP<br>
                     CNPJ: 46.136.820/0001-06</span> 
                   </p>
               </div>
   
               </div>

            </div>

         </div>

      </footer>

    @stack('style_footer')
    @stack('script_footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>







</html>


<!-- Scripts -->

<script src="{{asset('js/app.js')}}" defer></script>
<script src="{{asset('js/footer.js')}}" defer></script>
<script src="{{asset('js/header.js')}}" defer></script>
<script src="{{asset('js/functions.js')}}" defer></script>
<script src="{{asset('js/jquery-mask-custom.min.js')}}" ></script>



