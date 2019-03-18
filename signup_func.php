<?php

if (isset($_POST['submit'])) {

  include 'functions.php';
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $uid = htmlspecialchars($_POST['uid']);
  $pwd = htmlspecialchars($_POST['pwd']);

  if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname) || !preg_match("/^[a-zA-Z]*$/", $uid)) {
      header('Location: errormessage_subscribe.php');
      exit();

  } else {
      // Check if email is invalid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          header('Location: errormessage_subscribe.php');
          exit();

      } else {
          $userid_valid = $dbh->prepare("SELECT count(user_uid) FROM users WHERE user_uid LIKE ?");
          $userid_valid->execute([$uid]);

          $user_check = $userid_valid->fetch();
          $num = $user_check->count;

          if ($num > 0) {
              header('Location: errormessage_subscribe.php');
              exit();
          }
          else {
              $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
              // Insert the user into the database
              $user_insert = $dbh->prepare("INSERT INTO users(user_firstname, user_lastname, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);");
              $user_insert->execute(
                  array(
                      $_POST['firstname'],
                      $_POST['lastname'],
                      $_POST['email'],
                      $_POST['uid'],
                      $hashedPwd
                  )
              );

              $_SESSION['USER'] = $uid;
              header("Location: user_account.php");
              exit();
          }
      }
  }
} else {
  header("Location: signup.php");
  exit();
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
