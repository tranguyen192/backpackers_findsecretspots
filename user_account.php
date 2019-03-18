<?php
include "functions.php";
include "header.php";

$user_acc = $_SESSION['USER'];

$current_id = $dbh->prepare("SELECT user_firstname, user_lastname from users WHERE user_uid = ?");
$current_id->execute(array($user_acc));
$id = $current_id->fetch();

$firstname = $id->user_firstname;
$lastname = $id->user_lastname;

?>

<div class="user_account">
    <div class="user_details">
        <h1> Hi <?php echo $firstname . " " . $lastname; ?>
            <form action='edit_userinfo.php' method='post'>
                <button type='submit' name='submit' class='upload_button'><a class='ion-paintbrush' style='color: #bc8f8f; font-size: 1em'></a></button>
            </form>
        </h1>

        <div class="personal_data">
            <h2> EDIT YOUR PINS IN YOUR MAP</h2>
        </div>

        <div class="visa">
            <a class="ion-ios-body-outline" href="visa_requirements.php"> visa requirements </a>
        </div>

        <h2 class="headline_bucketlist">CREATE YOUR BUCKETLIST</h2>

        <div class="todo_input">
            <input type="text" placeholder="Your next destination will be..." id="item">
            <button id="add" class="ion-android-add"></button>
        </div>

        <div class="container">
            <ul class="todo" id="todo"></ul>
            <ul class="todo" id="completed"></ul>
        </div>
    </div>

    <div class="map_pos_acc">
    <?php
        include "user_map.php";
    ?>
    </div>

</div>

    <script src="js/todoList.js"></script>

<!--
Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
-->


