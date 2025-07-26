@extends('layouts.app')

@section('title', 'Informações do Profissional - VagaPet')

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
                <h4>Perfil Profissional</h4>
              </div>

              <div class="widget-content">

                <!--Skill Item-->
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="28">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="28">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="default-form" action="{{ route('onboarding.step3.professional.process') }}" method="post">
                  @csrf
                  <div class="row">
                    <!-- Upload de foto -->
                    <div class="uploading-outer">
                      <div class="uploadButton">
                        <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                        <label class="uploadButton-button ripple-effect" for="upload">Subir foto de perfil</label>
                        <span class="uploadButton-file-name"></span>
                      </div>
                      <div class="text">Tamanho máximo do arquivo: 1MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                      <label>Título profissional</label>
                      <input type="text" name="title" placeholder="Ex.: Banhista, tosador, monitor de creche, etc">
                    </div>

                    <!-- Experiência -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Experiência profissional</label>
                      <select name="experience" class="chosen-select">
                        <option value="">Selecione</option>
                        <option value="estagio">Estágio</option>
                        <option value="junior">Junior (até 2 anos)</option>
                        <option value="pleno">Pleno (de 3 a 5 anos)</option>
                        <option value="senior">Sênior (mais de 5 anos)</option>
                      </select>
                    </div>

                    <!-- Área de trabalho -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Área de trabalho*</label>
                      <p>Você pode incluir mais de uma opção</p>
                      <select data-placeholder="Escolha" name="work_areas[]" class="chosen-select multiple" multiple tabindex="4">
                        <option value="BanhoTosa">Banho & Tosa</option>
                        <option value="Recepcao">Recepção</option>
                        <option value="Vendas">Vendas</option>
                        <option value="Veterinario">Veterinário</option>
                        <option value="AuxiliarVeterinario">Auxiliar Veterinário</option>
                        <option value="Limpeza">Limpeza</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Estoque">Estoque</option>
                        <option value="Motorista">Motorista</option>
                      </select>
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="description" placeholder="Fale sobre você, sua experiência, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante."></textarea>
                    </div>
                  </div>

                  <!-- Área botão -->
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-12">
                      <a href="{{ route('onboarding.step2.professional') }}" class="theme-btn btn-style-one text-white">Voltar</a>
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
