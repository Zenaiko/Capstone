<?php 

$host = "localhost";
$user = "root";
$pass = "";
$database = "capstoneProto";

$conn = new mysqli($host , $user , $pass , $database);

if ($conn->connect_error){
    die("Connection failed, reason: " . $conn->connect_error);
}

?>