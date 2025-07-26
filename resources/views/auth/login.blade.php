@extends('layouts.app')

@section('title', 'Login - VagaPet')

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
          <h3>Entrar no VagaPet</h3>
          <!--Login Form-->
          <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label>Usuário</label>
              <input type="text" name="username" placeholder="Digite seu usuário" required>
            </div>

            <div class="form-group">
              <label>Senha</label>
              <input id="password-field" type="password" name="password" placeholder="Digite sua senha" required>
            </div>

            <div class="form-group">
              <div class="field-outer">
                <div class="input-group checkboxes square">
                  <input type="checkbox" name="remember-me" id="remember">
                  <label for="remember" class="remember"><span class="custom-checkbox"></span> Lembrar-me</label>
                </div>
                <a href="{{ route('change-password') }}" class="pwd">Esqueceu a senha?</a>
              </div>
            </div>

            <div class="form-group">
              <button class="theme-btn btn-style-one" type="submit" name="log-in">Entrar</button>
            </div>
          </form>

          <div class="bottom-box">
            <div class="text">Não tem uma conta? <a href="{{ route('register') }}" class="signup">Criar conta</a></div>
            <div class="divider"><span>ou</span></div>
            <div class="btn-box row">
              <div class="col-lg-6 col-md-12">
                <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Entrar com Facebook</a>
              </div>
              <div class="col-lg-6 col-md-12">
                <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Entrar com Google</a>
              </div>
            </div>
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
