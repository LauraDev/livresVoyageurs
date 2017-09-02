$(document).ready(function() {
    
    // Google Autocomplete
    function initializeCapture() {
        var input = document.getElementById('form_address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('form_city_pointer').value = place.name;
            document.getElementById('form_lat_pointer').value = place.geometry.location.lat();
            document.getElementById('form_lng_pointer').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initializeCapture);

}) // document ready