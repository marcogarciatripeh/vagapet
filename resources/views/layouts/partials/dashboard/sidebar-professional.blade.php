<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href=""><i class="la la-home"></i>Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('profile*') ? 'active' : '' }}">
                <a href=""><i class="la la-user-tie"></i>Meu Perfil</a>
            </li>
            <li class="{{ request()->routeIs('resume*') ? 'active' : '' }}">
                <a href=""><i class="la la-file-invoice"></i>Meu Currículo</a>
            </li>
            <li class="{{ request()->routeIs('applications*') ? 'active' : '' }}">
                <a href=""><i class="la la-briefcase"></i>Candidaturas</a>
            </li>
            <li class="{{ request()->routeIs('job.alerts') ? 'active' : '' }}">
                <a href=""><i class="la la-bell"></i>Alertas</a>
            </li>
            <li class="{{ request()->routeIs('favorites') ? 'active' : '' }}">
                <a href=""><i class="la la-heart-o"></i>Favoritos</a>
            </li>
            <li class="{{ request()->routeIs('help') ? 'active' : '' }}">
                <a href=""><i class="la la-question-circle"></i>Ajuda</a>
            </li>
        </ul>
    </div>
</div>
