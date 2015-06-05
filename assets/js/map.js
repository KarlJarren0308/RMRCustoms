var globalLatitude = 22.502;
var globalLongitude = 113.932;

function initializeMap(latitude, longitude) {
    if(latitude == '' || latitude == 0 || longitude == '' || longitude == 0) {
        latitude = globalLatitude;
        longitude = globalLongitude;
    }

    var coordinates = new google.maps.LatLng(latitude, longitude);
    var mapOptions = {
        center: coordinates,
        zoom: 4,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_CENTER
        }
    }
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var marker = new google.maps.Marker({
        map: map,
        position: coordinates,
        title: 'Hello World!'
    });
}