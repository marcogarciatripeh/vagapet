@extends('layouts.dashboard')

@section('title', 'Nova Vaga - VagaPet')

@section('content')
  <!-- Dashboard -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Publicar Nova Vaga</h3>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Detalhes</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('company.create-job.process') }}">
                  @csrf
                  <div class="row">
                    <!-- Input -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Título da Vaga</label>
                      <input type="text" name="title" placeholder="Título" required>
                    </div>

                    <!-- Descrição da Vaga -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição da Vaga</label>
                      <textarea name="description" placeholder="Estamos buscando um profissional para cuidar dos animais em um pet shop localizado em São Paulo. O candidato ideal deve ter experiência com cães e gatos, ser proativo, e estar disposto a aprender novas técnicas. O trabalho envolve banho e tosa, bem como atendimento ao cliente." required></textarea>
                    </div>

                    <!-- Tipo de contrato -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Tipo de contrato</label>
                      <select name="contract_type" class="chosen-select" required>
                        <option value="">Selecione</option>
                        <option value="CLT">CLT ou fixo</option>
                        <option value="Freelancer">Freelancer</option>
                        <option value="Temporário">Temporário</option>
                        <option value="Estágio">Estágio</option>
                      </select>
                    </div>

                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Remuneração</label>
                      <input type="text" name="salary" placeholder="Ex.: R$2500,00 por mês" required>
                    </div>

                    <!-- Input -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Carga horária</label>
                      <input type="text" name="workload" placeholder="Ex.: 44h por semana ou 8h por dia" required>
                    </div>

                    <!-- Benefícios -->
                    <!-- Seleção de Categorias -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Benefícios oferecidos</label>
                      <select data-placeholder="Categorias" name="benefits[]" class="chosen-select multiple" multiple tabindex="4">
                        <option value="VR">VR</option>
                        <option value="VT">VT</option>
                        <option value="Horaextra">Hora extra</option>
                        <option value="Comissao">Comissão</option>
                        <option value="insalubridade">Adicional de insalubridade</option>
                        <option value="Seguro de vida">Seguro de vida</option>
                        <option value="Bônus">Bônus</option>
                        <option value="Cesta básica">Cesta básica</option>
                        <option value="Assistência médica">Assistência médica</option>
                        <option value="Assistência odontológica">Assistência odontológica</option>
                      </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Experiência profissional buscada:</label>
                      <select name="experience_level" class="chosen-select" required>
                        <option value="">Selecione</option>
                        <option value="Todas">Todas</option>
                        <option value="Estágio">Estágio</option>
                        <option value="Junior">Junior (até 2 anos)</option>
                        <option value="Pleno">Pleno (de 2 a 5 anos)</option>
                        <option value="Sênior">Sênior (mais de 5 anos)</option>
                      </select>
                    </div>

                    <div class="form-group col-lg-6 col-md-12">
                      <label>Área de Atuação</label>
                      <select name="work_area" class="chosen-select" required>
                        <option value="">Selecione</option>
                        <option value="Adestramento">Adestramento</option>
                        <option value="Administrativo">Administrativo</option>
                        <option value="Banho e tosa">Banho e tosa</option>
                        <option value="Creche e hotel">Creche e hotel</option>
                        <option value="Enfermeiro, auxiliar ou técnico">Enfermeiro, auxiliar ou técnico</option>
                        <option value="Limpeza">Limpeza</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Motorista">Motorista</option>
                        <option value="Recepção">Recepção</option>
                        <option value="Serviços gerais">Serviços gerais</option>
                        <option value="Vendas">Vendas</option>
                        <option value="Veterinária">Veterinária</option>
                      </select>
                    </div>

                    <!-- Data Limite para Receber candidaturas -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Receber candidaturas até:</label>
                      <input type="date" name="application_deadline" required>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 text-right">
                      <button type="submit" class="theme-btn btn-style-one">Publicar Vaga</button>
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
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush

