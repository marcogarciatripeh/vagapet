<div class="row">
  @forelse($companies as $company)
    @php
      $logoUrl = $company->logo_url ?? asset('images/resource/default-company.png');
      $location = collect([$company->city, $company->state])->filter()->implode(', ');
      $services = collect($company->services)->filter()->take(3);
      $employees = $company->employees_count ? $company->employees_count . ' colaboradores' : 'Equipe não informada';
      $companySize = [
        'micro' => 'Microempresa',
        'small' => 'Pequena',
        'medium' => 'Média',
        'large' => 'Grande',
      ][$company->company_size] ?? 'Porte não informado';
    @endphp
    <div class="job-block col-lg-12 col-md-12 col-sm-12">
      <div class="inner-box">
        <div class="content">
          <span class="company-logo">
            <img src="{{ $logoUrl }}" alt="{{ $company->company_name }}">
          </span>
          <h4>
            <a href="{{ route('companies.show', $company) }}">{{ $company->company_name }}</a>
          </h4>
          <ul class="job-info">
            <li><span class="icon flaticon-briefcase"></span> {{ $companySize }}</li>
            <li><span class="icon flaticon-group"></span> {{ $employees }}</li>
            <li><span class="icon flaticon-map-locator"></span> {{ $location ?: 'Localização não informada' }}</li>
            <li><span class="icon flaticon-clock-3"></span> Atualizado {{ $company->updated_at?->diffForHumans() }}</li>
          </ul>
          @if($services->isNotEmpty())
            <ul class="job-other-info">
              @foreach($services as $service)
                <li class="time">{{ $service }}</li>
              @endforeach
            </ul>
          @endif
          <div class="d-flex gap-2 mt-3">
            <a href="{{ route('companies.show', $company) }}" class="theme-btn btn-style-three">
              <i class="las la-door-open"></i> Ver detalhes
            </a>
            <button class="bookmark-btn" type="button" title="Favoritar empresa">
              <span class="flaticon-bookmark"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12 text-center py-5">
      <img src="{{ asset('images/resource/default-company.png') }}" alt="Sem resultados" class="mb-3" style="max-width: 160px;">
      <h5>Nenhuma empresa encontrada</h5>
      <p class="text-muted">Tente ajustar os filtros ou pesquisar por outra palavra-chave.</p>
      <a href="{{ route('companies.index') }}" class="theme-btn btn-style-two mt-3">
        Limpar filtros
      </a>
    </div>
  @endforelse

  @if($companies instanceof \Illuminate\Contracts\Pagination\Paginator)
    <div class="col-12 mt-4">
      {{ $companies->withQueryString()->links() }}
    </div>
  @endif
</div>
