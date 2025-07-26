@extends('layouts.app')

@section('title', 'Ajuda - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Ajuda) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Ajuda</h3>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Como podemos te ajudar?</h4>
              </div>

              <div class="widget-content">

                <form class="default-form" action="{{ route('help.send') }}" method="POST">
                  @csrf
                  <div class="row">

                    <!-- Assunto -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Assunto*</label>
                      <input type="text" name="subject" placeholder="Ex.: Dificuldade técnica" required>
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição*</label>
                      <textarea name="description" placeholder="Descreva brevemente como o que podemos ajudar." required></textarea>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-one">Enviar</button>
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
  <!-- Fim Painel (Ajuda) -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
