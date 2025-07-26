@extends('layouts.app')

@section('title', 'VagaPet - Encontre ou Anuncie Vagas no Setor Pet')

@section('content')
<div class="page-wrapper">
  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Banner Section-->
  <section class="banner-section-seven">
    <div class="auto-container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="inner-column">
            <h3 class="wow fadeInUp" data-wow-delay="500ms">
              Mais de <span class="colored">1.200</span> vagas no setor pet
            </h3>
            <div class="text wow fadeInUp" data-wow-delay="700ms">
              Encontre ou anuncie vagas para veterinários, groomers, cuidadores e muito mais.
            </div>

            <!-- Job Search Form -->
            <div class="job-search-form wow fadeInUp" data-wow-delay="900ms">
              <form action="{{ route('jobs.index') }}" method="get">
                <div class="row">
                  <div class="form-group col-lg-5">
                    <span class="icon flaticon-search-1"></span>
                    <input type="text" name="q" placeholder="Cargo, habilidade ou empresa">
                  </div>
                  <div class="form-group col-lg-4">
                    <span class="icon flaticon-map-locator"></span>
                    <input type="text" name="location" placeholder="Cidade ou Estado">
                  </div>
                  <div class="form-group col-lg-3">
                    <button type="submit" class="theme-btn btn-style-one">
                      <span class="btn-title">Buscar Vagas</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- End Search Form -->

            <!-- Popular Searches -->
            <div class="popular-searches wow fadeInUp" data-wow-delay="1100ms">
              <span class="title">Buscas populares:</span>
              <a href="#">Veterinário</a>,
              <a href="#">Banho e Tosa</a>,
              <a href="#">Monitor de creche</a>,
              <a href="#">Recepção</a>,
              <a href="#">Auxiliar Geral</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <figure class="image wow fadeInRight" data-wow-delay="500ms">
            <img src="{{ asset('images/banner-pet.png') }}" alt="Banner VagaPet">
          </figure>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Section-->

  <!-- Featured Jobs -->
  <section class="job-section">
    <div class="auto-container">
      <div class="sec-title text-center">
        <h2>Vagas em Destaque</h2>
        <div class="text">As oportunidades mais buscadas pelos profissionais pet</div>
      </div>
      <div class="row">
        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12">
          <div class="inner-box">
            <div class="content">
              <span class="company-logo">
                <img src="{{ asset('images/resource/company-logo/petshop1.png') }}" alt="PetCare Prime">
              </span>
              <h4><a href="#">Veterinário(a) - PetCare Prime</a></h4>
              <ul class="job-info">
                <li><span class="icon flaticon-briefcase"></span> PetCare Prime</li>
                <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                <li><span class="icon flaticon-clock-3"></span> Publicado há 2 dias</li>
              </ul>
              <ul class="job-other-info">
                <li class="time">CLT</li>
                <li class="required">Urgente</li>
              </ul>
              <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>

        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12">
          <div class="inner-box">
            <div class="content">
              <span class="company-logo">
                <img src="{{ asset('images/resource/company-logo/petshop2.png') }}" alt="PetLove">
              </span>
              <h4><a href="#">Groomer - PetLove</a></h4>
              <ul class="job-info">
                <li><span class="icon flaticon-briefcase"></span> PetLove</li>
                <li><span class="icon flaticon-map-locator"></span> Rio de Janeiro, RJ</li>
                <li><span class="icon flaticon-clock-3"></span> Publicado há 1 dia</li>
              </ul>
              <ul class="job-other-info">
                <li class="time">CLT</li>
                <li class="required">Urgente</li>
              </ul>
              <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>

        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12">
          <div class="inner-box">
            <div class="content">
              <span class="company-logo">
                <img src="{{ asset('images/resource/company-logo/petshop3.png') }}" alt="Cobasi">
              </span>
              <h4><a href="#">Auxiliar de Veterinária - Cobasi</a></h4>
              <ul class="job-info">
                <li><span class="icon flaticon-briefcase"></span> Cobasi</li>
                <li><span class="icon flaticon-map-locator"></span> Belo Horizonte, MG</li>
                <li><span class="icon flaticon-clock-3"></span> Publicado há 3 dias</li>
              </ul>
              <ul class="job-other-info">
                <li class="time">CLT</li>
                <li class="required">Urgente</li>
              </ul>
              <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>

        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12">
          <div class="inner-box">
            <div class="content">
              <span class="company-logo">
                <img src="{{ asset('images/resource/company-logo/petshop4.png') }}" alt="Petz">
              </span>
              <h4><a href="#">Monitor de Creche - Petz</a></h4>
              <ul class="job-info">
                <li><span class="icon flaticon-briefcase"></span> Petz</li>
                <li><span class="icon flaticon-map-locator"></span> Curitiba, PR</li>
                <li><span class="icon flaticon-clock-3"></span> Publicado há 5 dias</li>
              </ul>
              <ul class="job-other-info">
                <li class="time">CLT</li>
                <li class="required">Urgente</li>
              </ul>
              <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Featured Jobs -->

  <!-- Footer -->
  @include('layouts.partials.footer')
  <!-- End Footer -->
</div>
@endsection

@push('scripts')
  @include('layouts.partials.scripts')
@endpush
