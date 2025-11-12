<div class="row">
  @forelse($professionals as $professional)
    @php
      $photoUrl = $professional->photo_url ?? asset('images/resource/default-avatar.png');
      $location = collect([$professional->city, $professional->state])->filter()->implode(', ');
      $areas = collect($professional->areas)->filter()->take(3);
      $skills = collect($professional->skills)->filter()->take(3);
      $experienceLevels = [
        'estagio' => 'Estágio',
        'junior' => 'Júnior',
        'pleno' => 'Pleno',
        'senior' => 'Sênior',
      ];
      $experienceLabel = $experienceLevels[$professional->experience_level] ?? 'Experiência não informada';
    @endphp
    <div class="job-block col-lg-12 col-md-12 col-sm-12">
      <div class="inner-box">
        <div class="content">
          <span class="company-logo">
            <img src="{{ $photoUrl }}" alt="{{ $professional->full_name }}">
          </span>
          <h4><a href="{{ route('professionals.show', $professional) }}">{{ $professional->full_name }}</a></h4>
          <p class="mb-2 text-muted">{{ $professional->title ?? 'Profissional do setor pet' }}</p>
          <ul class="job-info">
            <li><span class="icon flaticon-map-locator"></span> {{ $location ?: 'Localização não informada' }}</li>
            <li><span class="icon flaticon-resume"></span> {{ $experienceLabel }}</li>
            <li><span class="icon flaticon-briefcase"></span> {{ $professional->years_experience }} {{ \Illuminate\Support\Str::plural('ano', $professional->years_experience) }} de experiência</li>
            <li><span class="icon flaticon-clock-3"></span> Atualizado {{ $professional->updated_at?->diffForHumans() }}</li>
          </ul>
          @if($areas->isNotEmpty())
            <ul class="job-other-info">
              @foreach($areas as $area)
                <li class="time">{{ $area }}</li>
              @endforeach
            </ul>
          @endif
          @if($skills->isNotEmpty())
            <div class="tags-container mt-2">
              @foreach($skills as $skill)
                <span class="tag">{{ $skill }}</span>
              @endforeach
            </div>
          @endif
          <div class="d-flex gap-2 mt-3">
            <a href="{{ route('professionals.show', $professional) }}" class="theme-btn btn-style-three">
              <i class="las la-user"></i> Ver perfil
            </a>
            <button class="bookmark-btn" type="button" title="Favoritar profissional">
              <span class="flaticon-bookmark"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12 text-center py-5">
      <img src="{{ asset('images/resource/default-avatar.png') }}" alt="Sem profissionais" class="mb-3" style="max-width: 160px;">
      <h5>Nenhum profissional encontrado</h5>
      <p class="text-muted">Tente ajustar os filtros ou pesquisar por outra habilidade.</p>
      <a href="{{ route('professionals.index') }}" class="theme-btn btn-style-two mt-3">
        Limpar filtros
      </a>
    </div>
  @endforelse

  @if($professionals instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="col-12 mt-4">
      {{ $professionals->withQueryString()->links() }}
    </div>
  @endif
</div>
