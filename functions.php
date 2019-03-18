<?php
    session_start();
    ini_set('display_errors', true);

    $pagetitle = "No pagetitle insert";

    include "config.php";

    if( ! $DB_NAME ) die('please create config.php, define $DB_NAME, $DSN, $DB_USER, $DB_PASS there');

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    } catch (Exception $e) {
        die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
    }

/*
* Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
*/
