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
        @include('layouts.partials.dashboard-switcher-button', [
          'buttonClass' => 'btn btn-sm btn-primary menu-btn text-white mr-2',
          'dropdownMenuClass' => 'dropdown-menu dropdown-menu-right',
          'dropdownLabel' => 'Painéis',
          'containerClass' => 'mr-2'
        ])
        <a href="{{ route('company.favorite-professionals') }}" class="menu-btn" title="Profissionais Favoritos">
          <span class="icon la la-heart-o"></span>
        </a>

        <!-- Notificações -->
        @php
          $newApplicationsCount = Auth::user()->companyProfile
            ? App\Models\JobApplication::whereHas('job', function($q) {
                $q->where('company_profile_id', Auth::user()->companyProfile->id);
              })->where('status', 'pending')->whereNull('viewed_at')->count()
            : 0;
        @endphp
        <div class="dropdown">
          <button class="menu-btn" data-toggle="dropdown" id="notifications-bell" onclick="markNotificationsAsViewed()">
            @if($newApplicationsCount > 0)
              <span class="count" id="notifications-count">{{ $newApplicationsCount }}</span>
            @endif
            <span class="icon la la-bell"></span>
          </button>
          <ul class="dropdown-menu pull-right notifications-dropdown">
            @if($newApplicationsCount > 0)
              <li class="dropdown-header">{{ $newApplicationsCount }} {{ \Illuminate\Support\Str::plural('nova candidatura', $newApplicationsCount) }}</li>
              <li class="divider"></li>
              <li>
                <a href="{{ route('company.candidates') }}?status=pending" style="display: block; padding: 10px 20px; color: #1967d2;">
                  <i class="la la-user-check"></i> Ver todas as candidaturas
                </a>
              </li>
            @else
              <li style="padding: 15px 20px; text-align: center; color: #888;">
                Nenhuma notificação nova
              </li>
            @endif
          </ul>
        </div>

        <script>
        function markNotificationsAsViewed() {
          const countBadge = document.getElementById('notifications-count');
          if (countBadge) {
            fetch('{{ route("company.mark-notifications-viewed") }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                countBadge.style.display = 'none';
              }
            })
            .catch(error => console.error('Erro:', error));
          }
        }
        </script>

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
