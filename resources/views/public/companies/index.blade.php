@extends('layouts.app')

@section('title', 'Buscar Empresas - VagaPet')

@section('content')
<div class="page-wrapper">
  <div class="preloader"></div>
  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-professional')
  <!-- Listing Section -->

  <section class="ls-section map-layout">
    <div class="filters-backdrop"></div>
    <div class="ls-container">
      <!-- Filters Column -->
      <div class="filters-column hide-left">
        <div class="inner-column">
          <form method="GET" action="{{ route('companies.index') }}" id="company-filters">
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
                  <select name="city" class="chosen-select">
                    <option value="">Todas as cidades</option>
                    @foreach($cities as $city)
                      <option value="{{ $city }}" {{ request('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                  </select>
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
                <h4>Serviços oferecidos</h4>
                <div class="form-group">
                  <select name="services" class="chosen-select">
                    <option value="">Todos os serviços</option>
                    @foreach($servicesList as $service)
                      <option value="{{ $service }}" {{ request('services') === $service ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                  </select>
                  <span class="icon flaticon-briefcase"></span>
                </div>
              </div>

              <div class="filter-block">
                <h4>Porte da empresa</h4>
                <div class="form-group">
                  <select name="company_size" class="chosen-select">
                    <option value="">Todos os portes</option>
                    <option value="micro" {{ request('company_size') === 'micro' ? 'selected' : '' }}>Microempresa</option>
                    <option value="small" {{ request('company_size') === 'small' ? 'selected' : '' }}>Pequena</option>
                    <option value="medium" {{ request('company_size') === 'medium' ? 'selected' : '' }}>Média</option>
                    <option value="large" {{ request('company_size') === 'large' ? 'selected' : '' }}>Grande</option>
                  </select>
                  <span class="icon flaticon-team"></span>
                </div>
              </div>

              <div class="form-group mt-4">
                <button type="submit" class="theme-btn btn-style-two w-100"><i class="las la-search"></i> Aplicar filtros</button>
              </div>

              @if(request()->all())
                <div class="form-group mt-2">
                  <a href="{{ route('companies.index') }}" class="theme-btn btn-style-three w-100 text-center"><i class="las la-undo"></i> Limpar filtros</a>
                </div>
              @endif
            </div>
          </form>
        </div>
      </div>

      <!-- Map Column -->
      <div class="map-column width-50">
        <div class="map-outer">
          <div id="map" data-map-zoom="9" data-map-scroll="true"></div>
        </div>
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
                    <select class="chosen-select mt-3">
                      <option>Mostrar 10</option>
                      <option>Mostrar 20</option>
                      <option>Mostrar 30</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @php
            $filterLabels = collect([
              'search' => request('search') ? 'Busca: "' . request('search') . '"' : null,
              'city' => request('city') ? 'Cidade: ' . request('city') : null,
              'state' => request('state') ? 'Estado: ' . request('state') : null,
              'services' => request('services') ? 'Serviço: ' . request('services') : null,
              'company_size' => request('company_size') ? 'Porte: ' . [
                'micro' => 'Microempresa',
                'small' => 'Pequena',
                'medium' => 'Média',
                'large' => 'Grande',
              ][request('company_size')] : null,
            ])->filter();
          @endphp

          @if($filterLabels->isNotEmpty())
            <div class="row">
              <div class="col-12 mb-4 text-center">
                <p>Filtros aplicados:</p>
                <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-center">
                  <li class="badge text-bg-light">
                    <a href="{{ route('companies.index') }}">Remover todos os filtros <i class="la la-times"></i></a>
                  </li>
                  @foreach($filterLabels as $key => $label)
                    @php
                      $params = collect(request()->query())->forget($key)->filter()->all();
                    @endphp
                    <li class="badge text-bg-light">
                      <a href="{{ route('companies.index', $params) }}">{{ $label }} <i class="la la-times"></i></a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif

          <!-- Job Blocks -->
          @include('layouts.partials.companies-list')

        </div>
      </div>
    </div>
  </section>

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@include('layouts.partials.favorite-scripts')
@php
// Preparar dados do mapa no formato esperado pelo maps.js
$mapLocations = $mapCompanies->map(function($company) {
    $photoUrl = $company['photo'];
    $url = $company['url'];
    $title = htmlspecialchars($company['title'], ENT_QUOTES, 'UTF-8');
    $type = htmlspecialchars($company['type'], ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($company['address'], ENT_QUOTES, 'UTF-8');
    
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
        $company['latitude'],
        $company['longitude'],
        $company['id'],
        $icon
    ];
})->values()->all();
@endphp
<script>
// Preparar dados do mapa ANTES do maps.js carregar
window.mapLocations = @json($mapLocations);
</script>
<script src="{{ asset('js/maps.js') }}"></script>
@endpush
