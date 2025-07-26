@extends('layouts.app')

@section('title', 'Minhas Candidaturas - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-professional')
  <!-- End Main Header -->

  <!-- Painel de Candidaturas -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Minhas Candidaturas</h3>
        <div class="text">Acompanhe o status das suas candidaturas.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Candidaturas Recentes</h4>
              </div>

              <div class="widget-content">
                <div class="table-outer">
                  <table class="default-table manage-job-table">
                    <thead>
                      <tr>
                        <th>Vaga</th>
                        <th>Empresa</th>
                        <th>Data da Candidatura</th>
                        <th>Status</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <h6>Atendente de Banho e Tosa</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>Dogs, Cats and Love</td>
                        <td>15/01/2025</td>
                        <td><span class="badge badge-success">Aprovada</span></td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 1) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Vendedor de Produtos Pet</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>Petz Morumbi</td>
                        <td>12/01/2025</td>
                        <td><span class="badge badge-warning">Em Análise</span></td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 2) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Auxiliar Administrativo</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>Pet Center</td>
                        <td>10/01/2025</td>
                        <td><span class="badge badge-danger">Recusada</span></td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 3) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Painel de Candidaturas -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
