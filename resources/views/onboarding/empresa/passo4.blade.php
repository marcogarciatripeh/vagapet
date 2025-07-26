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
                      <div class="bar progress-line" data-width="75">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="75">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="default-form" method="POST" action="{{ route('onboarding.empresa.passo4.post') }}">
                  @csrf
                  <div class="row">
                    <div class="ls-widget">
                      <div class="tabs-box">
                        <div class="widget-title">
                          <h4>Espaço e localização</h4>
                        </div>
                        <div class="widget-content">
                          <div class="row">
                            <div class="form-group col-lg-12 col-md-12">
                              <div class="uploading-outer">
                                <div class="uploadButton">
                                  <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                                  <label class="uploadButton-button ripple-effect" for="upload">Fotos do espaço</label>
                                  <span class="uploadButton-file-name"></span>
                                </div>
                                 <div class="text">Tamanho máximo dos arquivos: 1MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                              </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Endereço Completo (aparece no mapa)*</label>
                              <input type="text" name="address" placeholder="Rua Exemplo, 123, Bairro, Cidade - Estado">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Bairro e cidade</label>
                              <input type="text" name="map" placeholder="Vila Clementina, São Paulo - SP">
                            </div>
                            <div class="form-group col-lg-12 col-md-12">
                              <div class="map-outer">
                                <div class="map-canvas map-height" data-zoom="12" data-lat="-23.550520" data-lng="-46.633308" data-type="roadmap" data-hue="#ffc400" data-title="Localização" data-icon-path="images/resource/map-marker.png" data-content="São Paulo - SP, Brasil&lt;br&gt;<a href='mailto:info@meuservicos.com'>info@meuservicos.com</a>"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6">
                      <a href="{{ route('onboarding.empresa.passo3') }}" class="theme-btn btn-style-one">Voltar</a>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 text-right">
                      <button class="theme-btn btn-style-one pull-right" type="submit">Próximo</button>
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
