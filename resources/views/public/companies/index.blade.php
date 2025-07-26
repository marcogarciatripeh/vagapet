@extends('layouts.app')

@section('title', 'Buscar Empresas - VagaPet')

@section('content')
<div class="page-wrapper">
  <div class="preloader"></div>
  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-company')
  <!-- Listing Section -->

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
              <h4>Serviços</h4>
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
      @include('layouts.partials.jobs-map')

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
@endpush
