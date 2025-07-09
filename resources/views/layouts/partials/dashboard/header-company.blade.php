<header class="main-header header-shaddow">
    <div class="container-fluid">
        <div class="main-box">
            <div class="nav-outer">
                <div class="logo-box">
                    <div class="logo"><a href="{{ route('empresa.painel') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo Empresa"></a></div>
                </div>
                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">
                        <li><a href="{{ route('empresa.gerenciar-vagas') }}">Gerenciar Vagas</a></li>
                        <li><a href="{{ route('empresa.candidatos') }}">Candidatos</a></li>
                        <li><a href="{{ route('empresa.perfil') }}">Meu Perfil</a></li>
                        <li><a href="{{ route('empresa.pagina') }}">Página Pública</a></li>
                    </ul>
                </nav>
            </div>
            <div class="outer-box">
                <button class="menu-btn">
                    <span class="icon la la-bell"></span>
                </button>
                <div class="dropdown dashboard-option">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar_url ?? asset('images/resource/company-6.png') }}" alt="avatar" class="thumb">
                        <span class="name">{{ auth()->user()?->name ?? 'Empresa' }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('empresa.perfil') }}">Perfil</a></li>
                        <li><a href="{{ route('empresa.painel') }}">Painel</a></li>
                        <li><a href="{{ route('empresa.gerenciar-vagas') }}">Vagas</a></li>
                        <li><a href="{{ route('empresa.candidatos') }}">Candidatos</a></li>
                        <li><a href="{{ route('empresa.pagina') }}">Página Pública</a></li>
                        <li><a href="{{ route('ajuda') }}">Ajuda</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="la la-sign-out"></i> Sair
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
        <div class="logo">
            <a href="{{ route('empresa.painel') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo Empresa"></a>
        </div>
        <div class="outer-box">
            <button id="toggle-user-sidebar">
                <img src="{{ auth()->user()->avatar_url ?? asset('images/resource/company-6.png') }}" alt="avatar" class="thumb">
                <i class="la la-angle-down"></i>
            </button>
        </div>
    </div>
    <div id="nav-mobile"></div>
</header>
