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

      <div class="row">
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-blue">
            <div class="left"><i class="icon flaticon-briefcase"></i></div>
            <div class="right">
              <h4>22</h4>
              <p>Vagas Publicadas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-red">
            <div class="left"><i class="icon la la-file-invoice"></i></div>
            <div class="right">
              <h4>9.382</h4>
              <p>Candidaturas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-yellow">
            <div class="left"><i class="icon la la-comment-o"></i></div>
            <div class="right">
              <h4>74</h4>
              <p>Mensagens</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="ui-item ui-green">
            <div class="left"><i class="icon la la-bookmark-o"></i></div>
            <div class="right">
              <h4>32</h4>
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
            <div class="widget-title"><h4>Notificações</h4></div>
            <div class="widget-content">
              <ul class="notification-list">
                <li><span class="icon flaticon-briefcase"></span> <strong>Lucas Silva</strong> se candidatou à vaga <span class="colored">Atendente de Loja (Cobasi - Tatuapé)</span></li>
                <li><span class="icon flaticon-briefcase"></span> <strong>Ana Oliveira</strong> se candidatou à vaga <span class="colored">Vendedor de Produtos Pet (Petz - Morumbi)</span></li>
                <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Bruno Santos</strong> se candidatou à vaga <span class="colored">Auxiliar de Serviços Gerais (Pet Center - Vila Olímpia)</span></li>
                <li><span class="icon flaticon-briefcase"></span> <strong>Fernanda Lima</strong> se candidatou à vaga <span class="colored">Vendedor de Ração (Cobasi - Moema)</span></li>
                <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Rafael Souza</strong> se candidatou à vaga <span class="colored">Atendente de Banho e Tosa (Petz - Itaim)</span></li>
              </ul>
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
      labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"],
      datasets: [{
        label: "Visualizações",
        backgroundColor: 'transparent',
        borderColor: '#1967D2',
        borderWidth: 1,
        data: [196, 132, 215, 362, 210, 252],
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
