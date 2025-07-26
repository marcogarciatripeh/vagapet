@extends('layouts.app')

@section('title', 'Dashboard Empresa - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Painel da Empresa -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Olá, Empresa!</h3>
        <div class="text">Aqui você vê o resumo das suas vagas e candidatos.</div>
      </div>

      <div class="row">
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-blue">
            <div class="left"><i class="icon flaticon-briefcase"></i></div>
            <div class="right">
              <h4>8</h4>
              <p>Vagas Ativas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-red">
            <div class="left"><i class="icon la la-file-invoice"></i></div>
            <div class="right">
              <h4>156</h4>
              <p>Candidaturas</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-yellow">
            <div class="left"><i class="icon la la-comment-o"></i></div>
            <div class="right">
              <h4>23</h4>
              <p>Mensagens</p>
            </div>
          </div>
        </div>
        <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
          <div class="ui-item ui-green">
            <div class="left"><i class="icon la la-bookmark-o"></i></div>
            <div class="right">
              <h4>12</h4>
              <p>Profissionais Favoritos</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Widgets -->
      <div class="row">

        <!-- Gráfico de Candidaturas -->
        <div class="col-xl-7 col-lg-12">
          <div class="graph-widget ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Candidaturas por Vaga</h4>
                <div class="chosen-outer">
                  <select class="chosen-select">
                    <option>Últimos 30 Dias</option>
                    <option>Últimos 60 Dias</option>
                    <option>Últimos 90 Dias</option>
                  </select>
                </div>
              </div>
              <div class="widget-content">
                <canvas id="chart" width="100" height="45"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Candidaturas Recentes -->
        <div class="col-xl-5 col-lg-12">
          <div class="notification-widget ls-widget">
            <div class="widget-title"><h4>Candidaturas Recentes</h4></div>
            <div class="widget-content">
              <ul class="notification-list">
                <li><span class="icon flaticon-briefcase"></span> <strong>Maria Santos</strong> se candidatou à vaga <span class="colored">Atendente de Loja</span></li>
                <li><span class="icon flaticon-briefcase"></span> <strong>Pedro Oliveira</strong> se candidatou à vaga <span class="colored">Vendedor de Produtos Pet</span></li>
                <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Ana Costa</strong> se candidatou à vaga <span class="colored">Auxiliar de Serviços Gerais</span></li>
                <li><span class="icon flaticon-briefcase"></span> <strong>Carlos Lima</strong> se candidatou à vaga <span class="colored">Atendente de Banho e Tosa</span></li>
                <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Fernanda Silva</strong> se candidatou à vaga <span class="colored">Vendedor de Ração</span></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Vagas Ativas -->
        <div class="col-lg-12">
          <div class="vagas-widget ls-widget">
            <div class="widget-title"><h4>Suas Vagas Ativas</h4></div>
            <div class="widget-content">
              <ul class="vaga-lista">
                <li><span class="icon flaticon-briefcase"></span> <strong>Atendente de Loja</strong> - 15 candidaturas <span class="colored">Ativa</span></li>
                <li><span class="icon flaticon-briefcase"></span> <strong>Vendedor de Produtos Pet</strong> - 8 candidaturas <span class="colored">Ativa</span></li>
                <li><span class="icon flaticon-briefcase"></span> <strong>Auxiliar de Serviços Gerais</strong> - 23 candidaturas <span class="colored">Ativa</span></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- End Painel da Empresa -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
  Chart.defaults.global.defaultFontFamily = "Sofia Pro";
  Chart.defaults.global.defaultFontColor = '#888';
  Chart.defaults.global.defaultFontSize = 14;
  var ctx = document.getElementById('chart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Atendente", "Vendedor", "Auxiliar", "Banho/Tosa"],
      datasets: [{
        label: "Candidaturas",
        backgroundColor: '#1967D2',
        borderColor: '#1967D2',
        borderWidth: 1,
        data: [15, 8, 23, 12],
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
