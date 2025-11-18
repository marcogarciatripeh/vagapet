@extends('layouts.dashboard')

@section('title', 'Dashboard Empresa - VagaPet')

@section('content')

  <!-- Painel da Empresa -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <div class="row">
          <div class="col-lg-9">
            <h3>Olá, {{ Auth::user()->companyProfile->company_name ?? Auth::user()->name }}!</h3>
          </div>
          <div class="col-lg-3">
            <a href="{{ route('company.create-job') }}" type="button" class="theme-btn btn-style-one medium">Publicar Vaga</a>
          </div>
        </div>
      </div>

      @if($profileCompletion < 90)
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
          <strong><i class="la la-exclamation-triangle"></i> Atenção!</strong> 
          Seu perfil está {{ $profileCompletion }}% completo. Complete seu perfil para melhorar sua visibilidade na plataforma.
          <a href="{{ route('company.profile') }}" class="alert-link">Complete seu perfil agora</a>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="row">
        <div class="ui-block col-xl-4 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-blue">
            <div class="left"><i class="icon flaticon-briefcase"></i></div>
            <div class="right">
              <h4>{{ $stats['jobs_count'] }}</h4>
              <p>Vagas Publicadas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-4 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-red">
            <div class="left"><i class="icon la la-file-invoice"></i></div>
            <div class="right">
              <h4>{{ number_format($stats['applications_received'], 0, ',', '.') }}</h4>
              <p>Candidaturas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-4 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-green">
            <div class="left"><i class="icon la la-bookmark-o"></i></div>
            <div class="right">
              <h4>{{ $stats['favorites_count'] }}</h4>
              <p>Profissionais Favoritos</p>
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
                <a href="{{ route('company.candidates') }}" class="theme-btn btn-style-three small">Ver todas</a>
              @endif
            </div>
            <div class="widget-content">
              @if($recent_applications->isNotEmpty())
                <ul class="notification-list">
                  @foreach($recent_applications as $application)
                    <li class="{{ $application->status === 'approved' ? 'success' : '' }}">
                      <span class="icon flaticon-briefcase"></span>
                      <strong>{{ $application->professionalProfile->first_name ?? 'Profissional' }} {{ $application->professionalProfile->last_name ?? '' }}</strong>
                      se candidatou à vaga
                      <span class="colored">{{ $application->job->title }}</span>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="text-center text-muted py-4">Nenhuma candidatura recente</p>
              @endif
            </div>
          </div>
        </div>

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
