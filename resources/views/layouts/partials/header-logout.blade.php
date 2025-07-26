<!-- Header para usuários não logados -->
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
      <div class="outer-box">
        <a href="{{ route('login') }}" class="btn btn-md btn-outline-dark menu-btn"><span>Criar conta</span></a>
        <a href="{{ route('login') }}" class="btn btn-md btn-primary menu-btn text-white"><span>Entrar</span></a>
      </div>
    </div>
  </div>

  <!-- Mobile Header -->
  <div class="mobile-header">
    <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
    <div class="logo pull-left"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
    <div class="outer-box pull-right">
      <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark menu-btn"><span>Criar conta</span></a>
      <a href="{{ route('login') }}" class="btn btn-sm btn-primary menu-btn text-white"><span>Entrar</span></a>
    </div>
  </div>
  <div id="nav-mobile"></div>
</header>
