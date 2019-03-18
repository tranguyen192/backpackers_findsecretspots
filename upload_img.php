<?php
include "functions.php";
include "header.php";
?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        <input type="hidden" name="location" id="location">

        <div class="upload_map_pos">
            <?php

            if(isset($_SESSION['USER']))
            {
                $userUid = $_SESSION['USER'];
                $current_id = $dbh->prepare("SELECT user_id from users WHERE user_uid = ?");
                $current_id->execute([$userUid]);
                $id = $current_id->fetch();

                echo '<div class="inputarea">
                <h1 class="headline_submit"> SHARE YOUR SECRET </h1>

                    <div class="upload_image">
                        <input type="file" name="file" value="file" id="file"> <!--  style="display:none" -->
                        <!--<label for="file" class="image_upload"> Select a file to upload </label>-->
                        <button type="submit" name="submit" class="upload_button">share</button>
                    </div>
                <textarea class="textarea" cols="35" rows="4" name="text" required></textarea>
            
              </div>';
            }
            ?>

            <div id="map_direction">
                <div id="map"></div>
            </div>

            <div id="place_pos">
                <input id="pac-input" class="controls" type="text" style="visibility: hidden" placeholder="Find your place here">
            </div>

        </div>

    </form>

    <!--<script src="js/pin_map.js"></script>-->

    <script>
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

            let autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            let infowindow = new google.maps.InfoWindow();
            let marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                let place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                }
                else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                let item_Lat = place.geometry.location.lat();
                let item_Lng = place.geometry.location.lng();
                let item_Location = place.formatted_address;
                //alert("Lat= "+item_Lat+"_______Lang="+item_Lng+"_______Location="+item_Location);

                $("#lat").val(item_Lat);
                $("#lng").val(item_Lng);
                $("#location").val(item_Location);

                let address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });

            let allData = <?php
                $marker = $dbh->prepare("SELECT place_lat as lat, place_lng as lng, user_input as name, place_location as location, user_image as image, users.user_firstname as firstname
            FROM map_pins LEFT OUTER JOIN users ON map_pins.user_id = ?;");
                $marker->execute([$id->user_id]);
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
                    content: "<h2 class='headline_pinmap'> 🎒" + data.firstname + " shared: </h2>" + "<h3>" + data.location + "</h3>" + "<p>" + data.name + "</p>" + "<img src='" + data.image + "' alt='There was a problem uploading your image!' width='380px'>",
                    maxWidth: 500
                });

                    google.maps.event.addListener(marker, 'click', function(){
                    infoWindow.open(map, marker);

                    google.maps.event.addListener(map, 'click', function() {
                        infoWindow.close();
                    });
                })
            })
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



