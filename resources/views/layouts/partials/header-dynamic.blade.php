<!-- Header dinâmico que detecta se o usuário está logado -->
@if(Auth::check())
  @include('layouts.partials.header-logged')
@else
  @include('layouts.partials.header-logout')
@endif
