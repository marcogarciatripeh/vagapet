@extends('layouts.app')

@section('title', 'Profissionais Favoritos - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Painel de Profissionais Favoritos -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Profissionais Favoritos</h3>
        <div class="text">Profissionais salvos para contato futuro.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Profissionais Salvos</h4>
              </div>

              <div class="widget-content">
                <div class="table-outer">
                  <table class="default-table manage-job-table">
                    <thead>
                      <tr>
                        <th>Profissional</th>
                        <th>Área de Atuação</th>
                        <th>Localização</th>
                        <th>Experiência</th>
                        <th>Data Salvo</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <h6>João Silva</h6>
                          <span class="info"><i class="icon flaticon-briefcase"></i> Atendente de Banho e Tosa</span>
                        </td>
                        <td>Banho e Tosa</td>
                        <td>São Paulo, SP</td>
                        <td>3 anos</td>
                        <td>15/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('professionals.show', 1) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-heart"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Maria Santos</h6>
                          <span class="info"><i class="icon flaticon-briefcase"></i> Vendedora</span>
                        </td>
                        <td>Vendas</td>
                        <td>São Paulo, SP</td>
                        <td>2 anos</td>
                        <td>14/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('professionals.show', 2) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-heart"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Pedro Oliveira</h6>
                          <span class="info"><i class="icon flaticon-briefcase"></i> Auxiliar Veterinário</span>
                        </td>
                        <td>Veterinária</td>
                        <td>São Paulo, SP</td>
                        <td>4 anos</td>
                        <td>13/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('professionals.show', 3) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-heart"></i></a></li>
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
  <!-- End Painel de Profissionais Favoritos -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
