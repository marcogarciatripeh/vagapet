<!-- Header para usuários logados -->
<header class="main-header header-shaddow">
  <div class="container-fluid">
    <div class="main-box">
      <div class="nav-outer">
        <div class="logo-box">
          <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
        </div>

        <nav class="nav main-menu">
          <ul class="navigation" id="navbar">
            <li><a href="{{ route('jobs.index') }}">Encontre Vagas</a></li>
            <li><a href="{{ route('professionals.index') }}">Encontrar Profissionais</a></li>
          </ul>
        </nav>
      </div>

      <div class="outer-box d-flex align-items-center gap-2">
        <!-- Botão do painel do usuário -->
        @include('layouts.partials.dashboard-switcher-button', [
          'buttonClass' => 'btn btn-md btn-primary menu-btn text-white'
        ])

        <!-- Botão de logout -->
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-md btn-outline-dark menu-btn">
          <i class="la la-sign-out"></i>
          <span>Sair</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Mobile Header -->
  <div class="mobile-header">
    <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
    <div class="logo pull-left"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
    <div class="outer-box pull-right">
      @include('layouts.partials.dashboard-switcher-button', [
        'buttonClass' => 'btn btn-sm btn-primary menu-btn text-white',
        'dropdownMenuClass' => 'dropdown-menu dropdown-menu-right',
        'dropdownLabel' => 'Painéis'
      ])
    </div>
  </div>
  <div id="nav-mobile"></div>

  <!-- Formulário de logout -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</header>
