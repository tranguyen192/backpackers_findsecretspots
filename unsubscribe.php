<?php
include "functions.php";

$user_acc = $_SESSION['USER'];

if (isset($_SESSION['USER'])) {

    $user_data = $dbh->prepare("SELECT user_email from users WHERE user_uid = ?");
    $user_data->execute([$user_acc]);
    $data_result = $user_data->fetch();

    $email = $data_result->user_email;

    $checkmail = $dbh->prepare("SELECT COUNT(name) FROM newsletter WHERE email = ?");
    $checkmail->execute([$email]);
    $unsub = $checkmail->fetch();

    if ($unsub->count > 0) {
        $delete_content = $dbh->prepare("DELETE FROM newsletter WHERE email = ?");
        $delete_content->execute(array($email));

        header("Location: unsubscribe_success.php");
        include "footer_1.php";
        exit();
    }
    else {
        header("Location: subscribe_delete.php");
        exit();
    }
}
else {
    header("Location: subscribe_delete.php");
    exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */


