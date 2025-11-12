/*var infoBox_ratingType='star-rating';*/

(function($){"use strict";
function locationData (locationImg, locationURL, locationTitle, job_type, job_address ) {return(''+
'<div class="map-listing-item">'+
    '<div class="inner-box">'+
        '<div class="infoBox-close"><i class="fa fa-times"></i></div>'+
        '<div class="image-box">'+
            '<figure class="image"><img src="'+locationImg+'" alt=""></figure>'+
        '</div>'+
        '<div class="content">'+
        '<h3><a href="'+locationURL+'">' + locationTitle + '</a></h3>'+
        '<ul class="job-info">'+
            '<li><span class="icon flaticon-briefcase"></span> ' +job_type+ '</li>'+
            '<li><span class="icon flaticon-map-locator"></span>' +job_address+ '</li>'+
        '</ul>'+
    '</div>'+
'</div>')};


// Dados de exemplo REMOVIDOS - não usar mais dados fake
// O mapa só mostrará dados reais via window.mapLocations

function numericalRating(ratingElem) {
        $(ratingElem).each(function() {
            var dataRating = $(this).attr('data-rating');
            if (dataRating >= 4.0) {
                $(this).addClass('high');
            } else if (dataRating >= 3.0) {
                $(this).addClass('mid');
            } else if (dataRating < 3.0) {
                $(this).addClass('low');
            }
        });
    }
    numericalRating('.numerical-rating');


    function starRating(ratingElem) {
        $(ratingElem).each(function() {
            var dataRating = $(this).attr('data-rating');

            function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
                return ('' +
                    '<span class="' + firstStar + '"></span>' +
                    '<span class="' + secondStar + '"></span>' +
                    '<span class="' + thirdStar + '"></span>' +
                    '<span class="' + fourthStar + '"></span>' +
                    '<span class="' + fifthStar + '"></span>');
            }
            var fiveStars = starsOutput('star', 'star', 'star', 'star', 'star');
            var fourHalfStars = starsOutput('star', 'star', 'star', 'star', 'star half');
            var fourStars = starsOutput('star', 'star', 'star', 'star', 'star empty');
            var threeHalfStars = starsOutput('star', 'star', 'star', 'star half', 'star empty');
            var threeStars = starsOutput('star', 'star', 'star', 'star empty', 'star empty');
            var twoHalfStars = starsOutput('star', 'star', 'star half', 'star empty', 'star empty');
            var twoStars = starsOutput('star', 'star', 'star empty', 'star empty', 'star empty');
            var oneHalfStar = starsOutput('star', 'star half', 'star empty', 'star empty', 'star empty');
            var oneStar = starsOutput('star', 'star empty', 'star empty', 'star empty', 'star empty');
            if (dataRating >= 4.75) {
                $(this).append(fiveStars);
            } else if (dataRating >= 4.25) {
                $(this).append(fourHalfStars);
            } else if (dataRating >= 3.75) {
                $(this).append(fourStars);
            } else if (dataRating >= 3.25) {
                $(this).append(threeHalfStars);
            } else if (dataRating >= 2.75) {
                $(this).append(threeStars);
            } else if (dataRating >= 2.25) {
                $(this).append(twoHalfStars);
            } else if (dataRating >= 1.75) {
                $(this).append(twoStars);
            } else if (dataRating >= 1.25) {
                $(this).append(oneHalfStar);
            } else if (dataRating < 1.25) {
                $(this).append(oneStar);
            }
        });
    }
    starRating('.star-rating');

/*google.maps.event.addListener(ib,'domready',function(){if(infoBox_ratingType='numerical-rating'){numericalRating('.infoBox .'+infoBox_ratingType+'');}
if(infoBox_ratingType='star-rating'){starRating('.infoBox .'+infoBox_ratingType+'');}});*/

function mainMap() {
// Usar APENAS dados dinâmicos - SEM dados fake
var locations = [];
if(typeof window.mapLocations !== 'undefined' && window.mapLocations && Array.isArray(window.mapLocations) && window.mapLocations.length > 0) {
    locations = window.mapLocations;
} else {
    // NÃO usar defaultLocations - deixar o mapa vazio se não houver dados reais
    locations = [];
}
var ib=new InfoBox();

var mapZoomAttr=$('#map').attr('data-map-zoom');var mapScrollAttr=$('#map').attr('data-map-scroll');if(typeof mapZoomAttr!==typeof undefined&&mapZoomAttr!==false){var zoomLevel=parseInt(mapZoomAttr);}else{var zoomLevel=5;}
if(typeof mapScrollAttr!==typeof undefined&&mapScrollAttr!==false){var scrollEnabled=parseInt(mapScrollAttr);}else{var scrollEnabled=false;}
// Calcular centro do mapa baseado nas localizações disponíveis
var mapCenter = new google.maps.LatLng(-23.550520,-46.633308); // Centro padrão: São Paulo
if(typeof locations !== 'undefined' && locations.length > 0) {
    try {
        var bounds = new google.maps.LatLngBounds();
        var validLocations = 0;
        for(var i = 0; i < locations.length; i++) {
            if(locations[i] && locations[i][1] != null && locations[i][2] != null && !isNaN(locations[i][1]) && !isNaN(locations[i][2])) {
                bounds.extend(new google.maps.LatLng(parseFloat(locations[i][1]), parseFloat(locations[i][2])));
                validLocations++;
            }
        }
        if(validLocations > 0) {
            mapCenter = bounds.getCenter();
            if(validLocations === 1) {
                zoomLevel = 12;
            } else if(validLocations > 1) {
                // Ajustar zoom para mostrar todos os marcadores
                var ne = bounds.getNorthEast();
                var sw = bounds.getSouthWest();
                var lat_diff = Math.abs(ne.lat() - sw.lat());
                var lng_diff = Math.abs(ne.lng() - sw.lng());
                if(lat_diff < 0.1 && lng_diff < 0.1) {
                    zoomLevel = 13;
                } else if(lat_diff < 0.5 && lng_diff < 0.5) {
                    zoomLevel = 11;
                }
            }
        }
    } catch(e) {
        console.error('Erro ao calcular centro do mapa:', e);
    }
}
var map=new google.maps.Map(document.getElementById('map'),{zoom:zoomLevel,scrollwheel:scrollEnabled,center:mapCenter,mapTypeId:google.maps.MapTypeId.ROADMAP,zoomControl:false,mapTypeControl:false,scaleControl:false,panControl:false,navigationControl:false,streetViewControl:false,gestureHandling:'cooperative',styles:
    [
    {
        "featureType": "landscape",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 60
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 40
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 30
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ef8c25"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#b6c54c"
            },
            {
                "lightness": 40
            },
            {
                "saturation": -40
            }
        ]
    },
    {}
]

});$('.listing-item-container').on('mouseover',function(){var listingAttr=$(this).data('marker-id');if(listingAttr!==undefined){var listing_id=$(this).data('marker-id')-1;var marker_div=allMarkers[listing_id].div;$(marker_div).addClass('clicked');$(this).on('mouseout',function(){if($(marker_div).is(":not(.infoBox-opened)")){$(marker_div).removeClass('clicked');}});}});var boxText=document.createElement("div");boxText.className='map-box'
var currentInfobox;var boxOptions={content:boxText,disableAutoPan:false,alignBottom:true,maxWidth:0,pixelOffset:new google.maps.Size(-134,-55),zIndex:null,boxStyle:{width:"320px"},closeBoxMargin:"0",closeBoxURL:"",infoBoxClearance:new google.maps.Size(25,25),isHidden:false,pane:"floatPane",enableEventPropagation:false,};var markerCluster,overlay,i;var allMarkers=[];var clusterStyles=[{textColor:'white',url:'',height:50,width:50}];var markerIco;for(i=0;i<locations.length;i++){markerIco=locations[i][4];var overlaypositions=new google.maps.LatLng(locations[i][1],locations[i][2]),overlay=new CustomMarker(overlaypositions,map,{marker_id:i},markerIco);allMarkers.push(overlay);google.maps.event.addDomListener(overlay,'click',(function(overlay,i){return function(){ib.setOptions(boxOptions);boxText.innerHTML=locations[i][0];ib.close();ib.open(map,overlay);currentInfobox=locations[i][3];google.maps.event.addListener(ib,'domready',function(){$('.infoBox-close').click(function(e){e.preventDefault();ib.close();$('.map-marker-container').removeClass('clicked infoBox-opened');});});}})(overlay,i));}
var options={imagePath:'images/',styles:clusterStyles,minClusterSize:2};markerCluster=new MarkerClusterer(map,allMarkers,options);google.maps.event.addDomListener(window,"resize",function(){var center=map.getCenter();google.maps.event.trigger(map,"resize");map.setCenter(center);});var zoomControlDiv=document.createElement('div');var zoomControl=new ZoomControl(zoomControlDiv,map);function ZoomControl(controlDiv,map){zoomControlDiv.index=1;map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);controlDiv.style.padding='5px';controlDiv.className="zoomControlWrapper";var controlWrapper=document.createElement('div');controlDiv.appendChild(controlWrapper);var zoomInButton=document.createElement('div');zoomInButton.className="custom-zoom-in";controlWrapper.appendChild(zoomInButton);var zoomOutButton=document.createElement('div');zoomOutButton.className="custom-zoom-out";controlWrapper.appendChild(zoomOutButton);google.maps.event.addDomListener(zoomInButton,'click',function(){map.setZoom(map.getZoom()+1);});google.maps.event.addDomListener(zoomOutButton,'click',function(){map.setZoom(map.getZoom()-1);});}
var scrollEnabling=$('#scrollEnabling');$(scrollEnabling).click(function(e){e.preventDefault();$(this).toggleClass("enabled");if($(this).is(".enabled")){map.setOptions({'scrollwheel':true});}else{map.setOptions({'scrollwheel':false});}})
$("#geoLocation, .input-with-icon.location a").click(function(e){e.preventDefault();geolocate();});

