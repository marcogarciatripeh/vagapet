<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href=""><i class="la la-home"></i>Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('company.profile*') ? 'active' : '' }}">
                <a href=""><i class="la la-building"></i>Perfil da Empresa</a>
            </li>
            <li class="{{ request()->routeIs('jobs.manage*') ? 'active' : '' }}">
                <a href=""><i class="la la-briefcase"></i>Gerenciar Vagas</a>
            </li>
            <li class="{{ request()->routeIs('jobs.create') ? 'active' : '' }}">
                <a href=""><i class="la la-plus-circle"></i>Publicar Vaga</a>
            </li>
            <li class="{{ request()->routeIs('candidates*') ? 'active' : '' }}">
                <a href=""><i class="la la-user-friends"></i>Candidatos</a>
            </li>
            <li class="{{ request()->routeIs('plans*') ? 'active' : '' }}">
                <a href=""><i class="la la-box"></i>Planos</a>
            </li>
            <li class="{{ request()->routeIs('help') ? 'active' : '' }}">
                <a href=""><i class="la la-question-circle"></i>Ajuda</a>
            </li>
        </ul>
    </div>
</div>
