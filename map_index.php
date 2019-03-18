<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">
    <input type="hidden" name="location" id="location">

    <div class="upload_map_pos">
        <div id="map_direction">
            <div id="map"></div>
        </div>
    </div>
</form>

<script src="js/map_index.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASfLMnjts4fzPLk0koyLo29UZUG_4Woqo&callback=initMap"
        async defer>
</script>

<?php
include "footer_1.php";

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
