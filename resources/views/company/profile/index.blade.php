@extends('layouts.app')

@section('title', 'Perfil da Empresa - VagaPet')

@section('content')
    <div class="page-wrapper dashboard">
        <!-- Preloader -->
        <div class="preloader"></div>
        <!-- Header Span -->
        <span class="header-span"></span>
        <!-- Cabeçalho Principal -->
        @include('layouts.partials.dashboard.header-company')
        <!-- Sidebar -->
        @include('layouts.partials.dashboard.sidebar-company')
        <!-- Painel (Meu Perfil) -->
        <section class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Perfil da empresa</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Ls widget (Seção de Informações Básicas) -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Meu Perfil</h4>
                                </div>
                                <div class="widget-content">
                                    <div class="uploading-outer">
                                        <div class="uploadButton">
                                            <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                                            <label class="uploadButton-button ripple-effect" for="upload">Subir logo</label>
                                            <span class="uploadButton-file-name"></span>
                                        </div>
                                        <div class="text">Tamanho máximo do arquivo: 1MB, dimensão mínima: 330x300, arquivos suportados: .jpg e .png</div>
                                    </div>
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Nome Empresa -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Nome da empresa*</label>
                                                <input type="text" name="name" placeholder="Nome do meu negócio">
                                            </div>
                                            <!-- Telefone -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Telefone*</label>
                                                <input type="text" name="phone" placeholder="(11) 98765-4321">
                                            </div>
                                            <!-- Endereço de E-mail -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Endereço de E-mail*</label>
                                                <input type="email" name="email" placeholder="maria@exemplo.com">
                                            </div>
                                            <!-- Site -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Site</label>
                                                <input type="text" name="website" placeholder="www.meuservicos.com.br">
                                            </div>
                                            <!-- Experiência -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Quantidade de funcionários</label>
                                                <select class="chosen-select">
                                                    <option>Selecione</option>
                                                    <option>Até 4</option>
                                                    <option>De 5 a 10</option>
                                                    <option>De 11 a 20</option>
                                                    <option>Acima de 21</option>
                                                </select>
                                            </div>
                                            <!-- Educação -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Educação</label>
                                                <select class="chosen-select">
                                                    <option>Ensino Fundamental</option>
                                                    <option>Ensino Médio</option>
                                                    <option>Ensino Superior</option>
                                                    <option>Pós-graduação (Mestrado ou doutorado)</option>
                                                </select>
                                            </div>
                                            <!-- Área de trabalho -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Serviços*</label>
                                                <p>Você pode incluir mais de uma opção</p>
                                                <select data-placeholder="Escolha" class="chosen-select multiple" multiple tabindex="4">
                                                    <option value="BanhoTosa">Banho & Tosa</option>
                                                    <option value="Recepcao">Recepção</option>
                                                    <option value="Vendas">Vendas</option>
                                                    <option value="Veterinario">Veterinário</option>
                                                    <option value="AuxiliarVeterinario">Auxiliar Veterinário</option>
                                                    <option value="Limpeza">Limpeza</option>
                                                    <option value="Gerente">Gerente</option>
                                                    <option value="Estoque">Estoque</option>
                                                    <option value="Motorista">Motorista</option>
                                                </select>
                                            </div>
                                            <!-- Portfólio -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <div class="uploading-outer">
                                                    <div class="uploadButton">
                                                        <input class="uploadButton-input" type="file" name="attachments[]" accept="image/*, application/pdf" id="upload" multiple />
                                                        <label class="uploadButton-button ripple-effect" for="upload">Fotos do espaço</label>
                                                        <span class="uploadButton-file-name"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Descrição -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Descrição</label>
                                                <textarea placeholder="Fale sobre sua experiência com animais, aptidões em pet shops, serviços oferecidos (banho, tosa, recepção, etc.) e qualquer outro detalhe relevante."></textarea>
                                            </div>
                                            <!-- Botão Salvar -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <button class="theme-btn btn-style-one">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Ls widget (Seção Redes Sociais) -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Redes Sociais</h4>
                                    <p>Inclua suas redes sociais se quiser que outros vejam seu perfil e possam te seguir.</p>
                                </div>
                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Facebook -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Facebook</label>
                                                <input type="text" name="facebook" placeholder="www.facebook.com/MeuPerfil">
                                            </div>
                                            <!-- Twitter -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>X (antigo Twitter)</label>
                                                <input type="text" name="twitter" placeholder="twitter.com/MeuPerfil">
                                            </div>
                                            <!-- Linkedin -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>TikTok</label>
                                                <input type="text" name="linkedin" placeholder="www.tiktok.com/meuperfil">
                                            </div>
                                            <!-- Instagram -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Instagram</label>
                                                <input type="text" name="instagram" placeholder="instagram.com/meuperfil">
                                            </div>
                                            <!-- Botão Salvar -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <button class="theme-btn btn-style-one">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Ls widget (Seção Informações de Contato) -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Localização</h4>
                                    <p>Só o bairro e cidade ficarão visíveis na plataforma para ajudar na busca por vagas releventes.</p>
                                </div>
                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Endereço Completo -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Endereço Completo (aparece no mapa)*</label>
                                                <input type="text" name="address" placeholder="Rua Exemplo, 123, Bairro, Cidade - Estado">
                                            </div>
                                            <!-- Encontrar no Mapa - Bairro -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Bairro e cidade</label>
                                                <input type="text" name="map" placeholder="Vila Clementina, São Paulo - SP">
                                            </div>
                                            <!-- Botão de Buscar Localização -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <button class="theme-btn btn-style-three">Buscar Localização</button>
                                            </div>
                                            <!-- Mapa -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <div class="map-outer">
                                                    <div class="map-canvas map-height" data-zoom="12"
                                                        data-lat="-23.550520" data-lng="-46.633308"
                                                        data-type="roadmap" data-hue="#ffc400"
                                                        data-title="Localização"
                                                        data-icon-path="images/resource/map-marker.png"
                                                        data-content="São Paulo - SP, Brasil<br><a href='mailto:info@meuservicos.com'>info@meuservicos.com</a>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Botão Salvar -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <button class="theme-btn btn-style-one">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Ls widget -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.partials.copyright')
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
    <!-- Google Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaaCBm4FEmgKs5cfVrh3JYue3Chj1kJMw&loading=async&callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Carregar scripts dependentes do Google Maps após a API estar disponível
            var script = document.createElement('script');
            script.src = "{{ asset('js/map-script.js') }}";
            script.onload = function() {
                // Aguardar um pouco para garantir que o DOM esteja pronto
                setTimeout(function() {
                    if (typeof GmapInit === 'function') {
                        try {
                            GmapInit();
                        } catch (error) {
                            console.log('Erro ao inicializar mapa:', error);
                            handleMapError();
                        }
                    }
                }, 100);
            };
            document.head.appendChild(script);
        }

        // Função para lidar com erros da API do Google Maps
        function handleMapError() {
            var mapCanvas = document.querySelector('.map-canvas');
            if (mapCanvas) {
                mapCanvas.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100%; background-color: #f8f9fa; border: 2px dashed #dee2e6; color: #6c757d; font-size: 16px; text-align: center; padding: 20px;"><div><i class="la la-map" style="font-size: 48px; margin-bottom: 10px; display: block;"></i><strong>Mapa Temporariamente Indisponível</strong><br><small>Estamos trabalhando para restaurar o mapa</small></div></div>';
            }
        }

        // Capturar erros globais da API do Google Maps
        window.addEventListener('error', function(e) {
            if (e.message && e.message.includes('BillingNotEnabledMapError')) {
                handleMapError();
            }
        });
    </script>
@endpush
