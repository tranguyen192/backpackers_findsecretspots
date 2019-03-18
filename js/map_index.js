let map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 3.1412, lng: 101.68653},
        zoom: 4
    });
    let input = /** @type {!HTMLInputElement} */(
        document.getElementById('pac-input'));

    let types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    let infowindow = new google.maps.InfoWindow();
    let marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */