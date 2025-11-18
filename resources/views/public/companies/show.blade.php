@extends('layouts.app')

@section('title', $company->company_name . ' - Perfil da Empresa')

@section('content')
<div class="page-wrapper">
  <div class="preloader"></div>
  <span class="header-span"></span>

  @include('layouts.partials.header-company')

  <section class="candidate-detail-section style-three">
    <div class="upper-box">
      <div class="auto-container">
        <div class="job-block-seven style-three">
          <div class="inner-box">
            <figure class="image">
              <img src="{{ $company->logo_url ?? asset('images/resource/default-company.png') }}" alt="{{ $company->company_name }}">
            </figure>
            <h4 class="name">{{ $company->company_name }}</h4>

            <div class="btn-box">
              @if($active_jobs->isNotEmpty())
                <a href="#open-jobs" class="theme-btn btn-style-one position-relative">
                  Vagas abertas: {{ $active_jobs->count() }}
                </a>
              @endif
              <button class="bookmark-btn" type="button" title="Favoritar empresa">
                <i class="flaticon-bookmark"></i>
              </button>
            </div>

            <div class="content mt-3">
              <ul class="job-info">
                <li><span class="icon las la-map-marker"></span> {{ collect([$company->city, $company->state])->filter()->implode(' - ') ?: 'Localização não informada' }}</li>
                <li><span class="icon las la-users"></span> {{ $company->employees_count ? $company->employees_count . ' colaboradores' : 'Equipe não informada' }}</li>
                <li><span class="icon las la-eye"></span> {{ number_format($company->views_count) }} visualizações</li>
              </ul>
              @if($company->description)
                <p class="text-muted mt-2">{{ $company->description }}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="candidate-detail-outer pb-5">
      <div class="auto-container">
        <div class="row">
          <div class="content-column col-lg-8 col-md-12 order-2">
            <div class="job-detail">
              <h4>Sobre a empresa</h4>
              <div class="text">
                {!! nl2br(e($company->description ?? 'Esta empresa ainda não adicionou uma descrição detalhada.')) !!}
              </div>

              @if($company->services)
                <div class="services-outer mt-4">
                  <h4>Serviços oferecidos</h4>
                  <div class="row">
                    @foreach($company->services as $service)
                      <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <div class="service-block">
                          <div class="inner-box">
                            <div class="icon-box">
                              <span class="icon flaticon-briefcase"></span>
                            </div>
                            <h5>{{ $service }}</h5>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($company->specialties)
                <div class="services-outer mt-4">
                  <h4>Especialidades</h4>
                  <div class="tags-container">
                    @foreach($company->specialties as $specialty)
                      <span class="tag">{{ $specialty }}</span>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($company->photos)
                <div class="portfolio-outer mt-4">
                  <h4>Fotos do espaço</h4>
                  <div class="row">
                    @foreach($company->photos as $photo)
                      <div class="col-lg-3 col-md-3 col-sm-6">
                        <figure class="image">
                          <a href="{{ asset($photo) }}" class="lightbox-image">
                            <img src="{{ asset($photo) }}" alt="Foto do espaço {{ $company->company_name }}">
                          </a>
                          <span class="icon flaticon-plus"></span>
                        </figure>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($active_jobs->isNotEmpty())
                <div class="mt-5" id="open-jobs">
                  <h4>Vagas abertas</h4>
                  <div class="row">
                    @foreach($active_jobs as $job)
                      <div class="job-block col-lg-12 col-md-12 col-sm-12">
                        <div class="inner-box">
                          <div class="content">
                            <h5><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a></h5>
                            <ul class="job-info">
                              <li><span class="icon flaticon-clock-3"></span> Publicada {{ $job->published_at?->diffForHumans() }}</li>
                              <li><span class="icon flaticon-resume"></span> {{ ucfirst($job->experience_level ?? 'any') }}</li>
                              <li><span class="icon flaticon-pin"></span> {{ collect([$job->city, $job->state])->filter()->implode(' - ') ?: 'Localidade não informada' }}</li>
                            </ul>
                            <a href="{{ route('jobs.show', $job->slug) }}" class="theme-btn btn-style-three mt-2">
                              Ver detalhes da vaga
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>

          <div class="sidebar-column col-lg-4 col-md-12 order-1">
            <aside class="sidebar">
              <div class="sidebar-widget m-0">
                <h4 class="widget-title">Informações</h4>
                <div class="widget-content">
                  <ul class="job-overview">
                    <li>
                      <i class="las la-briefcase icon"></i>
                      <h5>Serviços</h5>
                      <span>{{ $company->services ? implode(', ', $company->services) : 'Não informado' }}</span>
                    </li>
                    <li>
                      <i class="las la-users icon"></i>
                      <h5>Equipe</h5>
                      <span>{{ $company->employees_count ? $company->employees_count . ' colaboradores' : 'Não informado' }}</span>
                    </li>
                    <li>
                      <i class="las la-globe-americas icon"></i>
                      <h5>Cidade</h5>
                      <span>{{ collect([$company->city, $company->state])->filter()->implode(' - ') ?: 'Não informado' }}</span>
                    </li>
                    <li>
                      <i class="las la-phone-volume icon"></i>
                      <h5>Telefone</h5>
                      <span>{{ $company->phone ?? 'Não informado' }}</span>
                    </li>
                    <li>
                      <i class="las la-globe icon"></i>
                      <h5>Website</h5>
                      @if($company->website)
                        <span><a href="{{ $company->website }}" target="_blank" rel="noopener">{{ $company->website }}</a></span>
                      @else
                        <span>Não informado</span>
                      @endif
                    </li>
                  </ul>
                </div>
              </div>

              @php
                $facebookUrl = $company->facebook;
                $instagramUrl = $company->instagram
                  ? (\Illuminate\Support\Str::startsWith($company->instagram, ['http://', 'https://'])
                    ? $company->instagram
                    : 'https://instagram.com/' . ltrim($company->instagram, '@'))
                  : null;
                $linkedinUrl = $company->linkedin && !\Illuminate\Support\Str::startsWith($company->linkedin, ['http://', 'https://'])
                  ? 'https://' . ltrim($company->linkedin, 'https://')
                  : $company->linkedin;
                $youtubeUrl = $company->youtube && !\Illuminate\Support\Str::startsWith($company->youtube, ['http://', 'https://'])
                  ? 'https://' . ltrim($company->youtube, 'https://')
                  : $company->youtube;
              @endphp

              <div class="sidebar-widget social-media-widget">
                <h4 class="widget-title">Redes Sociais</h4>
                <div class="widget-content">
                  <div class="social-links">
                    @if($facebookUrl)
                      <a href="{{ $facebookUrl }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($instagramUrl)
                      <a href="{{ $instagramUrl }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($linkedinUrl)
                      <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($youtubeUrl)
                      <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(!$facebookUrl && !$instagramUrl && !$linkedinUrl && !$youtubeUrl)
                      <span class="text-muted">Nenhuma rede social informada.</span>
                    @endif
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('layouts.partials.footer')
</div>
@endsection

