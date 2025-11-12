@extends('layouts.app')

@section('title', 'VagaPet - Encontre ou Anuncie Vagas no Setor Pet')

@section('content')
<div class="page-wrapper">
  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-dynamic')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Banner Section-->
  <section class="banner-section-seven" style="padding: 80px 0 60px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="auto-container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="inner-column" style="padding-right: 40px;">
            <h3 class="wow fadeInUp" data-wow-delay="500ms" style="font-size: 3.5rem; font-weight: 700; margin-bottom: 25px; line-height: 1.2; color: #2c3e50;">
              Mais de <span class="colored" style="color: #28a745;">1.200</span> vagas no setor pet
            </h3>
            <div class="text wow fadeInUp" data-wow-delay="700ms" style="font-size: 1.2rem; color: #6c757d; margin-bottom: 40px; line-height: 1.6;">
              Encontre ou anuncie vagas para veterinários, groomers, cuidadores e muito mais.
            </div>

            <!-- Job Search Form -->
            <div class="job-search-form wow fadeInUp" data-wow-delay="900ms" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 30px;">
              <form action="{{ route('jobs.index') }}" method="get">
                <div class="row">
                  <div class="form-group col-lg-5" style="margin-bottom: 0;">
                    <span class="icon flaticon-search-1" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></span>
                    <input type="text" name="q" placeholder="Cargo, habilidade ou empresa" style="padding: 15px 15px 15px 45px; border: 2px solid #e9ecef; border-radius: 10px; width: 100%; font-size: 1rem;">
                  </div>
                  <div class="form-group col-lg-4" style="margin-bottom: 0;">
                    <span class="icon flaticon-map-locator" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></span>
                    <input type="text" name="location" placeholder="Cidade ou Estado" style="padding: 15px 15px 15px 45px; border: 2px solid #e9ecef; border-radius: 10px; width: 100%; font-size: 1rem;">
                  </div>
                  <div class="form-group col-lg-3" style="margin-bottom: 0;">
                    <button type="submit" class="theme-btn btn-style-one" style="width: 100%; padding: 15px; border-radius: 10px; background: #28a745; border: none; color: white; font-weight: 600; font-size: 1rem;">
                      <span class="btn-title">Buscar Vagas</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- End Search Form -->

            <!-- Popular Searches -->
            <div class="popular-searches wow fadeInUp" data-wow-delay="1100ms" style="margin-top: 20px;">
              <span class="title" style="color: #6c757d; font-weight: 500; margin-right: 10px;">Buscas populares:</span>
              <a href="{{ route('jobs.index') }}?q=Veterinário" style="color: #28a745; text-decoration: none; margin-right: 5px;">Veterinário</a>,
              <a href="{{ route('jobs.index') }}?q=Banho+e+Tosa" style="color: #28a745; text-decoration: none; margin-right: 5px;">Banho e Tosa</a>,
              <a href="{{ route('jobs.index') }}?q=Monitor+de+creche" style="color: #28a745; text-decoration: none; margin-right: 5px;">Monitor de creche</a>,
              <a href="{{ route('jobs.index') }}?q=Recepção" style="color: #28a745; text-decoration: none; margin-right: 5px;">Recepção</a>,
              <a href="{{ route('jobs.index') }}?q=Auxiliar+Geral" style="color: #28a745; text-decoration: none;">Auxiliar Geral</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <figure class="image wow fadeInRight" data-wow-delay="500ms" style="text-align: center; margin: 0;">
            <img src="{{ asset('images/banner-pet.png') }}" alt="Banner VagaPet" style="max-width: 100%; height: auto; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
          </figure>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Section-->

  <!-- Featured Jobs -->
  <section class="job-section" style="padding: 80px 0; background: white;">
    <div class="auto-container">
      <div class="sec-title text-center" style="margin-bottom: 60px;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 15px;">Vagas em Destaque</h2>
        <div class="text" style="font-size: 1.1rem; color: #6c757d;">As oportunidades mais buscadas pelos profissionais pet</div>
      </div>
      <div class="row" style="margin: 0 -15px;">
        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="inner-box" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="content">
              <span class="company-logo" style="display: inline-block; margin-bottom: 15px;">
                <img src="{{ asset('images/resource/company-logo/petshop1.png') }}" alt="PetCare Prime" style="width: 60px; height: 60px; border-radius: 10px; object-fit: cover;">
              </span>
              <h4 style="margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;"><a href="#" style="color: #2c3e50; text-decoration: none;">Veterinário(a) - PetCare Prime</a></h4>
              <ul class="job-info" style="list-style: none; padding: 0; margin-bottom: 15px;">
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-briefcase" style="margin-right: 8px; color: #28a745;"></span> PetCare Prime</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-map-locator" style="margin-right: 8px; color: #28a745;"></span> São Paulo, SP</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-clock-3" style="margin-right: 8px; color: #28a745;"></span> Publicado há 2 dias</li>
              </ul>
              <ul class="job-other-info" style="list-style: none; padding: 0; margin-bottom: 0;">
                <li class="time" style="display: inline-block; background: #e9ecef; color: #495057; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem; margin-right: 10px;">CLT</li>
                <li class="required" style="display: inline-block; background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">Urgente</li>
              </ul>
              <button class="bookmark-btn" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #6c757d; font-size: 1.2rem;"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>

        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="inner-box" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="content">
              <span class="company-logo" style="display: inline-block; margin-bottom: 15px;">
                <img src="{{ asset('images/resource/company-logo/petshop2.png') }}" alt="PetLove" style="width: 60px; height: 60px; border-radius: 10px; object-fit: cover;">
              </span>
              <h4 style="margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;"><a href="#" style="color: #2c3e50; text-decoration: none;">Groomer - PetLove</a></h4>
              <ul class="job-info" style="list-style: none; padding: 0; margin-bottom: 15px;">
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-briefcase" style="margin-right: 8px; color: #28a745;"></span> PetLove</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-map-locator" style="margin-right: 8px; color: #28a745;"></span> Rio de Janeiro, RJ</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-clock-3" style="margin-right: 8px; color: #28a745;"></span> Publicado há 1 dia</li>
              </ul>
              <ul class="job-other-info" style="list-style: none; padding: 0; margin-bottom: 0;">
                <li class="time" style="display: inline-block; background: #e9ecef; color: #495057; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem; margin-right: 10px;">CLT</li>
                <li class="required" style="display: inline-block; background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">Urgente</li>
              </ul>
              <button class="bookmark-btn" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #6c757d; font-size: 1.2rem;"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>

        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="inner-box" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="content">
              <span class="company-logo" style="display: inline-block; margin-bottom: 15px;">
                <img src="{{ asset('images/resource/company-logo/petshop3.png') }}" alt="Cobasi" style="width: 60px; height: 60px; border-radius: 10px; object-fit: cover;">
              </span>
              <h4 style="margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;"><a href="#" style="color: #2c3e50; text-decoration: none;">Auxiliar de Veterinária - Cobasi</a></h4>
              <ul class="job-info" style="list-style: none; padding: 0; margin-bottom: 15px;">
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-briefcase" style="margin-right: 8px; color: #28a745;"></span> Cobasi</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-map-locator" style="margin-right: 8px; color: #28a745;"></span> Belo Horizonte, MG</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-clock-3" style="margin-right: 8px; color: #28a745;"></span> Publicado há 3 dias</li>
              </ul>
              <ul class="job-other-info" style="list-style: none; padding: 0; margin-bottom: 0;">
                <li class="time" style="display: inline-block; background: #e9ecef; color: #495057; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem; margin-right: 10px;">CLT</li>
                <li class="required" style="display: inline-block; background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">Urgente</li>
              </ul>
              <button class="bookmark-btn" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #6c757d; font-size: 1.2rem;"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>

        <!-- Exemplo de Job Block -->
        <div class="job-block col-lg-6 col-md-12" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="inner-box" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="content">
              <span class="company-logo" style="display: inline-block; margin-bottom: 15px;">
                <img src="{{ asset('images/resource/company-logo/petshop4.png') }}" alt="Petz" style="width: 60px; height: 60px; border-radius: 10px; object-fit: cover;">
              </span>
              <h4 style="margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;"><a href="#" style="color: #2c3e50; text-decoration: none;">Monitor de Creche - Petz</a></h4>
              <ul class="job-info" style="list-style: none; padding: 0; margin-bottom: 15px;">
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-briefcase" style="margin-right: 8px; color: #28a745;"></span> Petz</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-map-locator" style="margin-right: 8px; color: #28a745;"></span> Curitiba, PR</li>
                <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-clock-3" style="margin-right: 8px; color: #28a745;"></span> Publicado há 5 dias</li>
              </ul>
              <ul class="job-other-info" style="list-style: none; padding: 0; margin-bottom: 0;">
                <li class="time" style="display: inline-block; background: #e9ecef; color: #495057; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem; margin-right: 10px;">CLT</li>
                <li class="required" style="display: inline-block; background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">Urgente</li>
              </ul>
              <button class="bookmark-btn" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #6c757d; font-size: 1.2rem;"><span class="flaticon-bookmark"></span></button>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box text-center" style="margin-top: 50px;">
        <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-one" style="display: inline-block; padding: 15px 40px; background: #28a745; color: white; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 1.1rem; transition: background 0.3s ease;">
          <span class="btn-title">Ver Todas as Vagas</span>
        </a>
      </div>
    </div>
  </section>
  <!-- End Featured Jobs -->

  <!-- How It Works -->
  <section class="how-it-works" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="auto-container">
      <div class="sec-title text-center" style="margin-bottom: 60px;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 15px;">Como Funciona</h2>
        <div class="text" style="font-size: 1.1rem; color: #6c757d;">Três passos simples para achar ou anunciar vagas</div>
      </div>
      <div class="row" style="margin: 0 -15px;">
        <div class="col-lg-4 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="work-block text-center" style="padding: 40px 30px; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;">
            <div class="icon-box" style="width: 80px; height: 80px; background: #007bff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
              <span class="flaticon-search-1" style="color: white; font-size: 30px;"></span>
            </div>
            <h4 style="margin-bottom: 20px; color: #2c3e50; font-size: 1.4rem; font-weight: 600;">1. Busque Vagas</h4>
            <p style="color: #6c757d; line-height: 1.6; font-size: 1rem;">Encontre vagas por cargo, localização ou categoria.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="work-block text-center" style="padding: 40px 30px; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;">
            <div class="icon-box" style="width: 80px; height: 80px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
              <span class="flaticon-briefcase" style="color: white; font-size: 30px;"></span>
            </div>
            <h4 style="margin-bottom: 20px; color: #2c3e50; font-size: 1.4rem; font-weight: 600;">2. Candidate-se</h4>
            <p style="color: #6c757d; line-height: 1.6; font-size: 1rem;">Envie seu currículo e responda perguntas de triagem.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-auto" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="work-block text-center" style="padding: 40px 30px; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;">
            <div class="icon-box" style="width: 80px; height: 80px; background: #ffc107; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
              <span class="flaticon-job" style="color: white; font-size: 30px;"></span>
            </div>
            <h4 style="margin-bottom: 20px; color: #2c3e50; font-size: 1.4rem; font-weight: 600;">3. Contrate ou Seja Contratado</h4>
            <p style="color: #6c757d; line-height: 1.6; font-size: 1rem;">Empresas recebem candidaturas e fecham a contratação.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End How It Works -->

  <!-- Footer -->
  @include('layouts.partials.footer')
  <!-- End Footer -->

</div>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@include('layouts.partials.favorite-scripts')
@endpush
