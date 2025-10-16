@extends('layouts.app')

@section('title', 'Escolha seu Perfil - VagaPet')

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
                <h4>Escolha o seu perfil</h4>
                @if(session('onboarding.email'))
                  <p class="text-muted">Conta: {{ session('onboarding.email') }}</p>
                @endif
              </div>

              <div class="widget-content">

                <!--Login Form-->
                <form method="post" action="{{ route('onboarding.step1.profile.process') }}" id="profileForm">
                  @csrf
                  <input type="hidden" name="profile_type" id="profileType" value="professional">

                  <div class="form-group">
                    <div class="radio-outer row justify-content-center">
                      <div class="col-lg-3 profile-choice-box card bg-light m-1" onclick="selectProfile('professional')">
                        <div class="radio-box card-body pt-5 pb-5">
                          <input class="theme-btn btn-style-seven" type="radio" name="profile_type_radio" id="radio-1" value="professional" checked>
                          <label class="mb-0" for="radio-1"><span><i class="la la-user"></i> Profissional</span></label>
                        </div>
                      </div>
                      <div class="col-lg-3 profile-choice-box card bg-light m-1" onclick="selectProfile('company')">
                        <div class="radio-box card-body pt-5 pb-5">
                          <input class="theme-btn btn-style-seven" type="radio" name="profile_type_radio" id="radio-2" value="company">
                          <label class="mb-0" for="radio-2"><span><i class="la la-building"></i> Empresa</span></label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Área botão -->
                  <div class="row">
                    <div class="form-group col-lg-12 col-md-12 mt-30">
                      <button class="theme-btn btn-style-one pull-right" type="submit">Próximo</button>
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
  </section>
  <!-- Fim Painel (Meu Perfil) -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
function selectProfile(type) {
    document.getElementById('profileType').value = type;

    // Atualizar visual dos cards
    document.querySelectorAll('.profile-choice-box').forEach(box => {
        box.classList.remove('selected');
        box.style.border = '2px solid #e9ecef';
        box.style.backgroundColor = '#f8f9fa';
    });
    event.currentTarget.classList.add('selected');
    event.currentTarget.style.border = '2px solid #007bff';
    event.currentTarget.style.backgroundColor = '#e3f2fd';

    // Atualizar radio buttons
    document.querySelectorAll('input[name="profile_type_radio"]').forEach(radio => {
        radio.checked = false;
    });
    document.getElementById('radio-' + (type === 'professional' ? '1' : '2')).checked = true;
}

// Inicializar seleção
document.addEventListener('DOMContentLoaded', function() {
    selectProfile('professional');
});
</script>
@endpush
