@extends('layouts.dashboard-professional')

@section('title', 'Vagas Favoritas - VagaPet')

@section('content')
  <!-- Dashboard -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Vagas Favoritas</h3>
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
                  <!-- Vaga Favorita 1 -->
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
                        <button class="bookmark-btn active"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Vaga Favorita 2 -->
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
                        <button class="bookmark-btn active"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Vaga Favorita 3 -->
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
                        <button class="bookmark-btn active"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Vaga Favorita 4 -->
                  <div class="job-block col-lg-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('images/resource/company-logo/1-1.png') }}" alt="Pet4U"></span>
                        <h4><a href="{{ route('jobs.show', 4) }}">Groomer Especialista em Tosa - Pet4U</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Banho e tosa</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 4 horas atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 2.500 - R$ 3.500</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Tempo Integral</li>
                          <li class="required">Urgente</li>
                        </ul>
                        <button class="bookmark-btn active"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Vaga Favorita 5 -->
                  <div class="job-block col-lg-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt="Amigão PetShop"></span>
                        <h4><a href="{{ route('jobs.show', 5) }}">Recepcionista de Pet Shop - Amigão PetShop</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Recepção</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 6 horas atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 2.000 - R$ 2.500</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Meio Período</li>
                          <li class="required">Creche e Hotel</li>
                        </ul>
                        <button class="bookmark-btn active"><span class="flaticon-bookmark"></span></button>
                      </div>
                    </div>
                  </div>

                  <!-- Vaga Favorita 6 -->
                  <div class="job-block col-lg-12">
                    <div class="inner-box">
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('images/resource/company-logo/1-3.png') }}" alt="Clínica AnimalCare"></span>
                        <h4><a href="{{ route('jobs.show', 6) }}">Auxiliar Veterinário(a) - Clínica AnimalCare</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> Veterinária</li>
                          <li><span class="icon flaticon-map-locator"></span> Rio de Janeiro, RJ</li>
                          <li><span class="icon flaticon-clock-3"></span> 1 dia atrás</li>
                          <li><span class="icon flaticon-money"></span> R$ 2.500 - R$ 3.000</li>
                        </ul>
                        <ul class="job-other-info">
                          <li class="time">Temporário</li>
                          <li class="required">Urgente</li>
                        </ul>
                        <button class="bookmark-btn active"><span class="flaticon-bookmark"></span></button>
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

