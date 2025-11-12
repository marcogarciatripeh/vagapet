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
                  <select class="chosen-select">
                    <option>Últimos 6 meses</option>
                    <option>Últimos 12 meses</option>
                    <option>Últimos 16 meses</option>
                    <option>Últimos 24 meses</option>
                    <option>Últimos 5 anos</option>
                  </select>
                </div>
              </div>

              <div class="widget-content">
                <div class="row">
                  @forelse($favorites as $favorite)
                    @php
                      $professional = $favorite->favoritable;
                    @endphp
                    @if($professional)
                      <div class="job-block col-lg-12 col-md-12 col-sm-12">
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
                            <form method="POST" action="{{ route('company.toggle-favorite') }}" class="bookmark-btn position-relative">
                              @csrf
                              <input type="hidden" name="favoritable_type" value="{{ App\Models\ProfessionalProfile::class }}">
                              <input type="hidden" name="favoritable_id" value="{{ $professional->id }}">
                              <button type="submit" class="bookmark-btn active" title="Remover dos favoritos">
                                <span class="flaticon-bookmark"></span>
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    @endif
                  @empty
                    <div class="col-12 text-center py-5">
                      <img src="{{ asset('images/resource/default-avatar.png') }}" alt="Sem favoritos" style="max-width: 160px;" class="mb-3">
                      <h5>Você ainda não favoritou profissionais</h5>
                      <p class="text-muted">Explore perfis e favorite talentos para acessar rapidamente mais tarde.</p>
                      <a href="{{ route('professionals.index') }}" class="theme-btn btn-style-two mt-3">Buscar profissionais</a>
                    </div>
                  @endforelse
                </div>

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
@endpush

