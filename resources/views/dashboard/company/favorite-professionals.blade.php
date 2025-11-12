@extends('layouts.dashboard')

@section('title', 'Profissionais Favoritos - VagaPet')

@section('content')
  <!-- Dashboard -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Profissionais favoritos</h3>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Lista de Vagas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Lista</h4>
                <div class="chosen-outer">
                  <form method="GET" action="{{ route('company.favorite-professionals') }}" id="period-filter-form">
                    <select class="chosen-select" name="period" onchange="document.getElementById('period-filter-form').submit();">
                      <option value="">Todos os períodos</option>
                      <option value="6" {{ request('period') == 6 ? 'selected' : '' }}>Últimos 6 meses</option>
                      <option value="12" {{ request('period') == 12 ? 'selected' : '' }}>Últimos 12 meses</option>
                      <option value="16" {{ request('period') == 16 ? 'selected' : '' }}>Últimos 16 meses</option>
                      <option value="24" {{ request('period') == 24 ? 'selected' : '' }}>Últimos 24 meses</option>
                      <option value="60" {{ request('period') == 60 ? 'selected' : '' }}>Últimos 5 anos</option>
                    </select>
                  </form>
                </div>
              </div>

              <div class="widget-content">
                <div class="row favorites-list">
                  @if($favorites->count())
                    @foreach($favorites as $favorite)
                    @php
                      $professional = $favorite->favoritable;
                    @endphp
                    @if($professional)
                      <div class="job-block col-lg-12 col-md-12 col-sm-12" id="favorite-card-{{ $favorite->id }}">
                        <div class="inner-box">
                          <div class="content">
                            <span class="company-logo">
                              <img src="{{ $professional->photo_url ?? asset('images/resource/default-avatar.png') }}" alt="{{ $professional->full_name }}">
                            </span>
                            <h4><a href="{{ route('professionals.show', $professional) }}" target="_blank">{{ $professional->full_name }}</a></h4>
                            <ul class="job-info">
                              <li><span class="icon flaticon-resume"></span> {{ $professional->title ?? 'Profissional do setor pet' }}</li>
                              <li><span class="icon flaticon-map-locator"></span> {{ collect([$professional->city, $professional->state])->filter()->implode(', ') ?: 'Localização não informada' }}</li>
                              <li><span class="icon flaticon-clock-3"></span> Favoritado {{ $favorite->created_at->diffForHumans() }}</li>
                            </ul>
                            <ul class="job-other-info">
                              @foreach(collect($professional->areas)->filter()->take(3) as $area)
                                <li class="time">{{ $area }}</li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="option-box">
                            <ul class="option-list">
                              <li class="ml-0">
                                <button type="button" data-text="Ver perfil" onclick="window.open('{{ route('professionals.show', $professional) }}', '_blank')">
                                  <span class="la la-eye"></span>
                                </button>
                              </li>
                              <li>
                                <button type="button" data-text="Remover dos favoritos" onclick="removeFavorite({{ $professional->id }}, {{ $favorite->id }}, event); return false;">
                                  <span class="la la-trash"></span>
                                </button>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    @endif
                    @endforeach
                  @else
                    <div class="col-12 text-center py-5" id="favorites-empty-state">
                      <img src="{{ asset('images/resource/default-avatar.png') }}" alt="Sem favoritos" style="max-width: 160px;" class="mb-3">
                      <h5>Você ainda não favoritou profissionais</h5>
                      <p class="text-muted">Explore perfis e favorite talentos para acessar rapidamente mais tarde.</p>
                      <a href="{{ route('professionals.index') }}" class="theme-btn btn-style-two mt-3">Buscar profissionais</a>
                    </div>
                  @endif
                </div>

                @if($favorites->count())
                  <div class="col-12 text-center py-5" id="favorites-empty-state" style="display:none;">
                    <img src="{{ asset('images/resource/default-avatar.png') }}" alt="Sem favoritos" style="max-width: 160px;" class="mb-3">
                    <h5>Você ainda não favoritou profissionais</h5>
                    <p class="text-muted">Explore perfis e favorite talentos para acessar rapidamente mais tarde.</p>
                    <a href="{{ route('professionals.index') }}" class="theme-btn btn-style-two mt-3">Buscar profissionais</a>
                  </div>
                @endif

                @if($favorites instanceof \Illuminate\Contracts\Pagination\Paginator && $favorites->count())
                  <div class="mt-4">
                    {{ $favorites->withQueryString()->links() }}
                  </div>
                @endif
              </div>
            </div>
            <!-- Fim tabs-box -->
          </div>
          <!-- End Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Dashboard -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@include('layouts.partials.favorite-scripts')
<script>
function removeFavorite(professionalId, favoriteId, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  
  if (!confirm('Deseja remover este profissional dos favoritos?')) {
    return false;
  }
  
  toggleFavorite('App\\Models\\ProfessionalProfile', professionalId, {
    onRemoved: function() {
      // Remover o card da lista
      const card = document.getElementById('favorite-card-' + favoriteId);
      if (card) {
        card.style.transition = 'opacity 0.3s ease';
        card.style.opacity = '0';
        setTimeout(function() {
          card.remove();
          
          // Verificar se não há mais favoritos
          const list = document.querySelector('.favorites-list');
          if (list && !list.querySelector('.job-block')) {
            const empty = document.getElementById('favorites-empty-state');
            if (empty) {
              empty.style.display = 'block';
            }
          }
        }, 300);
      }
    },
    onError: function(error) {
      console.error('Erro ao remover favorito:', error);
      alert('Erro ao remover favorito. Tente novamente.');
    }
  });
  
  return false;
}
</script>
@endpush

