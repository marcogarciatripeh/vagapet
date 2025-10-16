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
          
          <!-- Exibir erros de validação -->
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <!-- Exibir mensagens de erro da sessão -->
          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif
          
          <!-- Exibir mensagens de sucesso -->
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          
          <!--Login Form-->
          <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" name="email" placeholder="Digite seu e-mail" required>
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
            <div class="text">Não tem uma conta? <a href="{{ route('onboarding.step0') }}" class="signup">Criar conta</a></div>
            <div class="divider"><span>ou</span></div>
            <div class="btn-box row">
              <div class="col-lg-6 col-md-12">
                <a href="{{ route('auth.facebook') }}" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Entrar com Facebook</a>
              </div>
              <div class="col-lg-6 col-md-12">
                <a href="{{ route('auth.google') }}" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Entrar com Google</a>
              </div>
              <div class="col-lg-12 col-md-12">
                <a href="{{ route('auth.apple') }}" class="theme-btn social-btn-two bg-dark text-white"><i class="fab fa-apple"></i> Entrar com Apple</a>
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

<style>
.alert {
  padding: 12px 16px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
  font-size: 14px;
}

.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
}

.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}

.alert ul {
  margin: 0;
  padding-left: 20px;
}

.alert li {
  margin-bottom: 5px;
}

.alert li:last-child {
  margin-bottom: 0;
}
</style>

@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
