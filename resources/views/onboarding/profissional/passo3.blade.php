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
                      <div class="bar progress-line" data-width="40">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="40">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="default-form" method="POST" action="{{ route('onboarding.profissional.passo3.post') }}">
                  @csrf
                  <div class="row">
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
                      <input type="text" name="titulo" placeholder="Ex.: Banhista, tosador, monitor de creche, etc">
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Experiência profissional</label>
                      <select class="chosen-select" name="experiencia">
                        <option>Selecione</option>
                        <option>Estágio</option>
                        <option>Junior (até 2 anos)</option>
                        <option>Pleno (de 3 a 5 anos)</option>
                        <option>Sênior (mais de 5 anos)</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Área de trabalho*</label>
                      <p>Você pode incluir mais de uma opção</p>
                      <select data-placeholder="Escolha" class="chosen-select multiple" name="area[]" multiple tabindex="4">
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
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="descricao" placeholder="Fale sobre você, sua experiência, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante."></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6">
                      <a href="{{ route('onboarding.profissional.passo2') }}" class="theme-btn btn-style-one">Voltar</a>
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
