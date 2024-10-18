<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    unset($_SESSION["user"]);
    unset($_SESSION["cus_id"]);
    session_destroy();

    header("location: ../")

?>