@extends('layouts.app')

@section('title', 'Publicar Nova Vaga - VagaPet')

@section('content')
    <div class="page-wrapper dashboard">
        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- Cabeçalho Principal -->
        @include('layouts.partials.dashboard.header-company')
        <!-- Fim do Cabeçalho Principal -->

        <!-- Fundo da Barra Lateral -->
        <div class="sidebar-backdrop"></div>

        <!-- Barra Lateral do Usuário -->
        @include('layouts.partials.dashboard.sidebar-company')
        <!-- Fim da Barra Lateral do Usuário -->

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
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Título da Vaga</label>
                                                <input type="text" name="name" placeholder="Título">
                                            </div>
                                            <!-- Descrição da Vaga -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Descrição da Vaga</label>
                                                <textarea placeholder="Estamos buscando um profissional para cuidar dos animais em um pet shop localizado em São Paulo. O candidato ideal deve ter experiência com cães e gatos, ser proativo, e estar disposto a aprender novas técnicas. O trabalho envolve banho e tosa, bem como atendimento ao cliente."></textarea>
                                            </div>
                                            <!-- Tipo de contrato -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Tipo de contrato</label>
                                                <select class="chosen-select">
                                                    <option>Selecione</option>
                                                    <option>CLT ou fixo</option>
                                                    <option>Freelancer</option>
                                                    <option>Temporário</option>
                                                    <option>Estágio</option>
                                                </select>
                                            </div>
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Remuneração</label>
                                                <input type="text" name="name" placeholder="Ex.: R$2500,00 por mês">
                                            </div>
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Carga horária</label>
                                                <input type="text" name="name" placeholder="Ex.: 44h por semana ou 8h por dia">
                                            </div>
                                            <!-- Benefícios -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Benefícios oferecidos</label>
                                                <select data-placeholder="Categorias" class="chosen-select multiple" multiple tabindex="4">
                                                    <option value="VR">VR</option>
                                                    <option value="VT">VT</option>
                                                    <option value="Horaextra">Hora extra</option>
                                                    <option value="Comissao">Comissão</option>
                                                    <option value="insalubridade">Adicional de insalubridade</option>
                                                    <option value="insalubridade">Seguro de vida</option>
                                                    <option value="Bônus">Bônus</option>
                                                    <option value="Cesta básica">Cesta básica</option>
                                                    <option value="Cesta básica">Assistência médica</option>
                                                    <option value="Cesta básica">Assistência odontológica</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Experiência profissional buscada:</label>
                                                <select class="chosen-select">
                                                    <option>Selecione</option>
                                                    <option>Todas</option>
                                                    <option>Estágio</option>
                                                    <option>Junior (até 2 anos)</option>
                                                    <option>Pleno (de 2 a 5 anos)</option>
                                                    <option>Sênior (mais de 5 anos)</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Área de Atuação</label>
                                                <select class="chosen-select">
                                                    <option>Selecione</option>
                                                    <option>Adestramento</option>
                                                    <option>Administrativo</option>
                                                    <option>Banho e tosa</option>
                                                    <option>Creche e hotel</option>
                                                    <option>Enfermeiro, auxiliar ou técnico</option>
                                                    <option>Limpeza</option>
                                                    <option>Marketing</option>
                                                    <option>Motorista</option>
                                                    <option>Recepção</option>
                                                    <option>Serviços gerais</option>
                                                    <option>Vendas</option>
                                                    <option>Veterinária</option>
                                                </select>
                                            </div>
                                            <!-- Data Limite para Receber candidaturas -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Receber candidaturas até:</label>
                                                <input type="date" name="data-limite">
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12 text-right">
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
        <!-- Rodapé -->
        @include('layouts.partials.copyright')
        <!-- Fim do Rodapé -->
    </div>
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
@endpush
