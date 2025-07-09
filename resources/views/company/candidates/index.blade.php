@extends('layouts.app')

@section('title', 'Lista de Candidatos - VagaPet')

@section('content')
    <div class="page-wrapper dashboard">
        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Cabeçalho Principal -->
        @include('layouts.partials.dashboard.header-company')

        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- User Sidebar (Empresa) -->
        @include('layouts.partials.dashboard.sidebar-company')

        <!-- Dashboard Content -->
        <section class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Todos os Candidatos</h3>
                    <div class="text">Pronto para voltar ao trabalho?</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Candidatos</h4>
                                    <div class="chosen-outer">
                                        <!-- Selecione a Vaga -->
                                        <select class="chosen-select">
                                            <option>Selecione a Vaga</option>
                                            <option>Groomer Sênior Pet</option>
                                            <option>Recepcionista Pet Shop</option>
                                            <option>Auxiliar Veterinário</option>
                                            <option>Dog Walker / Pet Sitter</option>
                                            <option>Especialista em Banho/Tosa Estilizada</option>
                                        </select>
                                        <!-- Filtro de Status -->
                                        <select class="chosen-select">
                                            <option>Todos os Status</option>
                                            <option>Aprovado</option>
                                            <option>Rejeitado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="tabs-box">
                                        <div class="aplicants-upper-bar">
                                            <h6>Vaga: Groomer Sênior Pet</h6>
                                            <ul class="aplicantion-status tab-buttons clearfix">
                                                <li class="tab-btn active-btn totals" data-tab="#totals">
                                                    Total(s): 6
                                                </li>
                                                <li class="tab-btn approved" data-tab="#approved">
                                                    Aprovado(s): 2
                                                </li>
                                                <li class="tab-btn rejected" data-tab="#rejected">
                                                    Rejeitado(s): 4
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tabs-content">
                                            <!-- Aba Totals -->
                                            <div class="tab active-tab" id="totals">
                                                <div class="row">
                                                    <!-- Exemplo de Candidato 1 -->
                                                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">
                                                                <figure class="image">
                                                                    <img src="{{ asset('images/resource/candidate-1.png') }}" alt="Candidato 1">
                                                                </figure>
                                                                <h4 class="name"><a href="#">Maria da Silva</a></h4>
                                                                <ul class="candidate-info">
                                                                    <li class="designation">Banho e Tosa</li>
                                                                    <li>
                                                                        <span class="icon flaticon-map-locator"></span>
                                                                        São Paulo, SP
                                                                    </li>
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    <li><a href="#">Banho</a></li>
                                                                    <li><a href="#">Tosa</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li>
                                                                        <button data-text="Ver Candidatura">
                                                                            <span class="la la-eye"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Aprovar Candidatura">
                                                                            <span class="la la-check"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Rejeitar Candidatura">
                                                                            <span class="la la-times-circle"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Excluir Candidatura">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Exemplo de Candidato 2 -->
                                                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">
                                                                <figure class="image">
                                                                    <img src="{{ asset('images/resource/candidate-2.png') }}" alt="Candidato 2">
                                                                </figure>
                                                                <h4 class="name"><a href="#">João Nunes</a></h4>
                                                                <ul class="candidate-info">
                                                                    <li class="designation">Recepção / Atendimento</li>
                                                                    <li>
                                                                        <span class="icon flaticon-map-locator"></span>
                                                                        São Paulo, SP
                                                                    </li>
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    <li><a href="#">Recepção</a></li>
                                                                    <li><a href="#">Cliente</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li>
                                                                        <button data-text="Ver Candidatura">
                                                                            <span class="la la-eye"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Aprovar Candidatura">
                                                                            <span class="la la-check"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Rejeitar Candidatura">
                                                                            <span class="la la-times-circle"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Excluir Candidatura">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim Aba Totals -->
                                            <!-- Aba Approved -->
                                            <div class="tab" id="approved">
                                                <div class="row">
                                                    <!-- Exemplo Candidato Aprovado 1 -->
                                                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">
                                                                <figure class="image">
                                                                    <img src="{{ asset('images/resource/candidate-1.png') }}" alt="Candidato Aprovado 1">
                                                                </figure>
                                                                <h4 class="name"><a href="#">Daniela Ramos</a></h4>
                                                                <ul class="candidate-info">
                                                                    <li class="designation">Groomer Estilizada</li>
                                                                    <li>
                                                                        <span class="icon flaticon-map-locator"></span>
                                                                        São Paulo, SP
                                                                    </li>
                                                                    <li>
                                                                        <span class="icon flaticon-money"></span>
                                                                        R$ 30 / hora
                                                                    </li>
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    <li><a href="#">Banho</a></li>
                                                                    <li><a href="#">Tosa</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li>
                                                                        <button data-text="Ver Candidatura">
                                                                            <span class="la la-eye"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Aprovar Candidatura">
                                                                            <span class="la la-check"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Rejeitar Candidatura">
                                                                            <span class="la la-times-circle"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Excluir Candidatura">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Exemplo Candidato Aprovado 2 -->
                                                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">
                                                                <figure class="image">
                                                                    <img src="{{ asset('images/resource/candidate-2.png') }}" alt="Candidato Aprovado 2">
                                                                </figure>
                                                                <h4 class="name"><a href="#">Carlos Eduardo</a></h4>
                                                                <ul class="candidate-info">
                                                                    <li class="designation">Auxiliar Veterinário</li>
                                                                    <li>
                                                                        <span class="icon flaticon-map-locator"></span>
                                                                        Rio de Janeiro, RJ
                                                                    </li>
                                                                    <li>
                                                                        <span class="icon flaticon-money"></span>
                                                                        R$ 2.500 / mês
                                                                    </li>
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    <li><a href="#">Vet</a></li>
                                                                    <li><a href="#">Cuidados</a></li>
                                                                    <li><a href="#">Pets</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li>
                                                                        <button data-text="Ver Candidatura">
                                                                            <span class="la la-eye"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Aprovar Candidatura">
                                                                            <span class="la la-check"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Rejeitar Candidatura">
                                                                            <span class="la la-times-circle"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Excluir Candidatura">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim Aba Approved -->
                                            <!-- Aba Rejected -->
                                            <div class="tab" id="rejected">
                                                <div class="row">
                                                    <!-- Exemplo Candidato Rejeitado 1 -->
                                                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">
                                                                <figure class="image">
                                                                    <img src="{{ asset('images/resource/candidate-3.png') }}" alt="Candidato Rejeitado 1">
                                                                </figure>
                                                                <h4 class="name">
                                                                    <a href="#">Paulo Mendes</a>
                                                                </h4>
                                                                <ul class="candidate-info">
                                                                    <li class="designation">Vendas Pet Shop</li>
                                                                    <li>
                                                                        <span class="icon flaticon-map-locator"></span>
                                                                        Curitiba, PR
                                                                    </li>
                                                                    <li>
                                                                        <span class="icon flaticon-money"></span>
                                                                        R$ 2.200 / mês
                                                                    </li>
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    <li><a href="#">Vendas</a></li>
                                                                    <li><a href="#">Atendimento</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li>
                                                                        <button data-text="Ver Candidatura">
                                                                            <span class="la la-eye"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Aprovar Candidatura">
                                                                            <span class="la la-check"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Rejeitar Candidatura">
                                                                            <span class="la la-times-circle"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button data-text="Excluir Candidatura">
                                                                            <span class="la la-trash"></span>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Exemplo Candidato Rejeitado 2 -->
                                                    <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                                                        <div class="inner-box">
                                                            <div class="content">
                                                                <figure class="image">
                                                                    <img src="{{ asset('images/resource/candidate-1.png') }}" alt="Candidato Rejeitado 2">
                                                                </figure>
                                                                <h4 class="name">
                                                                    <a href="#">Larissa Santos</a>
                                                                </h4>
                                                                <ul class="candidate-info">
                                                                    <li class="designation">Pet Walker</li>
                                                                    <li>
                                                                        <span class="icon flaticon-map-locator"></span>
                                                                        São Paulo, SP
                                                                    </li>
                                                                    <li>
                                                                        <span class="icon flaticon-money"></span>
                                                                        R$ 1.500 / mês
                                                                    </li>
                                                                </ul>
                                                                <ul class="post-tags">
                                                                    <li><a href="#">Passeios</a></li>
                                                                    <li><a href="#">Pets</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li><button data-text="Ver Candidatura"><span class="la la-eye"></span></button></li>
                                                                    <li><button data-text="Aprovar Candidatura"><span class="la la-check"></span></button></li>
                                                                    <li><button data-text="Rejeitar Candidatura"><span class="la la-times-circle"></span></button></li>
                                                                    <li><button data-text="Excluir Candidatura"><span class="la la-trash"></span></button></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim Aba Rejected -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Fim widget-content -->
                            </div>
                            <!-- Fim tabs-box -->
                        </div>
                        <!-- Fim ls-widget -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.partials.copyright')
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
@endpush
