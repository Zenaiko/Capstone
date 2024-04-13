<?php 

$host = "localhost";
$user = "root";
$pass = "";
$database = "";

$conn = new mysqli($host , $user , $password , $database);

if ($conn->connect_error){
    die("Connection failed, reason: " . $conn->connect_error);
}

?>