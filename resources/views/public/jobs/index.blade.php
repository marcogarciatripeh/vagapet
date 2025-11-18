@extends('layouts.app')

@section('title', 'Buscar Vagas - VagaPet')

@section('content')
<div class="page-wrapper">
  <div class="preloader"></div>

  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-dynamic')
  <!-- Listing Section -->

  <!-- includes/sidebar.html -->
  <div class="sidebar-backdrop"></div>

  <div class="user-sidebar d-lg-none">
    <div class="sidebar-inner">
      <ul class="navigation">
        @include('layouts.partials.menu-professional')
      </ul>
    </div>
  </div>

  <section class="ls-section map-layout">
    <div class="filters-backdrop"></div>
    <div class="ls-container">
      <!-- Filters Column -->
      <div class="filters-column hide-left">
        <div class="inner-column">
          <form method="GET" action="{{ route('jobs.index') }}" id="job-filters">
            <div class="filters-outer">
              <button type="button" class="theme-btn close-filters">X</button>

              <div class="filter-block">
                <h4>Buscar por palavras-chave</h4>
                <div class="form-group">
                  <input type="text" name="search" value="{{ request('search') }}" placeholder="Digite a busca">
                  <span class="icon flaticon-search-3"></span>
                </div>
              </div>

              <div class="filter-block">
                <h4>Localização</h4>
                <div class="form-group">
                  <input type="text" name="city" value="{{ request('city') }}" placeholder="Cidade">
                  <span class="icon flaticon-map-locator"></span>
                </div>
                <div class="form-group mt-3">
                  <select name="state" class="chosen-select">
                    <option value="">Todos os estados</option>
                    @foreach($states as $state)
                      <option value="{{ $state }}" {{ request('state') === $state ? 'selected' : '' }}>{{ $state }}</option>
                    @endforeach
                  </select>
                  <span class="icon flaticon-worldwide"></span>
                </div>
              </div>

              <div class="filter-block">
                <h4>Área de atuação</h4>
                <div class="form-group">
                  <select name="area" class="chosen-select">
                    <option value="">Todas as áreas</option>
                    @foreach($areas as $area)
                      <option value="{{ $area }}" {{ request('area') === $area ? 'selected' : '' }}>{{ $area }}</option>
                    @endforeach
                  </select>
                  <span class="icon flaticon-briefcase"></span>
                </div>
              </div>

              <div class="filter-block">
                <h4>Tipo de contrato</h4>
                <div class="form-group">
                  <select name="contract_type" class="chosen-select">
                    <option value="">Todos os tipos</option>
                    <option value="clt" {{ request('contract_type') === 'clt' ? 'selected' : '' }}>CLT</option>
                    <option value="pj" {{ request('contract_type') === 'pj' ? 'selected' : '' }}>PJ</option>
                    <option value="freelance" {{ request('contract_type') === 'freelance' ? 'selected' : '' }}>Freelancer</option>
                    <option value="temporary" {{ request('contract_type') === 'temporary' ? 'selected' : '' }}>Temporário</option>
                    <option value="internship" {{ request('contract_type') === 'internship' ? 'selected' : '' }}>Estágio</option>
                  </select>
                  <span class="icon flaticon-briefcase"></span>
                </div>
              </div>

              <div class="filter-block">
                <button type="submit" class="theme-btn btn-style-one w-100">Aplicar Filtros</button>
                <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-two w-100 mt-2">Limpar Filtros</a>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Map Column -->
      <div class="map-column width-50">
        <div id="map" data-map-zoom="9" data-map-scroll="true"></div>
      </div>

      <!-- Content Column -->
      <div class="content-column width-50">
        <div class="ls-outer">
          <!-- Switcher -->
          <div class="ls-switcher">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-6 show-filters">
                  <button type="button" class="theme-btn toggle-filters"><i class="las la-filter"></i> Filtrar</button>
                </div>
                <div class="col-6">
                  <div class="sort-by float-end mt-3">
                    <form method="GET" action="{{ route('jobs.index') }}" id="per-page-form" style="display: inline;">
                      @foreach(request()->except('per_page', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                      @endforeach
                      <select name="per_page" class="chosen-select mt-3" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page', 12) == 10 ? 'selected' : '' }}>Mostrar 10</option>
                        <option value="12" {{ request('per_page', 12) == 12 ? 'selected' : '' }}>Mostrar 12</option>
                        <option value="20" {{ request('per_page', 12) == 20 ? 'selected' : '' }}>Mostrar 20</option>
                        <option value="30" {{ request('per_page', 12) == 30 ? 'selected' : '' }}>Mostrar 30</option>
                        <option value="40" {{ request('per_page', 12) == 40 ? 'selected' : '' }}>Mostrar 40</option>
                        <option value="50" {{ request('per_page', 12) == 50 ? 'selected' : '' }}>Mostrar 50</option>
                      </select>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Filtros aplicados -->
          @php
            $hasFilters = request()->filled('search') || request()->filled('city') || request()->filled('state') || request()->filled('area') || request()->filled('contract_type');
          @endphp
          @if($hasFilters)
            <div class="row">
              <div class="col-12 mb-3">
                <p class="mb-2"><strong>Filtros aplicados:</strong></p>
                <div class="d-flex flex-wrap gap-2">
                  @if(request('search'))
                    <span class="badge text-bg-light">
                      Busca: {{ request('search') }}
                      <a href="{{ route('jobs.index', request()->except('search')) }}" class="ms-1"><i class="la la-times"></i></a>
                    </span>
                  @endif
                  @if(request('city'))
                    <span class="badge text-bg-light">
                      Cidade: {{ request('city') }}
                      <a href="{{ route('jobs.index', request()->except('city')) }}" class="ms-1"><i class="la la-times"></i></a>
                    </span>
                  @endif
                  @if(request('state'))
                    <span class="badge text-bg-light">
                      Estado: {{ request('state') }}
                      <a href="{{ route('jobs.index', request()->except('state')) }}" class="ms-1"><i class="la la-times"></i></a>
                    </span>
                  @endif
                  @if(request('area'))
                    <span class="badge text-bg-light">
                      Área: {{ request('area') }}
                      <a href="{{ route('jobs.index', request()->except('area')) }}" class="ms-1"><i class="la la-times"></i></a>
                    </span>
                  @endif
                  @if(request('contract_type'))
                    <span class="badge text-bg-light">
                      Contrato: {{ ucfirst(request('contract_type')) }}
                      <a href="{{ route('jobs.index', request()->except('contract_type')) }}" class="ms-1"><i class="la la-times"></i></a>
                    </span>
                  @endif
                  <a href="{{ route('jobs.index') }}" class="badge text-bg-danger text-white">
                    Remover todos <i class="la la-times"></i>
                  </a>
                </div>
              </div>
            </div>
          @endif

          <!-- Job Blocks -->
          <div class="row">
            @include('layouts.partials.jobs-list')
          </div>

          <!-- Pagination -->
          @if($jobs->hasPages())
            <div class="ls-show-more">
              <p>Mostrando {{ $jobs->firstItem() ?? 0 }} a {{ $jobs->lastItem() ?? 0 }} de {{ $jobs->total() }} Vagas</p>
              <div class="bar">
                <span class="bar-inner" style="width:{{ ($jobs->currentPage() / $jobs->lastPage()) * 100 }}%"></span>
              </div>
              <div class="mt-3">
                {{ $jobs->links() }}
              </div>
            </div>
          @else
            <div class="ls-show-more">
              <p>Mostrando {{ $jobs->count() }} de {{ $jobs->total() }} Vagas</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  @include('layouts.partials.footer')
</div>
@endsection

@push('scripts')
  @include('layouts.partials.scripts')
  @include('layouts.partials.favorite-scripts')
  @php
  // Preparar dados do mapa no formato esperado pelo maps.js
  $mapLocations = $mapJobs->map(function($job) {
      $photoUrl = $job['photo'];
      $url = $job['url'];
      $title = htmlspecialchars($job['title'], ENT_QUOTES, 'UTF-8');
      $type = htmlspecialchars($job['type'], ENT_QUOTES, 'UTF-8');
      $address = htmlspecialchars($job['address'], ENT_QUOTES, 'UTF-8');
      
      $html = '<div class="map-listing-item">' .
          '<div class="inner-box">' .
          '<div class="infoBox-close"><i class="fa fa-times"></i></div>' .
          '<div class="image-box">' .
          '<figure class="image"><img src="' . $photoUrl . '" alt=""></figure>' .
          '</div>' .
          '<div class="content">' .
          '<h3><a href="' . $url . '">' . $title . '</a></h3>' .
          '<ul class="job-info">' .
          '<li><span class="icon flaticon-briefcase"></span> ' . $type . '</li>' .
          '<li><span class="icon flaticon-map-locator"></span> ' . $address . '</li>' .
          '</ul>' .
          '</div>' .
          '</div>';
      
      $icon = '<div style="background-image: url(' . $photoUrl . ');"></div>';
      
      return [
          $html,
          $job['latitude'],
          $job['longitude'],
          $job['id'],
          $icon
      ];
  })->values()->all();
  @endphp
  <script>
  // Preparar dados do mapa antes do maps.js carregar
  window.mapLocations = @json($mapLocations);
  </script>
  <script src="{{ asset('js/maps.js') }}"></script>
@endpush
