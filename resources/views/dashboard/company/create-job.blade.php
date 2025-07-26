@extends('layouts.app')

@section('title', 'Nova Vaga - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Painel de Nova Vaga -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Nova Vaga</h3>
        <div class="text">Crie uma nova vaga para sua empresa.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Informações da Vaga</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" action="{{ route('company.jobs.store') }}" method="POST">
                  @csrf
                  <div class="row">

                    <!-- Título da Vaga -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Título da Vaga*</label>
                      <input type="text" name="title" placeholder="Ex: Atendente de Banho e Tosa" required>
                    </div>

                    <!-- Categoria -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Categoria*</label>
                      <select class="chosen-select" name="category" required>
                        <option value="">Selecione uma categoria</option>
                        <option value="banho-tosa">Banho e Tosa</option>
                        <option value="vendas">Vendas</option>
                        <option value="veterinaria">Veterinária</option>
                        <option value="administrativo">Administrativo</option>
                        <option value="servicos-gerais">Serviços Gerais</option>
                      </select>
                    </div>

                    <!-- Tipo de Contrato -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Tipo de Contrato*</label>
                      <select class="chosen-select" name="contract_type" required>
                        <option value="">Selecione o tipo</option>
                        <option value="clt">CLT</option>
                        <option value="pj">PJ</option>
                        <option value="freelancer">Freelancer</option>
                        <option value="estagio">Estágio</option>
                      </select>
                    </div>

                    <!-- Salário -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Faixa Salarial</label>
                      <input type="text" name="salary" placeholder="Ex: R$ 1.800 - R$ 2.200">
                    </div>

                    <!-- Localização -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Localização*</label>
                      <input type="text" name="location" placeholder="Ex: São Paulo, SP" required>
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição da Vaga*</label>
                      <textarea name="description" placeholder="Descreva as atividades, responsabilidades e requisitos da vaga..." required></textarea>
                    </div>

                    <!-- Requisitos -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Requisitos</label>
                      <textarea name="requirements" placeholder="Liste os requisitos para a vaga..."></textarea>
                    </div>

                    <!-- Benefícios -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Benefícios</label>
                      <textarea name="benefits" placeholder="Liste os benefícios oferecidos..."></textarea>
                    </div>

                    <!-- Data de Expiração -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Data de Expiração</label>
                      <input type="date" name="expiry_date">
                    </div>

                    <!-- Botão Publicar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-one">Publicar Vaga</button>
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
  <!-- End Painel de Nova Vaga -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
