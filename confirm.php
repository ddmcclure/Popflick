<?php
require_once "header.php";
if ($_GET['state'] == 1) {
    echo "You have successfully logged out. <br>";
    echo "<a href='members.php'>Log in</a>";
}
elseif ($_GET['state'] == 2) {
    echo "Welcome $_SESSION[uname]";
}
else {
    echo "<h1>You are not supposed to be here.</h1>";
}

require_once "footer.php";