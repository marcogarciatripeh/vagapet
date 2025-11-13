// Mapa interativo para endereços
document.addEventListener('DOMContentLoaded', function() {
    // Verificar se o elemento do mapa existe
    const mapCanvas = document.getElementById('map-canvas');
    if (!mapCanvas) {
        return; // Não há mapa nesta página
    }

    // Inicializar mapa
    let map;
    let marker;
    let geocoder;

    // Obter coordenadas iniciais dos campos hidden ou usar padrão
    function getInitialCoords() {
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        
        let lat = -23.550520; // São Paulo padrão
        let lng = -46.633308;
        
        if (latInput && latInput.value) {
            const parsedLat = parseFloat(latInput.value);
            if (!isNaN(parsedLat) && parsedLat !== 0) {
                lat = parsedLat;
            }
        }
        
        if (lngInput && lngInput.value) {
            const parsedLng = parseFloat(lngInput.value);
            if (!isNaN(parsedLng) && parsedLng !== 0) {
                lng = parsedLng;
            }
        }
        
        return { lat, lng };
    }

    // Função para inicializar o mapa
    function initMap() {
        const coords = getInitialCoords();
        
        // Criar mapa
        map = new google.maps.Map(mapCanvas, {
            zoom: coords.lat === -23.550520 && coords.lng === -46.633308 ? 12 : 15,
            center: { lat: coords.lat, lng: coords.lng },
            mapTypeId: 'roadmap',
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: true,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: true
        });

        // Criar geocoder
        geocoder = new google.maps.Geocoder();

        // Criar marcador (não arrastável - apenas visualização)
        marker = new google.maps.Marker({
            position: { lat: coords.lat, lng: coords.lng },
            map: map,
            draggable: false,
            title: 'Sua localização'
        });

        // Se já temos coordenadas válidas, fazer reverse geocoding para atualizar endereço
        if (coords.lat !== -23.550520 || coords.lng !== -46.633308) {
            reverseGeocode(coords.lat, coords.lng, function(address) {
                if (address) {
                    const addressInput = document.querySelector('input[name="address"]');
                    if (addressInput && !addressInput.value) {
                        addressInput.value = address;
                    }
                }
            });
        }
    }

    // Função para buscar coordenadas por endereço
    function geocodeAddress(address, callback) {
        if (!geocoder) {
            callback(null, null);
            return;
        }

        geocoder.geocode({ address: address }, function(results, status) {
            if (status === 'OK' && results[0]) {
                const location = results[0].geometry.location;
                callback(location.lat(), location.lng());
            } else {
                console.warn('Geocoding failed: ' + status);
                callback(null, null);
            }
        });
    }

    // Função para buscar endereço por coordenadas
    function reverseGeocode(lat, lng, callback) {
        if (!geocoder) {
            callback(null);
            return;
        }

        const latlng = { lat: lat, lng: lng };
        geocoder.geocode({ location: latlng }, function(results, status) {
            if (status === 'OK' && results[0]) {
                callback(results[0].formatted_address);
            } else {
                console.warn('Reverse geocoding failed: ' + status);
                callback(null);
            }
        });
    }


    // Função para construir endereço completo para geocoding
    function buildFullAddress() {
        const addressInput = document.querySelector('input[name="address"]');
        const cityInput = document.querySelector('input[name="city"]');
        const stateSelect = document.querySelector('select[name="state"]');
        const zipCodeInput = document.getElementById('zip_code');
        
        const parts = [];
        
        // Prioridade 1: CEP (mais preciso)
        if (zipCodeInput && zipCodeInput.value) {
            const cep = zipCodeInput.value.replace(/\D/g, '');
            if (cep.length === 8) {
                return cep + ', Brasil';
            }
        }
        
        // Prioridade 2: Endereço completo
        if (addressInput && addressInput.value) {
            parts.push(addressInput.value);
        }
        
        // Adicionar cidade
        if (cityInput && cityInput.value) {
            parts.push(cityInput.value);
        }
        
        // Adicionar estado
        if (stateSelect && stateSelect.value) {
            parts.push(stateSelect.value);
        }
        
        // Adicionar Brasil se tiver algum dado
        if (parts.length > 0) {
            parts.push('Brasil');
        }
        
        return parts.join(', ');
    }

    // Função para atualizar mapa a partir de endereço
    function updateMapFromAddress() {
        const fullAddress = buildFullAddress();
        
        if (!fullAddress || fullAddress === 'Brasil') {
            return; // Não há endereço suficiente
        }

        geocodeAddress(fullAddress, function(lat, lng) {
            if (lat && lng) {
                const location = { lat: lat, lng: lng };

                // Atualizar posição do mapa
                map.setCenter(location);
                map.setZoom(15);

                // Atualizar posição do marcador
                marker.setPosition(location);

                // Atualizar campos de latitude e longitude
                const latInput = document.getElementById('latitude');
                const lngInput = document.getElementById('longitude');

                if (latInput) latInput.value = lat.toFixed(8);
                if (lngInput) lngInput.value = lng.toFixed(8);
            }
        });
    }

    // Event listeners para os campos de endereço
    const addressInput = document.querySelector('input[name="address"]');
    const cityInput = document.querySelector('input[name="city"]');
    const stateSelect = document.querySelector('select[name="state"]');
    const zipCodeInput = document.getElementById('zip_code');

    // Timeout para evitar muitas requisições
    let geocodeTimeout;

    function scheduleGeocode() {
        clearTimeout(geocodeTimeout);
        geocodeTimeout = setTimeout(function() {
            updateMapFromAddress();
        }, 1000); // Aguardar 1 segundo após parar de digitar
    }

    if (addressInput) {
        addressInput.addEventListener('input', scheduleGeocode);
    }

    if (cityInput) {
        cityInput.addEventListener('input', scheduleGeocode);
    }

    if (stateSelect) {
        stateSelect.addEventListener('change', scheduleGeocode);
    }

    if (zipCodeInput) {
        zipCodeInput.addEventListener('input', scheduleGeocode);
        
        // Máscara de CEP
        zipCodeInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });
    }

    // Inicializar mapa quando a página carregar
    if (typeof google !== 'undefined' && google.maps) {
        initMap();
    } else {
        // Carregar Google Maps API se não estiver carregada
        const script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDxTQNhcxy3E2xiQHa66sk25pyz4KcT-Qs&callback=initAddressMap';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);

        // Função global para callback
        window.initAddressMap = initMap;
    }
});
