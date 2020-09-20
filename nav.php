<?php
?>
<div class="topnav">
    <?php
    echo (basename(PHP_SELF) == "index.php") ? "<a class='active' href='index.php'>Home</a>" : "<a href='index.php'>Home</a>";
    echo (basename(PHP_SELF) == "catalog.php") ? "<a class='active' href='catalog.php'>Catalog</a>" : "<a href='catalog.php'>Catalog</a>";
    echo (basename(PHP_SELF) == "members.php") ? "<a class='active' href='members.php'>Members</a>" : "<a href='members.php'>Member</a>";
    echo (basename(PHP_SELF) == "storeinfo.php") ? "<a class='active' href='members.php'>About Us</a>" : "<a href='storeinfo.php'>About us</a>";
    echo (basename(PHP_SELF) == "contact.php") ? "<a class='active' href='contact.php'>Contact</a>" : "<a href='contact.php'>Contact Us</a>";
    ?>
</div>
