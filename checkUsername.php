<?php

include 'dbConnection.php';

$conn = connectToDB("heroku_96be87d910b5efe");

$username = $_GET['username'];

//next query allows SQL Injection!
//$sql = "SELECT * FROM lab8_user WHERE username = '$username' ";
$sql = "SELECT * FROM lab8_user WHERE username = :username ";


$stmt = $conn->prepare($sql);
$stmt->execute( array(":username"=> $username ));
$record = $stmt->fetch(PDO::FETCH_ASSOC);

//print_r($record);

echo json_encode($record);

?>