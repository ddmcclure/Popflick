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
    <title>Popflick - Employee
    </title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;700&display=swap" rel="stylesheet">
</head>
<header>
    <h1>Popflick - Employee</h1>
</header>
<body>
<div class="topnav">
    <?php
    if (isset($_SESSION['emploginid'])){
      echo ($currentfile == "index.php") ? "<a class='active' href='index.php'>Home</a>" : "<a href='index.php'>Home</a>";
      echo ($currentfile == "purchase.php") ? "<a class='active' href='purchase.php'>Purchase</a>" : "<a href='purchase.php'>Purchase</a>";
      if ($_SESSION['emploginaccess'] == 3){
      echo ($currentfile == "createemployee.php") ? "<a class='active' href='createemployee.php'>Create Employee</a>" : "<a href='createemployee.php'>Create Employee</a>";
      }
      echo($currentfile == "logout.php") ? "<a class='active' href='logout.php'>Logout</a>" : "<a href='logout.php'>Logout</a>";
    } else {
    echo ($currentfile == "index.php") ? "<a class='active' href='index.php'>Home</a>" : "<a href='index.php'>Home</a>";
    echo ($currentfile == "employeelogin.php") ? "<a class='active' href='employeelogin.php'>Login</a>" : "<a href='employeelogin.php'>Login</a>";
    }
    ?>
</div>
