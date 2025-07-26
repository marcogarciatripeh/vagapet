@extends('layouts.app')

@section('title', 'Cadastro do Profissional - VagaPet')

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
                <h4>Cadastro</h4>
              </div>

              <div class="widget-content">

                <!--Skill Item-->
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="14">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="14">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="default-form" action="{{ route('onboarding.step2.professional.process') }}" method="post">
                  @csrf
                  <div class="row">
                    <!-- Dados básicos -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Nome*</label>
                      <input type="text" name="first_name" placeholder="Digite aqui o seu nome" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Sobrenome*</label>
                      <input type="text" name="last_name" placeholder="Digite aqui o seu sobrenome" required>
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Crie uma senha</label>
                      <input id="password-field" type="password" name="password" placeholder="Digite sua senha" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Confirme a senha</label>
                      <input id="password-field" type="password" name="password_confirmation" placeholder="Digite a mesma senha para confirmar" required>
                    </div>
                  </div>

                  <!-- Área botão -->
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-12">
                      <a href="{{ route('onboarding.step1') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                    </div>
                    <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                      <button class="theme-btn btn-style-one text-white" type="submit">Próximo</button>
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

@push('scripts')
@include('layouts.partials.scripts')
@endpush