function geolocate(){if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(position){var pos=new google.maps.LatLng(position.coords.latitude,position.coords.longitude);map.setCenter(pos);map.setZoom(12);});}}
} // Fim da função mainMap()

var map=document.getElementById('map');if(typeof(map)!='undefined'&&map!=null){google.maps.event.addDomListener(window,'load',mainMap);}

function singleListingMap() {
    var myLatlng=new google.maps.LatLng( {
        lng: $('#singleListingMap').data('longitude'), lat: $('#singleListingMap').data('latitude'),
    }
    );
    var single_map=new google.maps.Map(document.getElementById('singleListingMap'), {
        zoom:15, center:myLatlng, scrollwheel:false, zoomControl:false, mapTypeControl:false, scaleControl:false, panControl:false, navigationControl:false, streetViewControl:false, styles:

        [
    {
        "featureType": "landscape",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 60
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 40
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 30
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ef8c25"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#b6c54c"
            },
            {
                "lightness": 40
            },
            {
                "saturation": -40
            }
        ]
    },
    {}
]

    }
    );
    $('#streetView').click(function(e) {
        e.preventDefault();
        single_map.getStreetView().setOptions( {
            visible: true, position: myLatlng
        }
        );
    }
    );
    var zoomControlDiv=document.createElement('div');
    var zoomControl=new ZoomControl(zoomControlDiv, single_map);
    function ZoomControl(controlDiv, single_map) {
        zoomControlDiv.index=1;
        single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
        controlDiv.style.padding='5px';
        var controlWrapper=document.createElement('div');
        controlDiv.appendChild(controlWrapper);
        var zoomInButton=document.createElement('div');
        zoomInButton.className="custom-zoom-in";
        controlWrapper.appendChild(zoomInButton);
        var zoomOutButton=document.createElement('div');
        zoomOutButton.className="custom-zoom-out";
        controlWrapper.appendChild(zoomOutButton);
        google.maps.event.addDomListener(zoomInButton, 'click', function() {
            single_map.setZoom(single_map.getZoom()+1);
        }
        );
        google.maps.event.addDomListener(zoomOutButton, 'click', function() {
            single_map.setZoom(single_map.getZoom()-1);
        }
        );
    }
    var singleMapIco="<i class='"+$('#singleListingMap').data('map-icon')+"'></i>";
    new CustomMarker(myLatlng, single_map, {
        marker_id: '1'
    }
    , singleMapIco);
}

