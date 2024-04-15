<?php 
require_once("conn.php");

$topMarketQry = "SELECT * FROM tblMarket";
$getTopMarket = $conn->execute_query($topMarketQry); 


?>