@extends('layouts.app')

@section('title', 'Profissionais Favoritos - VagaPet')

@section('content')
    <div class="page-wrapper dashboard">
        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Header Span -->
        <span class="header-span"></span>

        <!-- Cabeçalho Principal -->
        @include('layouts.partials.dashboard.header-company')

        <!-- Sidebar Backdrop -->
        <div class="sidebar-backdrop"></div>

        <!-- User Sidebar -->
        @include('layouts.partials.dashboard.sidebar-company')

        <!-- Dashboard -->
        <section class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Profissionais favoritos</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Ls widget (Lista de Profissionais Favoritos) -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Lista</h4>
                                    <div class="chosen-outer">
                                        <select class="chosen-select">
                                            <option>Últimos 6 meses</option>
                                            <option>Últimos 12 meses</option>
                                            <option>Últimos 16 meses</option>
                                            <option>Últimos 24 meses</option>
                                            <option>Últimos 5 anos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="row">
                                        <!-- Exemplo de Bloco de Profissional -->
                                        <div class="job-block col-lg-12 col-md-12 col-sm-12">
                                            <div class="inner-box">
                                                <div class="content">
                                                    <span class="company-logo">
                                                        <img src="images/resource/company-logo/1-1.png" alt="">
                                                    </span>
                                                    <h4><a href="profissional-pagina.php">Groomer Especialista em Tosa</a></h4>
                                                    <ul class="job-info">
                                                        <li><span class="icon flaticon-briefcase"></span> Pet4U</li>
                                                        <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                                                        <li><span class="icon flaticon-clock-3"></span> 4 horas atrás</li>
                                                        <li><span class="icon flaticon-money"></span> R$ 2.500 - R$ 3.500</li>
                                                    </ul>
                                                    <ul class="job-other-info">
                                                        <li class="time">Tempo Integral</li>
                                                        <li class="required">Banho e tosa</li>
                                                        <li class="required">Urgente</li>
                                                    </ul>
                                                    <button class="bookmark-btn">
                                                        <span class="flaticon-bookmark"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Outro Exemplo de Profissional -->
                                        <div class="job-block col-lg-12 col-md-12 col-sm-12">
                                            <div class="inner-box">
                                                <div class="content">
                                                    <span class="company-logo">
                                                        <img src="images/resource/company-logo/1-2.png" alt="">
                                                    </span>
                                                    <h4><a href="profissional-pagina.php">Recepcionista de Pet Shop</a></h4>
                                                    <ul class="job-info">
                                                        <li><span class="icon flaticon-briefcase"></span> Amigão PetShop</li>
                                                        <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                                                        <li><span class="icon flaticon-clock-3"></span> 6 horas atrás</li>
                                                        <li><span class="icon flaticon-money"></span> R$ 2.000 - R$ 2.500</li>
                                                    </ul>
                                                    <ul class="job-other-info">
                                                        <li class="time">Meio Período</li>
                                                        <li class="required">Creche e Hotel</li>
                                                    </ul>
                                                    <button class="bookmark-btn">
                                                        <span class="flaticon-bookmark"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Outro Exemplo de Profissional -->
                                        <div class="job-block col-lg-12 col-md-12 col-sm-12">
                                            <div class="inner-box">
                                                <div class="content">
                                                    <span class="company-logo">
                                                        <img src="images/resource/company-logo/1-3.png" alt="">
                                                    </span>
                                                    <h4><a href="profissional-pagina.php">Auxiliar Veterinário(a)</a></h4>
                                                    <ul class="job-info">
                                                        <li><span class="icon flaticon-briefcase"></span> Clínica AnimalCare</li>
                                                        <li><span class="icon flaticon-map-locator"></span> Rio de Janeiro, RJ</li>
                                                        <li><span class="icon flaticon-clock-3"></span> 1 dia atrás</li>
                                                        <li><span class="icon flaticon-money"></span> R$ 2.500 - R$ 3.000</li>
                                                    </ul>
                                                    <ul class="job-other-info">
                                                        <li class="time">Temporário</li>
                                                        <li class="required">Banho e tosa</li>
                                                        <li class="required">Urgente</li>
                                                    </ul>
                                                    <button class="bookmark-btn">
                                                        <span class="flaticon-bookmark"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Outro Exemplo de Profissional -->
                                        <div class="job-block col-lg-12 col-md-12 col-sm-12">
                                            <div class="inner-box">
                                                <div class="content">
                                                    <span class="company-logo">
                                                        <img src="images/resource/company-logo/1-4.png" alt="">
                                                    </span>
                                                    <h4><a href="profissional-pagina.php">Dog Walker / Pet Sitter</a></h4>
                                                    <ul class="job-info">
                                                        <li><span class="icon flaticon-briefcase"></span> PetLovers</li>
                                                        <li><span class="icon flaticon-map-locator"></span> Belo Horizonte, MG</li>
                                                        <li><span class="icon flaticon-clock-3"></span> 2 dias atrás</li>
                                                        <li><span class="icon flaticon-money"></span> R$ 1.500 - R$ 2.000</li>
                                                    </ul>
                                                    <ul class="job-other-info">
                                                        <li class="time">Freelance</li>
                                                        <li class="required">Adestramento</li>
                                                    </ul>
                                                    <button class="bookmark-btn">
                                                        <span class="flaticon-bookmark"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Mostrar Mais Resultados -->
                                    <div class="ls-show-more">
                                        <p>Exibindo 4 de 50 Profissionais</p>
                                        <div class="bar">
                                            <span class="bar-inner" style="width: 40%"></span>
                                        </div>
                                        <button class="show-more">Mostrar Mais</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Ls widget -->
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
