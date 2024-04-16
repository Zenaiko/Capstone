<?php 
require_once("conn.php");

if(isset($_POST["login"])){

$validityUser = $_POST["userName"];
$vailidityPass = $_POST["userPass"];

$userExistQry = "SELECT * FROM tblUser WHERE phoneNumber = (?) AND pass = (?)";
$checkValidity = $conn->execute_query($userExistQry,([$validityUser , $vailidityPass]));

if ($checkValidity -> num_rows == 1 ){
        header("location: /pages/newsFeed.php");
        echo ("success");
    }
    else{
        echo ("error");
    }

}

?>