<?php
include "functions.php";

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);

if (isset($_POST['submit'])) {

    $user_data = $dbh->prepare("SELECT email from newsletter WHERE email = ? AND name = ?");
    $user_data->execute(
        array(
            $email,
            $name
        )
    );
    $data_result = $user_data->fetch();

    $email = $data_result->email;

    if ($email) {
        $delete_content = $dbh->prepare("DELETE FROM newsletter WHERE email = ?");
        $delete_content->execute(array($email));

        header("Location: unsubscribe_success.php");
        exit();
    }
    else {
        header("Location: index.php"); // nothing to unsubscribe
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */