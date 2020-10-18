<?php
try {
    $connString = "mysql:host=localhost;dbname=popflick";
    $user = "root";
    $pass = ""; //normally would hide this information but i don't think it's that important
    $pdo = new PDO($connString,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die($e->getMessage());
}
