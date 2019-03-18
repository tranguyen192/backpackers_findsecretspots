<?php

if ($_SERVER['HTTP_HOST'] == 'users.multimediatechnology.at') {
    $DB_NAME = "fhs41218_mmp1";
    $DB_USER = "fhs41218";
    $DB_PASS = "";  // fill in password here!!
    $DSN     = "pgsql:dbname=$DB_NAME;host=users.multimediatechnology.at";
} else {
    $DB_NAME = "fhs41218_mmp1";
    $DB_USER = ""; // fill in your local db-username here!!
    $DB_PASS = ""; // fill in password here!!
    $DSN     = "pgsql:dbname=$DB_NAME;host=users.multimediatechnology.at";
}


/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */
