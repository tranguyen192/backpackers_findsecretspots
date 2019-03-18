<?php

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['email'])) {
    include 'functions.php';

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: errormessage_subscribe.php');
        exit();
    }
    else {
        $userid_valid = $dbh->prepare("SELECT count(email) FROM newsletter WHERE newsletter.email LIKE ?");
        $userid_valid->execute([$email]);
        $user_check = $userid_valid->fetch();

        if ($user_check->count > 0) {
            header('Location: errormessage_subscribe.php');
            exit();
        }
        else {
            $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/*';
            $token = str_shuffle($token);
            $token = substr($token, 0, 10);

            $user = $dbh->prepare("INSERT INTO newsletter(name, email, isemailconfirmed, token) VALUES (?, ?, ?, ?);");
            $user->execute(
                array(
                    $_POST['name'],
                    $_POST['email'],
                    '0',
                    $token
                )
            );

            include_once "PHPMailer/PHPMailer.php";
            $mail = new PHPMailer(true);
            $mail->setFrom('hnguyen.mmt-b2017@fh-salzburg.ac.at', 'BACKPACKERS - Find Secret Spots');
            $mail->addAddress($email, $name);
            $mail->Subject = "Backpackers - Find Secret Spots: Verify your email!";
            $mail->isHTML(true);
            $mail->Body = "
                Hi $name! <br><br>
                I am so happy to have you on board! There is just one last step to 
                complete before you can start exploring secret spots in Southeast Asia. <br><br> Just click the
                following link to verify your email address:<br><br>
                
                <a href='https://users.multimediatechnology.at/~fhs41218/mmp1/confirm.php?email=$email&token=$token'>Click here</a><br><br>
                
                Happy Backpacking!
                ";

            if ($mail->send()) {
                header('Location: thank_you.php');
            }
            else
            {
                header('Location: errormessage_subscribe.php');
            }

        }
    }
}
else {
    header('Location: index.php');
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
