@extends('layouts.dashboard')

@section('title', 'Gerenciar Vagas - VagaPet')

@section('content')
  <!-- Painel de Gerenciar Vagas -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Gerenciar Vagas</h3>
        <div class="text">Pronto para voltar ao trabalho?</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Minhas Vagas</h4>
                <div class="flex-grow-1">
                  <form class="row g-2 justify-content-end" method="GET" action="{{ route('company.manage-jobs') }}">
                    <div class="col-md-6">
                      <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por título">
                    </div>
                    <div class="col-md-4">
                      <select name="status" class="form-select">
                        <option value="">Todos os status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Publicado</option>
                        <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>Pausado</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Rascunho</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Encerrado</option>
                  </select>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="theme-btn btn-style-two w-100">Filtrar</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="widget-content">
                <div class="table-outer row">
                  @forelse($jobs as $job)
                    @php
                      $statusColors = [
                        'active' => 'success',
                        'paused' => 'warning',
                        'draft' => 'secondary',
                        'closed' => 'danger',
                      ];
                      $statusLabels = [
                        'active' => 'Publicado',
                        'paused' => 'Pausado',
                        'draft' => 'Rascunho',
                        'closed' => 'Encerrado',
                      ];
                      $badgeColor = $statusColors[$job->status] ?? 'secondary';
                    @endphp
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <span class="badge text-bg-{{ $badgeColor }} text-white rounded-start-2" style="position:absolute; bottom:0; right:0;">
                          {{ $statusLabels[$job->status] ?? ucfirst($job->status) }}
                        </span>
                        <div class="content">
                          <span class="company-logo">
                            <img src="{{ optional($job->companyProfile)->logo_url ?? asset('images/resource/default-company.png') }}" alt="{{ $job->companyProfile->company_name ?? 'Empresa' }}">
                          </span>
                          <h4><a href="{{ route('jobs.show', $job->slug) }}" target="_blank">{{ $job->title }}</a></h4>

                        <ul class="job-info">
                            <li><span class="icon flaticon-briefcase"></span> {{ $job->applications_count }} {{ \Illuminate\Support\Str::plural('candidatura', $job->applications_count) }}</li>
                            <li><span class="icon flaticon-map-locator"></span> {{ collect([$job->city, $job->state])->filter()->implode(', ') ?: 'Local não informado' }}</li>
                            <li><span class="icon flaticon-clock-3"></span> Atualizado {{ $job->updated_at->diffForHumans() }}</li>
                          </ul>
                        <div class="option-box pb-4">
                          <ul class="option-list">
                              <li class="ml-0">
                                <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" data-text="Ver vaga">
                                  <span class="la la-eye"></span>
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('company.edit-job', $job->id) }}" data-text="Editar vaga">
                                  <span class="la la-pencil"></span>
                                </a>
                              </li>
                              <li>
                                <form method="POST" action="{{ route('company.delete-job', $job->id) }}" onsubmit="return confirm('Deseja realmente excluir esta vaga?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" data-text="Apagar vaga"><span class="la la-trash"></span></button>
                                </form>
                              </li>
                          </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-12 text-center py-5">
                      <img src="{{ asset('images/resource/default-company.png') }}" alt="Sem vagas" style="max-width: 160px;" class="mb-3">
                      <h5>Você ainda não publicou nenhuma vaga</h5>
                      <p class="text-muted">Clique no botão abaixo para criar sua primeira oportunidade.</p>
                      <a href="{{ route('company.create-job') }}" class="theme-btn btn-style-two mt-3">Publicar nova vaga</a>
                    </div>
                  @endforelse
                  </div>

                @if($jobs instanceof \Illuminate\Contracts\Pagination\Paginator && $jobs->count())
                  <div class="mt-4">
                    {{ $jobs->withQueryString()->links() }}
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
