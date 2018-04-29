<?php

function connectToDB($dbName) {
    //$host = 'localhost';
    $db   =  $dbName;
    //$user = 'root';
    //$pass = '';
    $charset = 'utf8mb4';
    
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $user = "bf8752d16fa867";
    $pass = "dc52894c";
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo; 
}



?>