<?php 
    require_once('db_cus_login_conn.php');

    class class_log_credentials{
        public $user;
        public $password;
        public $user_id;
        public $username_id;
    }

    $log_credentials = new class_log_credentials;

    $log_credentials->user = $_POST["cus_log_user"];
    $log_credentials->password = $_POST["cus_log_pass"];

    $get_username = $conn->query("SELECT usname.username, log.passwordID FROM tbl_username usname, tbl_login log
    WHERE usname.usernameID = log.usernameID AND usname.username = '$log_credentials->user'");
    
    $get_username = $conn->query("SELECT username FROM tbl_username WHERE username = '$log_credentials->user'");
    $contact = $get_contact->fetch_assoc();
    $username = $get_username->fetch_assoc();
    if(isset($contact) or isset($username)){
        
    }
?>