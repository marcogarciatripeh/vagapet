@extends('layouts.app')

@section('title', 'Escolher Perfil - VagaPet')

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

  <!-- Painel (Escolher Perfil) -->
  <section class="user-dashboard row justify-content-center">
    <div class="dashboard-outer col-lg-8 mt-30 mb-50">

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Escolha de Perfil) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Escolher Perfil</h4>
              </div>

              <div class="widget-content">
                <div class="text-center mb-4">
                  <p>Olá, {{ $user->name }}! Escolha o tipo de perfil que você deseja usar:</p>
                </div>

                <form class="default-form" action="{{ route('switch-profile') }}" method="post">
                  @csrf

                  <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4">
                      <div class="profile-choice-box text-center p-4 border rounded" style="cursor: pointer; transition: all 0.3s;" onclick="selectProfile('professional')">
                        <div class="icon mb-3" style="font-size: 48px; color: #007bff;">
                          <i class="la la-user"></i>
                        </div>
                        <h5>Profissional</h5>
                        <p class="text-muted">Procuro oportunidades de trabalho</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="profile" id="professional" value="professional" required>
                          <label class="form-check-label" for="professional">
                            Selecionar como Profissional
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-12 mb-4">
                      <div class="profile-choice-box text-center p-4 border rounded" style="cursor: pointer; transition: all 0.3s;" onclick="selectProfile('company')">
                        <div class="icon mb-3" style="font-size: 48px; color: #28a745;">
                          <i class="la la-building"></i>
                        </div>
                        <h5>Empresa</h5>
                        <p class="text-muted">Contrato profissionais</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="profile" id="company" value="company" required>
                          <label class="form-check-label" for="company">
                            Selecionar como Empresa
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="theme-btn btn-style-one text-white" disabled id="submitBtn">
                      Continuar
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Escolher Perfil) -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('styles')
<style>
.profile-choice-box:hover {
  border-color: #007bff !important;
  box-shadow: 0 4px 8px rgba(0,123,255,0.2);
}

.profile-choice-box.selected {
  border-color: #007bff !important;
  background-color: #f8f9ff;
}

.profile-choice-box.selected .icon {
  color: #007bff !important;
}
</style>
@endpush

@push('scripts')
<script>
function selectProfile(profile) {
  // Remove seleção anterior
  document.querySelectorAll('.profile-choice-box').forEach(box => {
    box.classList.remove('selected');
  });

  // Seleciona o perfil
  document.getElementById(profile).checked = true;
  document.querySelector(`input[value="${profile}"]`).closest('.profile-choice-box').classList.add('selected');

  // Habilita o botão
  document.getElementById('submitBtn').disabled = false;
}
</script>
@endpush
