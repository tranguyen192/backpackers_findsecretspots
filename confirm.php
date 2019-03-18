<?php
include 'functions.php';

if(!isset($_GET['email']) || !isset($_GET['token'])) {
    header('Location: index.php');
}
else {
    $email = htmlspecialchars($_GET['email']);
    $token = htmlspecialchars($_GET['token']);

    $userid_valid = $dbh->prepare("SELECT count(id) FROM newsletter WHERE email = ? AND token = ? AND isemailconfirmed = ?");
    $userid_valid->execute(
        array(
            $email,
            $token,
            '0'
        )
    );
    $user_check = $userid_valid->fetch();

    if ($user_check->count > 0) {
        $update = $dbh->prepare("UPDATE newsletter SET isemailconfirmed = ?, token = ? WHERE email = ?");
        $update->execute(
            array(
                '1',
                '',
                $email
            )
        );

        header('Location: email_verify.php');
        exit();
    }
    else {
        header('Location: index.php');
    }
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */