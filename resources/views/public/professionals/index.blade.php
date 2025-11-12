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
      @include('layouts.partials.professionals-map')

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
                    <select class="chosen-select mt-3">
                      <option>Mostrar 10</option>
                      <option>Mostrar 20</option>
                      <option>Mostrar 30</option>
                      <option>Mostrar 40</option>
                      <option>Mostrar 50</option>
                      <option>Mostrar 60</option>
                    </select>
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

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
