@extends('layouts.app')

@section('title', 'Perfil da Empresa - VagaPet')

@section('content')
    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Cabeçalho Principal -->
    @include('layouts.partials.dashboard.header-company')

    <!-- Seção de Detalhes da Empresa -->
    <section class="candidate-detail-section style-three">
        <!-- Box Superior -->
        <div class="upper-box">
            <div class="auto-container">
                <!-- Bloco da Empresa -->
                <div class="job-block-seven style-three">
                    <div class="inner-box">
                        <figure class="image">
                            <img src="{{ asset('images/resource/candidate-4.png') }}" alt="Logotipo Dogs, Cats & Love">
                        </figure>
                        <h4 class="name"><a href="#">Dogs, Cats & Love</a></h4>
                        <div class="btn-box">
                            <a href="#" type="button" class="theme-btn btn-style-one position-relative">
                                Ver vagas abertas: 3
                            </a>
                            <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
                        </div>
                        <div class="content">
                            <!-- poderia vir um resumo curto aqui -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="candidate-detail-outer">
            <div class="auto-container">
                <div class="row">
                    <!-- Conteúdo Principal -->
                    <div class="content-column col-lg-8 col-md-12 order-2">
                        <div class="job-detail">
                            <h4>Perfil da Empresa</h4>
                            <p>A <strong>Dogs, Cats & Love</strong> é um pet shop completo em São Bernardo do Campo, com mais de 10 anos de tradição no cuidado de cães e gatos. Oferecemos:</p>
                            <ul>
                                <li>Banho e Tosa com produtos de qualidade;</li>
                                <li>Day Care com espaço climatizado e recreação;</li>
                                <li>Hotelzinho com acompanhamento 24h;</li>
                                <li>Adestramento básico e avançado.</li>
                            </ul>
                            <p></p>
                            <p>Nosso time de groomers é formado por profissionais certificados, treinados em primeiros socorros e técnicas de bem-estar animal.</p>
                            <!-- Portfólio -->
                            <div class="portfolio-outer">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <figure class="image">
                                            <a href="{{ asset('images/resource/pet-portfolio-1.jpg') }}" class="lightbox-image">
                                                <img src="{{ asset('images/resource/pet-portfolio-1.jpg') }}" alt="Banho e Tosa">
                                            </a>
                                            <span class="icon flaticon-plus"></span>
                                        </figure>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <figure class="image">
                                            <a href="{{ asset('images/resource/pet-portfolio-2.jpg') }}" class="lightbox-image">
                                                <img src="{{ asset('images/resource/pet-portfolio-2.jpg') }}" alt="Day Care">
                                            </a>
                                            <span class="icon flaticon-plus"></span>
                                        </figure>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <figure class="image">
                                            <a href="{{ asset('images/resource/pet-portfolio-3.jpg') }}" class="lightbox-image">
                                                <img src="{{ asset('images/resource/pet-portfolio-3.jpg') }}" alt="Hotelzinho">
                                            </a>
                                            <span class="icon flaticon-plus"></span>
                                        </figure>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <figure class="image">
                                            <a href="{{ asset('images/resource/pet-portfolio-4.jpg') }}" class="lightbox-image">
                                                <img src="{{ asset('images/resource/pet-portfolio-4.jpg') }}" alt="Adestramento">
                                            </a>
                                            <span class="icon flaticon-plus"></span>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <!-- Vídeo Institucional -->
                            <div class="video-outer">
                                <h4>Vídeo Institucional</h4>
                                <div class="video-box">
                                    <figure class="image">
                                        <a href="https://www.youtube.com/watch?v=Fvae8nxzVz4" class="play-now" data-fancybox="gallery">
                                            <img src="{{ asset('images/resource/pet-video.jpg') }}" alt="Vídeo Dogs, Cats & Love">
                                            <i class="icon flaticon-play-button-3" aria-hidden="true"></i>
                                        </a>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="sidebar-column col-lg-4 col-md-12">
                        <aside class="sidebar">
                            <div class="sidebar-widget m-0">
                                <h4 class="widget-title">Informações</h4>
                                <div class="widget-content">
                                    <ul class="job-overview">
                                        <li>
                                            <i class="las la-briefcase icon"></i>
                                            <h5>Serviços:</h5>
                                            <span>Day Care, Hotelzinho, Banho e Tosa, Adestramento</span>
                                        </li>
                                        <li>
                                            <i class="las la-users icon"></i>
                                            <h5>Equipe:</h5>
                                            <span>8 funcionários</span>
                                        </li>
                                        <li>
                                            <i class="las la-calendar-check icon"></i>
                                            <h5>Fundação:</h5>
                                            <span>2012</span>
                                        </li>
                                        <li>
                                            <i class="las la-map-marker icon"></i>
                                            <h5>Endereço:</h5>
                                            <span>Rua Guilherme Dumont Villares, 1234</span>
                                        </li>
                                        <li>
                                            <i class="las la-globe-americas icon"></i>
                                            <h5>Cidade:</h5>
                                            <span>São Bernardo do Campo – SP</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget social-media-widget">
                                <h4 class="widget-title">Redes Sociais</h4>
                                <div class="widget-content">
                                    <div class="social-links">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Seção de Detalhes da Empresa -->

    <!-- Main Footer -->
    @include('layouts.partials.footer')
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
@endpush
