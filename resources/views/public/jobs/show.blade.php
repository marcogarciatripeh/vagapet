@extends('layouts.app')

@section('title', 'Atendente de Banho e Tosa - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-logout')
  <!-- End Main Header -->

  <!-- Seção de Detalhes da Vaga (estilo v5) -->
  <section class="job-detail-section">
    <!-- Box Superior -->
    <div class="upper-box">
      <div class="auto-container">

        <div class="job-block-seven style-three">
          <div class="inner-box">
            <div class="content">
              <figure class="image">
                <img src="{{ asset('images/resource/candidate-4.png') }}" alt="Profissional PetShop">
              </figure>
              <h4>Atendente de Banho e Tosa</h4>
              <a href="{{ route('companies.show', 1) }}"><span class="designation">Dogs, Cats and Love (VIla Clementino)</span></a>
              <ul class="job-info mt-2">
                <li><span class="icon flaticon-briefcase"></span> Banho & Tosa</li>
                <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                <li><span class="icon flaticon-clock-3"></span> Publicado há 2 dias</li>
                <li><span class="icon flaticon-money"></span> R$ 1.800 – R$ 2.200</li>
              </ul>
              <ul class="job-other-info">
                <li class="time">CLT ou fixo</li>
              </ul>
            </div>
            <div class="btn-box">
              <a href="#" class="theme-btn btn-style-one">Quero me condidatar</a>
              <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Conteúdo e Sidebar -->
    <div class="job-detail-outer">
      <div class="auto-container">
        <div class="row">

          <!-- Conteúdo Principal -->
          <div class="content-column col-lg-8 offset-lg-2 col-md-12">
            <div class="job-overview-two">
              <h4>Visão Geral da Vaga</h4>
              <ul>
                <li><i class="icon icon-user-2"></i><h5>Empresa:</h5><span><a href="{{ route('companies.show', 1) }}">Dogs, Cats and Love</a></span></li>
                <li><i class="icon icon-calendar"></i><h5>Publicado em:</h5><span>Publicado há 2 dias</span></li>
                <li><i class="icon icon-expiry"></i><h5>Aceita candidaturas até:</h5><span>30 de Maio de 2025</span></li>
                <li><i class="icon icon-location"></i><h5>Localização:</h5><span>Vila Clementino, São Paulo, SP</span></li>
                <li><i class="icon icon-clock"></i><h5>Carga Horária:</h5><span>44h / semana</span></li>
              </ul>
            </div>
            <div class="job-detail">
              <h4>Descrição da Vaga</h4>
              <p>Procuramos um profissional dedicado para atuar como <strong>Atendente de Banho e Tosa</strong> na loja Petz Morumbi. Principais atividades:</p>
              <ul>
                <li>Banho e tosa higiênica em cães e gatos;</li>
                <li>Manter higiene e organização do espaço;</li>
                <li>Atendimento ao tutor com orientações de cuidados;</li>
                <li>Controle de materiais e estoque.</li>
              </ul>
              <h4>Responsabilidades</h4>
              <ul>
                <li>Seguir protocolos de higiene e segurança;</li>
                <li>Observar conforto e stress dos pets;</li>
                <li>Agendar e confirmar atendimentos;</li>
                <li>Auxiliar equipe em demandas gerais.</li>
              </ul>
              <h4>Requisitos</h4>
              <ul class="list-style-one">
                <li>Experiência mínima de 1 ano em banho e tosa;</li>
                <li>Conhecimento em tosa básica e estética;</li>
                <li>Boa comunicação e proatividade;</li>
                <li>Disponibilidade para turnos.</li>
              </ul>
            </div>

            <!-- Vagas Relacionadas -->
            <div class="related-jobs mt-1">
              <div class="title-box">
                <h3>Vagas Relacionadas</h3>
                <div class="text">Outras oportunidades em pet shops</div>
              </div>
              @include('layouts.partials.jobs-list')
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- End Job Detail Section -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
<!-- End Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
