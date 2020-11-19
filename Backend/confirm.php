<?php
require_once "backheader.php";
if ($_GET['state'] == 1) {
    echo"<br><br>";
    echo "<center><div class=smallloginblock><p>You have successfully logged out.</p> <br>";
    echo "<p><a href='employeelogin.php'>Log in</a></p></div></center>";
}
elseif ($_GET['state'] == 2) {
    echo "<center><p>Welcome, $_SESSION[emploginname]!</p></center>";
    echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

}

else {
  echo "<h1>You are not supposed to be here.</h1>";
}

require_once "footer.php";
