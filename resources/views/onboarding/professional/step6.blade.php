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

                <form class="default-form" action="{{ route('onboarding.step6.professional.process') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <div class="row">

                    <!-- Ls widget (Seção Localização) -->
                    <div class="ls-widget">
                      <div class="tabs-box">
                        <div class="widget-title">
                          <h4>Localização</h4>
                        </div>

                        <div class="widget-content">
                          <div class="row">

                            <!-- Endereço Completo -->
                            <div class="form-group col-lg-12 col-md-12 mb-3">
                              <label>Endereço Completo (não será divulgado) *</label>
                              <input type="text" name="address" placeholder="Rua Exemplo, 123" required
                                     value="{{ old('address', session('onboarding.step6_data.address')) }}" class="form-control">
                            </div>

                            <!-- Bairro (Complemento) -->
                            <div class="form-group col-lg-6 col-md-12 mb-3">
                              <label>Bairro (Complemento)</label>
                              <input type="text" name="neighborhood" placeholder="Vila Clementina"
                                     value="{{ old('neighborhood', session('onboarding.step6_data.neighborhood')) }}" class="form-control">
                            </div>

                            <!-- Cidade -->
                            <div class="form-group col-lg-6 col-md-12 mb-3">
                              <label>Cidade *</label>
                              <input type="text" name="city" placeholder="São Paulo" required
                                     value="{{ old('city', session('onboarding.step6_data.city')) }}" class="form-control">
                            </div>

                            <!-- Estado -->
                            <div class="form-group col-lg-4 col-md-12 mb-3">
                              <label>Estado (UF) *</label>
                              <select name="state" required class="form-control chosen-select">
                                <option value="">Selecione o estado</option>
                                @foreach($states as $code => $name)
                                  <option value="{{ $code }}" {{ old('state', $step6Data['state'] ?? '') == $code ? 'selected' : '' }}>
                                    {{ $code }} - {{ $name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>

                            <!-- CEP -->
                            <div class="form-group col-lg-4 col-md-12 mb-3">
                              <label>CEP *</label>
                              <input type="text" name="zip_code" id="zip_code" placeholder="01234-567" required
                                     value="{{ old('zip_code', session('onboarding.step6_data.zip_code')) }}" class="form-control">
                            </div>

                            <!-- Campos ocultos para latitude e longitude -->
                            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', session('onboarding.step6_data.latitude', -23.550520)) }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', session('onboarding.step6_data.longitude', -46.633308)) }}">

                          </div>

                          <!-- Mapa do Google Maps -->
                          <div class="form-group col-lg-12 col-md-12 mb-3">
                            <label>Localização no Mapa</label>
                            <div id="map-canvas" style="width: 100%; height: 400px; border: 1px solid #ddd; border-radius: 4px;"></div>
                            <small class="form-text text-muted">O mapa será atualizado automaticamente quando você preencher o endereço ou CEP.</small>
                          </div>

                          <!-- Área botão -->
                          <div class="row mt-4">
                            <div class="form-group col-lg-6 col-md-12">
                              <a href="{{ route('onboarding.step5.professional') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                            </div>
                            <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                              <button type="submit" class="theme-btn btn-style-one text-white">Próximo</button>
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

@push('styles')
<link rel="stylesheet" href="{{ asset('css/onboarding-improvements.css') }}">
@endpush

@push('scripts')
@include('layouts.partials.scripts')
<script src="{{ asset('js/address-map.js') }}"></script>
@endpush
