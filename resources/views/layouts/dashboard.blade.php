<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VagaPet')</title>

    <!-- Stylesheets -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    @stack('styles')
</head>
<body>

<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Barra Lateral do Usuário -->
  <div class="sidebar-backdrop"></div>
  <div class="user-sidebar">
    <div class="sidebar-inner">
      <ul class="navigation">
        @include('layouts.partials.menu-company')
      </ul>
    </div>
  </div>
  <!-- Fim da Barra Lateral do Usuário -->

  @yield('content')

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- End Page Wrapper -->

@stack('scripts')
</body>
</html>
