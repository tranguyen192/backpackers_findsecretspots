<?php

session_start();
session_unset();
session_destroy();

header("Location: index.php");
exit();

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */

