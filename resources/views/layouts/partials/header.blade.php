<!-- Main Header -->
<header class="main-header">
    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}" alt="VagaPet"></a></div>
                </div>

                <div class="nav-outer">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('sobre') }}">Sobre</a></li>
                                <li><a href="{{ route('vagas') }}">Vagas</a></li>
                                <li><a href="{{ route('busca.empresas') }}">Empresas</a></li>
                                <li class="current"><a href="{{ route('faq') }}">FAQ</a></li>
                                <li><a href="{{ route('contato') }}">Contato</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="outer-box">
                    <a href="{{ route('login') }}" class="theme-btn btn-style-one">Login / Cadastro</a>
                </div>
            </div>
        </div>
    </div>
</header>
