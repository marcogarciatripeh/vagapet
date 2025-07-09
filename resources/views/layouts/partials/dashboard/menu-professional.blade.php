<li>
    <a href="#"><i class="la la-user"></i>Meu Perfil</a>
</li>
<li>
    <a href="{{ route('profissional.painel') }}"><i class="la la-home"></i>Painel</a>
</li>
<li>
    <a href="#"><i class="la la-briefcase"></i>Minhas Candidaturas</a>
</li>
<li>
    <a href="{{ route('profissional.curriculo') }}"><i class="la la-file-text"></i>Meu Currículo</a>
</li>
<li>
    <a href="{{ route('profissional.favoritos') }}"><i class="la la-heart-o"></i>Vagas Favoritas</a>
</li>
<li>
    <a href="{{ route('vagas.alertas') }}"><i class="la la-bell"></i>Alertas de Vagas</a>
</li>
<li>
    <a href="{{ route('ajuda') }}"><i class="la la-question-circle"></i>Ajuda</a>
</li>
<li>
    <form method="POST" action="" id="logout-form">
        @csrf
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="la la-sign-out"></i>Sair
        </a>
    </form>
</li>
