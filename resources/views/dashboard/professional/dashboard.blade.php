@extends('layouts.dashboard-professional')

@section('title', 'Dashboard Profissional - VagaPet')

@section('content')

  <!-- Painel de Vagas -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Olá, {{ Auth::user()->professionalProfile->first_name ?? Auth::user()->name }}!</h3>
        <div class="text">Aqui você vê o resumo do seu perfil.</div>
      </div>

      @if($profileCompletion < 90)
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
          <strong><i class="la la-exclamation-triangle"></i> Atenção!</strong> 
          Seu perfil está {{ $profileCompletion }}% completo. Para aparecer nas buscas, você precisa completar pelo menos 90% do seu perfil.
          <a href="{{ route('professional.profile') }}" class="alert-link">Complete seu perfil agora</a>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="row">
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-blue">
            <div class="left"><i class="icon flaticon-briefcase"></i></div>
            <div class="right">
              <h4>{{ number_format($stats['views_count'], 0, ',', '.') }}</h4>
              <p>Visualizações do Perfil</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-red">
            <div class="left"><i class="icon la la-file-invoice"></i></div>
            <div class="right">
              <h4>{{ number_format($stats['applications_count'], 0, ',', '.') }}</h4>
              <p>Candidaturas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-yellow">
            <div class="left"><i class="icon la la-check-circle"></i></div>
            <div class="right">
              <h4>{{ number_format($stats['approved_applications'], 0, ',', '.') }}</h4>
              <p>Aprovadas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-green">
            <div class="left"><i class="icon la la-bookmark-o"></i></div>
            <div class="right">
              <h4>{{ number_format($stats['favorites_count'], 0, ',', '.') }}</h4>
              <p>Favoritos</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Widgets -->
      <div class="row">

        <!-- Gráfico de Visualizações -->
        <div class="col-xl-7 col-lg-12">
          <div class="graph-widget ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Visualizações do Perfil</h4>
                <div class="chosen-outer">
                  <select class="chosen-select">
                    <option>Últimos 6 Meses</option>
                    <option>Últimos 12 Meses</option>
                    <option>Últimos 16 Meses</option>
                    <option>Últimos 24 Meses</option>
                    <option>Últimos 5 Anos</option>
                  </select>
                </div>
              </div>
              <div class="widget-content">
                <canvas id="chart" width="100" height="45"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Notificações Rápidas -->
        <div class="col-xl-5 col-lg-12">
          <div class="notification-widget ls-widget">
            <div class="widget-title">
              <h4>Notificações</h4>
              @if($recent_applications->isNotEmpty())
                <a href="{{ route('professional.applications') }}" class="theme-btn btn-style-three small">Ver todas</a>
              @endif
            </div>
            <div class="widget-content">
              @if($recent_applications->isNotEmpty())
                <ul class="notification-list">
                  @foreach($recent_applications as $application)
                    @php
                      $statusClass = match($application->status) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => ''
                      };
                    @endphp
                    <li class="{{ $statusClass }}">
                      <span class="icon flaticon-briefcase"></span>
                      <strong>{{ $application->job->title }}</strong>
                      @if($application->job->companyProfile)
                        - {{ $application->job->companyProfile->company_name }}
                      @endif
                      <br>
                      <small>
                        Status: 
                        @if($application->status === 'approved')
                          <span class="text-success">Aprovada</span>
                        @elseif($application->status === 'rejected')
                          <span class="text-danger">Rejeitada</span>
                        @elseif($application->status === 'pending')
                          <span class="text-warning">Em análise</span>
                        @else
                          {{ ucfirst($application->status) }}
                        @endif
                        • {{ $application->created_at->format('d/m/Y') }}
                      </small>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="text-center text-muted py-4">Nenhuma candidatura recente</p>
              @endif
            </div>
          </div>
        </div>

        <!-- Vagas Recomendadas -->
        @if($recommended_jobs->isNotEmpty())
          <div class="col-lg-12">
            <div class="vagas-widget ls-widget">
              <div class="widget-title">
                <h4>Vagas Recomendadas</h4>
                <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-three small">Ver todas</a>
              </div>
              <div class="widget-content">
                <ul class="vaga-lista">
                  @foreach($recommended_jobs as $job)
                    <li>
                      <span class="icon flaticon-briefcase"></span>
                      <strong><a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a></strong>
                      @if($job->companyProfile)
                        - {{ $job->companyProfile->company_name }}
                      @endif
                      @if($job->city)
                        ({{ $job->city }}{{ $job->state ? ', ' . $job->state : '' }})
                      @endif
                      <span class="colored">
                        @if($job->contract_type === 'full_time')
                          Tempo Integral
                        @elseif($job->contract_type === 'part_time')
                          Meio Período
                        @elseif($job->contract_type === 'freelance')
                          Freelance
                        @else
                          {{ ucfirst($job->contract_type) }}
                        @endif
                      </span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif

      </div>
    </div>
  </section>
  <!-- End Painel de Vagas -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
  Chart.defaults.global.defaultFontFamily = "Poppins";
  Chart.defaults.global.defaultFontColor = '#888';
  Chart.defaults.global.defaultFontSize = 14;
  var ctx = document.getElementById('chart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: @json($chartLabels),
      datasets: [{
        label: "Visualizações",
        backgroundColor: 'transparent',
        borderColor: '#1967D2',
        borderWidth: 1,
        data: @json($chartData),
        pointRadius: 3,
        pointHoverRadius: 3,
        pointHitRadius: 10,
        pointBackgroundColor: "#1967D2",
        pointHoverBackgroundColor: "#1967D2",
        pointBorderWidth: 2
      }]
    },
    options: {
      layout: { padding: 10 },
      legend: { display: false },
      title: { display: false },
      scales: {
        yAxes: [{ gridLines: { borderDash: [6,10], color: "#d8d8d8", lineWidth: 1 } }],
        xAxes: [{ gridLines: { display: false } }]
      },
      tooltips: {
        backgroundColor: '#333',
        titleFontSize: 13,
        titleFontColor: '#fff',
        bodyFontColor: '#fff',
        bodyFontSize: 13,
        displayColors: false,
        xPadding: 10,
        yPadding: 10,
        intersect: false
      }
    }
  });
</script>
@endpush
