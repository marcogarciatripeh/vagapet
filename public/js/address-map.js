// Mapa interativo para endereços
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar mapa
    let map;
    let marker;

    // Função para inicializar o mapa
    function initMap() {
        // Coordenadas padrão (São Paulo)
        const defaultLat = -23.550520;
        const defaultLng = -46.633308;

        // Criar mapa
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 12,
            center: { lat: defaultLat, lng: defaultLng },
            mapTypeId: 'roadmap'
        });

        // Criar marcador
        marker = new google.maps.Marker({
            position: { lat: defaultLat, lng: defaultLng },
            map: map,
            draggable: true,
            title: 'Sua localização'
        });

        // Evento quando o marcador é arrastado
        marker.addListener('dragend', function() {
            const position = marker.getPosition();
            updateAddressFromCoords(position.lat(), position.lng());
        });
    }

    // Função para buscar coordenadas por endereço
    function geocodeAddress(address, callback) {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: address }, function(results, status) {
            if (status === 'OK' && results[0]) {
                const location = results[0].geometry.location;
                callback(location.lat(), location.lng());
            } else {
                console.error('Geocoding failed: ' + status);
                callback(null, null);
            }
        });
    }

    // Função para buscar endereço por coordenadas
    function reverseGeocode(lat, lng, callback) {
        const geocoder = new google.maps.Geocoder();
        const latlng = { lat: lat, lng: lng };

        geocoder.geocode({ location: latlng }, function(results, status) {
            if (status === 'OK' && results[0]) {
                callback(results[0].formatted_address);
            } else {
                console.error('Reverse geocoding failed: ' + status);
                callback(null);
            }
        });
    }

    // Função para atualizar endereço a partir de coordenadas
    function updateAddressFromCoords(lat, lng) {
        reverseGeocode(lat, lng, function(address) {
            if (address) {
                const addressInput = document.querySelector('input[name="address"]');
                if (addressInput) {
                    addressInput.value = address;
                }
            }
        });
    }

    // Função para atualizar mapa a partir de endereço
    function updateMapFromAddress(address) {
        if (!address || address.length < 5) return;

        geocodeAddress(address, function(lat, lng) {
            if (lat && lng) {
                const location = { lat: lat, lng: lng };

                // Atualizar posição do mapa
                map.setCenter(location);
                map.setZoom(15);

                // Atualizar posição do marcador
                marker.setPosition(location);

                // Atualizar campos de latitude e longitude
                const latInput = document.querySelector('input[name="latitude"]');
                const lngInput = document.querySelector('input[name="longitude"]');

                if (latInput) latInput.value = lat;
                if (lngInput) lngInput.value = lng;
            }
        });
    }

    // Event listeners para os campos de endereço
    const addressInput = document.querySelector('input[name="address"]');
    const mapInput = document.querySelector('input[name="map"]');

    if (addressInput) {
        let addressTimeout;
        addressInput.addEventListener('input', function() {
            clearTimeout(addressTimeout);
            addressTimeout = setTimeout(function() {
                updateMapFromAddress(addressInput.value);
            }, 1000); // Aguardar 1 segundo após parar de digitar
        });
    }

    if (mapInput) {
        let mapTimeout;
        mapInput.addEventListener('input', function() {
            clearTimeout(mapTimeout);
            mapTimeout = setTimeout(function() {
                updateMapFromAddress(mapInput.value);
            }, 1000); // Aguardar 1 segundo após parar de digitar
        });
    }

    // Inicializar mapa quando a página carregar
    if (typeof google !== 'undefined' && google.maps) {
        initMap();
    } else {
        // Carregar Google Maps API se não estiver carregada
        const script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDxTQNhcxy3E2xiQHa66sk25pyz4KcT-Qs&callback=initMap';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);

        // Função global para callback
        window.initMap = initMap;
    }

    // Adicionar campos ocultos para latitude e longitude
    const form = document.querySelector('form');
    if (form) {
        const latInput = document.createElement('input');
        latInput.type = 'hidden';
        latInput.name = 'latitude';
        latInput.value = '-23.550520';

        const lngInput = document.createElement('input');
        lngInput.type = 'hidden';
        lngInput.name = 'longitude';
        lngInput.value = '-46.633308';

        form.appendChild(latInput);
        form.appendChild(lngInput);
    }
});
