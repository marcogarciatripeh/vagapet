@extends('layouts.app')

@section('title', $job->title . ' - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header -->
  @include('layouts.partials.header-dynamic')
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
                @if($job->companyProfile && $job->companyProfile->logo)
                  <img src="{{ url('storage/' . $job->companyProfile->logo) }}" alt="{{ $job->companyProfile->company_name }}">
                @else
                  <img src="{{ asset('images/resource/candidate-4.png') }}" alt="Empresa">
                @endif
              </figure>
              <h4>{{ $job->title }}</h4>
              @if($job->companyProfile)
                <a href="{{ route('companies.show', $job->companyProfile->id) }}"><span class="designation">{{ $job->companyProfile->company_name }} ({{ $job->city ?? 'São Paulo' }})</span></a>
              @else
                <span class="designation">Empresa</span>
              @endif
              <ul class="job-info mt-2">
                <li><span class="icon flaticon-briefcase"></span> {{ $job->area ?? 'Não especificado' }}</li>
                <li><span class="icon flaticon-map-locator"></span> {{ $job->city ?? 'São Paulo' }}, {{ $job->state ?? 'SP' }}</li>
                <li><span class="icon flaticon-clock-3"></span> Publicado {{ $job->published_at ? $job->published_at->diffForHumans() : $job->created_at->diffForHumans() }}</li>
                @if($job->salary_type === 'range' && $job->salary_min && $job->salary_max)
                  <li><span class="icon flaticon-money"></span> R$ {{ number_format($job->salary_min, 0, ',', '.') }} – R$ {{ number_format($job->salary_max, 0, ',', '.') }}</li>
                @elseif($job->salary_type === 'fixed' && $job->salary_min)
                  <li><span class="icon flaticon-money"></span> R$ {{ number_format($job->salary_min, 0, ',', '.') }}</li>
                @else
                  <li><span class="icon flaticon-money"></span> A combinar</li>
                @endif
              </ul>
              <ul class="job-other-info">
                <li class="time">{{ $job->contract_type ? ucfirst($job->contract_type) : 'CLT' }}</li>
              </ul>
            </div>
            <div class="btn-box">
              @auth
                @if(Auth::user()->professionalProfile)
                  @if($hasApplied)
                    <button class="theme-btn btn-style-two" disabled style="cursor: not-allowed; opacity: 0.6;">Você já se candidatou</button>
                  @else
                    <form method="POST" action="{{ route('professional.apply-job', $job->id) }}" style="display:inline;">
                      @csrf
                      <button type="submit" class="theme-btn btn-style-one">Quero me candidatar</button>
                    </form>
                  @endif
                  <button class="bookmark-btn {{ $isFavorited ? 'active' : '' }}" data-favorite-id="{{ $job->id }}" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})"><i class="flaticon-bookmark"></i></button>
                @else
                  <button class="theme-btn btn-style-one" onclick="alert('Apenas profissionais podem se candidatar a vagas. Crie um perfil profissional primeiro.')">Quero me candidatar</button>
                @endif
              @else
                <a href="{{ route('login') }}" class="theme-btn btn-style-one">Quero me candidatar</a>
              @endauth
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
                @if($job->companyProfile)
                  <li><i class="icon icon-user-2"></i><h5>Empresa:</h5><span><a href="{{ route('companies.show', $job->companyProfile->id) }}">{{ $job->companyProfile->company_name }}</a></span></li>
                @endif
                <li><i class="icon icon-calendar"></i><h5>Publicado em:</h5><span>{{ $job->published_at ? $job->published_at->format('d \d\e F \d\e Y') : $job->created_at->format('d \d\e F \d\e Y') }}</span></li>
                @if($job->deadline)
                  <li><i class="icon icon-expiry"></i><h5>Aceita candidaturas até:</h5><span>{{ $job->deadline->format('d \d\e F \d\e Y') }}</span></li>
                @endif
                <li><i class="icon icon-location"></i><h5>Localização:</h5><span>{{ $job->work_location ?? $job->city }}, {{ $job->city }}, {{ $job->state }}</span></li>
                @if($job->work_hours)
                  <li><i class="icon icon-clock"></i><h5>Carga Horária:</h5><span>{{ $job->work_hours }}h / semana</span></li>
                @endif
              </ul>
            </div>
            <div class="job-detail">
              <h4>Descrição da Vaga</h4>
              {!! nl2br(e($job->description)) !!}

              @if($job->requirements)
                <h4>Requisitos</h4>
                {!! nl2br(e($job->requirements)) !!}
              @endif

              @if($job->benefits)
                <h4>Benefícios</h4>
                {!! nl2br(e($job->benefits)) !!}
              @endif
            </div>

            <!-- Vagas Relacionadas -->
            @if($related_jobs->count() > 0)
            <div class="related-jobs mt-1">
              <div class="title-box">
                <h3>Vagas Relacionadas</h3>
                <div class="text">Outras oportunidades em pet shops</div>
              </div>
              <div class="row">
                @foreach($related_jobs as $relatedJob)
                <div class="job-block col-lg-12">
                  <div class="inner-box">
                    <div class="content">
                      <span class="company-logo">
                        @if($relatedJob->companyProfile && $relatedJob->companyProfile->logo)
                          <img src="{{ url('storage/' . $relatedJob->companyProfile->logo) }}" alt="{{ $relatedJob->companyProfile->company_name }}">
                        @else
                          <img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt="Empresa">
                        @endif
                      </span>
                      <h4><a href="{{ route('jobs.show', $relatedJob->slug) }}">{{ $relatedJob->title }} - {{ $relatedJob->companyProfile->company_name ?? 'Empresa' }} ({{ $relatedJob->city }})</a></h4>
                      <ul class="job-info">
                        <li><span class="icon flaticon-briefcase"></span> {{ $relatedJob->area ?? 'Não especificado' }}</li>
                        <li><span class="icon flaticon-map-locator"></span> {{ $relatedJob->city }}, {{ $relatedJob->state }}</li>
                        <li><span class="icon flaticon-clock-3"></span> {{ $relatedJob->created_at->diffForHumans() }}</li>
                        @if($relatedJob->salary_type === 'range' && $relatedJob->salary_min && $relatedJob->salary_max)
                          <li><span class="icon flaticon-money"></span> R$ {{ number_format($relatedJob->salary_min, 0, ',', '.') }} - R$ {{ number_format($relatedJob->salary_max, 0, ',', '.') }}</li>
                        @elseif($relatedJob->salary_type === 'fixed' && $relatedJob->salary_min)
                          <li><span class="icon flaticon-money"></span> R$ {{ number_format($relatedJob->salary_min, 0, ',', '.') }}</li>
                        @endif
                      </ul>
                      <ul class="job-other-info"><li class="time">{{ ucfirst($relatedJob->contract_type ?? 'CLT') }}</li></ul>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @endif
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
@include('layouts.partials.favorite-scripts')
@endpush

