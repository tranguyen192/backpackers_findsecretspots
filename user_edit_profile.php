<?php
include "functions.php";

$user = $_SESSION['USER'];

$user_data = $dbh->prepare("SELECT user_id from users WHERE user_uid = ?");
$user_data->execute([$user]);

$data_result = $user_data->fetch();
$id = $data_result->user_id;

if (isset($_POST['submit'])) {

    if (isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_uid']) && isset($_POST['user_email'])) {

        $email = htmlspecialchars($_POST['user_email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: errormessage_subscribe.php');
            exit();
        }
        else {
            $uid = $_POST['user_uid'];
            if (!preg_match("/^[a-zA-Z]*$/", $uid)) {
                header("Location: errormessage_useredit.php");
                exit();
            }

            $new = $dbh->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_email = ?, user_uid = ? WHERE user_id = ?");

            $update_ok = $new->execute(
                array(
                    htmlspecialchars($_POST['user_firstname']),
                    htmlspecialchars($_POST['user_lastname']),
                    $email,
                    htmlspecialchars($_POST['user_uid']),
                    $id
                )
            );
            $_SESSION['USER'] = $_POST['user_uid'];

            header("Location: user_account.php");
            exit();
        }
    }
}
else {
    header("Location: user_account.php");
    exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */