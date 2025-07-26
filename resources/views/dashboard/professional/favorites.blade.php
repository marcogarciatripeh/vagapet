@extends('layouts.app')

@section('title', 'Vagas Favoritas - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-professional')
  <!-- End Main Header -->

  <!-- Painel de Favoritos -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Vagas Favoritas</h3>
        <div class="text">Suas vagas salvas para candidatura posterior.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Vagas Salvas</h4>
              </div>

              <div class="widget-content">
                <div class="table-outer">
                  <table class="default-table manage-job-table">
                    <thead>
                      <tr>
                        <th>Vaga</th>
                        <th>Empresa</th>
                        <th>Localização</th>
                        <th>Salário</th>
                        <th>Data Salva</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <h6>Atendente de Banho e Tosa</h6>
                          <span class="info"><i class="icon flaticon-clock-3"></i> Publicado há 2 dias</span>
                        </td>
                        <td>Dogs, Cats and Love</td>
                        <td>São Paulo, SP</td>
                        <td>R$ 1.800 - R$ 2.200</td>
                        <td>15/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 1) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-heart"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Vendedor de Produtos Pet</h6>
                          <span class="info"><i class="icon flaticon-clock-3"></i> Publicado há 5 dias</span>
                        </td>
                        <td>Petz Morumbi</td>
                        <td>São Paulo, SP</td>
                        <td>R$ 1.500 - R$ 1.800</td>
                        <td>12/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 2) }}"><i class="la la-eye"></i></a></li>
                              <li><a href="#"><i class="la la-heart"></i></a></li>
                              <li><a href="#"><i class="la la-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h6>Auxiliar Administrativo</h6>
                          <span class="info"><i class="icon flaticon-clock-3"></i> Publicado há 1 semana</span>
                        </td>
                        <td>Pet Center</td>
                        <td>São Paulo, SP</td>
                        <td>R$ 1.600 - R$ 2.000</td>
                        <td>10/01/2025</td>
                        <td>
                          <div class="option-box">
                            <ul class="option-list">
                              <li><a href="{{ route('jobs.show', 3) }}"><i class="la la-eye"></i></a></li>
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
  <!-- End Painel de Favoritos -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
