<!-- Header para empresas logadas -->
<header class="main-header header-shaddow">
  <div class="container-fluid">
    <div class="main-box">
      <div class="nav-outer">
        <div class="logo-box">
          <div class="logo"><a href="{{ route('company.dashboard') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
        </div>
        <nav class="nav main-menu">
          <ul class="navigation" id="navbar">
            <li><a href="{{ route('jobs.index') }}">Encontre Vagas</a></li>
            <li><a href="{{ route('professionals.index') }}">Encontrar Profissionais</a></li>
          </ul>
        </nav>
      </div>
      <div class="outer-box">
        <button class="menu-btn"><span class="count">1</span><span class="icon la la-heart-o"></span></button>
        <button class="menu-btn"><span class="icon la la-bell"></span></button>
        <div class="dropdown dashboard-option">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown">
            @if(Auth::user()->companyProfile && Auth::user()->companyProfile->logo)
              <img src="{{ Auth::user()->companyProfile->logo_url }}" alt="{{ Auth::user()->companyProfile->company_name }}" class="thumb">
            @else
              <img src="{{ asset('images/resource/default-company.png') }}" alt="Logo" class="thumb">
            @endif
            <span class="name">{{ Auth::user()->companyProfile ? Auth::user()->companyProfile->company_name : Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            @include('layouts.partials.menu-company')
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Mobile Header -->
  <div class="mobile-header">
    <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="flaticon-menu-1"></span></a>
    <div class="logo"><a href="{{ route('company.dashboard') }}"><img src="{{ asset('images/logo-empresa.svg') }}" alt="Logo VagaPet"></a></div>
    <div class="outer-box">
      <button id="toggle-user-sidebar">
        @if(Auth::user()->companyProfile && Auth::user()->companyProfile->logo)
          <img src="{{ Auth::user()->companyProfile->logo_url }}" alt="{{ Auth::user()->companyProfile->company_name }}" class="thumb">
        @else
          <img src="{{ asset('images/resource/default-company.png') }}" alt="Logo" class="thumb">
        @endif
        <i class="la la-angle-down"></i></button>
    </div>
  </div>
  <div id="nav-mobile"></div>
</header>
