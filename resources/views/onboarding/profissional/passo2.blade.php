@extends('layouts.app')

@section('content')
<div class="page-wrapper">
  <!-- Preloader -->
  <div class="preloader"></div>
  <!-- Header Span -->
  <span class="header-span"></span>
  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-onboarding')
  <!-- Fim do Cabeçalho Principal -->
  <section class="user-dashboard row justify-content-center">
    <div class="dashboard-outer col-lg-10 mt-30 mb-50">
      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Cadastro</h4>
              </div>
              <div class="widget-content">
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="20">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="20">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="default-form" method="POST" action="{{ route('onboarding.profissional.passo2.post') }}">
                  @csrf
                  <div class="row">
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Nome*</label>
                      <input type="text" name="nome" placeholder="Digite aqui o seu nome">
                    </div>
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Sobrenome*</label>
                      <input type="text" name="sobrenome" placeholder="Digite aqui o seu sobrenome">
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
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6">
                      <a href="{{ route('onboarding.passo1') }}" class="theme-btn btn-style-one">Voltar</a>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 text-right">
                      <button class="theme-btn btn-style-one pull-right text-white" type="submit">Próximo</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('layouts.partials.copyright')
</div>
@endsection
@push('scripts')
@include('layouts.partials.scripts')
@endpush
