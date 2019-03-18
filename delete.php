<?php
include "functions.php";

$user = $_SESSION['USER'];
$location = $_POST['delete_location'];

if (isset($_POST['submit'])) {

    $query = $dbh->prepare("SELECT place_location as location 
    FROM map_pins LEFT OUTER JOIN users ON map_pins.user_id = users.user_id WHERE ? = place_location AND ? = users.user_uid");
    $query->execute(
        array(
            $location,
            $user
        )
    );

    $data = $query->fetch();
    $loc = $data->location;

    $delete_content = $dbh->prepare("DELETE FROM map_pins WHERE place_location = ?");
    $delete_content->execute(array($loc));

    header("Location: user_account.php");
    exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */