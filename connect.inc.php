<?php
try {
    $connString = "mysql:host=localhost;dbname=popflick";
    $user = "root";
    $pass = "";
    $pdo = new PDO($connString,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die($e->getMessage());
}
