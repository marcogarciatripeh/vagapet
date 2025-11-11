@extends('layouts.app')

@section('title', 'Serviços e Especialidades - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  <header class="main-header">
    <div class="container-fluid">
      <div class="main-box">
        <div class="nav-outer">
          <!-- Logo -->
          <div class="logo-box">
            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-junto.svg') }}" alt="Junto.pet" title="Junto.pet"></a></div>
          </div>
        </div>

        <div class="outer-box">
          <!-- Placeholder for alignment -->
        </div>
      </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
      <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-junto.svg') }}" alt="Junto.pet" title="Junto.pet"></a></div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
  </header>
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Meu Perfil) -->
  <section class="user-dashboard row justify-content-center">
    <div class="dashboard-outer col-lg-10 mt-30 mb-50">

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Cadastro</h4>
              </div>

              <div class="widget-content">

                <!--Skill Item-->
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="86">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="86">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                  <!-- Ls widget (Seção Serviços e Especialidades) -->
                  <div class="ls-widget">
                    <div class="tabs-box">
                      <div class="widget-title">
                        <h4>Serviços e Especialidades</h4>
                        <p>Informe os serviços oferecidos e as especialidades da sua empresa.</p>
                      </div>

                      <div class="widget-content">
                        <form class="default-form" action="{{ route('onboarding.step5.company.process') }}" method="post">
                          @csrf

                          @if($errors->any())
                            <div class="alert alert-danger">
                              <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif

                          <div class="row">
                            <!-- Serviços -->
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Serviços</label>
                              <p class="text-muted">Liste os serviços oferecidos pela empresa (separados por vírgula)</p>
                              <textarea name="services" placeholder="Banho e Tosa, Consultas Veterinárias, Hotel, Creche, etc." rows="3">{{ old('services', isset($step5Data['services']) ? (is_array($step5Data['services']) ? implode(', ', $step5Data['services']) : $step5Data['services']) : '') }}</textarea>
                            </div>

                            <!-- Especialidades -->
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Especialidades</label>
                              <p class="text-muted">Liste as especialidades da empresa (separadas por vírgula)</p>
                              <textarea name="specialties" placeholder="Clínica Veterinária, Pet Shop, Hotel para Cães, etc." rows="3">{{ old('specialties', isset($step5Data['specialties']) ? (is_array($step5Data['specialties']) ? implode(', ', $step5Data['specialties']) : $step5Data['specialties']) : '') }}</textarea>
                            </div>

                            <!-- Porte da Empresa -->
                            <div class="form-group col-lg-6 col-md-12">
                              <label>Porte da Empresa</label>
                              <select name="company_size" class="chosen-select">
                                <option value="">Selecione</option>
                                <option value="micro" {{ old('company_size', $step5Data['company_size'] ?? '') == 'micro' ? 'selected' : '' }}>Microempresa</option>
                                <option value="small" {{ old('company_size', $step5Data['company_size'] ?? '') == 'small' ? 'selected' : '' }}>Pequena</option>
                                <option value="medium" {{ old('company_size', $step5Data['company_size'] ?? '') == 'medium' ? 'selected' : '' }}>Média</option>
                                <option value="large" {{ old('company_size', $step5Data['company_size'] ?? '') == 'large' ? 'selected' : '' }}>Grande</option>
                              </select>
                            </div>
                          </div>

                          <!-- Área botão -->
                          <div class="row mt-4">
                            <div class="form-group col-lg-6 col-md-12">
                              <a href="{{ route('onboarding.step4.company') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                            </div>
                            <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                              <button type="submit" class="theme-btn btn-style-one text-white">Próximo</button>
                            </div>
                          </div>
                          <!-- Fim área botão -->
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Fim Ls widget -->

                </div>

              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Meu Perfil) -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/onboarding-improvements.css') }}">
@endpush

@push('scripts')
@include('layouts.partials.scripts')
@endpush
