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
          <div class="filters-outer">
            <button type="button" class="theme-btn close-filters">X</button>

            <div class="filter-block">
              <h4>Buscar por palavras-chave</h4>
              <div class="form-group">
                <input type="text" name="listing-search" placeholder="Digite a busca">
                <span class="icon flaticon-search-3"></span>
              </div>
            </div>

            <div class="filter-block">
              <h4>Localização</h4>
              <div class="form-group">
                <input type="text" name="listing-search" placeholder="Cidade ou CEP">
                <span class="icon flaticon-map-locator"></span>
              </div>
              <p>Raio ao redor do local selecionado</p>
              <div class="range-slider-one">
                <div class="area-range-slider"></div>
                <div class="input-outer">
                  <div class="amount-outer"><span class="area-amount"></span> km</div>
                </div>
              </div>
            </div>

            <div class="filter-block">
              <h4>Área de atuação</h4>
              <div class="form-group">
                <select class="chosen-select">
                  <option>Selecione</option>
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

            <div class="switchbox-outer">
              <h4>Tipo de contrato</h4>
              <ul class="switchbox">
                <li>
                  <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                    <span class="title">CLT ou Fixo</span>
                  </label>
                </li>
                <li>
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                    <span class="title">Freelancer</span>
                  </label>
                </li>
                <li>
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                    <span class="title">Temporário</span>
                  </label>
                </li>
                <li>
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                    <span class="title">Estágio</span>
                  </label>
                </li>
              </ul>
            </div>

            <!-- Bloco de Filtro: Tags -->
            <div class="filter-block">
              <h4>Benefícios oferecidos</h4>
              <ul class="tags-style-one">
                <li><a href="#">VT</a></li>
                <li><a href="#">Hora extra</a></li>
                <li><a href="#">Comissão</a></li>
                <li><a href="#">Adicional de insalubridade</a></li>
                <li><a href="#">Seguro de vida</a></li>
                <li><a href="#">Bônus</a></li>
                <li><a href="#">Cesta básica</a></li>
                <li><a href="#">Assistência médica</a></li>
                <li><a href="#">Assistência odontológica</a></li>
              </ul>
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
                  <input id="check-g" type="checkbox" name="check">
                  <label for="check-g">Última Hora</label>
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
                  <input id="check-j" type="checkbox" name="check">
                  <label for="check-j">Últimos 14 Dias</label>
                </li>
                <li>
                  <input id="check-k" type="checkbox" name="check">
                  <label for="check-k">Últimos 30 Dias</label>
                </li>
              </ul>
            </div>
          </div>
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
                    <select class="chosen-select mt-3">
                      <option>Mostrar 10</option>
                      <option>Mostrar 20</option>
                      <option>Mostrar 30</option>
                      <option>Mostrar 40</option>
                      <option>Mostrar 50</option>
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

          <!-- Job Blocks -->
          <div class="row">
            <div class="job-block col-lg-12">
              <div class="inner-box">
                <div class="content">
                  <span class="company-logo"><img src="{{ asset('images/logo-petz.png') }}" alt="Petz"></span>
                  <h4><a href="{{ route('jobs.show', 1) }}">Atendente de Banho e Tosa - Petz (Itaim Bibi)</a></h4>
                  <ul class="job-info">
                    <li><span class="icon flaticon-briefcase"></span> Enfermeiro, auxiliar ou técnico</li>
                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                    <li><span class="icon flaticon-clock-3"></span> 3 horas atrás</li>
                    <li><span class="icon flaticon-money"></span> R$ 1.500 - R$ 1.800</li>
                  </ul>
                  <ul class="job-other-info"><li class="time">Tempo Integral</li></ul>
                  <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                </div>
              </div>
            </div>

            <div class="job-block col-lg-12">
              <div class="inner-box">
                <div class="content">
                  <span class="company-logo"><img src="{{ asset('images/logo-cobasi.png') }}" alt="Cobasi"></span>
                  <h4><a href="{{ route('jobs.show', 2) }}">Vendedor de Ração - Cobasi (Moema)</a></h4>
                  <ul class="job-info">
                    <li><span class="icon flaticon-briefcase"></span> Vendas</li>
                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                    <li><span class="icon flaticon-clock-3"></span> 1 dia atrás</li>
                    <li><span class="icon flaticon-money"></span> R$ 1.400 - R$ 1.600</li>
                  </ul>
                  <ul class="job-other-info"><li class="time">Meio Período</li></ul>
                  <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                </div>
              </div>
            </div>

            <div class="job-block col-lg-12">
              <div class="inner-box">
                <div class="content">
                  <span class="company-logo"><img src="{{ asset('images/logo-petcenter.png') }}" alt="Pet Center"></span>
                  <h4><a href="{{ route('jobs.show', 3) }}">Auxiliar Veterinário - Pet Center (Vila Olímpia)</a></h4>
                  <ul class="job-info">
                    <li><span class="icon flaticon-briefcase"></span> Banho e tosa</li>
                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                    <li><span class="icon flaticon-clock-3"></span> 2 dias atrás</li>
                    <li><span class="icon flaticon-money"></span> R$ 1.800</li>
                  </ul>
                  <ul class="job-other-info"><li class="time">Tempo Integral</li></ul>
                  <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div class="ls-show-more">
            <p>Mostrando 3 de 497 Vagas</p>
            <div class="bar">
              <span class="bar-inner" style="width:20%"></span>
            </div>
            <button class="show-more">Carregar mais vagas</button>
          </div>
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
@endpush
