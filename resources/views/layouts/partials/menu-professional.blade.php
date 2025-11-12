<li class="{{ request()->routeIs('professional.dashboard') ? 'active' : '' }}">
  <a href="{{ route('professional.dashboard') }}"><i class="la la-home"></i> Painel</a>
</li>

<li class="{{ request()->routeIs('professional.profile') ? 'active' : '' }}">
  <a href="{{ route('professional.profile') }}"><i class="la la-user"></i> Meu perfil</a>
</li>

<li class="{{ request()->routeIs('jobs.index') || request()->routeIs('jobs.show') ? 'active' : '' }}">
  <a href="{{ route('jobs.index') }}"><i class="la la-search"></i> Buscar vagas</a>
</li>

<li class="{{ request()->routeIs('professional.applications') ? 'active' : '' }}">
  <a href="{{ route('professional.applications') }}"><i class="la la-file-invoice"></i> Candidaturas</a>
</li>

<li class="{{ request()->routeIs('professional.settings') ? 'active' : '' }}">
  <a href="{{ route('professional.settings') }}"><i class="la la-cog"></i> Configurações</a>
</li>

<li class="{{ request()->routeIs('help') ? 'active' : '' }}">
  <a href="{{ route('help') }}"><i class="la la-life-ring"></i> Ajuda</a>
</li>

<li>
  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="la la-sign-out"></i> Sair</a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
