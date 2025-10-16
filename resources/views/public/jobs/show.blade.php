@extends('layouts.app')

@section('title', 'Atendente de Banho e Tosa - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-professional')
  <!-- End Main Header -->

  <!-- includes/sidebar.html -->
  <div class="sidebar-backdrop"></div>

  <div class="user-sidebar d-lg-none">
    <div class="sidebar-inner">
      <ul class="navigation">
        @include('layouts.partials.menu-professional')
      </ul>
    </div>
  </div>

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
              <a href="{{ route('professional.apply-job', $job->id) }}" class="theme-btn btn-style-one">Quero me candidatar</a>
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
              <div class="row">
                <div class="job-block col-lg-12">
                  <div class="inner-box">
                    <div class="content">
                      <span class="company-logo"><img src="{{ asset('images/logo-petz.png') }}" alt="Petz"></span>
                      <h4><a href="{{ route('jobs.show', 2) }}">Atendente de Banho e Tosa - Petz (Itaim Bibi)</a></h4>
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
                      <h4><a href="{{ route('jobs.show', 3) }}">Vendedor de Ração - Cobasi (Moema)</a></h4>
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
                      <h4><a href="{{ route('jobs.show', 4) }}">Auxiliar Veterinário - Pet Center (Vila Olímpia)</a></h4>
                      <ul class="job-info">
                        <li><span class="icon flaticon-briefcase"></span> Bnaho e tosa</li>
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
      </div>
    </div>
  </section>
  <!-- End Job Detail Section -->

  <!-- Main Footer -->
  <footer class="main-footer alternate5">
    <div class="auto-container">
      <div class="widgets-section">
        <div class="row">
          <div class="big-column col-xl-4 col-lg-3 col-md-12">
            <div class="about-widget">
              <div class="logo"><a href="#"><img src="{{ asset('images/logo.svg') }}" alt="Junto.pet"></a></div>
              <p class="phone-num"><span>Telefone </span><a href="tel:+5511999999999">(11) 99999-9999</a></p>
              <p class="address">Rua das Flores, 123<br>São Paulo – SP<br><a href="mailto:contato@junto.pet" class="email">contato@junto.pet</a></p>
            </div>
          </div>
          <div class="big-column col-xl-8 col-lg-9 col-md-12">
            <div class="row">
              <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                <div class="links-widget">
                  <h4 class="widget-title">Para Profissionais</h4>
                  <ul class="list">
                    <li><a href="{{ route('jobs.index') }}">Buscar Vagas</a></li>
                    <li><a href="{{ route('professional.profile') }}">Meu Perfil</a></li>
                    <li><a href="{{ route('professional.applications') }}">Minhas Candidaturas</a></li>
                    <li><a href="{{ route('professional.favorites') }}">Favoritos</a></li>
                  </ul>
                </div>
              </div>
              <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                <div class="links-widget">
                  <h4 class="widget-title">Para Empresas</h4>
                  <ul class="list">
                    <li><a href="{{ route('professionals.index') }}">Buscar Profissionais</a></li>
                    <li><a href="{{ route('company.create-job') }}">Publicar Vaga</a></li>
                    <li><a href="{{ route('company.dashboard') }}">Painel da Empresa</a></li>
                  </ul>
                </div>
              </div>
              <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                <div class="links-widget">
                  <h4 class="widget-title">Sobre</h4>
                  <ul class="list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('contact') }}">Contato</a></li>
                  </ul>
                </div>
              </div>
              <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                <div class="links-widget">
                  <h4 class="widget-title">Ajuda</h4>
                  <ul class="list">
                    <li><a href="{{ route('terms') }}">Termos de Uso</a></li>
                    <li><a href="{{ route('privacy') }}">Política de Privacidade</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="auto-container">
        <div class="outer-box">
          <div class="copyright-text">© 2025 Junto.pet - Todos os direitos reservados.</div>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Main Footer -->

</div>
<!-- End Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
