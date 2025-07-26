@extends('layouts.app')

@section('title', 'Perfil da Empresa - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Painel de Perfil da Empresa -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Perfil da Empresa</h3>
        <div class="text">Gerencie as informações da sua empresa.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Informações da Empresa</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" action="{{ route('company.profile.update') }}" method="POST">
                  @csrf
                  <div class="row">

                    <!-- Nome da Empresa -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Nome da Empresa*</label>
                      <input type="text" name="company_name" placeholder="Nome da empresa" value="{{ old('company_name', 'Dogs, Cats and Love') }}" required>
                    </div>

                    <!-- CNPJ -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>CNPJ*</label>
                      <input type="text" name="cnpj" placeholder="00.000.000/0000-00" value="{{ old('cnpj', '12.345.678/0001-90') }}" required>
                    </div>

                    <!-- E-mail -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>E-mail*</label>
                      <input type="email" name="email" placeholder="contato@empresa.com" value="{{ old('email', 'contato@dogsandcats.com') }}" required>
                    </div>

                    <!-- Telefone -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Telefone*</label>
                      <input type="text" name="phone" placeholder="(11) 98765-4321" value="{{ old('phone', '(11) 98765-4321') }}" required>
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

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição da Empresa</label>
                      <textarea name="description" placeholder="Descreva sua empresa...">{{ old('description', 'Empresa especializada em produtos e serviços para pets.') }}</textarea>
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
  <!-- End Painel de Perfil da Empresa -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
