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

                <form class="default-form" action="{{ route('onboarding.step3.company.process') }}" method="post">
                  @csrf
                  <div class="row">

                    <!-- Upload de foto -->
                    <div class="uploading-outer">
                      <div class="uploadButton">
                        <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                        <label class="uploadButton-button ripple-effect" for="upload">Subir logo</label>
                        <span class="uploadButton-file-name"></span>
                      </div>
                      <div class="text">Tamanho máximo do arquivo: 1MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                    </div>

                    <!-- Site -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Site</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br">
                    </div>

                    <!-- Equipe -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Quantidade de funcionários</label>
                      <select name="employees" class="chosen-select">
                        <option value="">Selecione</option>
                        <option value="ate4">Até 4</option>
                        <option value="5a10">De 5 a 10</option>
                        <option value="11a20">De 11 a 20</option>
                        <option value="acima21">Acima de 21</option>
                      </select>
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="description" placeholder="Fale sobre sua empresa, o que ela tem de diferente, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante."></textarea>
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
