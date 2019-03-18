<?php
include "functions.php";
include "header.php";

?>

<h3 class="headline_subscribe" id="headline_unsub">unsubscribe from newsletter</h3>
<div class="subscribe" id="unsubscribe">
    <form action="unsubscribe_email.php" method="POST">
        <input type="text" name="name" id="email" placeholder="Your name..." required>
        <input type="text" name="email" id="email" placeholder="Your e-mail address..." required>
        <input id="submit_subscribe" type="submit" name="submit" value="I am out!">
    </form>
</div>

<?php
include "footer_1.php";

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */