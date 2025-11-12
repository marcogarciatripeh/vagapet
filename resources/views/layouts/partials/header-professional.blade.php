<!-- Header para profissionais logados -->
<header class="main-header header-shaddow">
  <div class="container-fluid">
    <div class="main-box">
      <div class="nav-outer">
        <div class="logo-box">
          <div class="logo"><a href="{{ route('professional.dashboard') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
        </div>
        <nav class="nav main-menu">
          <ul class="navigation" id="navbar">
            <li><a href="{{ route('jobs.index') }}">Encontrar Vagas</a></li>
            <li><a href="{{ route('companies.index') }}">Encontrar Empresas</a></li>
          </ul>
        </nav>
      </div>
      <div class="outer-box">
        @include('layouts.partials.dashboard-switcher-button', [
          'buttonClass' => 'btn btn-sm btn-primary menu-btn text-white mr-2',
          'dropdownMenuClass' => 'dropdown-menu dropdown-menu-right',
          'dropdownLabel' => 'Painéis',
          'containerClass' => 'mr-2'
        ])
        <a href="{{ route('professional.favorites') }}" class="menu-btn" title="Meus Favoritos">
          <span class="icon la la-heart-o"></span>
        </a>
        <button class="menu-btn"><span class="icon la la-bell"></span></button>
        @auth
        <div class="dropdown dashboard-option">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown">
            @if(Auth::user()->professionalProfile && Auth::user()->professionalProfile->photo)
              <img src="{{ Auth::user()->professionalProfile->photo_url }}" alt="{{ Auth::user()->professionalProfile->full_name }}" class="thumb">
            @else
              <img src="{{ asset('images/resource/default-avatar.png') }}" alt="Avatar" class="thumb">
            @endif
            <span class="name">{{ Auth::user()->professionalProfile ? Auth::user()->professionalProfile->first_name : Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            @include('layouts.partials.menu-professional')
          </ul>
        </div>
        @endauth
      </div>
    </div>
  </div>
  <!-- Mobile Header -->
  @auth
  <div class="mobile-header">
    <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
    <div class="logo"><a href="{{ route('professional.dashboard') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
    <div class="outer-box">
      <button id="toggle-user-sidebar">
        @if(Auth::user()->professionalProfile && Auth::user()->professionalProfile->photo)
          <img src="{{ Auth::user()->professionalProfile->photo_url }}" alt="{{ Auth::user()->professionalProfile->full_name }}" class="thumb">
        @else
          <img src="{{ asset('images/resource/default-avatar.png') }}" alt="Avatar" class="thumb">
        @endif
        <i class="la la-angle-down"></i></button>
    </div>
  </div>
  @endauth
  <div id="nav-mobile"></div>
</header>
