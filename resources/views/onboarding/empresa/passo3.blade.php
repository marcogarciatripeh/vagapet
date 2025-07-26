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
                      <div class="bar progress-line" data-width="50">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="50">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="default-form" method="POST" action="{{ route('onboarding.empresa.passo3.post') }}">
                  @csrf
                  <div class="row">
                    <div class="uploading-outer">
                      <div class="uploadButton">
                        <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                        <label class="uploadButton-button ripple-effect" for="upload">Subir logo</label>
                        <span class="uploadButton-file-name"></span>
                      </div>
                      <div class="text">Tamanho máximo do arquivo: 1MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Site</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br">
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Quantidade de funcionários</label>
                      <select class="chosen-select" name="equipe">
                        <option>Selecione</option>
                        <option>Até 4</option>
                        <option>De 5 a 10</option>
                        <option>De 11 a 20</option>
                        <option>Acima de 21</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="descricao" placeholder="Fale sobre sua empresa, o que ela tem de diferente, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante."></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6">
                      <a href="{{ route('onboarding.empresa.passo2') }}" class="theme-btn btn-style-one">Voltar</a>
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
