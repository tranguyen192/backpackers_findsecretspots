<?php

include "functions.php";

if (isset($_POST['submit'])) {

    $uid = htmlspecialchars($_POST['username_login']);
    $pwd = htmlspecialchars($_POST['password']);

    $user_data = $dbh->prepare("SELECT count(user_uid), users.user_uid, users.user_pwd FROM users WHERE user_uid = ? GROUP BY users.user_pwd, users.user_uid");
    $user_data->execute([$uid]);
    $stm = $user_data->fetch();

    if (strlen($stm->count) < 1) {
        header("Location: wrong_password.php");
        exit();

    } else {

        $hashedPassword = password_verify($pwd, $stm->user_pwd);

        if ($hashedPassword === false) {
            header("Location: wrong_password.php");
            exit();
        } elseif ($hashedPassword === true) {

            // Login the user
            $_SESSION['USER_ID'] = $stm->user_id;
            $_SESSION['USER_first'] = $stm->user_firstname;
            $_SESSION['USER_last'] = $stm->user_lastname;
            $_SESSION['USER'] = $stm->user_uid;

            header("Location: user_account.php");
            exit();
        }
    }
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */