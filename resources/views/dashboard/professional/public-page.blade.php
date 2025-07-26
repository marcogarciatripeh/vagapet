@extends('layouts.app')

@section('title', 'Página Pública - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-professional')
  <!-- End Main Header -->

  <!-- Página Pública -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Minha Página Pública</h3>
        <div class="text">Como as empresas veem seu perfil.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Visualização Pública</h4>
              </div>

              <div class="widget-content">
                <div class="profile-preview">
                  <div class="profile-header">
                    <div class="profile-image">
                      <img src="{{ asset('images/resource/candidate-4.png') }}" alt="Foto do Perfil">
                    </div>
                    <div class="profile-info">
                      <h3>João Silva</h3>
                      <p class="title">Atendente de Banho e Tosa</p>
                      <p class="location"><i class="icon flaticon-map-locator"></i> São Paulo, SP</p>
                    </div>
                  </div>

                  <div class="profile-details">
                    <h4>Sobre Mim</h4>
                    <p>Profissional dedicado com mais de 3 anos de experiência em banho e tosa. Apaixonado por animais e comprometido com o bem-estar dos pets.</p>

                    <h4>Experiência</h4>
                    <ul>
                      <li>Atendente de Banho e Tosa - Petz Morumbi (2022-2024)</li>
                      <li>Auxiliar de Veterinário - Clínica Pet Care (2020-2022)</li>
                    </ul>

                    <h4>Habilidades</h4>
                    <div class="skills">
                      <span class="skill-tag">Banho</span>
                      <span class="skill-tag">Tosa</span>
                      <span class="skill-tag">Atendimento</span>
                      <span class="skill-tag">Primeiros Socorros</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Página Pública -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
