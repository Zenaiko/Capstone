<?php 

$host = "localhost";
$user = "cab_mart_visitor";
$password = "";
$dataBase = "db_cab_mart";

$conn = new mysqli($host , $user , $password , $dataBase);

if ($conn->connect_error){
    die("Connection failed, reason: " . $conn->connect_error);
}

?>