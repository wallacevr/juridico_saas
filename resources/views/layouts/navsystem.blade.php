<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('img/logo_branco.png')}}" class="logo-icon" alt="logo icon">
        </div>
      
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Inicial</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-calendar-check'></i>
                </div>
                <div class="menu-title">Agenda</div>
            </a>
        </li>
        <li
        >
            <a href="{{route('tenant.clientes.index')}}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Clientes</div>
            </a>
        </li>
        <li
        >
            <a href="{{route('tenant.envolvidos.index')}}">
                <div class="parent-icon"><i class='bx bx-group'></i>
                </div>
                <div class="menu-title">Envolvidos</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-chat'></i>
                </div>
                <div class="menu-title">Atendimentos</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-folder-open'></i>
                </div>
                <div class="menu-title">Processos e Casos</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-dollar-circle'></i>
                </div>
                <div class="menu-title">Financeiro</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Documentos</div>
            </a>
        </li>
        <li class="menu-label">Relatórios</li>


        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-bar-chart-alt-2'></i>
                </div>
                <div class="menu-title">Relatórios</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-pie-chart-alt-2'></i>
                </div>
                <div class="menu-title">Gráficos</div>
            </a>
        </li>

        <li class="menu-label">Financeiro</li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><img src="{{asset('img/custo.png')}}" alt="">
                </div>
                <div class="menu-title">Centro de Custos</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-sitemap'></i>
                </div>
                <div class="menu-title">Classificações</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-trending-up'></i>
                </div>
                <div class="menu-title">Contas a receber</div>
            </a>
        </li>
        <li
        >
            <a href="#">
                <div class="parent-icon"><i class='bx bx-trending-down'></i>
                </div>
                <div class="menu-title">Contas a pagar</div>
            </a>
        </li>
        @if(Auth::user()->nivel_id==2)
                    <li class="menu-label">Configurações</li>
                    <li
                    >
                        <a href="#">
                            <div class="parent-icon"><i class='bx bx-user'></i>
                            </div>
                            <div class="menu-title">Usuários</div>
                        </a>
                    </li>
                    <li
                    >
                        <a href="#">
                            <div class="parent-icon"><i class='bx bx-group'></i>
                            </div>
                            <div class="menu-title">Grupos</div>
                        </a>
                    </li>
            @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
