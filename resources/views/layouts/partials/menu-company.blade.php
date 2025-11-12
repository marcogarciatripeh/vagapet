<li>
  <a href="{{ route('company.create-job') }}" type="button" class="theme-btn btn-style-one medium mb-2 btn-block text-white">Publicar Vaga</a>
</li>

<li class="{{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
  <a href="{{ route('company.dashboard') }}"><i class="la la-home"></i> Painel</a>
</li>

<li class="{{ request()->routeIs('company.profile') ? 'active' : '' }}">
  <a href="{{ route('company.profile') }}"><i class="la la-building"></i> Perfil da Empresa</a>
</li>

<li class="{{ request()->routeIs('company.manage-jobs') || request()->routeIs('company.edit-job') ? 'active' : '' }}">
  <a href="{{ route('company.manage-jobs') }}"><i class="la la-clipboard-list"></i> Vagas publicadas</a>
</li>

<li class="{{ request()->routeIs('company.candidates') ? 'active' : '' }}">
  <a href="{{ route('company.candidates') }}"><i class="la la-columns"></i> Candidaturas</a>
</li>

<li class="{{ request()->routeIs('professionals.index') || request()->routeIs('professionals.show') ? 'active' : '' }}">
  <a href="{{ route('professionals.index') }}"><i class="la la-search"></i> Profissionais</a>
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
