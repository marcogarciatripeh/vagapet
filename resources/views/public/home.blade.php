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
              Mais de <span class="colored" style="color: #22c400;">{{ number_format($stats['total_jobs'], 0, ',', '.') }}</span> vagas no setor pet
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
                    <input type="text" name="search" placeholder="Cargo, habilidade ou empresa" value="{{ request('search') }}" style="padding: 15px 15px 15px 45px; border: 2px solid #e9ecef; border-radius: 10px; width: 100%; font-size: 1rem;">
                  </div>
                  <div class="form-group col-lg-4" style="margin-bottom: 0;">
                    <span class="icon flaticon-map-locator" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></span>
                    <input type="text" name="city" placeholder="Cidade ou Estado" value="{{ request('city') }}" style="padding: 15px 15px 15px 45px; border: 2px solid #e9ecef; border-radius: 10px; width: 100%; font-size: 1rem;">
                  </div>
                  <div class="form-group col-lg-3" style="margin-bottom: 0;">
                    <button type="submit" class="theme-btn btn-style-one" style="width: 100%; padding: 15px; border-radius: 10px; background: #22c400; border: none; color: white; font-weight: 600; font-size: 1rem;">
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
              <a href="{{ route('jobs.index') }}?search=Veterinário" style="color: #22c400; text-decoration: none; margin-right: 5px;">Veterinário</a>,
              <a href="{{ route('jobs.index') }}?search=Banho+e+Tosa" style="color: #22c400; text-decoration: none; margin-right: 5px;">Banho e Tosa</a>,
              <a href="{{ route('jobs.index') }}?search=Monitor+de+creche" style="color: #22c400; text-decoration: none; margin-right: 5px;">Monitor de creche</a>,
              <a href="{{ route('jobs.index') }}?search=Recepção" style="color: #22c400; text-decoration: none; margin-right: 5px;">Recepção</a>,
              <a href="{{ route('jobs.index') }}?search=Auxiliar+Geral" style="color: #22c400; text-decoration: none;">Auxiliar Geral</a>
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

  <!-- Stats Section -->
  <section class="stats-section" style="padding: 60px 0; background: white;">
    <div class="auto-container">
      <div class="row" style="margin: 0 -15px;">
        <div class="col-lg-3 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="stat-box text-center" style="padding: 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px;">
            <div class="icon" style="font-size: 3rem; color: #22c400; margin-bottom: 15px;">
              <span class="flaticon-briefcase"></span>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">{{ number_format($stats['total_jobs'], 0, ',', '.') }}</h3>
            <p style="color: #6c757d; font-size: 1.1rem; margin: 0;">Vagas Disponíveis</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="stat-box text-center" style="padding: 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px;">
            <div class="icon" style="font-size: 3rem; color: #22c400; margin-bottom: 15px;">
              <span class="flaticon-workers"></span>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">{{ number_format($stats['total_companies'], 0, ',', '.') }}</h3>
            <p style="color: #6c757d; font-size: 1.1rem; margin: 0;">Empresas Cadastradas</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="stat-box text-center" style="padding: 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px;">
            <div class="icon" style="font-size: 3rem; color: #22c400; margin-bottom: 15px;">
              <span class="flaticon-user"></span>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">{{ number_format($stats['total_professionals'], 0, ',', '.') }}</h3>
            <p style="color: #6c757d; font-size: 1.1rem; margin: 0;">Profissionais</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="stat-box text-center" style="padding: 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px;">
            <div class="icon" style="font-size: 3rem; color: #22c400; margin-bottom: 15px;">
              <span class="flaticon-paper-plane"></span>
            </div>
            <h3 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">{{ number_format($stats['total_applications'], 0, ',', '.') }}</h3>
            <p style="color: #6c757d; font-size: 1.1rem; margin: 0;">Candidaturas</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Stats Section -->

  <!-- Featured Jobs -->
  @if($featured_jobs->count() > 0)
  <section class="job-section" style="padding: 80px 0; background: white;">
    <div class="auto-container">
      <div class="sec-title text-center" style="margin-bottom: 60px;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 15px;">Vagas em Destaque</h2>
        <div class="text" style="font-size: 1.1rem; color: #6c757d;">As oportunidades mais buscadas pelos profissionais pet</div>
      </div>
      <div class="row" style="margin: 0 -15px;">
        @foreach($featured_jobs as $job)
          @php
            $logo = $job->companyProfile && $job->companyProfile->logo 
              ? url('storage/' . $job->companyProfile->logo) 
              : asset('images/resource/default-company.png');
            $companyName = $job->companyProfile->company_name ?? 'Empresa';
            $location = collect([$job->city, $job->state])->filter()->implode(', ') ?: 'Local não informado';
            
            // Formatar salário
            $salary = 'A combinar';
            if ($job->salary_type === 'fixed' && $job->salary_min) {
              $salary = 'R$ ' . number_format($job->salary_min, 2, ',', '.');
            } elseif ($job->salary_type === 'range' && $job->salary_min && $job->salary_max) {
              $salary = 'R$ ' . number_format($job->salary_min, 2, ',', '.') . ' - R$ ' . number_format($job->salary_max, 2, ',', '.');
            }
            
            $contractType = match($job->contract_type) {
              'clt' => 'CLT',
              'pj' => 'PJ',
              'freelancer' => 'Freelancer',
              'temporary' => 'Temporário',
              'internship' => 'Estágio',
              default => 'Não informado'
            };
            
            $isFavorited = $favoritedJobIds->contains($job->id);
          @endphp
          <div class="job-block col-lg-6 col-md-12" style="padding: 0 15px; margin-bottom: 30px;">
            <div class="inner-box" style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef; transition: transform 0.3s ease, box-shadow 0.3s ease; position: relative;">
              <div class="content">
                <span class="company-logo" style="display: inline-block; margin-bottom: 15px;">
                  <img src="{{ $logo }}" alt="{{ $companyName }}" style="width: 60px; height: 60px; border-radius: 10px; object-fit: cover;">
                </span>
                <h4 style="margin-bottom: 15px; font-size: 1.3rem; font-weight: 600;">
                  <a href="{{ route('jobs.show', $job->slug) }}" style="color: #2c3e50; text-decoration: none;">{{ $job->title }}</a>
                </h4>
                <ul class="job-info" style="list-style: none; padding: 0; margin-bottom: 15px;">
                  @if($job->area)
                    <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-briefcase" style="margin-right: 8px; color: #22c400;"></span> {{ $job->area }}</li>
                  @endif
                  <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-map-locator" style="margin-right: 8px; color: #22c400;"></span> {{ $location }}</li>
                  <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-clock-3" style="margin-right: 8px; color: #22c400;"></span> {{ $job->created_at->diffForHumans() }}</li>
                  <li style="margin-bottom: 8px; color: #6c757d;"><span class="icon flaticon-money" style="margin-right: 8px; color: #22c400;"></span> {{ $salary }}</li>
                </ul>
                <ul class="job-other-info" style="list-style: none; padding: 0; margin-bottom: 0;">
                  <li class="time" style="display: inline-block; background: #e9ecef; color: #495057; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem; margin-right: 10px;">{{ $contractType }}</li>
                  @if($job->is_urgent)
                    <li class="required" style="display: inline-block; background: #dc3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">Urgente</li>
                  @endif
                </ul>
                @auth
                  @if(Auth::user()->professionalProfile)
                    <button class="bookmark-btn {{ $isFavorited ? 'active' : '' }}" data-favorite-id="{{ $job->id }}" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: {{ $isFavorited ? '#22c400' : '#6c757d' }}; font-size: 1.2rem; cursor: pointer;" title="{{ $isFavorited ? 'Remover dos favoritos' : 'Favoritar vaga' }}">
                      <span class="flaticon-bookmark"></span>
                    </button>
                  @endif
                @else
                  <button class="bookmark-btn" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #6c757d; font-size: 1.2rem; cursor: pointer;" title="Favoritar vaga">
                    <span class="flaticon-bookmark"></span>
                  </button>
                @endauth
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="btn-box text-center" style="margin-top: 50px;">
        <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-one" style="display: inline-block; padding: 15px 40px; background: #22c400; color: white; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 1.1rem; transition: background 0.3s ease;">
          <span class="btn-title">Ver Todas as Vagas</span>
        </a>
      </div>
    </div>
  </section>
  @endif
  <!-- End Featured Jobs -->

  <!-- Featured Companies -->
  @if($featured_companies->count() > 0)
  <section class="companies-section" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="auto-container">
      <div class="sec-title text-center" style="margin-bottom: 60px;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 15px;">Empresas em Destaque</h2>
        <div class="text" style="font-size: 1.1rem; color: #6c757d;">Conheça as empresas que mais contratam no setor pet</div>
      </div>
      <div class="row" style="margin: 0 -15px;">
        @foreach($featured_companies->take(6) as $company)
          @php
            $logo = $company->logo 
              ? url('storage/' . $company->logo) 
              : asset('images/resource/default-company.png');
            $location = collect([$company->city, $company->state])->filter()->implode(', ') ?: 'Local não informado';
          @endphp
          <div class="col-lg-4 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
            <div class="company-block text-center" style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef; transition: transform 0.3s ease, box-shadow 0.3s ease;">
              <div class="company-logo" style="margin-bottom: 20px;">
                <img src="{{ $logo }}" alt="{{ $company->company_name }}" style="width: 100px; height: 100px; border-radius: 10px; object-fit: cover; margin: 0 auto;">
              </div>
              <h4 style="margin-bottom: 10px; font-size: 1.3rem; font-weight: 600;">
                <a href="{{ route('companies.show', $company->id) }}" style="color: #2c3e50; text-decoration: none;">{{ $company->company_name }}</a>
              </h4>
              <p style="color: #6c757d; margin-bottom: 15px; font-size: 0.95rem;">
                <span class="icon flaticon-map-locator" style="margin-right: 5px; color: #22c400;"></span>{{ $location }}
              </p>
              @if($company->description)
                <p style="color: #6c757d; font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px;">
                  {{ \Illuminate\Support\Str::limit($company->description, 100) }}
                </p>
              @endif
              <a href="{{ route('companies.show', $company->id) }}" class="theme-btn btn-style-one" style="display: inline-block; padding: 10px 25px; background: #22c400; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem;">
                Ver Perfil
              </a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="btn-box text-center" style="margin-top: 50px;">
        <a href="{{ route('companies.index') }}" class="theme-btn btn-style-one" style="display: inline-block; padding: 15px 40px; background: #22c400; color: white; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 1.1rem; transition: background 0.3s ease;">
          <span class="btn-title">Ver Todas as Empresas</span>
        </a>
      </div>
    </div>
  </section>
  @endif
  <!-- End Featured Companies -->

  <!-- How It Works -->
  <section class="how-it-works" style="padding: 80px 0; background: white;">
    <div class="auto-container">
      <div class="sec-title text-center" style="margin-bottom: 60px;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 15px;">Como Funciona</h2>
        <div class="text" style="font-size: 1.1rem; color: #6c757d;">Três passos simples para achar ou anunciar vagas</div>
      </div>
      <div class="row" style="margin: 0 -15px;">
        <div class="col-lg-4 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="work-block text-center" style="padding: 40px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;">
            <div class="icon-box" style="width: 80px; height: 80px; background: #22c400; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
              <span class="flaticon-search-1" style="color: white; font-size: 30px;"></span>
            </div>
            <h4 style="margin-bottom: 20px; color: #2c3e50; font-size: 1.4rem; font-weight: 600;">1. Busque Vagas</h4>
            <p style="color: #6c757d; line-height: 1.6; font-size: 1rem;">Encontre vagas por cargo, localização ou categoria.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="work-block text-center" style="padding: 40px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;">
            <div class="icon-box" style="width: 80px; height: 80px; background: #22c400; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
              <span class="flaticon-briefcase" style="color: white; font-size: 30px;"></span>
            </div>
            <h4 style="margin-bottom: 20px; color: #2c3e50; font-size: 1.4rem; font-weight: 600;">2. Candidate-se</h4>
            <p style="color: #6c757d; line-height: 1.6; font-size: 1rem;">Envie seu currículo e responda perguntas de triagem.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-auto" style="padding: 0 15px; margin-bottom: 30px;">
          <div class="work-block text-center" style="padding: 40px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;">
            <div class="icon-box" style="width: 80px; height: 80px; background: #22c400; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
              <span class="flaticon-handshake" style="color: white; font-size: 30px;"></span>
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
