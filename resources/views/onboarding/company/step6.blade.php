@extends('layouts.app')

@section('title', 'Redes Sociais e Finalizar - VagaPet')

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

                <form class="default-form" action="{{ route('onboarding.step6.company.process') }}" method="post" enctype="multipart/form-data">
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

                    <!-- Fotos do Espaço -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Fotos do Espaço</label>
                      @if(session('onboarding.photos') && count(session('onboarding.photos')) > 0)
                        <div class="alert alert-info">
                          <i class="la la-info-circle"></i> {{ count(session('onboarding.photos')) }} foto(s) já enviada(s). Você pode adicionar mais (máximo 5 no total).
                        </div>
                      @endif
                      <div class="uploading-outer">
                        <div class="uploadButton">
                          <input class="uploadButton-input" type="file" name="photos[]" accept="image/*" id="upload-photos" multiple />
                          <label class="uploadButton-button ripple-effect" for="upload-photos">Adicionar fotos</label>
                          <span class="uploadButton-file-name"></span>
                        </div>
                        <div class="text">Tamanho máximo: 2MB por foto. Máximo de 5 fotos. Formatos: .jpg e .png</div>
                      </div>
                    </div>

                    <!-- Redes Sociais -->
                    <div class="form-group col-lg-12 col-md-12">
                      <h5 class="mb-3">Redes Sociais</h5>
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>LinkedIn</label>
                      <input type="text" name="linkedin" placeholder="www.linkedin.com/company/empresa" value="{{ old('linkedin', $step6Data['linkedin'] ?? '') }}">
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Instagram</label>
                      <input type="text" name="instagram" placeholder="instagram.com/empresa" value="{{ old('instagram', $step6Data['instagram'] ?? '') }}">
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Facebook</label>
                      <input type="text" name="facebook" placeholder="www.facebook.com/empresa" value="{{ old('facebook', $step6Data['facebook'] ?? '') }}">
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>YouTube</label>
                      <input type="text" name="youtube" placeholder="www.youtube.com/@empresa" value="{{ old('youtube', $step6Data['youtube'] ?? '') }}">
                    </div>

                  </div>

                  <!-- Área botão -->
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-12">
                      <a href="{{ route('onboarding.step5.company') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                    </div>
                    <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                      <button class="theme-btn btn-style-one text-white" type="submit">Finalizar Cadastro</button>
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
