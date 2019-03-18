<?php

if (isset($_POST['submit'])) {
    include 'functions.php';

    $current_user = $_SESSION['USER'];

    $current_id = $dbh->prepare("SELECT user_id from users WHERE user_uid = ?");
    $current_id->execute([$current_user]);
    $id = $current_id->fetch();

    $file = $_FILES['file'];

    $lat=$_POST['lat'];
    $lng=$_POST['lng'];
    $location=$_POST['location'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG');

    if (in_array($fileActualExt, $allowed)) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true).'.'.$fileActualExt;

                $fileDestination = "img_uploads/".$fileNameNew;
                $upload = move_uploaded_file($fileTmpName, $fileDestination);

                if ($upload) {
                    $content = htmlspecialchars($_POST['text']);

                    if(!($lat === '' || $lng === '' || $location === '')) {
                        $user_input = $dbh->prepare("INSERT INTO map_pins(user_input, user_image, place_lat, place_lng, place_location, user_id) VALUES (?, ?, ?, ?, ?, ?);");
                        $user_input->execute(
                            array(
                                $content,
                                $fileDestination,
                                $lat,
                                $lng,
                                $location,
                                $id->user_id
                            )
                        );

                        header("Location: upload_img.php");
                        exit();
                    }
                    else
                    {
                        header("Location: error_message.php");
                        exit();
                    }
                }
                else {
                    header("Location: error_message.php");
                    exit();
                }
            }
            else {
                header("Location: error_message.php");
                exit();
            }
        }
        else {
            header("Location: error_message.php");
            exit();
        }
    }
    else {
        header("Location: error_message.php");
        exit();
    }


/*
* Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
*/






