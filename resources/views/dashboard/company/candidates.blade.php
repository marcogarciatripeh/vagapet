@extends('layouts.dashboard')

@section('title', 'Candidatos - VagaPet')

@section('content')
  <!-- Painel (Candidatos) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Candidatos</h3>
        <div class="text">Gerencie as candidaturas recebidas</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Candidatos</h4>

                <form method="GET" action="{{ route('company.candidates') }}" id="filter-form" style="display: contents;">
                  <div class="chosen-outer">
                    <!-- Selecione a Vaga -->
                    <select class="chosen-select" name="job_id" onchange="document.getElementById('filter-form').submit();">
                      <option value="">Selecione a Vaga</option>
                      @foreach($jobs as $jobOption)
                        <option value="{{ $jobOption->id }}" {{ request('job_id') == $jobOption->id ? 'selected' : '' }}>
                          {{ $jobOption->title }}
                        </option>
                      @endforeach
                    </select>

                    <!-- Filtro de Status -->
                    <select class="chosen-select" name="status" onchange="document.getElementById('filter-form').submit();">
                      <option value="">Todos os Status</option>
                      <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendente</option>
                      <option value="viewed" {{ request('status') === 'viewed' ? 'selected' : '' }}>Visualizado</option>
                      <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Aprovado</option>
                      <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejeitado</option>
                    </select>
                  </div>
                </form>
              </div>

              <div class="widget-content">
                <div class="tabs-box">
                  @php
                    $totalCount = $applications->total();
                    $approvedCount = $applications->where('status', 'approved')->count();
                    $rejectedCount = $applications->where('status', 'rejected')->count();
                    $selectedJobTitle = request('job_id') 
                      ? $jobs->where('id', request('job_id'))->first()->title ?? 'Todas as Vagas'
                      : 'Todas as Vagas';
                  @endphp
                  <div class="aplicants-upper-bar">
                    <h6>Vaga: {{ $selectedJobTitle }}</h6>
                    <ul class="aplicantion-status tab-buttons clearfix">
                      <li class="tab-btn active-btn totals" data-tab="#totals">
                        Total(s): {{ $totalCount }}
                      </li>
                      <li class="tab-btn approved" data-tab="#approved">
                        Aprovado(s): {{ $approvedCount }}
                      </li>
                      <li class="tab-btn rejected" data-tab="#rejected">
                        Rejeitado(s): {{ $rejectedCount }}
                      </li>
                    </ul>
                  </div>

                  <div class="tabs-content">
                    <!-- Aba Totals -->
                    <div class="tab active-tab" id="totals">
                      <div class="row">
                        @forelse($applications as $application)
                        <!-- Candidato {{ $loop->iteration }} -->
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                @if($application->professionalProfile && $application->professionalProfile->photo)
                                  <img src="{{ url('storage/' . $application->professionalProfile->photo) }}" alt="{{ $application->professionalProfile->full_name }}">
                                @else
                                  <img src="{{ asset('images/resource/candidate-' . (($loop->iteration % 4) + 1) . '.png') }}" alt="Candidato">
                                @endif
                              </figure>
                              <h4 class="name">
                                <a href="{{ route('professionals.show', $application->professionalProfile->id) }}">
                                  {{ $application->professionalProfile->full_name }}
                                </a>
                              </h4>
                              <ul class="candidate-info">
                                <li class="designation">{{ $application->professionalProfile->title ?? 'Profissional' }}</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  {{ $application->professionalProfile->city ?? 'Não informado' }}, {{ $application->professionalProfile->state ?? '' }}
                                </li>
                              </ul>
                              <ul class="post-tags">
                                @if($application->professionalProfile->areas && is_array($application->professionalProfile->areas))
                                  @foreach(array_slice($application->professionalProfile->areas, 0, 2) as $area)
                                    <li><a href="#">{{ $area }}</a></li>
                                  @endforeach
                                @endif
                              </ul>
                            </div>
                            <div class="option-box">
                              <ul class="option-list">
                                <li>
                                  <a href="{{ route('professionals.show', $application->professionalProfile->id) }}" data-text="Ver Candidatura">
                                    <span class="la la-eye"></span>
                                  </a>
                                </li>
                                <li>
                                  <form method="POST" action="{{ route('company.approve-application', $application->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" data-text="Aprovar Candidatura">
                                      <span class="la la-check"></span>
                                    </button>
                                  </form>
                                </li>
                                <li>
                                  <form method="POST" action="{{ route('company.reject-application', $application->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" data-text="Rejeitar Candidatura">
                                      <span class="la la-times-circle"></span>
                                    </button>
                                  </form>
                                </li>
                                <li>
                                  <form method="POST" action="{{ route('company.reject-application', $application->id) }}" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir esta candidatura?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-text="Excluir Candidatura">
                                      <span class="la la-trash"></span>
                                    </button>
                                  </form>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        @empty
                        <div class="col-12">
                          <p class="text-center">Nenhum candidato encontrado.</p>
                        </div>
                        @endforelse
                      </div>
                    </div>

                    <!-- Aba Aprovados -->
                    <div class="tab" id="approved">
                      <div class="row">
                        @foreach($applications->where('status', 'approved') as $application)
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                @if($application->professionalProfile && $application->professionalProfile->photo)
                                  <img src="{{ url('storage/' . $application->professionalProfile->photo) }}" alt="{{ $application->professionalProfile->full_name }}">
                                @else
                                  <img src="{{ asset('images/resource/candidate-' . (($loop->iteration % 4) + 1) . '.png') }}" alt="Candidato">
                                @endif
                              </figure>
                              <h4 class="name">
                                <a href="{{ route('professionals.show', $application->professionalProfile->id) }}">
                                  {{ $application->professionalProfile->full_name }}
                                </a>
                              </h4>
                              <ul class="candidate-info">
                                <li class="designation">{{ $application->professionalProfile->title ?? 'Profissional' }}</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  {{ $application->professionalProfile->city ?? 'Não informado' }}, {{ $application->professionalProfile->state ?? '' }}
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>

                    <!-- Aba Rejeitados -->
                    <div class="tab" id="rejected">
                      <div class="row">
                        @foreach($applications->where('status', 'rejected') as $application)
                        <div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">
                          <div class="inner-box">
                            <div class="content">
                              <figure class="image">
                                @if($application->professionalProfile && $application->professionalProfile->photo)
                                  <img src="{{ url('storage/' . $application->professionalProfile->photo) }}" alt="{{ $application->professionalProfile->full_name }}">
                                @else
                                  <img src="{{ asset('images/resource/candidate-' . (($loop->iteration % 4) + 1) . '.png') }}" alt="Candidato">
                                @endif
                              </figure>
                              <h4 class="name">
                                <a href="{{ route('professionals.show', $application->professionalProfile->id) }}">
                                  {{ $application->professionalProfile->full_name }}
                                </a>
                              </h4>
                              <ul class="candidate-info">
                                <li class="designation">{{ $application->professionalProfile->title ?? 'Profissional' }}</li>
                                <li>
                                  <span class="icon flaticon-map-locator"></span>
                                  {{ $application->professionalProfile->city ?? 'Não informado' }}, {{ $application->professionalProfile->state ?? '' }}
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Paginação -->
                @if($applications->hasPages())
                <div class="ls-pagination mt-4">
                  {{ $applications->links() }}
                </div>
                @endif
              </div>
            </div>
          </div>
          <!-- Fim Widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Candidatos) -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
$(document).ready(function() {
    // Tabs functionality
    $('.tab-btn').on('click', function() {
        var target = $(this).data('tab');
        $('.tab-btn').removeClass('active-btn');
        $(this).addClass('active-btn');
        $('.tab').removeClass('active-tab');
        $(target).addClass('active-tab');
    });
});
</script>
@endpush