var single_map=document.getElementById('singleListingMap');
if(typeof(single_map)!='undefined'&&single_map!=null) {
    google.maps.event.addDomListener(window, 'load', singleListingMap);
}





function CustomMarker(latlng,map,args,markerIco){this.latlng=latlng;this.args=args;this.markerIco=markerIco;this.setMap(map);}
CustomMarker.prototype=new google.maps.OverlayView();CustomMarker.prototype.draw=function(){var self=this;var div=this.div;if(!div){div=this.div=document.createElement('div');div.className='map-marker-container';div.innerHTML='<div class="marker-container">'+
'<div class="marker-card">'+
'<div class="front face">'+self.markerIco+'</div>'+
'<div class="back face">'+self.markerIco+'</div>'+
'<div class="marker-arrow"></div>'+
'</div>'+
'</div>'
google.maps.event.addDomListener(div,"click",function(event){$('.map-marker-container').removeClass('clicked infoBox-opened');google.maps.event.trigger(self,"click");$(this).addClass('clicked infoBox-opened');});if(typeof(self.args.marker_id)!=='undefined'){div.dataset.marker_id=self.args.marker_id;}
var panes=this.getPanes();panes.overlayImage.appendChild(div);}
var point=this.getProjection().fromLatLngToDivPixel(this.latlng);if(point){div.style.left=(point.x)+'px';div.style.top=(point.y)+'px';}};CustomMarker.prototype.remove=function(){if(this.div){this.div.parentNode.removeChild(this.div);this.div=null;$(this).removeClass('clicked');}};CustomMarker.prototype.getPosition=function(){return this.latlng;};})(this.jQuery);
