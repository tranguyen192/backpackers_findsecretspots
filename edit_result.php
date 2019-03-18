<?php
    include "functions.php";

if (isset($_POST['submit'])) {
    $new = $dbh->prepare("UPDATE map_pins SET user_input = ?");

    $update_ok = $new->execute(
        array(
            $_POST['user_input']
        )
    );

    header("Location: user_account.php");
    exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */