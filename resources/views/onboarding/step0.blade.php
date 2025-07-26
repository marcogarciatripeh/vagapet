@extends('layouts.app')

@section('title', 'Criar Conta - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Main Header-->
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

  <!--End Main Header -->

  <!-- Login Section -->
  <div class="login-section">
    <div class="image-layer" style="background-image: url({{ asset('images/background/12.jpg') }});"></div>
    <div class="outer-box">

      <!-- Login Form -->
      <div class="login-form default-form">

        <div class="form-inner">
          <h3>Crie uma conta grátis</h3>

          <div class="btn-box row">
            <div class="col-lg-12 col-md-12">
              <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Criar conta com Facebook</a>
            </div>
            <div class="col-lg-12 col-md-12">
              <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Criar conta com Google</a>
            </div>
            <div class="col-lg-12 col-md-12">
              <a href="#" class="theme-btn social-btn-two bg-dark text-white"><i class="fab fa-apple"></i> Criar conta com Apple</a>
            </div>
          </div>

          <div class="bottom-box">
            <div class="divider"><span>ou</span></div>

            <!--Login Form-->
            <form action="{{ route('onboarding.step1') }}" method="post">
              @csrf

              <div class="form-group">
                <label>WhatsApp</label>
                <input type="text" name="whatsapp" placeholder="Digite seu telefone" required>
              </div>

              <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="Digite o e-mail" required>
              </div>

              <div class="form-group">
                <button class="theme-btn btn-style-one" type="submit" name="log-in">Criar conta</button>
              </div>
            </form>

          </div>
        </div>
      </div>
      <!--End Login Form -->

    </div>
  </div>
  <!-- End Login Section -->

</div><!-- End Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
