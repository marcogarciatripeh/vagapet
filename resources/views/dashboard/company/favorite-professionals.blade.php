@extends('layouts.dashboard')

@section('title', 'Profissionais Favoritos - VagaPet')

@section('content')
  <!-- Dashboard -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Profissionais favoritos</h3>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Lista de Vagas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Lista</h4>
                <div class="chosen-outer">
                  <select class="chosen-select">
                    <option>Últimos 6 meses</option>
                    <option>Últimos 12 meses</option>
                    <option>Últimos 16 meses</option>
                    <option>Últimos 24 meses</option>
                    <option>Últimos 5 anos</option>
                  </select>
                </div>
              </div>

              <div class="widget-content">
                <div class="row">
                  <!-- Exemplo de Bloco de Profissional -->
                  <div class="job-block col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-1.png') }}" alt="">
                        </span>
                        <h4><a href="{{ route('professionals.show', 1) }}">Groomer Especialista em Tosa</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Pet4U</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 4 horas atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 2.500 - R$ 3.500</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Tempo Integral</li>
                          <li class="required">Banho e tosa</li>
                          <li class="required">Urgente</li>
                        </ul>
                        <button class="bookmark-btn">
                          <span class="flaticon-bookmark"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Outro Exemplo de Profissional -->
                  <div class="job-block col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt="">
                        </span>
                        <h4><a href="{{ route('professionals.show', 2) }}">Recepcionista de Pet Shop</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Amigão PetShop</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 6 horas atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 2.000 - R$ 2.500</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Meio Período</li>
                          <li class="required">Creche e Hotel</li>
                        </ul>
                        <button class="bookmark-btn">
                          <span class="flaticon-bookmark"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Outro Exemplo de Profissional -->
                  <div class="job-block col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-3.png') }}" alt="">
                        </span>
                        <h4><a href="{{ route('professionals.show', 3) }}">Auxiliar Veterinário(a)</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Clínica AnimalCare</li>
                          <li><span class="icon flaticon-map-locator"></span> Rio de Janeiro, RJ</li>
                          <li><span class="icon flaticon-clock-3"></span> 1 dia atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 2.500 - R$ 3.000</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Temporário</li>
                          <li class="required">Banho e tosa</li>
                          <li class="required">Urgente</li>
                        </ul>
                        <button class="bookmark-btn">
                          <span class="flaticon-bookmark"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Outro Exemplo de Profissional -->
                  <div class="job-block col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-4.png') }}" alt="">
                        </span>
                        <h4><a href="{{ route('professionals.show', 4) }}">Dog Walker / Pet Sitter</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> PetLovers</li>
                          <li><span class="icon flaticon-map-locator"></span> Belo Horizonte, MG</li>
                          <li><span class="icon flaticon-clock-3"></span> 2 dias atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 1.500 - R$ 2.000</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Freelance</li>
                          <li class="required">Adestramento</li>
                        </ul>
                        <button class="bookmark-btn">
                          <span class="flaticon-bookmark"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Outro Exemplo de Profissional -->
                  <div class="job-block col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-5.png') }}" alt="">
                        </span>
                        <h4><a href="{{ route('professionals.show', 5) }}">Vendedor de Produtos Pet</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Petz</li>
                          <li><span class="icon flaticon-map-locator"></span> Curitiba, PR</li>
                          <li><span class="icon flaticon-clock-3"></span> 3 dias atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 1.800 - R$ 2.200</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Tempo Integral</li>
                          <li class="required">Vendas</li>
                        </ul>
                        <button class="bookmark-btn">
                          <span class="flaticon-bookmark"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Outro Exemplo de Profissional -->
                  <div class="job-block col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-6.png') }}" alt="">
                        </span>
                        <h4><a href="{{ route('professionals.show', 6) }}">Auxiliar de Serviços Gerais</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Cobasi</li>
                          <li><span class="icon flaticon-map-locator"></span> Porto Alegre, RS</li>
                          <li><span class="icon flaticon-clock-3"></span> 1 semana atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 1.500 - R$ 1.800</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Tempo Integral</li>
                          <li class="required">Limpeza</li>
                        </ul>
                        <button class="bookmark-btn">
                          <span class="flaticon-bookmark"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <!-- Fim widget-content -->
            </div>
            <!-- Fim tabs-box -->
          </div>
          <!-- End Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Dashboard -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush

