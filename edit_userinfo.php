<?php
include "functions.php";
include "header.php";

$user = $_SESSION['USER'];

$user_data = $dbh->prepare("SELECT user_id from users WHERE user_uid = ?");
$user_data->execute(array($user));

$data_result = $user_data->fetch();
$id = $data_result->user_id;

if (isset($_POST['submit'])) {

    $user_data = $dbh->prepare("SELECT user_firstname, user_lastname, user_email, user_uid from users WHERE user_uid = ?");
    $user_data->execute([$user]);

    $data_result = $user_data->fetchAll();

    $user_pins = $dbh->prepare("SELECT user_id FROM map_pins WHERE user_id = ?");
    $user_pins->execute([$id]);

    $result = $user_pins->fetch();

    if ($data_result) {
        foreach ($data_result as $output) {
            $firstname = htmlspecialchars($output->user_firstname);
            $lastname = htmlspecialchars($output->user_lastname);
            $email = htmlspecialchars($output->user_email);
            $uid = htmlspecialchars($output->user_uid);

            echo '<div class="search_output">
                    <h3 class="headline_output"> EDIT YOUR PROFILE </h3> 
                    <div class="content_output">
                    <ul>
                        <li>
                            <p>
                            After changing your profile data, you have to log in once again.
                            <div class="delete_edit_buttons" id="user_edit">
                                <form action="user_edit_profile.php" method="post">
                                    <input type="text" name="user_firstname" value="'.$firstname.'" required>
                                    <input type="text" name="user_lastname" value="'.$lastname.'" required>
                                    <input type="text" name="user_email" value="'.$email.'" required>
                                    <input type="text" name="user_uid" value="'.$uid.'" required>
                                    <button type="submit" name="submit" id="edit_button" class="upload_button">SAVE</button>
                                </form>
                                            
                                <form action="delete_confirmation.php" method="post">
                                    <button type="submit" name="submit" id="edit_button" class="upload_button">DELETE</button>
                                </form>
                            </div>
                            </p>
                        </li>
                    </ul>
                    </div>
                </div>';
        }
    }
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */


