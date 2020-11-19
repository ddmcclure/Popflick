<?php
require_once "header.php";
if ($_GET['state'] == 1) {
    echo"<br><br>";
    echo "<center><div class=smallloginblock><p>You have successfully logged out.</p> <br>";
    echo "<p><a href='members.php'>Log in</a></p></div></center>";
    echo"<br><br><br><br><br><br><br><br><br><br>";

}
elseif ($_GET['state'] == 2) {
    echo "<center><p>Welcome $_SESSION[uname]!</p></center>";
    echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

}
else {
    echo "<h1>You are not supposed to be here.</h1>";
}
echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
require_once "footer.php";
