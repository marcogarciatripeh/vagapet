@forelse($jobs as $job)
  @php
    $logo = $job->companyProfile && $job->companyProfile->logo 
      ? url('storage/' . $job->companyProfile->logo) 
      : asset('images/resource/company-logo/1-1.png');
    $companyName = $job->companyProfile->company_name ?? 'Empresa';
    $location = collect([$job->city, $job->state])->filter()->implode(', ') ?: 'Local não informado';
    $salary = $job->salary_range ?? 'A combinar';
    $contractType = match($job->contract_type) {
      'clt' => 'CLT',
      'pj' => 'PJ',
      'freelancer' => 'Freelancer',
      'temporary' => 'Temporário',
      'internship' => 'Estágio',
      default => 'Não informado'
    };
  @endphp
  <div class="job-block-seven">
    <div class="inner-box">
      <div class="content">
        <figure class="image">
          <img src="{{ $logo }}" alt="{{ $companyName }}">
        </figure>
        <h4><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a></h4>
        <a href="{{ route('companies.show', $job->companyProfile) }}"><span class="designation">{{ $companyName }}</span></a>
        <ul class="job-info">
          <li><span class="icon flaticon-map-locator"></span> {{ $location }}</li>
          <li><span class="icon flaticon-clock-3"></span> {{ $job->created_at->diffForHumans() }}</li>
          <li><span class="icon flaticon-money"></span> {{ $salary }}</li>
        </ul>
        <ul class="job-other-info">
          <li class="time">{{ $contractType }}</li>
        </ul>
      </div>
      <div class="btn-box">
        <a href="{{ route('jobs.show', $job->slug) }}" class="theme-btn btn-style-one">Ver Detalhes</a>
        @auth
          @if(Auth::user()->professionalProfile)
            @php
              $isFavorited = isset($favoritedJobIds) && $favoritedJobIds->contains($job->id);
            @endphp
            <button class="bookmark-btn {{ $isFavorited ? 'active' : '' }}" data-favorite-id="{{ $job->id }}" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})" title="{{ $isFavorited ? 'Remover dos favoritos' : 'Favoritar vaga' }}">
              <i class="flaticon-bookmark"></i>
            </button>
          @endif
        @else
          <button class="bookmark-btn" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})" title="Favoritar vaga">
            <i class="flaticon-bookmark"></i>
          </button>
        @endauth
      </div>
    </div>
  </div>
@empty
  <div class="col-12 text-center py-5">
    <h5>Nenhuma vaga encontrada</h5>
    <p class="text-muted">Tente ajustar os filtros ou pesquisar por outras palavras-chave.</p>
  </div>
@endforelse
