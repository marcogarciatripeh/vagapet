@extends('layouts.app')

@section('title', 'Finalizar Cadastro - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  <header class="main-header">
    <div class="container-fluid">
      <div class="main-box">
        <div class="nav-outer">
          <!-- Logo -->
          <div class="logo-box">
            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-junto.svg') }}" alt="Junto.pet" title="Junto.pet"></a></div>
          </div>
        </div>

        <div class="outer-box">
          <!-- Placeholder for alignment -->
        </div>
      </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
      <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-junto.svg') }}" alt="Junto.pet" title="Junto.pet"></a></div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
  </header>
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Meu Perfil) -->
  <section class="user-dashboard row justify-content-center">
    <div class="dashboard-outer col-lg-10 mt-30 mb-50">

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Finalizar Cadastro</h4>
              </div>

              <div class="widget-content">

                <!--Skill Item-->
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="100">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="100">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <div class="success-icon" style="font-size: 80px; color: #28a745; margin: 30px 0;">
                    <i class="la la-check-circle"></i>
                  </div>

                  <h3 style="margin-bottom: 20px;">Cadastro Concluído!</h3>
                  <p style="margin-bottom: 30px; color: #666;">Sua conta foi criada com sucesso. Agora você pode começar a usar a plataforma.</p>

                  <div class="btn-box">
                    <a href="{{ route('onboarding.step6.professional') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                    <a href="{{ route('professional.dashboard') }}" class="theme-btn btn-style-one text-white">Encontrar vaga</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Meu Perfil) -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
