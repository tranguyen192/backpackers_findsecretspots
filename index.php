<?php
    include "functions.php";
    include "header.php";
?>

<div class="map_index">
    <div class="content_pos">
        <div class="headline_pos">
            <h1> BACKPACKERS </h1>
            <h2> FIND SECRET SPOTS </h2>
        </div>

        <div class="content_index">

            Sometimes I feel like there are no parts left of the world to explore.
            With the popularity of blogs and social media, it feels as if the world knows all
            there is to know about travel now.
            Every destination seems to have been photographed and shared a million times.

            But lucky we do live in a very big world that still offers the hungry traveler
            those hidden secret destination experiences on a budget.

            <div class="explore_world">
                <b>Backpackers - Find Secret Spots</b> is all about bringing out the best of
                your adventures by helping people discover and share secret places around
                the globe!
            </div>

            <h2 class="headline_map">More Than Just A Map</h2>

            <div class="index_content">
                <div class="index_worldmap">
                    <img src="img_website/pin_worldmap.png" alt="worldmap" width="80">
                    <h4>PLAN YOUR TRIP</h4>
                    Make the most of your stay by choosing the next incredible travel destination.
                </div>

                <div class="index_radar">
                    <img src="img_website/radar.png" alt="radar" width="80">
                    <h4>BE SPONTANEAOUS</h4>
                    Scan for secret places and discover the world through different eyes.
                </div>

                <div class="index_discover">
                    <img src="img_website/discover.png" alt="discover" width="80">
                    <h4>SHARE AND DISCOVER</h4>
                    No more tourist traps - get honest feedback from fellow travelers and share yours to travelers.
                </div>
            </div>

            <div id="image_index">
                <img src="img_website/travel2.jpg" alt="travel" class="image_index">
            </div>

            <h3 class="headline_subscribe">Keep in touch</h3>
            <div class="subscribe">
                <form action="subscribe.php" method="POST">
                    <p>Subscribe now to Backpackers - Find Secret Spots newsletter.</p>
                    <input type="text" name="name" placeholder="Your name..." required>
                    <input type="text" name="email" id="email" placeholder="Your e-mail address..." required>
                    <input id="submit_subscribe" type="submit" name="submit" value="I am in!">
                </form>
            </div>

        </div>
    </div>
</div>

<?php
include "footer_1.php";

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */

