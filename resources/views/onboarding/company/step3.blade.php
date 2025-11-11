@extends('layouts.app')

@section('title', 'Informações da Empresa - VagaPet')

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
                <h4>Informações da Empresa</h4>
              </div>

              <div class="widget-content">

                <!--Skill Item-->
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="50">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="50">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="default-form" action="{{ route('onboarding.step3.company.process') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  @if($errors->any())
                    <div class="alert alert-danger">
                      <ul class="mb-0">
                        @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <div class="row">

                    <!-- Upload de logo -->
                    <div class="uploading-outer">
                      <div class="uploadButton">
                        <input class="uploadButton-input" type="file" name="logo" accept="image/*" id="upload-logo" />
                        <label class="uploadButton-button ripple-effect" for="upload-logo">Subir logo</label>
                        <span class="uploadButton-file-name"></span>
                      </div>
                      <div class="text">Tamanho máximo do arquivo: 2MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                      @if(session('onboarding.logo'))
                        <small class="form-text text-success mt-2">
                          <i class="la la-check-circle"></i> Logo enviado com sucesso
                        </small>
                      @endif
                    </div>

                    <!-- Site -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Site</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br" value="{{ old('website', $step3Data['website'] ?? '') }}">
                    </div>

                    <!-- Equipe -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Quantidade de funcionários</label>
                      <select name="employees" class="chosen-select">
                        <option value="">Selecione</option>
                        <option value="ate4" {{ old('employees', isset($step3Data['employees']) ? $step3Data['employees'] : '') == 'ate4' ? 'selected' : '' }}>Até 4</option>
                        <option value="5a10" {{ old('employees', isset($step3Data['employees']) ? $step3Data['employees'] : '') == '5a10' ? 'selected' : '' }}>De 5 a 10</option>
                        <option value="11a20" {{ old('employees', isset($step3Data['employees']) ? $step3Data['employees'] : '') == '11a20' ? 'selected' : '' }}>De 11 a 20</option>
                        <option value="acima21" {{ old('employees', isset($step3Data['employees']) ? $step3Data['employees'] : '') == 'acima21' ? 'selected' : '' }}>Acima de 21</option>
                      </select>
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="description" placeholder="Fale sobre sua empresa, o que ela tem de diferente, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante.">{{ old('description', $step3Data['description'] ?? '') }}</textarea>
                    </div>

                  </div>

                  <!-- Área botão -->
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-12">
                      <a href="{{ route('onboarding.step2.company') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                    </div>
                    <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                      <button class="theme-btn btn-style-one text-white">Próximo</button>
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
