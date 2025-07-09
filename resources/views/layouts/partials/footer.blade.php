<footer class="main-footer alternate5">
    <div class="auto-container">
        <!-- Sessão Widgets -->
        <div class="widgets-section">
            <div class="row">
                <div class="big-column col-xl-4 col-lg-3 col-md-12">
                    <div class="footer-column about-widget">
                        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.svg') }}" alt="VagaPet"></a></div>
                        <p class="phone-num">
                            <span>Ligue para nós </span>
                            <a href="tel:1234567890">123 456 7890</a>
                        </p>
                        <p class="address">
                            Rua Exemplo, 123, São Paulo <br>SP, Brasil<br>
                            <a href="mailto:support@junto.pet" class="email">support@junto.pet</a>
                        </p>
                    </div>
                </div>

                <div class="big-column col-xl-8 col-lg-9 col-md-12">
                    <div class="row">
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Para Profissionais</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('jobs') }}">Procurar Vagas</a></li>
                                        <li><a href="{{ route('categories') }}">Categorias</a></li>
                                        <li><a href="{{ route('professional.dashboard') }}">Painel do Profissional</a></li>
                                        <li><a href="{{ route('job.alerts') }}">Alertas de Vagas</a></li>
                                        <li><a href="{{ route('favorites') }}">Favoritas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Para Empresas</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('professionals.search') }}">Procurar Profissionais</a></li>
                                        <li><a href="{{ route('company.dashboard') }}">Painel da Empresa</a></li>
                                        <li><a href="{{ route('jobs.create') }}">Adicionar Vaga</a></li>
                                        <li><a href="{{ route('plans') }}">Planos de Vaga</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Sobre Nós</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('jobs') }}">Página de Vagas</a></li>
                                        <li><a href="{{ route('resume') }}">Página de Currículo</a></li>
                                        <li><a href="{{ route('blog') }}">Blog</a></li>
                                        <li><a href="{{ route('contact') }}">Contato</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title">Recursos Úteis</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('sitemap') }}">Mapa do Site</a></li>
                                        <li><a href="{{ route('terms') }}">Termos de Uso</a></li>
                                        <li><a href="{{ route('privacy') }}">Política de Privacidade</a></li>
                                        <li><a href="{{ route('security') }}">Central de Segurança</a></li>
                                        <li><a href="{{ route('accessibility') }}">Acessibilidade</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="outer-box">
            <div class="copyright-text">
                © 2025 junto.pet. Todos os Direitos Reservados.
            </div>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
            </div>
        </div>
    </div>

    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="fa fa-angle-up"></span>
    </div>
</footer>
