@extends('layouts.app')

@section('title', 'Portfólio e Localização - VagaPet')

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
                      <div class="bar progress-line" data-width="71">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="71">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="default-form" action="{{ route('onboarding.step6.professional.process') }}" method="post">
                  @csrf
                  <div class="row">

                    <!-- Ls widget (Seção Experiência Profissional) -->
                    <div class="ls-widget">
                      <div class="tabs-box">
                        <div class="widget-title">
                          <h4>Portfólio e localização</h4>
                        </div>

                        <div class="widget-content">
                          <div class="row">

                            <!-- Portfólio -->
                            <div class="form-group col-lg-6 col-md-12">
                              <div class="uploading-outer">
                                <div class="uploadButton">
                                  <input class="uploadButton-input" type="file"
                                    name="attachments[]" accept="image/*, application/pdf"
                                    id="upload" multiple />
                                  <label class="uploadButton-button ripple-effect" for="upload">
                                    Adicionar Portfólio
                                  </label>
                                  <span class="uploadButton-file-name"></span>
                                </div>
                              </div>
                            </div>

                            <!-- Endereço Completo -->
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Endereço Completo (não será divulgado)*</label>
                              <input type="text" name="address" placeholder="Rua Exemplo, 123, Bairro, Cidade - Estado">
                            </div>

                            <!-- Encontrar no Mapa - Bairro -->
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Bairro e cidade (aparece no mapa)*</label>
                              <input type="text" name="map" placeholder="Vila Clementina, São Paulo - SP">
                            </div>

                            <!-- Mapa -->
                            <div class="form-group col-lg-12 col-md-12">
                              <div class="map-outer">
                                <div class="map-canvas map-height" data-zoom="12"
                                  data-lat="-23.550520" data-lng="-46.633308"
                                  data-type="roadmap" data-hue="#ffc400"
                                  data-title="Localização"
                                  data-icon-path="images/resource/map-marker.png"
                                  data-content="São Paulo - SP, Brasil<br><a href='mailto:info@meuservicos.com'>info@meuservicos.com</a>">
                                </div>
                              </div>
                            </div>

                          </div>

                          <!-- Área botão -->
                          <div class="row">
                            <div class="form-group col-lg-6 col-md-12">
                              <a href="{{ route('onboarding.step5.professional') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                            </div>
                            <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                              <button class="theme-btn btn-style-one text-white">Próximo</button>
                            </div>
                          </div>
                          <!-- Fim área botão -->
                        </div>
                      </div>
                    </div>
                    <!-- Fim Ls widget -->

                  </div>
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
