<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
    <link rel="icon" type="image/png" href="{{ asset('img/Mandala Azul-Laranja.png') }}"/>
	<!--plugins-->

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

	@yield("style")
	
	<link href="{{ asset('plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/icons.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	

	<title>{{ config('app.name', 'IziSystem') }}</title>
	@livewireStyles
</head>

<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">



	    <!--sidebar wrapper -->
<div class="sidebar-wrapper d-none d-sm-block" data-simplebar="true">
    <div class="sidebar-header ">
        <div>
            <img src="{{ asset('img/LOGO.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text"></h4>
        </div>
        {{-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div> --}}
    </div>
    <!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">

				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu d-sm-none d-none d-sm-block"><i class='bx bx-menu'></i>
					</div>
					<div class="top-menu ms-auto">


					</div>
					<div class="mudar-tema">
                            <span class="material-icons-sharp rounded-circle" data-toggle="tooltip" data-placement="bottom" title="Modo Claro">light_mode</span>
                            <span class="material-icons-sharp rounded-circle" data-toggle="tooltip" data-placement="bottom" title="Modo Escuro">nightlight_round</span>
                        </div>
					<div class="user-box dropdown ">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							{{--<img src="{{ asset('img/Mandala Azul-Laranja.png') }}" class="user-img" alt="user avatar"> --}}
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{Auth::user()->name}}</p>
								<p class="designattion mb-0">Administrador</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end ">
							<li  class=" user-dropdown-menu"><a class="dropdown-item" href="javascript:;"><i class="bx bx-user genomatextcolor"></i><span class="genomatextcolor">Perfil</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li  class=" user-dropdown-menu">
									<a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									Sair
									<form id="logout-form" action="#" method="POST" class="d-none">
										@csrf
									</form>
								</a>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown d-xl-none">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							
							<div class="user-info ps-3">
								<p class="user-name mb-0"><i class='bx bx-menu'></i></p>
							
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end ">
							<li  class=" user-dropdown-menu"><a class="dropdown-item" href="#"><i class="bx bx-home-circle genomatextcolor"></i><span class="genomatextcolor">Dashboard</span></a>
							</li>
					
							<li  class=" user-dropdown-menu"><a class="dropdown-item" href="#"><i class="bx bx-box genomatextcolor"></i><span class="genomatextcolor">Planos</span></a>
							</li>
						

							<li  class=" user-dropdown-menu"><a class="dropdown-item" href="#"><i class="bx bx-user genomatextcolor"></i><span class="genomatextcolor">Clientes</span></a>
							</li>
					
							<li  class=" user-dropdown-menu"><a class="mx-2" href="#"><img src="{{asset('img/icons/parceiro.png')}}" class="mx-2" alt="" style="width:20px"><span class="genomatextcolor">Influencers</span></a>
							</li>
							<li  class=" user-dropdown-menu"><a class="mx-3" href="#"><img src="{{asset('img/icons/cupom.png')}}" alt="" style="width:20px"><span class="genomatextcolor">Cupons</span></a>
							</li>
							<li  class=" user-dropdown-menu"><a href="#" class="mx-3"><i class="bx bx-wallet genomatextcolor"></i><span class="genomatextcolor">Assinaturas</span></a>
							</li>
						
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><img src="{{asset('img/icons/parceiro.png')}}" alt="" style="width:30px">
                </div>
                <div class="menu-title">Parceiros</div>
            </a>
        </li>

        <li >
            <a href="2">
                <div class="parent-icon"><i class='bx bx-box'></i>
                </div>
                <div class="menu-title">Planos</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Clientes</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-buildings'></i>
                </div>
                <div class="menu-title">Empresariais</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bxs-group'></i>
                </div>
                <div class="menu-title">Grupo de Parceiros</div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="parent-icon"><img src="{{asset('img/icons/vendedor.png')}}" alt="" style="width:30px">
                </div>
                <div class="menu-title">Vendedores</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><img src="{{asset('img/icons/cupom.png')}}" alt="" style="width:30px">
                </div>
                <div class="menu-title">Cupons</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-wallet'></i>
                </div>
                <div class="menu-title">Assinaturas</div>
            </a>
        </li>
        {{--
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-bar-chart-alt-2'></i>
                </div>
                <div class="menu-title">Relatórios</div>
            </a>
        </li>

        --}}


        <li class="menu-label">Configurações</li>
        <li>
            <a href="# ">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Usuários</div>
            </a>
        </li>

        {{--
        <li>

            <a href="#">
                <div class="parent-icon"><i class='bx bx-group'></i>
                </div>
                <div class="menu-title">Grupos</div>
            </a>

        </li>
        --}}
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->

	


	<div class="page-wrapper">
		<div class="page-content">

			@yield("wrapper")

        </div>
    </div>


		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/jquery-mask-custom.min.js')}}" ></script>
	@yield("script")
	@livewireScripts
	
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @push('js')

<script>
    $(document).ready(function() {
        $('#cep').mask('00000-000');
        $("#cpfcnpj").keydown(function(){
          try {
              $("#cpfcnpj").unmask();
          } catch (e) {}

          var tamanho = $("#cpfcnpj").val().length;

          if(tamanho < 11){
              $("#cpfcnpj").mask("999.999.999-99");
          } else {
              $("#cpfcnpj").mask("99.999.999/9999-99");
          }

          // ajustando foco
          var elem = this;
          setTimeout(function(){
              // mudo a posição do seletor
              elem.selectionStart = elem.selectionEnd = 10000;
          }, 0);
          // reaplico o valor para mudar o foco
          var currentValue = $(this).val();
          $(this).val('');
          $(this).val(currentValue);
      });
        $('#celular').mask('(00) 00000-0000');
        $('#telefone').mask('(00) 0000-0000');

        
  });
</script>



</body>

</html>
