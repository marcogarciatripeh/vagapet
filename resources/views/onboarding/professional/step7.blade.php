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

                <form class="default-form" action="{{ route('onboarding.step7.professional.process') }}" method="post">
                  @csrf

                  <div class="row">
                    <div class="form-group col-lg-12 col-md-12 mb-3">
                      <h4>Redes Sociais (Opcional)</h4>
                      <p class="text-muted">Adicione suas redes sociais para aumentar sua visibilidade</p>
                    </div>

                    <div class="form-group col-lg-6 col-md-12 mb-3">
                      <label>LinkedIn</label>
                      <input type="url" name="linkedin" placeholder="https://linkedin.com/in/seu-perfil"
                             value="{{ old('linkedin', session('onboarding.step7_data.linkedin')) }}" class="form-control">
                    </div>

                    <div class="form-group col-lg-6 col-md-12 mb-3">
                      <label>Instagram</label>
                      <input type="text" name="instagram" placeholder="@seu_usuario"
                             value="{{ old('instagram', session('onboarding.step7_data.instagram')) }}" class="form-control">
                    </div>

                    <div class="form-group col-lg-6 col-md-12 mb-3">
                      <label>Facebook</label>
                      <input type="text" name="facebook" placeholder="facebook.com/seu-perfil"
                             value="{{ old('facebook', session('onboarding.step7_data.facebook')) }}" class="form-control">
                    </div>

                    <div class="form-group col-lg-6 col-md-12 mb-3">
                      <label>Website</label>
                      <input type="url" name="website" placeholder="https://seu-site.com"
                             value="{{ old('website', session('onboarding.step7_data.website')) }}" class="form-control">
                    </div>
                  </div>

                  <!-- Área botão -->
                  <div class="row mt-4">
                    <div class="form-group col-lg-6 col-md-12">
                      <a href="{{ route('onboarding.step6.professional') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                    </div>
                    <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                      <button class="theme-btn btn-style-one text-white">Finalizar Cadastro</button>
                    </div>
                  </div>
                  <!-- Fim área botão -->
                </form>
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

@push('styles')
<link rel="stylesheet" href="{{ asset('css/onboarding-improvements.css') }}">
@endpush

@push('scripts')
@include('layouts.partials.scripts')
@endpush
