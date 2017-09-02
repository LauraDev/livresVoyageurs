$(document).ready(function() {
    
    // variable pour la carte
    var map;
    // Hide pointers data
    $('.startpoint').hide()
    $('.pointer').hide()

    //fonction init pour executer l'API par google
    function init() {

        var bounds  = new google.maps.LatLngBounds();
        var loc;
        // Define where to postion the map
        var mapDiv = document.getElementById('map');
        // Lat / lng startpoint
        var latStart =  Number($('.lat_startpoint').eq(0).html())
        var lngStart = Number($('.lng_startpoint').eq(0).html())
        var latlng = {lat: Number($('.lat_startpoint').html()), lng:Number($('.lng_startpoint').html()) };
        // Get lat and lng for other markers (captures)
        var pointer = document.getElementsByClassName('pointer')

        // Map creation
        map = new google.maps.Map(mapDiv, {
            styles: [
                {"featureType": "landscape.natural", "elementType": "geometry.fill", "stylers": [{"visibility": "on"},{"color": "#e0efef"}]},
                {"featureType": "poi", "elementType": "geometry.fill", "stylers": [{"visibility": "on"},{"hue": "#1900ff"},{"color": "#c0e8e8"}]},
                {"featureType": "road", "elementType": "geometry", "stylers": [{"lightness": 100},{"visibility": "simplified"}]},
                {"featureType": "road", "elementType": "labels", "stylers": [{"visibility": "off"}]},
                {"featureType": "transit.line", "elementType": "geometry", "stylers": [{"visibility": "on"}, {"lightness": 700}]},
                {"featureType": "water", "elementType": "all", "stylers": [{"color": "#7dcdcd"}]}
            ]
        })

        var contentStart =
            '<link href="/livresVoyageurs/public/assets/css/infowindow.css">'+
            '<h1>Point de départ</h1>' +
            '<div class="row">' +
                '<img class="col-xs-7 img" src="/livresVoyageurs/public/assets/images/avatar/' + $('.avatar_startpoint').html() +'" style="width:65px; height:auto" alt="Avatar membre" />' +
                '<div class="col-sm-4">'+
                    '<h2>' + $('.city_startpoint').html() +'</h2>' +
                    '<h2>' + $('.pseudo_startpoint').html() + '</h2>' +
                '</div>'+
            '</div>'
        // Create startpoint marker
        var marker =  new google.maps.Marker({
            position: latlng,
            map: map,
            //Tooltip
            title: 'Départ du livre',
            content: contentStart
        })
            loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(loc);
        var infowindow = new google.maps.InfoWindow({
            content: contentStart
        });
        // ajout de la boite d'info et du listener
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);

        var pos;
        var posCapt= [];

        // Create captures markers
        for (var i = 0; i < pointer.length; i++) {

        var latPoint = Number($('.lat_pointer').eq(i).html())
        var lngPoint = Number($('.lng_pointer').eq(i).html())
            var markers = [];
            var pos = new google.maps.LatLng( latPoint , lngPoint);
            var contentCapture =
                '<h1>Capturé le:<br>'+ $('.date_pointer').eq(i).html() +'</h1>' +
                '<div class="row">' +
                    '<img class="col-sm-7 img img-responsive" src="/livresVoyageurs/public/assets/images/avatar/' + $('.avatar_pointer').eq(i).html() + '" style="width:65px; height:auto" alt="Avatar Membre" />'+
                    '<div class="col-sm-4">'+
                        '<h2>' + $('.city_pointer').eq(i).html() +'</h2>' +
                        '<h2>' + $('.pseudo_pointer').eq(i).html() + '</h2>' +
                    '</div>'+
                '</div>'
            // Create captures marker
            markers[i] = new google.maps.Marker({
                position: pos,
                map: map,
                id: i+1,
                title: 'Voyage n:',
                content: contentCapture
            });
            // Define markers infos
            var infowindow = new google.maps.InfoWindow({
                content: contentCapture
            });
            // add listener
            markers[i].addListener('click', function() {
                infowindow.open(map, markers[i]);
            });
            infowindow.open(map, markers[i]);

            // Marker position
            posCapt[0] = {lat: latStart , lng: lngStart }
            posCapt[i] = {lat:latPoint , lng:lngPoint};

            // Extend bounds
            loc[i] = {lat:latPoint , lng:lngPoint};
            bounds.extend(loc[i]);

        } // loop end


        // alert(JSON.stringify(loc))

        // Lines between marker: Follow the path
        var flightPath = new google.maps.Polyline({
        path: posCapt,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
        });
        flightPath.setMap(map);

        // Automatically zoom and center the map (include all markers inside the map)
        map.fitBounds(bounds);       // auto-zoom
        map.panToBounds(bounds);     // auto-center


    } // init() end
    // load map on window load
    google.maps.event.addDomListener(window, 'load', init);

}) // document ready