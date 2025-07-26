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
  <section class="order-confirmation">
    <div class="auto-container">
      <div class="upper-box text-center">
        <span class="icon fa fa-check text-white bg-primary"></span>
        <h4>Seu perfil foi concluído com sucesso!</h4>
        <div class="text">Obrigado! Agora você pode aproveitar a plataforma.</div>
      </div>
    </div>
  </section>
  <div class="row">
    <div class="form-group col-lg-12 col-md-12 text-center mb-50">
      <form method="POST" action="{{ route('onboarding.profissional.passo7.post') }}">
        @csrf
        <button class="theme-btn btn-style-one">Encontrar vaga</button>
      </form>
    </div>
  </div>
  @include('layouts.partials.copyright')
</div>
@endsection
@push('scripts')
@include('layouts.partials.scripts')
@endpush
