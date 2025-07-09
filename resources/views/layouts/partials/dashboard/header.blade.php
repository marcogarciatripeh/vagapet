<header class="main-header header-shaddow">
    <div class="container-fluid">
        <div class="main-box">
            <div class="nav-outer">
                <div class="logo-box">
                    <div class="logo"><a href="{{ route('professional.dashboard') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
                </div>
                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">
                        <li><a href="">Encontrar Vagas</a></li>
                        <li><a href="">Encontrar Empresas</a></li>
                        <li><a href="">(teste) Mudar para empresa</a></li>
                    </ul>
                </nav>
            </div>
            <div class="outer-box">
                <button class="menu-btn">
                    <span class="count">1</span>
                    <span class="icon la la-heart-o"></span>
                </button>
                <button class="menu-btn">
                    <span class="icon la la-bell"></span>
                </button>
                <div class="dropdown dashboard-option">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar_url ?? asset('images/resource/company-6.png') }}" alt="avatar" class="thumb">
                        <span class="name">{{ auth()->user()?->name ?? 'João' }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @include('layouts.partials.dashboard.menu-professional')
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
            <div class="logo">
                <a href="{{ route('professional.dashboard') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a>
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
