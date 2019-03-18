<?php
    include "functions.php";
    include "header.php";
?>

<div class="login_box">
    <h1> LOGIN </h1>

    <form action="login_func.php" method="post">
        <p>Username:</p>
        <input type="text" name="username_login" placeholder="Enter your username" required>
        <p>Passwort:</p>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="submit" name="submit" value="LET'S START">

        <a class="signup" href="signup.php">Create a new account</a>
    </form>
</div>

<?php
include "footer.php";


/*
* Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
*/