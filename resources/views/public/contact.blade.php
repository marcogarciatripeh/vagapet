@extends('layouts.app')

@section('title', 'Contato - VagaPet')

@section('content')
<div class="page-wrapper dashboard">
  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Contato) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Contato</h3>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Quer falar com a gente?</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('contact.send') }}">
                  @csrf
                  <div class="row">

                    <!-- Assunto -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Assunto*</label>
                      <input type="text" name="subject" placeholder="Escreva o assunto." required>
                    </div>

                    <!-- Mensagem -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Mensagem*</label>
                      <textarea name="message" placeholder="Escreva sua mensagem aqui." required></textarea>
                    </div>

                    <!-- Botão Enviar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-one" type="submit">Enviar</button>
                    </div>
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
  <!-- Fim Painel (Contato) -->

  <!-- Rodapé -->
  @include('layouts.partials.footer')
  <!-- Fim do Rodapé -->
</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
  @include('layouts.partials.scripts')
@endpush
