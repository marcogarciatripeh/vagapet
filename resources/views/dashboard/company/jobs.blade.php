@extends('layouts.app')

@section('title', 'Vagas da Empresa - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop"></div>

  <!-- User Sidebar -->
  <div class="user-sidebar d-lg-none">
    <div class="sidebar-inner">
      <ul class="navigation">
        @include('layouts.partials.menu-company')
      </ul>
    </div>
  </div>
  <!-- End User Sidebar -->

  <!-- Seção de Detalhes da Empresa -->
  <section class="candidate-detail-section style-three">

    <!-- Box Superior -->
    <div class="upper-box">
      <div class="auto-container">
        <a href="#" class="btn btn-lg btn-white position-absolute">
          <i class="flaticon-bookmark"></i> Favoritar
        </a>
        <!-- Bloco da Empresa -->
        <div class="candidate-block-six">
          <div class="inner-box">
            <figure class="image">
              <img src="{{ asset('images/resource/pet-shop-logo.png') }}" alt="Logotipo Dogs, Cats & Love">
            </figure>
            <h4 class="name"><a href="{{ route('company.public-page') }}">Dogs, Cats & Love</a></h4>
            <ul class="job-other-info">
              <li class="text-primary">Vagas Abertas: 3</li>
            </ul>
            <div class="content">
              <!-- poderia vir um resumo curto aqui -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="candidate-detail-outer">
      <div class="auto-container">
        <div class="row justify-content-md-center">
          <!-- Conteúdo Principal -->
          <div class="content-column col-offset-lg-2 col-lg-8 col-md-12 order-2">
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

          <!-- Sidebar -->

        </div>
      </div>
    </div>
  </section>
  <!-- End Seção de Detalhes da Empresa -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
<!-- End Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
