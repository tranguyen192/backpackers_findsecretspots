<?php
    include "functions.php";
    include "header.php";
?>

<div class="signup_box">
    <h1> CREATE AN ACCOUNT </h1>

    <form action="signup_func.php" method="post">
        <label>Firstname</label>
        <input type="text" name="firstname" required>
        <label>Lastname</label>
        <input type="text" name="lastname" required>
        <label>Username</label>
        <input type="text" name="uid" required>
        <label>Password</label>
        <input type="password" name="pwd" required>
        <input type="text" name="email" placeholder="Enter e-mail address: hello@me.com" required>
        <button type="submit" name="submit">SIGN UP</button>
    </form>
</div>

<?php
include "footer.php";
?>

<!--
* Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
-->
