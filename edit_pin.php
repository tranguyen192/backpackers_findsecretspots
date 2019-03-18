<?php
include "functions.php";
include "header.php";

$user = $_SESSION['USER'];
$location = $_POST['location'];

if (isset($_POST['submit'])) {

    $query = $dbh->prepare("SELECT place_location as location, user_input as content FROM map_pins
    LEFT OUTER JOIN users ON map_pins.user_id = users.user_id WHERE ? = place_location AND ? = users.user_uid");

    $query->execute(
        array(
            $location,
            $user
        )
    );
    $data = $query->fetchAll();
}

if ($location) {
    foreach ($data as $output) {
        $checked = htmlspecialchars($output->content);

        echo '<div class="search_output">
            <h3 class="headline_output">' . $output->location . '</h3> 
                <div class="content_output">
                    <ul>
                        <li>
                            <p>
                            <div class="delete_edit_buttons">
                                <form action="edit_result.php" method="post">
                                <textarea name="user_input" class="textarea_edit" cols="95" rows="15">'.$checked.'</textarea>
                                <button type="submit" name="submit" id="edit_button" class="upload_button">SAVE</button>
                                </form>
                                
                                <form action="delete.php" method="post">
                                <input type="hidden" name="delete_location" value="'.$location.'">
                                <button type="submit" name="submit" id="edit_button" class="upload_button">DELETE</button>
                                </form>
                            </div>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>';
    }
}

include "footer_1.php";

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
