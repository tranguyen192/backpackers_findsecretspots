<?php
include "functions.php";

$user = $_SESSION['USER'];

if (isset($_POST['submit'])) {

    $query = $dbh->prepare("SELECT user_id from users WHERE user_uid = ?");
    $query->execute([$user]);

    $data = $query->fetch();
    $user_id = $data->user_id;

    $pin = $dbh->prepare("SELECT user_id FROM map_pins WHERE user_id = ?");
    $pin->execute([$user_id]);

    $result = $pin->fetch();
    $id = $result->user_id;

    $delete_pin = $dbh->prepare("DELETE FROM map_pins WHERE user_id=?");
    $delete_pin->execute(array($id));

    $delete_content = $dbh->prepare("DELETE FROM users WHERE user_id=?");
    $delete_content->execute(array($user_id));

    header("Location: logout.php");
    exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */