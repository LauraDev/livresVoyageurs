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
            '<div class="iw-container">'+
                '<div class="iw-title">'+
                    '<h1 class="text-center">1 - Point de départ : ' +$('.city_startpoint').html() + '</h1>' +
                '</div>'+
                '<div class="row">' +
                    '<img class="col-xs-4 img" src="/livresVoyageurs/public/assets/images/avatar/' + $('.avatar_startpoint').html() +'" alt="Avatar membre" />' +
                    '<div class="col-xs-8">'+
                        '<h2>' + $('.pseudo_startpoint').html() + '</h2>' +
                    '</div>'+
                '</div>'
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
            content: contentStart,

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
            var pos = new google.maps.LatLng( latPoint , lngPoint);
            var contentCapture =
            '<div class="iw-container">'+
                '<div class="iw-title">'+
                '<h1 class="text-center">'+(i+2)+' - Capturé le : '+ $('.date_pointer').eq(i).html() +'</h1>' +
                '</div>'+
                '<div class="row">' +
                    '<img class="col-xs-4 img" src="/livresVoyageurs/public/assets/images/avatar/' + $('.avatar_pointer').eq(i).html() +'" alt="Avatar membre" />' +
                    '<div class="col-xs-8">'+
                        '<h2>Par : ' + $('.pseudo_pointer').eq(i).html() + '</h2>' +
                    '</div>'+
                    '<h3 class="text-center">' + $('.city_pointer').eq(i).html() +'</h3>' +
                '</div>'
            '</div>'
            // Create captures marker
            var markers = new google.maps.Marker({
                position: pos,
                map: map,
                id: i+1,
                title: 'Voyage n:',
                content: contentCapture
            });
            // Define markers infos
            var infowindow = new google.maps.InfoWindow({
                content: contentCapture,


            });
            // add listener
            markers.addListener('click', function() {
                infowindow.open(map, markers);
            });
            infowindow.open(map, markers);

            // Marker position
            posCapt[0] = {lat: latStart , lng: lngStart };
            posCapt[i+1] = {lat:latPoint , lng:lngPoint};

            // Extend bounds
            loc[i] = {lat:latPoint , lng:lngPoint};
            bounds.extend(loc[i]);

        } // loop end


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

        google.maps.event.addListener(infowindow, 'domready', function() {

            // Reference to the DIV which receives the contents of the infowindow using jQuery
            var iwOuter = $('.gm-style-iw');

            /* The DIV we want to change is above the .gm-style-iw DIV.
            * So, we use jQuery and create a iwBackground variable,
            * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
            */
            var iwBackground = iwOuter.prev();
            // Remove the background shadow DIV
            iwBackground.children(':nth-child(2)').css({'display' : 'none'});
            // Remove the white background DIV
            iwBackground.children(':nth-child(4)').css({'display' : 'none'});
            // Reference to the div that groups the close button elements.
            var iwCloseBtn = iwOuter.next();

            iwCloseBtn.css({
                opacity: '1', // by default the close button has an opacity of 0.7
                right: '45px',
                top: '5px', // button repositioning
                border: '10px solid #48b5e9', // increasing button border and new color
                'border-radius': '13px', // circular effect
                'box-shadow': '0 0 5px #3990B9' // 3D effect to highlight the button
            });

            iwCloseBtn.mouseout(function(){
                $(this).css({opacity: '1'});
            });
        });



    } // init() end
    // load map on window load
    google.maps.event.addDomListener(window, 'load', init);

}) // document ready
