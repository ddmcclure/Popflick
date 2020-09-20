<?php
$filename = basename($_SERVER['PHP_SELF']);
?>
<div class="topnav">
    <?php
    echo ($filename == "index.php") ? "<a class='active' href='index.php'>Home</a>" : "<a href='index.php'>Home</a>";
    echo ($filename == "catalog.php") ? "<a class='active' href='catalog.php'>Catalog</a>" : "<a href='catalog.php'>Catalog</a>";
    echo ($filename == "members.php") ? "<a class='active' href='members.php'>Members</a>" : "<a href='members.php'>Member</a>";
    echo ($filename == "storeinfo.php") ? "<a class='active' href='members.php'>About Us</a>" : "<a href='storeinfo.php'>About us</a>";
    echo ($filename == "contact.php") ? "<a class='active' href='contact.php'>Contact</a>" : "<a href='contact.php'>Contact Us</a>";
    ?>
</div>
