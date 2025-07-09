<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="{{ request()->routeIs('empresa.painel') ? 'active' : '' }}">
                <a href="{{ route('empresa.painel') }}"><i class="la la-home"></i>Painel</a>
            </li>
            <li class="{{ request()->routeIs('company.profile*') ? 'active' : '' }}">
                <a href="#"><i class="la la-building"></i>Perfil da Empresa</a>
            </li>
            <li class="{{ request()->routeIs('empresa.gerenciar-vagas') ? 'active' : '' }}">
                <a href="{{ route('empresa.gerenciar-vagas') }}"><i class="la la-briefcase"></i>Gerenciar Vagas</a>
            </li>
            <li class="{{ request()->routeIs('vagas.criar') ? 'active' : '' }}">
                <a href="{{ route('vagas.criar') }}"><i class="la la-plus-circle"></i>Publicar Vaga</a>
            </li>
            <li class="{{ request()->routeIs('empresa.candidatos') ? 'active' : '' }}">
                <a href="{{ route('empresa.candidatos') }}"><i class="la la-user-friends"></i>Candidatos</a>
            </li>
            <li class="{{ request()->routeIs('planos*') ? 'active' : '' }}">
                <a href="{{ route('planos') }}"><i class="la la-box"></i>Planos</a>
            </li>
            <li class="{{ request()->routeIs('ajuda') ? 'active' : '' }}">
                <a href="{{ route('ajuda') }}"><i class="la la-question-circle"></i>Ajuda</a>
            </li>
        </ul>
    </div>
</div>
