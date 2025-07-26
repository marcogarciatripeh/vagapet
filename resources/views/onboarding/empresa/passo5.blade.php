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
    <div class="dashboard-outer col-lg-10 mt-30">
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
                      <div class="bar progress-line" data-width="100">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="100">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="ls-widget">
                    <div class="tabs-box">
                      <div class="widget-title">
                        <h4>Redes Sociais</h4>
                        <p>Coloque o endereço das redes sociais da sua empresa.</p>
                      </div>
                      <div class="widget-content">
                        <form class="default-form" method="POST" action="{{ route('onboarding.empresa.passo5.post') }}">
                          @csrf
                          <div class="row">
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Instagram</label>
                              <input type="text" name="instagram" placeholder="@dogsLove">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                              <label>YouTube</label>
                              <input type="text" name="youtube" placeholder="/DogsLove">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                              <label>TikTok</label>
                              <input type="text" name="tiktok" placeholder="/DogsLove">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Facebook</label>
                              <input type="text" name="facebook" placeholder="@DogsLove">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                              <a href="{{ route('onboarding.empresa.passo4') }}" class="theme-btn btn-style-one">Voltar</a>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 text-right">
                              <button class="theme-btn btn-style-one pull-right" type="submit">Finalizar</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
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
