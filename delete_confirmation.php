<?php
include "header.php";

?>

<h3 class="headline_subscribe" id="headline_unsub">Are you sure you want to delete your account?</h3>
<div class="delete_confirmation">
    <form action="delete_user.php" method="post">
        <button type="submit" name="submit" class="upload_button">YES, I am pretty sure!</button>
    </form>

    <button><a href="user_account.php">NO, it was a mistake!</a></button>
</div>

<?php
include "footer_1.php";

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */