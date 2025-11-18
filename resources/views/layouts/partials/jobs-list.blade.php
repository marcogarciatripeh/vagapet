@forelse($jobs as $job)
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
    
    $isFavorited = isset($favoritedJobIds) && $favoritedJobIds->contains($job->id);
  @endphp
  <div class="job-block col-lg-12">
    <div class="inner-box">
      <div class="content">
        <span class="company-logo"><img src="{{ $logo }}" alt="{{ $companyName }}"></span>
        <h4><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a></h4>
        <ul class="job-info">
          @if($job->area)
            <li><span class="icon flaticon-briefcase"></span> {{ $job->area }}</li>
          @endif
          <li><span class="icon flaticon-map-locator"></span> {{ $location }}</li>
          <li><span class="icon flaticon-clock-3"></span> {{ $job->created_at->diffForHumans() }}</li>
          <li><span class="icon flaticon-money"></span> {{ $salary }}</li>
        </ul>
        <ul class="job-other-info">
          <li class="time">{{ $contractType }}</li>
        </ul>
        @auth
          @if(Auth::user()->professionalProfile)
            <button class="bookmark-btn {{ $isFavorited ? 'active' : '' }}" data-favorite-id="{{ $job->id }}" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})" title="{{ $isFavorited ? 'Remover dos favoritos' : 'Favoritar vaga' }}">
              <span class="flaticon-bookmark"></span>
            </button>
          @endif
        @else
          <button class="bookmark-btn" onclick="toggleFavorite('App\\Models\\Job', {{ $job->id }})" title="Favoritar vaga">
            <span class="flaticon-bookmark"></span>
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
