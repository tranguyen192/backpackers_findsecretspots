<?php
    include "functions.php";
    include "header.php";

    $input = "";

    if( isset($_GET['search']) ) {
        $search_result = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['search']);

        $search = $dbh->prepare("SELECT user_input as input, place_location as location, user_image as image 
        FROM map_pins WHERE place_location ILIKE '%$search_result%' OR user_input ILIKE '%$search_result%'");
        $search->execute();

        $result = $search->fetchAll();

        if ($result) {
            foreach ($result as $output) {
                echo '<div class="search_output">
                    <h3 class="headline_output">' . $output->location . '</h3> 

                    <div class="content_output">
                        <ul>
                           <li>
                              <p>' . $output->input . '</p>
                              <img src="' . $output->image . '" width="380px">
                           </li>
                        </ul>
                    </div>
                    </div>';
            }
        }
        else {
            echo '<div class="search_box">
                <a class="ion-ios-paperplane"></a>
                <form>
                <input type="text" name="search" placeholder="What are you looking for?">
                </form>
            </div>';

            include "footer.php";
        }
}
else
{
    echo '<div class="search_box">
                <a class="ion-ios-paperplane"></a>
                <form>
                <input type="text" name="search" placeholder="What are you looking for?">
                </form>
            </div>';

    include "footer.php";
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */