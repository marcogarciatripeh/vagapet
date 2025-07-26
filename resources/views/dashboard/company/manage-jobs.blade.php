@extends('layouts.app')

@section('title', 'Gerenciar Vagas - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Painel de Gerenciar Vagas -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Gerenciar Vagas</h3>
        <div class="text">Gerencie suas vagas publicadas.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Suas Vagas</h4>
                <a href="{{ route('company.create-job') }}" class="theme-btn btn-style-one">Nova Vaga</a>
              </div>

              <div class="widget-content">
                <div class="table-outer">
                  <table class="default-table manage-job-table">
                    <thead>
                      <tr>
                        <th>Vaga</th>
                        <th>Candidaturas</th>
                        <th>Status</th>
                        <th>Data de Publicação</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <h6>Atendente de Banho e Tosa</h6>
                          <span class="info"><i class="icon flaticon-map-locator"></i> São Paulo, SP</span>
                        </td>
                        <td>15 candidaturas</td>
                        <td><span class="badge badge-success">Ativa</span></td>
                        <td>15/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 1) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-edit"></i></a></li>
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
                        <td>8 candidaturas</td>
                        <td><span class="badge badge-success">Ativa</span></td>
                        <td>12/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 2) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-edit"></i></a></li>
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
                        <td>23 candidaturas</td>
                        <td><span class="badge badge-warning">Expirada</span></td>
                        <td>05/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 3) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-edit"></i></a></li>
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
  <!-- End Painel de Gerenciar Vagas -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
