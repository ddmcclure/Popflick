<?php
require_once "header.php";
if ($_GET['state'] == 1) {
    echo "<p>You have successfully logged out.</p> <br>";
    echo "<p><a href='members.php'>Log in</a></p>";
}
elseif ($_GET['state'] == 2) {
    echo "<p>Welcome $_SESSION[uname]!</p>";
}
else {
    echo "<h1>You are not supposed to be here.</h1>";
}

require_once "footer.php";