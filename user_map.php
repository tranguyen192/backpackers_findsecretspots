<?php
$current_user = $_SESSION['USER'];

$current_id = $dbh->prepare("SELECT user_id from users WHERE user_uid = ?");
$current_id->execute(array($current_user));
$id = $current_id->fetch();

?>

    <div id="map_direction">
        <div id="map"></div>

        <div class="location_button">
            <button type="submit" name="get_location" class="upload_button" id="location_button">GET LOCATION</button>
        </div>
    </div>

<!--<script src="js/user_map.js"></script>-->

    <script>
        let map;

        function initMap() {

            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 3.1412, lng: 101.68653},
                zoom: 4
            });

            let types = document.getElementById('type-selector');
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            let infowindow = new google.maps.InfoWindow();
            let marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            let loc_marker = 'http://www.robotwoods.com/dev/misc/bluecircle.png';
            //let loc_marker = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

            // GET LOCATION
            $('#location_button').click(function() {
                let myPosition;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                            let pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            myPosition = pos;

                            infowindow.setPosition(pos);
                            infowindow.setContent('Location found.');
                            map.setCenter(pos);

                            let userMarker = new google.maps.Marker({
                                position: pos,
                                map: map,
                                animation: google.maps.Animation.DROP,
                                icon: loc_marker
                            });

                            let cityCircle = new google.maps.Circle({
                                strokeColor: '#87CEFA',
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: '#87CEFA',
                                fillOpacity: 0.35,
                                map: map,
                                center: myPosition,
                                radius: 10000
                            });
                        },
                        function() {
                            handleLocationError(true, infowindow, map.getCenter());
                        });
                }
                else {
                    // if browser doesn't support Geolocation
                    handleLocationError(false, infowindow, map.getCenter());
                }
            });

            //=====

            let allData = <?php
                $marker = $dbh->prepare("SELECT place_lat as lat, place_lng as lng, user_input as name, place_location as location, user_image as image, user_id as id 
                FROM map_pins WHERE user_id = ?;");
                $marker->execute(array($id->user_id));
                $result = $marker->fetchAll();
                echo json_encode($result,true);
                ?>;
            showAllPins(allData);
        }

        // NEW ALLDATA:
        function showAllPins(allData) {
            Array.prototype.forEach.call(allData, function(data) {
                let marker = new google.maps.Marker({
                    position: new google.maps.LatLng(data.lat, data.lng),
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: 'Click for more details'
                });
                let infoWindow = new google.maps.InfoWindow({
                    content: "<br><form action='edit_pin.php' method='post'>" +
                    "<button type='submit' name='submit' class='upload_button'><a class='ion-paintbrush' style='color: #bc8f8f'></a></button>" +
                    "<input type='hidden' name='location' value='" + data.location + "'>" +
                    "</form>" +
                    "<br><h3>" + data.location + "</h3>" + "<p style='font-size: 1.2em'>" + data.name + "</p>" +
                    "<img src='" + data.image + "' alt='There was a problem uploading your image!' width='580px'>",
                    maxWidth: 440
                });

                google.maps.event.addListener(marker, 'click', function(){
                    infoWindow.open(map, marker);


                    google.maps.event.addListener(map, 'click', function() {
                        infoWindow.close();
                    });
                })
            })
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX-44AyqY8Aw1zQT4zOKv0wgNbd6oJjU0&libraries=places&callback=initMap"
            async defer>
    </script>

<?php
include "footer_1.php";

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
