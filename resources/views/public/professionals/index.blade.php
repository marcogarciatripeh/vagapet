@extends('layouts.app')

@section('title', 'Buscar Profissionais - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-company')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Seção de Listagem (Layout com Mapa) -->
  <section class="ls-section map-layout">
    <div class="filters-backdrop"></div>
    <div class="ls-cotainer">
      <!-- Coluna de Filtros -->
      <div class="filters-column hide-left">
        <div class="inner-column">
          <form method="GET" action="{{ route('professionals.index') }}" id="professional-filters">
            <div class="filters-outer">
              <button type="button" class="theme-btn close-filters">X</button>

              <div class="filter-block">
                <h4>Pesquisar por Palavras-chave</h4>
                <div class="form-group">
                  <input type="text" name="search" value="{{ request('search') }}" placeholder="Nome, habilidade, especialidade">
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
                <h4>Nível de Experiência</h4>
                <div class="form-group">
                  <select name="experience_level" class="chosen-select">
                    <option value="">Todos os níveis</option>
                    @foreach($experienceLevels as $key => $label)
                      <option value="{{ $key }}" {{ request('experience_level') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                  </select>
                  <span class="icon flaticon-resume"></span>
                </div>
              </div>

              <div class="filter-block">
                <h4>Anos de experiência</h4>
                <div class="row g-2">
                  <div class="col-6">
                    <div class="form-group">
                      <input type="number" min="0" name="experience_min" value="{{ request('experience_min') }}" placeholder="Mínimo">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <input type="number" min="0" name="experience_max" value="{{ request('experience_max') }}" placeholder="Máximo">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group mt-4">
                <button type="submit" class="theme-btn btn-style-two w-100"><i class="las la-search"></i> Aplicar filtros</button>
              </div>

              @if(request()->all())
                <div class="form-group mt-2">
                  <a href="{{ route('professionals.index') }}" class="theme-btn btn-style-three w-100 text-center"><i class="las la-undo"></i> Limpar filtros</a>
                </div>
              @endif
            </div>
          </form>
        </div>
      </div>
      <!-- Fim da Coluna de Filtros -->

      <!-- Coluna do Mapa -->
      <div class="map-column width-50">
        @include('layouts.partials.professionals-map')
      </div>

      <!-- Coluna de Conteúdo -->
      <div class="content-column width-50">
        <div class="ls-outer">
          <!-- ls Switcher -->
          <div class="ls-switcher">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-6">
                  <div class="showing-result show-filters">
                    <button type="button" class="theme-btn toggle-filters">
                      <span><i class="icon las la-filter"></i></span> Filtrar
                    </button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="sort-by float-end">
                    <form method="GET" action="{{ route('professionals.index') }}" id="per-page-form" style="display: inline-block;">
                      @foreach(request()->except('per_page', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                      @endforeach
                      <select name="per_page" class="chosen-select mt-3" onchange="document.getElementById('per-page-form').submit();">
                        @php
                          $currentPerPage = request('per_page', 12);
                        @endphp
                        <option value="10" {{ $currentPerPage == 10 ? 'selected' : '' }}>Mostrar 10</option>
                        <option value="12" {{ $currentPerPage == 12 ? 'selected' : '' }}>Mostrar 12</option>
                        <option value="20" {{ $currentPerPage == 20 ? 'selected' : '' }}>Mostrar 20</option>
                        <option value="30" {{ $currentPerPage == 30 ? 'selected' : '' }}>Mostrar 30</option>
                        <option value="40" {{ $currentPerPage == 40 ? 'selected' : '' }}>Mostrar 40</option>
                        <option value="50" {{ $currentPerPage == 50 ? 'selected' : '' }}>Mostrar 50</option>
                        <option value="60" {{ $currentPerPage == 60 ? 'selected' : '' }}>Mostrar 60</option>
                      </select>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @php
            $experienceLabels = [
              'estagio' => 'Estágio',
              'junior' => 'Júnior',
              'pleno' => 'Pleno',
              'senior' => 'Sênior',
            ];
            $appliedFilters = collect([
              'search' => request('search') ? 'Busca: "' . request('search') . '"' : null,
              'city' => request('city') ? 'Cidade: ' . request('city') : null,
              'state' => request('state') ? 'Estado: ' . request('state') : null,
              'area' => request('area') ? 'Área: ' . request('area') : null,
              'experience_level' => request('experience_level') ? 'Nível: ' . ($experienceLabels[request('experience_level')] ?? request('experience_level')) : null,
              'experience_min' => request('experience_min') ? 'Experiência mínima: ' . request('experience_min') . ' anos' : null,
              'experience_max' => request('experience_max') ? 'Experiência máxima: ' . request('experience_max') . ' anos' : null,
            ])->filter();
          @endphp

          @if($appliedFilters->isNotEmpty())
            <div class="row">
              <div class="col-12 mb-4 text-center">
                <p>Filtros aplicados:</p>
                <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-center">
                  <li class="badge text-bg-light">
                    <a href="{{ route('professionals.index') }}">Remover todos os filtros <i class="la la-times"></i></a>
                  </li>
                  @foreach($appliedFilters as $filterKey => $label)
                    @php
                      $params = collect(request()->query())->forget($filterKey)->filter()->all();
                    @endphp
                    <li class="badge text-bg-light">
                      <a href="{{ route('professionals.index', $params) }}">{{ $label }} <i class="la la-times"></i></a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif

          @include('layouts.partials.professionals-list')

        </div>
      </div>
    </div>
  </section>
  <!-- Fim da Seção de Listagem -->

  <!-- Footer -->
  @include('layouts.partials.footer')

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@php
// Preparar dados do mapa no formato esperado pelo maps.js
$mapLocations = $mapProfessionals->map(function($p) {
    $photoUrl = $p['photo'];
    $url = $p['url'];
    $title = htmlspecialchars($p['title'], ENT_QUOTES, 'UTF-8');
    $type = htmlspecialchars($p['type'], ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($p['address'], ENT_QUOTES, 'UTF-8');
    
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
        $p['latitude'],
        $p['longitude'],
        $p['id'],
        $icon
    ];
})->values()->all();
@endphp
@include('layouts.partials.scripts')
@include('layouts.partials.favorite-scripts')
<script>
// Preparar dados do mapa ANTES do maps.js carregar
window.mapLocations = @json($mapLocations);
</script>
<script src="{{ asset('js/maps.js') }}"></script>
@endpush
