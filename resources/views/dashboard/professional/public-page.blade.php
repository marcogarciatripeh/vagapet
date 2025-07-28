@extends('layouts.app')

@section('title', 'Página Pública - VagaPet')

@section('content')
<div class="page-wrapper">
  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-professional')
  <!-- Fim do Cabeçalho Principal -->

  <!-- includes/sidebar.html -->
  <div class="sidebar-backdrop"></div>

  <div class="user-sidebar d-lg-none">
    <div class="sidebar-inner">
      <ul class="navigation">
        @include('layouts.partials.menu-professional')
      </ul>
    </div>
  </div>

  <!-- Seção Detalhes do Profissional -->
  <section class="candidate-detail-section style-three">
    <!-- Caixa Superior -->
    <div class="upper-box">
      <div class="auto-container">
        <!-- Bloco de Profissional -->
        <div class="candidate-block-six">
          <div class="inner-box">
            <figure class="image">
              <img src="{{ asset('images/resource/candidate-4.png') }}" alt="Profissional PetShop">
            </figure>
            <h4 class="name"><a href="#">Marina Santos</a></h4>
            <span class="designation">Groomer Especialista em Tosa</span>
            <div class="content">
              <ul class="post-tags">
                <li><a href="#">Banho e Tosa</a></li>
                <li><a href="#">3-5 anos de experiência</a></li>
                <li><a href="#">Freelancer</a></li>
              </ul>

              <ul class="candidate-info">
                <li><span class="icon flaticon-map-locator"></span> São Paulo, Brasil</li>
              </ul>

              <div class="btn-box">
                <a href="#" class="theme-btn btn-style-one">Baixar Currículo</a>
                <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="candidate-detail-outer">
      <div class="auto-container">
        <div class="row">
          <!-- Coluna de Conteúdo -->
          <div class="content-column col-lg-8 col-md-12 col-sm-12 order-2">
            <div class="job-detail">
              <h4>Sobre a Profissional</h4>
              <p>Olá, meu nome é Marina Santos, groomer especializada em banho e tosa de animais de pequeno e médio porte. Tenho experiência em tosa higiênica, penteados estilizados, hidratação de pelagem, além de oferecer orientação aos tutores sobre cuidados diários. Trabalho há 5 anos em São Paulo, cuidando do bem-estar dos pets e garantindo um ambiente acolhedor e seguro.</p>
              <p>Também possuo certificações em primeiros socorros para pets e atendimento especializado para raças específicas. Sou apaixonada por animais e busco sempre atualizar minhas técnicas para oferecer o melhor serviço possível.</p>

              <!-- Currículo / Formação -->
              <div class="resume-outer">
                <div class="upper-title">
                  <h4>Formação Acadêmica</h4>
                </div>
                <!-- Bloco de Currículo -->
                <div class="resume-block">
                  <div class="inner">
                    <span class="name">C</span>
                    <div class="title-box">
                      <div class="info-box">
                        <h3>Curso de Tosa Avançada</h3>
                        <span>Instituto Pet Brasil</span>
                      </div>
                      <div class="edit-box">
                        <span class="year">2019 - 2020</span>
                      </div>
                    </div>
                    <div class="text">Aprendi técnicas de tosa em diferentes raças, penteados criativos e cuidados especiais pós-tosa.</div>
                  </div>
                </div>

                <!-- Bloco de Currículo -->
                <div class="resume-block">
                  <div class="inner">
                    <span class="name">V</span>
                    <div class="title-box">
                      <div class="info-box">
                        <h3>Auxiliar Veterinário</h3>
                        <span>Vet School Online</span>
                      </div>
                      <div class="edit-box">
                        <span class="year">2018 - 2019</span>
                      </div>
                    </div>
                    <div class="text">Curso online de assistência em procedimentos veterinários, entendendo a anatomia básica e primeiros socorros.</div>
                  </div>
                </div>
              </div>

              <!-- Currículo / Experiência de Trabalho -->
              <div class="resume-outer theme-blue">
                <div class="upper-title">
                  <h4>Experiência de Trabalho</h4>
                </div>
                <!-- Bloco de Currículo -->
                <div class="resume-block">
                  <div class="inner">
                    <span class="name">P</span>
                    <div class="title-box">
                      <div class="info-box">
                        <h3>Groomer Sênior</h3>
                        <span>Pet4U</span>
                      </div>
                      <div class="edit-box">
                        <span class="year">2020 - Presente</span>
                      </div>
                    </div>
                    <div class="text">Responsável por serviços de banho, tosa simples e estilizada, hidratação de pelagem e técnicas avançadas de estética pet.</div>
                  </div>
                </div>

                <!-- Bloco de Currículo -->
                <div class="resume-block">
                  <div class="inner">
                    <span class="name">C</span>
                    <div class="title-box">
                      <div class="info-box">
                        <h3>Estagiária em Clínica Veterinária</h3>
                        <span>Clínica Bem-Estar Animal</span>
                      </div>
                      <div class="edit-box">
                        <span class="year">2018 - 2019</span>
                      </div>
                    </div>
                    <div class="text">Auxiliava o veterinário em procedimentos de rotina, administração de medicamentos e orientava tutores sobre cuidados básicos.</div>
                  </div>
                </div>
              </div>

              <!-- Portfólio -->
              <div class="portfolio-outer">
                <h4>Portfólio</h4>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <figure class="image">
                      <a href="{{ asset('images/resource/portfolio-1.jpg') }}" class="lightbox-image"><img src="{{ asset('images/resource/portfolio-1.jpg') }}" alt=""></a>
                      <span class="icon flaticon-plus"></span>
                    </figure>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <figure class="image">
                      <a href="{{ asset('images/resource/portfolio-2.jpg') }}" class="lightbox-image"><img src="{{ asset('images/resource/portfolio-2.jpg') }}" alt=""></a>
                      <span class="icon flaticon-plus"></span>
                    </figure>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <figure class="image">
                      <a href="{{ asset('images/resource/portfolio-3.jpg') }}" class="lightbox-image"><img src="{{ asset('images/resource/portfolio-3.jpg') }}" alt=""></a>
                      <span class="icon flaticon-plus"></span>
                    </figure>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <figure class="image">
                      <a href="{{ asset('images/resource/portfolio-4.jpg') }}" class="lightbox-image"><img src="{{ asset('images/resource/portfolio-4.jpg') }}" alt=""></a>
                      <span class="icon flaticon-plus"></span>
                    </figure>
                  </div>
                </div>
              </div>

              <!-- Currículo / Premiações -->
              <div class="resume-outer theme-yellow">
                <div class="upper-title">
                  <h4>Premiações</h4>
                </div>
                <!-- Bloco de Currículo -->
                <div class="resume-block">
                  <div class="inner">
                    <div class="title-box">
                      <div class="info-box">
                        <h3>Concurso Melhor Tosa Estilizada</h3>
                        <span>Pet Festival SP</span>
                      </div>
                      <div class="edit-box">
                        <span class="year">2022</span>
                      </div>
                    </div>
                    <div class="text">Homenagem pela excelência no atendimento aos tutores e animais, garantindo segurança e bem-estar.</div>
                  </div>
                </div>
              </div>

              <!-- Vídeo -->
              <div class="video-outer">
                <h4>Apresentação em Vídeo</h4>
                <div class="video-box">
                  <figure class="image">
                    <a href="https://www.youtube.com/watch?v=Fvae8nxzVz4" class="play-now" data-fancybox="gallery" data-caption="">
                      <img src="{{ asset('images/resource/video-img.jpg') }}" alt="">
                      <i class="icon flaticon-play-button-3" aria-hidden="true"></i>
                    </a>
                  </figure>
                </div>
              </div>
            </div>
          </div>

          <!-- Coluna Lateral -->
          <div class="sidebar-column col-lg-4 col-md-12 col-sm-12 order-1">
            <aside class="sidebar">
              <!-- Informações de Contato -->
              <div class="sidebar-widget contact-widget">
                <h4 class="widget-title">Informações de Contato</h4>
                <div class="widget-content">
                  <ul class="contact-info">
                    <li><span class="icon flaticon-phone"></span> (11) 91234-5678</li>
                    <li><span class="icon flaticon-mail"></span> marina@exemplo.com</li>
                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                  </ul>
                </div>
              </div>

              <!-- Habilidades Profissionais -->
              <div class="sidebar-widget m-0">
                <h4 class="widget-title">Habilidades Profissionais</h4>
                <div class="widget-content">
                  <ul class="job-skills">
                    <li><a href="#">Banho e Tosa</a></li>
                    <li><a href="#">Hidratação</a></li>
                    <li><a href="#">Tosa Estilizada</a></li>
                    <li><a href="#">Assistência Veterinária</a></li>
                    <li><a href="#">Atendimento ao Cliente</a></li>
                  </ul>
                </div>
              </div>

              <!-- Redes Sociais -->
              <div class="sidebar-widget social-media-widget">
                <h4 class="widget-title">Redes Sociais</h4>
                <div class="widget-content">
                  <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Fim da Seção Detalhes do Profissional -->

  <!-- Rodapé Principal -->
  @include('layouts.partials.footer')
  <!-- Fim Rodapé Principal -->
</div>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush

