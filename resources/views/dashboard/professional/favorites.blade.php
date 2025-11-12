@extends('layouts.dashboard-professional')

@section('title', 'Favoritos - VagaPet')

@section('content')
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Favoritos</h3>
        <div class="text">Acompanhe suas vagas e empresas salvas</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Lista atualizada</h4>
              </div>

              <div class="widget-content">
                <div class="row">
                  @forelse($favorites as $favorite)
                    @php $item = $favorite->favoritable; @endphp

                    @if($item instanceof App\Models\Job)
                      <div class="job-block col-lg-12">
                        <div class="inner-box">
                          <div class="content">
                            <span class="company-logo">
                              <img src="{{ optional($item->companyProfile)->logo_url ?? asset('images/resource/default-company.png') }}" alt="{{ optional($item->companyProfile)->company_name }}">
                            </span>
                            <h4><a href="{{ route('jobs.show', $item->slug) }}" target="_blank">{{ $item->title }}</a></h4>
                            <ul class="job-info">
                              <li><span class="icon flaticon-briefcase"></span> {{ ucfirst($item->experience_level ?? 'indiferente') }}</li>
                              <li><span class="icon flaticon-map-locator"></span> {{ collect([$item->city, $item->state])->filter()->implode(', ') ?: 'Local não informado' }}</li>
                              <li><span class="icon flaticon-clock-3"></span> Favoritada {{ $favorite->created_at->diffForHumans() }}</li>
                            </ul>
                            <form method="POST" action="{{ route('professional.toggle-favorite') }}" class="bookmark-btn active">
                              @csrf
                              <input type="hidden" name="favoritable_type" value="{{ App\Models\Job::class }}">
                              <input type="hidden" name="favoritable_id" value="{{ $item->id }}">
                              <button type="submit" title="Remover dos favoritos"><span class="flaticon-bookmark"></span></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    @elseif($item instanceof App\Models\CompanyProfile)
                      <div class="job-block col-lg-12">
                        <div class="inner-box">
                          <div class="content">
                            <span class="company-logo">
                              <img src="{{ $item->logo_url ?? asset('images/resource/default-company.png') }}" alt="{{ $item->company_name }}">
                            </span>
                            <h4><a href="{{ route('companies.show', $item) }}" target="_blank">{{ $item->company_name }}</a></h4>
                            <ul class="job-info">
                              <li><span class="icon flaticon-team"></span> {{ $item->employees_count ? $item->employees_count . ' colaboradores' : 'Equipe não informada' }}</li>
                              <li><span class="icon flaticon-map-locator"></span> {{ collect([$item->city, $item->state])->filter()->implode(', ') ?: 'Local não informado' }}</li>
                              <li><span class="icon flaticon-clock-3"></span> Favoritada {{ $favorite->created_at->diffForHumans() }}</li>
                            </ul>
                            <form method="POST" action="{{ route('professional.toggle-favorite') }}" class="bookmark-btn active">
                              @csrf
                              <input type="hidden" name="favoritable_type" value="{{ App\Models\CompanyProfile::class }}">
                              <input type="hidden" name="favoritable_id" value="{{ $item->id }}">
                              <button type="submit" title="Remover dos favoritos"><span class="flaticon-bookmark"></span></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    @endif
                  @empty
                    <div class="col-12 text-center py-5">
                      <img src="{{ asset('images/resource/default-company.png') }}" alt="Sem favoritos" style="max-width: 160px;" class="mb-3">
                      <h5>Você ainda não favoritou oportunidades</h5>
                      <p class="text-muted">Salve vagas e empresas para acompanhá-las posteriormente.</p>
                      <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-two mt-3">Explorar vagas</a>
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
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush

