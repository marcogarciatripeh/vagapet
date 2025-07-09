<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="{{ request()->routeIs('profissional.painel') ? 'active' : '' }}">
                <a href="{{ route('profissional.painel') }}"><i class="la la-home"></i>Painel</a>
            </li>
            <li class="{{ request()->routeIs('profile*') ? 'active' : '' }}">
                <a href="#"><i class="la la-user-tie"></i>Meu Perfil</a>
            </li>
            <li class="{{ request()->routeIs('profissional.curriculo*') ? 'active' : '' }}">
                <a href="{{ route('profissional.curriculo') }}"><i class="la la-file-invoice"></i>Meu Currículo</a>
            </li>
            <li class="{{ request()->routeIs('applications*') ? 'active' : '' }}">
                <a href="#"><i class="la la-briefcase"></i>Candidaturas</a>
            </li>
            <li class="{{ request()->routeIs('vagas.alertas') ? 'active' : '' }}">
                <a href="{{ route('vagas.alertas') }}"><i class="la la-bell"></i>Alertas</a>
            </li>
            <li class="{{ request()->routeIs('profissional.favoritos') ? 'active' : '' }}">
                <a href="{{ route('profissional.favoritos') }}"><i class="la la-heart-o"></i>Favoritos</a>
            </li>
            <li class="{{ request()->routeIs('ajuda') ? 'active' : '' }}">
                <a href="{{ route('ajuda') }}"><i class="la la-question-circle"></i>Ajuda</a>
            </li>
        </ul>
    </div>
</div>
