@extends('layouts.app')

@section('title', 'Meu Perfil - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-professional')
  <!-- End Main Header -->

  <!-- Painel de Perfil -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Meu Perfil</h3>
        <div class="text">Gerencie suas informações pessoais e profissionais.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Informações Pessoais</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" action="{{ route('professional.profile.update') }}" method="POST">
                  @csrf
                  <div class="row">

                    <!-- Nome Completo -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Nome Completo*</label>
                      <input type="text" name="name" placeholder="Seu nome completo" value="{{ old('name', 'João Silva') }}" required>
                    </div>

                    <!-- E-mail -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>E-mail*</label>
                      <input type="email" name="email" placeholder="seu@email.com" value="{{ old('email', 'joao@email.com') }}" required>
                    </div>

                    <!-- Telefone -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Telefone*</label>
                      <input type="text" name="phone" placeholder="(11) 98765-4321" value="{{ old('phone', '(11) 98765-4321') }}" required>
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Data de Nascimento</label>
                      <input type="date" name="birth_date" value="{{ old('birth_date', '1990-01-01') }}">
                    </div>

                    <!-- Endereço -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Endereço</label>
                      <input type="text" name="address" placeholder="Rua Exemplo, 123" value="{{ old('address', 'Rua das Flores, 123') }}">
                    </div>

                    <!-- Cidade e Estado -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Cidade</label>
                      <input type="text" name="city" placeholder="São Paulo" value="{{ old('city', 'São Paulo') }}">
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Estado</label>
                      <input type="text" name="state" placeholder="SP" value="{{ old('state', 'SP') }}">
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-one">Salvar Alterações</button>
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
  <!-- End Painel de Perfil -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
