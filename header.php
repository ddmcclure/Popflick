<?php
session_start();
$currentfile = basename($_SERVER['PHP_SELF']);
$currenttime = time();

error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set('date.timezone', 'America/New_York');
date_default_timezone_set('America/New_York');

require_once "connect.inc.php";
require_once "functions.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Popflick - Home
    </title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;700&display=swap" rel="stylesheet">
</head>
<header>
    <h1>Popflick</h1>
</header>
<body>
<div class="topnav">
    <?php
    echo ($currentfile == "index.php") ? "<a class='active' href='index.php'>Home</a>" : "<a href='index.php'>Home</a>";
    echo ($currentfile == "catalog.php") ? "<a class='active' href='catalog.php'>Catalog</a>" : "<a href='catalog.php'>Catalog</a>";
    echo ($currentfile == "members.php") ? "<a class='active' href='members.php'>Members</a>" : "<a href='members.php'>Members</a>";
    if (isset($_SESSION['ID'])) {
        echo($currentfile == "rewards.php") ? "<a class='active' href='rewards.php'>Rewards</a>" : "<a href='rewards.php'>Rewards</a>";
    }
    echo ($currentfile == "storeinfo.php") ? "<a class='active' href='members.php'>About Us</a>" : "<a href='storeinfo.php'>About us</a>";
    echo ($currentfile == "contact.php") ? "<a class='active' href='contact.php'>Contact Us</a>" : "<a href='contact.php'>Contact Us</a>";
    if (isset($_SESSION['ID'])) {
        echo($currentfile == "logout.php") ? "<a class='active' href='logout.php'>Logout</a>" : "<a href='logout.php'>Logout</a>";
    }
    ?>
</div>
