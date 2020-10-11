<?php
require_once "header.inc.php";
if ($_GET['state'] == 1) {
    echo "You have successfully logged out. <br>";
    echo "<a href='login.php'>Log in</a>";
}
elseif ($_GET['state'] == 2) {
    echo "Welcome $_SESSION[uname]";
}
else {
    echo "Choose an option from the menu.";
}

require_once "footer.inc.php";