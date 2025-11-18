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
                <h4>Minhas Vagas Publicadas</h4>
                <div class="chosen-outer">
                  <form method="GET" action="{{ route('company.manage-jobs') }}" id="jobs-period-filter-form">
                    <select class="chosen-select" name="period" onchange="document.getElementById('jobs-period-filter-form').submit();">
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
                <div class="table-outer row">
                  @forelse($jobs as $job)
                    @php
                      $statusBadge = [
                        'active' => ['class' => 'success', 'label' => 'Ativa'],
                        'paused' => ['class' => 'warning', 'label' => 'Em análise'],
                        'draft' => ['class' => 'danger', 'label' => 'Não publicada'],
                        'closed' => ['class' => 'secondary', 'label' => 'Encerrada'],
                      ];
                      $badge = $statusBadge[$job->status] ?? ['class' => 'secondary', 'label' => ucfirst($job->status)];
                      $logo = $job->companyProfile && $job->companyProfile->logo 
                        ? url($job->companyProfile->logo) 
                        : asset('images/resource/company-logo/1-2.png');
                    @endphp
                    <div class="job-block col-lg-6 col-md-12 col-sm-12">
                      <div class="inner-box">
                        <span class="badge text-bg-{{ $badge['class'] }} text-white rounded-start-2" style="position:absolute; bottom:10px; right:10px;">{{ $badge['label'] }}</span>
                        <div class="content">
                          <span class="company-logo">
                            <img src="{{ $logo }}" alt="">
                          </span>

                          <h4><a href="{{ route('jobs.show', $job->slug) }}" target="_blank">{{ $job->title }} – {{ $job->companyProfile->company_name ?? 'Empresa' }}</a></h4>

                          <ul class="job-info">
                            <li><span class="icon flaticon-briefcase"></span> {{ $job->applications_count ?? 0 }} {{ \Illuminate\Support\Str::plural('candidatura', $job->applications_count ?? 0) }}</li>
                            <li><span class="icon flaticon-map-locator"></span> {{ $job->city ?? 'Não informado' }}, {{ $job->state ?? '' }}</li>
                            @php
                              $mesesPt = [
                                1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr',
                                5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago',
                                9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez'
                              ];
                              $mesAbrev = $mesesPt[$job->created_at->month];
                            @endphp
                            <li><span class="icon flaticon-clock-3"></span> {{ $job->created_at->format('d') }} {{ $mesAbrev }} {{ $job->created_at->format('Y') }}</li>
                          </ul>
                          <div class="option-box pb-4">
                            <ul class="option-list">
                              <li class="ml-0"><button onclick="window.open('{{ route('jobs.show', $job->slug) }}', '_blank')" data-text="Ver vaga"><span class="la la-eye"></span></button></li>
                              <li><button onclick="window.location.href='{{ route('company.edit-job', $job->id) }}'" data-text="Editar vaga"><span class="la la-pencil"></span></button></li>
                              <li><button data-text="Apagar vaga" onclick="if(confirm('Deseja realmente excluir esta vaga?')) { document.getElementById('delete-form-{{ $job->id }}').submit(); }"><span class="la la-trash"></span></button></li>
                            </ul>
                            <form id="delete-form-{{ $job->id }}" method="POST" action="{{ route('company.delete-job', $job->id) }}" style="display:none;">
                              @csrf
                              @method('DELETE')
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-12">
                      <p class="text-center">Nenhuma vaga publicada ainda.</p>
                    </div>
                  @endforelse
                </div>
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
