@extends('layouts.dashboard-professional')

@section('title', 'Minhas Candidaturas - VagaPet')

@section('content')
  <!-- Painel do Candidato -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Candidaturas</h3>
        <div class="text">Pronto para continuar?</div>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="row">
        <div class="col-lg-12">
          <!-- Widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Minhas Candidaturas</h4>

                <form method="GET" action="{{ route('professional.applications') }}" id="filter-form" style="display: contents;">
                  <div class="chosen-outer">
                    <!-- Filtro de Tempo -->
                    <select class="chosen-select" name="time_filter" onchange="document.getElementById('filter-form').submit();">
                      <option value="6months" {{ request('time_filter', '6months') == '6months' ? 'selected' : '' }}>Últimos 6 meses</option>
                      <option value="12months" {{ request('time_filter') == '12months' ? 'selected' : '' }}>Últimos 12 meses</option>
                      <option value="16months" {{ request('time_filter') == '16months' ? 'selected' : '' }}>Últimos 16 meses</option>
                      <option value="24months" {{ request('time_filter') == '24months' ? 'selected' : '' }}>Últimos 24 meses</option>
                      <option value="5years" {{ request('time_filter') == '5years' ? 'selected' : '' }}>Últimos 5 anos</option>
                    </select>
                  </div>
                </form>
              </div>

              <div class="widget-content">
                <div class="row">
                  @forelse($applications as $application)
                    @php
                      $job = $application->job;
                      $company = $job->companyProfile ?? null;
                      $statusBadgeClass = match($application->status) {
                        'approved' => 'text-bg-success',
                        'rejected' => 'text-bg-danger',
                        'withdrawn' => 'text-bg-secondary',
                        default => 'text-bg-warning'
                      };
                      $statusText = match($application->status) {
                        'approved' => 'Aprovado',
                        'rejected' => 'Rejeitado',
                        'withdrawn' => 'Cancelado',
                        default => 'Em análise'
                      };
                    @endphp
                    <div class="job-block col-lg-6 col-md-12 col-sm-12">
                      <div class="inner-box">
                        <span class="badge {{ $statusBadgeClass }} text-white rounded-start-2" style="position:absolute; bottom:10px; right:10px; padding: 5px 10px;">{{ $statusText }}</span>
                        <div class="content">
                          <span class="company-logo">
                            @if($company && $company->logo)
                              <img src="{{ url($company->logo) }}" alt="{{ $company->company_name }}">
                            @else
                              <img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt="">
                            @endif
                          </span>

                          <h4><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}@if($company) – {{ $company->company_name }}@endif</a></h4>

                          <ul class="job-info">
                            <li><span class="icon flaticon-briefcase"></span> {{ $job->applications_count ?? 0 }} candidaturas</li>
                            <li><span class="icon flaticon-map-locator"></span> {{ $job->city ?? 'Não informado' }}, {{ $job->state ?? '' }}</li>
                            <li><span class="icon flaticon-clock-3"></span> {{ $application->created_at->format('d M Y') }}</li>
                          </ul>

                          <div class="option-box">
                            <ul class="option-list">
                              <li class="m-0">
                                <a href="{{ route('jobs.show', $job->slug) }}" data-text="Ver vaga">
                                  <span class="la la-eye"></span>
                                </a>
                              </li>
                              @if($application->status == 'pending')
                                <li>
                                  <button type="button" class="btn-link edit-application" data-application-id="{{ $application->id }}" data-cover-letter="{{ $application->cover_letter }}" data-text="Editar detalhes">
                                    <span class="la la-pencil"></span>
                                  </button>
                                </li>
                                <li>
                                  <form method="POST" action="{{ route('professional.withdraw-application', $application->id) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja cancelar esta candidatura?');">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn-link" data-text="Cancelar candidatura">
                                      <span class="la la-trash"></span>
                                    </button>
                                  </form>
                                </li>
                              @endif
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-lg-12">
                      <div class="alert alert-info">
                        <p>Você ainda não se candidatou para nenhuma vaga.</p>
                        <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-one">Buscar Vagas</a>
                      </div>
                    </div>
                  @endforelse
                </div>

                <!-- Paginação -->
                @if($applications->hasPages())
                  <div class="ls-pagination mt-4">
                    {{ $applications->links() }}
                  </div>
                @endif
              </div>
              <!-- Fim widget-content -->
            </div>
            <!-- Fim tabs-box -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal para Editar Carta de Apresentação -->
  <div class="modal fade" id="editApplicationModal" tabindex="-1" role="dialog" aria-labelledby="editApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editApplicationModalLabel">Editar Carta de Apresentação</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" id="editApplicationForm">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="cover_letter">Carta de Apresentação</label>
              <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5" placeholder="Escreva uma mensagem para a empresa..."></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fim do Painel do Candidato -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
  // Abrir modal para editar carta de apresentação
  document.addEventListener('click', function(e) {
    if (e.target.closest('.edit-application')) {
      const button = e.target.closest('.edit-application');
      const applicationId = button.getAttribute('data-application-id');
      const coverLetter = button.getAttribute('data-cover-letter') || '';
      
      document.getElementById('cover_letter').value = coverLetter;
      document.getElementById('editApplicationForm').action = '{{ url("/profissional/candidaturas") }}/' + applicationId + '/update';
      
      $('#editApplicationModal').modal('show');
    }
  });
</script>
@endpush
