<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <title>BACKPACKERS - SECRET SPOTS</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img_website/logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<main>
    <div class="sidebar">
        <ul>
            <li><a class="ion-home" href="index.php"></a></li>

            <?php
            if(isset($_SESSION['USER']))
            {
                echo '<li><a class="ion-earth" href="upload_img.php"></a></li>';
            }
            ?>

            <li><a class="ion-ios-search-strong" href="search.php"></a></li>


            <?php

            if(isset($_SESSION['USER']))
            {
                echo '<li><a class="ion-ios-lightbulb" href="facts.php"></a></li>
                        <li><a class="ion-android-person" href="user_account.php"></a></li>
                       <li><a class="ion-log-out" href="logout.php"></a></li>';
            }
            else {
                echo '<li><a class="ion-log-in" href="login.php"></a></li>';
            }

            ?>
        </ul>
    </div>


    <?php
/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
