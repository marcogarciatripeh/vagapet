@extends('layouts.app')

@section('title', $professional->full_name . ' - Perfil Profissional')

@section('content')
<div class="page-wrapper">
  <div class="preloader"></div>
  <span class="header-span"></span>

  @include('layouts.partials.header-professional')

  <section class="candidate-detail-section style-three">
    <div class="upper-box">
      <div class="auto-container">
        <div class="candidate-block-six">
          <div class="inner-box">
            <figure class="image">
              <img src="{{ $professional->photo_url ?? asset('images/resource/default-avatar.png') }}" alt="{{ $professional->full_name }}">
            </figure>
            <h4 class="name">{{ $professional->full_name }}</h4>
            @if($professional->title)
              <span class="designation">{{ $professional->title }}</span>
            @endif
            <div class="content mt-3">
              <ul class="post-tags">
                @foreach(collect($professional->areas)->filter()->take(4) as $area)
                  <li><a href="#">{{ $area }}</a></li>
                @endforeach
                <li><a href="#">{{ $professional->years_experience }} {{ \Illuminate\Support\Str::plural('ano', $professional->years_experience) }} de experiência</a></li>
              </ul>

              <ul class="candidate-info">
                <li><span class="icon flaticon-map-locator"></span> {{ collect([$professional->city, $professional->state])->filter()->implode(', ') ?: 'Localização não informada' }}</li>
                <li><span class="icon flaticon-eye"></span> {{ number_format($professional->views_count) }} visualizações</li>
              </ul>

              <div class="btn-box">
                @if($professional->resume_url)
                  <a href="{{ $professional->resume_url }}" class="theme-btn btn-style-one" target="_blank" rel="noopener">
                    <i class="las la-file-pdf"></i> Baixar Currículo
                  </a>
                @endif
                <button class="bookmark-btn" type="button" title="Favoritar profissional"><i class="flaticon-bookmark"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="candidate-detail-outer">
      <div class="auto-container">
        <div class="row">
          <div class="content-column col-lg-8 col-md-12 col-sm-12 order-2">
            <div class="job-detail">
              <h4>Sobre {{ $professional->first_name }}</h4>
              <div class="text">
                {!! nl2br(e($professional->bio ?? 'O profissional ainda não adicionou uma biografia.')) !!}
              </div>

              @if($professional->skills)
                <div class="resume-outer mt-4">
                  <div class="upper-title">
                    <h4>Habilidades</h4>
                  </div>
                  <div class="tags-container">
                    @foreach(collect($professional->skills)->filter() as $skill)
                      <span class="tag">{{ $skill }}</span>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($professional->education)
                <div class="resume-outer mt-4">
                  <div class="upper-title">
                    <h4>Formação Acadêmica</h4>
                  </div>
                  @foreach(collect($professional->education) as $education)
                    <div class="resume-block">
                      <div class="inner">
                        <span class="name">{{ strtoupper(mb_substr($education['institution'] ?? 'C', 0, 1)) }}</span>
                        <div class="title-box">
                          <div class="info-box">
                            <h3>{{ $education['course'] ?? 'Curso não informado' }}</h3>
                            <span>{{ $education['institution'] ?? 'Instituição não informada' }}</span>
                          </div>
                          <div class="edit-box">
                            <span class="year">{{ $education['period'] ?? '' }}</span>
                          </div>
                        </div>
                        @if(!empty($education['description']))
                          <div class="text">{{ $education['description'] }}</div>
                        @endif
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif

              @if($professional->experiences)
                <div class="resume-outer theme-blue mt-4">
                  <div class="upper-title">
                    <h4>Experiência Profissional</h4>
                  </div>
                  @foreach(collect($professional->experiences) as $experience)
                    <div class="resume-block">
                      <div class="inner">
                        <span class="name">{{ strtoupper(mb_substr($experience['company'] ?? 'P', 0, 1)) }}</span>
                        <div class="title-box">
                          <div class="info-box">
                            <h3>{{ $experience['role'] ?? 'Cargo não informado' }}</h3>
                            <span>{{ $experience['company'] ?? 'Empresa não informada' }}</span>
                          </div>
                          <div class="edit-box">
                            <span class="year">{{ $experience['period'] ?? '' }}</span>
                          </div>
                        </div>
                        @if(!empty($experience['description']))
                          <div class="text">{{ $experience['description'] }}</div>
                        @endif
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>

          <div class="sidebar-column col-lg-4 col-md-12 col-sm-12 order-1">
            <aside class="sidebar">
              <div class="sidebar-widget contact-widget">
                <h4 class="widget-title">Informações de Contato</h4>
                <div class="widget-content">
                  <ul class="contact-info">
                    @if($professional->phone)
                      <li><span class="icon flaticon-phone"></span> {{ $professional->phone }}</li>
                    @endif
                    <li><span class="icon flaticon-mail"></span> {{ $professional->user->email ?? 'E-mail não informado' }}</li>
                    <li><span class="icon flaticon-map-locator"></span> {{ collect([$professional->city, $professional->state])->filter()->implode(', ') ?: 'Localização não informada' }}</li>
                  </ul>
                </div>
              </div>

              @php
                $facebookUrl = $professional->facebook;
                $instagramUrl = $professional->instagram
                  ? (\Illuminate\Support\Str::startsWith($professional->instagram, ['http://', 'https://'])
                    ? $professional->instagram
                    : 'https://instagram.com/' . ltrim($professional->instagram, '@'))
                  : null;
                $linkedinUrl = $professional->linkedin && !\Illuminate\Support\Str::startsWith($professional->linkedin, ['http://', 'https://'])
                  ? 'https://' . ltrim($professional->linkedin, 'https://')
                  : $professional->linkedin;
                $websiteUrl = $professional->website && !\Illuminate\Support\Str::startsWith($professional->website, ['http://', 'https://'])
                  ? 'https://' . ltrim($professional->website, 'https://')
                  : $professional->website;
              @endphp

              <div class="sidebar-widget m-0">
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
                    @if($websiteUrl)
                      <a href="{{ $websiteUrl }}" target="_blank" rel="noopener"><i class="fas fa-globe"></i></a>
                    @endif
                    @if(!$facebookUrl && !$instagramUrl && !$linkedinUrl && !$websiteUrl)
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

