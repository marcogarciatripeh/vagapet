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
          <div class="filters-outer">
            <button type="button" class="theme-btn close-filters">X</button>

            <!-- Bloco de Filtro: Palavras-chave -->
            <div class="filter-block">
              <h4>Pesquisar por Palavras-chave</h4>
              <div class="form-group">
                <input type="text" name="listing-search" placeholder="Digite a busca">
                <span class="icon flaticon-search-3"></span>
              </div>
            </div>

            <!-- Bloco de Filtro: Localização -->
            <div class="filter-block">
              <h4>Localização</h4>
              <div class="form-group">
                <input type="text" name="listing-search" placeholder="Cidade ou CEP">
                <span class="icon flaticon-map-locator"></span>
              </div>
              <p>Raio em torno da localização</p>
              <div class="range-slider-one">
                <div class="area-range-slider"></div>
                <div class="input-outer">
                  <div class="area-amount"></div>
                </div>
              </div>
            </div>

            <!-- Bloco de Filtro: Categoria -->
            <div class="filter-block">
              <h4>Área de atuação</h4>
              <div class="form-group">
                <select class="chosen-select">
                  <option>Selecione uma categoria</option>
                  <option>Adestramento</option>
                  <option>Administrativo</option>
                  <option>Banho e tosa</option>
                  <option>Creche e hotel</option>
                  <option>Enfermeiro, auxiliar ou técnico</option>
                  <option>Limpeza</option>
                  <option>Marketing</option>
                  <option>Motorista</option>
                  <option>Recepção</option>
                  <option>Serviços gerais</option>
                  <option>Vendas</option>
                  <option>Veterinária</option>
                </select>
                <span class="icon flaticon-briefcase"></span>
              </div>
            </div>

            <!-- Checkboxes: Data de Publicação -->
            <div class="checkbox-outer">
              <h4>Data de Publicação</h4>
              <ul class="checkboxes">
                <li>
                  <input id="check-f" type="checkbox" name="check">
                  <label for="check-f">Todas</label>
                </li>
                <li>
                  <input id="check-h" type="checkbox" name="check">
                  <label for="check-h">Últimas 24 Horas</label>
                </li>
                <li>
                  <input id="check-i" type="checkbox" name="check">
                  <label for="check-i">Últimos 7 Dias</label>
                </li>
                <li>
                  <input id="check-k" type="checkbox" name="check">
                  <label for="check-k">Últimos 30 Dias</label>
                </li>
              </ul>
            </div>

            <!-- Checkboxes: Nível de Experiência -->
            <div class="checkbox-outer">
              <h4>Nível de Experiência</h4>
              <ul class="checkboxes">
                <li>
                  <input id="check-a" type="checkbox" name="check">
                  <label for="check-a">Todos</label>
                </li>
                <li>
                  <input id="check-b" type="checkbox" name="check">
                  <label for="check-b">Estágio (estudante)</label>
                </li>
                <li>
                  <input id="check-c" type="checkbox" name="check">
                  <label for="check-c">Júnior (até 2 anos)</label>
                </li>
                <li>
                  <input id="check-d" type="checkbox" name="check">
                  <label for="check-d">Pleno (de 2 a 5 anos)</label>
                </li>
                <li>
                  <input id="check-e" type="checkbox" name="check">
                  <label for="check-e">Sênior (mais de 5 anos)</label>
                </li>
              </ul>
            </div>

            <!-- Bloco de Filtro: Tags -->
            <div class="filter-block">
              <h4>Tags</h4>
              <ul class="tags-style-one">
                <li><a href="#">Banho</a></li>
                <li><a href="#">Tosa</a></li>
                <li><a href="#">Veterinária</a></li>
                <li><a href="#">Recepção</a></li>
                <li><a href="#">Pets</a></li>
                <li><a href="#">Freelancer</a></li>
              </ul>
            </div>

          </div>
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

          <!-- Remover filtros -->
          <div class="row">
            <div class="col-12 mb-5 text-center">
              <p>Filtros aplicados:</p>
              <ul>
                <li class="badge text-bg-light"><a href="#" >Remover todos os filtros <i class="la la-times"></i></a></li>
                <li class="badge text-bg-light"><a href="#" >CLT ou fixo <i class="la la-times"></i></a></li>
                <li class="badge text-bg-light"><a href="#" >Banho e tosa <i class="la la-times"></i></a></li>
              </ul>
            </div>
          </div>

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
