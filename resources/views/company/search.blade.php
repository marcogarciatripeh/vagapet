@extends('layouts.app')

@section('title', 'Buscar Empresas - VagaPet')

@section('content')
    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Cabeçalho Principal -->
    @include('layouts.partials.dashboard.header-professional')

    <!-- Listing Section -->
    <section class="ls-section map-layout">
        <div class="filters-backdrop"></div>
        <div class="ls-container">
            <!-- Filters Column -->
            <div class="filters-column hide-left">
                <div class="inner-column">
                    <div class="filters-outer">
                        <button type="button" class="theme-btn close-filters">X</button>

                        <div class="filter-block">
                            <h4>Buscar por palavras-chave</h4>
                            <div class="form-group">
                                <input type="text" name="listing-search" placeholder="Digite a busca">
                                <span class="icon flaticon-search-3"></span>
                            </div>
                        </div>

                        <div class="filter-block">
                            <h4>Localização</h4>
                            <div class="form-group">
                                <input type="text" name="listing-search" placeholder="Cidade ou CEP">
                                <span class="icon flaticon-map-locator"></span>
                            </div>
                            <p>Raio ao redor do local selecionado</p>
                            <div class="range-slider-one">
                                <div class="area-range-slider"></div>
                                <div class="input-outer">
                                    <div class="amount-outer"><span class="area-amount"></span> km</div>
                                </div>
                            </div>
                        </div>

                        <div class="filter-block">
                            <h4>Serviços</h4>
                            <div class="form-group">
                                <select class="chosen-select">
                                    <option>Selecione</option>
                                    <option>Adestramento</option>
                                    <option>Administrativo</option>
                                    <option>Banho e tosa</option>
                                    <option>Creche e hotel</option>
                                    <option>Enfermeiro, auxiliar ou técnico</option>
                                    <option>Limpeza</option>
                                    <option>Marketing</option>
                                    <option>Motorista</option>
                                    <option>Recepção</option>
                                    <option>Serviços gerais</option>
                                    <option>Vendas</option>
                                    <option>Veterinária</option>
                                </select>
                                <span class="icon flaticon-briefcase"></span>
                            </div>
                        </div>

                        <div class="switchbox-outer">
                            <h4>Tipo de contrato</h4>
                            <ul class="switchbox">
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                        <span class="title">CLT ou Fixo</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Freelancer</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Temporário</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Estágio</span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- Bloco de Filtro: Tags -->
                        <div class="filter-block">
                            <h4>Benefícios oferecidos</h4>
                            <ul class="tags-style-one">
                                <li><a href="#">VT</a></li>
                                <li><a href="#">Hora extra</a></li>
                                <li><a href="#">Comissão</a></li>
                                <li><a href="#">Adicional de insalubridade</a></li>
                                <li><a href="#">Seguro de vida</a></li>
                                <li><a href="#">Bônus</a></li>
                                <li><a href="#">Cesta básica</a></li>
                                <li><a href="#">Assistência médica</a></li>
                                <li><a href="#">Assistência odontológica</a></li>
                            </ul>
                        </div>

                        <!-- Checkboxes: Data de Publicação -->
                        <div class="checkbox-outer">
                            <h4>Data de Publicação</h4>
                            <ul class="checkboxes">
                                <li>
                                    <input id="check-f" type="checkbox" name="check">
                                    <label for="check-f">Todas</label>
                                </li>
                                <li>
                                    <input id="check-g" type="checkbox" name="check">
                                    <label for="check-g">Última Hora</label>
                                </li>
                                <li>
                                    <input id="check-h" type="checkbox" name="check">
                                    <label for="check-h">Últimas 24 Horas</label>
                                </li>
                                <li>
                                    <input id="check-i" type="checkbox" name="check">
                                    <label for="check-i">Últimos 7 Dias</label>
                                </li>
                                <li>
                                    <input id="check-j" type="checkbox" name="check">
                                    <label for="check-j">Últimos 14 Dias</label>
                                </li>
                                <li>
                                    <input id="check-k" type="checkbox" name="check">
                                    <label for="check-k">Últimos 30 Dias</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Column -->
            <div class="map-column width-50" style="height: 600px; width: 50%;">
                <div class="map-outer" style="height: 600px; width: 100%;">
                    <div class="map-canvas" data-zoom="12" data-lat="-23.5505" data-lng="-46.6333" data-type="roadmap" data-hue="#ffc400" data-title="VagaPet" data-content="São Paulo, SP, Brasil" style="height: 600px; width: 100%; min-height: 600px; background-color: #f0f0f0;">
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="content-column width-50">
                <div class="ls-outer">
                    <!-- Switcher -->
                    <div class="ls-switcher">
                        <div class="container-fluid">
                            <div class="row justify-content-between">
                                <div class="col-6 show-filters">
                                    <button type="button" class="theme-btn toggle-filters"><i class="las la-filter"></i> Filtrar</button>
                                </div>
                                <div class="col-6">
                                    <div class="sort-by float-end mt-3">
                                        <select class="chosen-select mt-3">
                                            <option>Mostrar 10</option>
                                            <option>Mostrar 20</option>
                                            <option>Mostrar 30</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remover filtros -->
                    <div class="row">
                        <div class="col-12 mb-5 text-center">
                            <p>Filtros aplicados:</p>
                            <ul>
                                <li class="badge text-bg-light"><a href="#">Remover todos os filtros <i class="la la-times"></i></a></li>
                                <li class="badge text-bg-light"><a href="#">CLT ou fixo <i class="la la-times"></i></a></li>
                                <li class="badge text-bg-light"><a href="#">Banho e tosa <i class="la la-times"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Miolo correto: empresas-lista.html -->
                    <div class="row">
                        <div class="job-block col-lg-12">
                            <div class="inner-box">
                                <div class="content">
                                <span class="company-logo"><img src="images/logo-petz.png" alt="Petz"></span>
                                <h4><a href="empresa-pagina.php">Petz (Itaim Bibi)</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> De 5 a 10 funcionários</li>
                                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                                    <li><span class="icon flaticon-clock-3"></span> 3 horas atrás</li>
                                </ul>
                                <ul class="job-other-info">
                                    <li class="time">Banho e tosa</li>
                                    <li class="time">Creche e hotel</li>
                                </ul>
                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="job-block col-lg-12">
                            <div class="inner-box">
                                <div class="content">
                                <span class="company-logo"><img src="images/logo-petz.png" alt="Petz"></span>
                                <h4><a href="empresa-pagina.php">Dogs, Cats and Love</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> De 11 a 15 funcionários</li>
                                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                                    <li><span class="icon flaticon-clock-3"></span> 15 dias atrás</li>
                                </ul>
                                <ul class="job-other-info">
                                    <li class="time">Veterinário</li>
                                    <li class="time">Creche e hotel</li>
                                </ul>
                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="job-block col-lg-12">
                            <div class="inner-box">
                                <div class="content">
                                <span class="company-logo"><img src="images/logo-petz.png" alt="Petz"></span>
                                <h4><a href="empresa-pagina.php">Pata, pet, Dog</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> De 5 a 10 funcionários</li>
                                    <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                                    <li><span class="icon flaticon-clock-3"></span> 3 horas atrás</li>
                                </ul>
                                <ul class="job-other-info">
                                    <li class="time">Adestramento</li>
                                    <li class="time">Banho e tosa</li>
                                </ul>
                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                                </div>
                            </div>
                        </div>

                    <!-- Pagination -->
                    <div class="ls-show-more">
                        <p>Mostrando 3 de 497 Vagas</p>
                        <div class="bar">
                            <span class="bar-inner" style="width:20%"></span>
                        </div>
                        <button class="show-more">Carregar mais vagas</button>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.partials.copyright')
    @include('layouts.partials.footer')
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
                            // Mostrar mensagem alternativa quando a API não estiver disponível
                            var mapCanvas = document.querySelector('.map-canvas');
                            if (mapCanvas) {
                                mapCanvas.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100%; background-color: #f8f9fa; border: 2px dashed #dee2e6; color: #6c757d; font-size: 16px; text-align: center; padding: 20px;"><div><i class="la la-map" style="font-size: 48px; margin-bottom: 10px; display: block;"></i><strong>Mapa Temporariamente Indisponível</strong><br><small>Estamos trabalhando para restaurar o mapa</small></div></div>';
                            }
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
