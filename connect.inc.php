<?php
try {
    $connString = "mysql:host=sql9.freesqldatabase.com;dbname=Popflick";
    $user = "sql9370129";
    $pass = "gbMuJfRQAj"; //normally would hide this information but i don't think it's that important
    $pdo = new PDO($connString,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die($e->getMessage());
}
