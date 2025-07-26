@extends('layouts.app')

@section('title', 'Candidatos - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Painel de Candidatos -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Candidatos</h3>
        <div class="text">Gerencie as candidaturas recebidas.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Candidaturas Recebidas</h4>
              </div>

              <div class="widget-content">
                <div class="table-outer">
                  <table class="default-table manage-job-table">
                    <thead>
                      <tr>
                        <th>Candidato</th>
                        <th>Vaga</th>
                        <th>Data da Candidatura</th>
                        <th>Status</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <h6>Maria Santos</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>Atendente de Banho e Tosa</td>
                        <td>15/01/2025</td>
                        <td><span class="badge badge-warning">Em Análise</span></td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('professionals.show', 1) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-check"></i></a></li>
                              <li><a href="#"><i class="la la-times"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Pedro Oliveira</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>Vendedor de Produtos Pet</td>
                        <td>14/01/2025</td>
                        <td><span class="badge badge-success">Aprovado</span></td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('professionals.show', 2) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-check"></i></a></li>
                              <li><a href="#"><i class="la la-times"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Ana Costa</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>Auxiliar de Serviços Gerais</td>
                        <td>13/01/2025</td>
                        <td><span class="badge badge-danger">Recusado</span></td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('professionals.show', 3) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-check"></i></a></li>
                              <li><a href="#"><i class="la la-times"></i></a></li>
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
  <!-- End Painel de Candidatos -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
