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
    $log_credentials->password = hash('sha256', $_POST["cus_log_pass"]);

    $get_username = $conn->query("SELECT log.usernameID, log.passwordID ,cus.customerID FROM tbl_username usname, tbl_login log, tbl_customer cus
    WHERE usname.usernameID = log.usernameID AND cus.usernameID = usname.usernameID AND usname.username ='$log_credentials->user'");
    $username_validation = $get_username->fetch_assoc();

    $get_contact = $conn->query("SELECT log.usernameID, log.passwordID, cus.customerID FROM tbl_contact con , tbl_user user, tbl_username usrnm, tbl_login log,  tbl_customer cus
    WHERE con.contactID = user.contactID AND user.userID = usrnm.userID AND usrnm.usernameID = log.usernameID AND cus.usernameID = usrnm.usernameID AND con.contact ='$log_credentials->user'");
    $contact_validation = $get_contact->fetch_assoc();
        
    $credential = $username_validation??$contact_validation??null;
    $username_id = $credential['usernameID'] ?? null;
    $pass_id = $credential['passwordID']??null;
    $cus_id = $credential['customerID']??null; 

    if(isset($pass_id) && isset($username_id)){
        $get_pass = $conn->query("SELECT pswd.password FROM tbl_password pswd, tbl_login log WHERE log.passwordID = pswd.passwordID AND log.usernameID = '$username_id' AND pswd.password = '$log_credentials->password'");
        $pass_qry = $get_pass->fetch_assoc();
        

        if (isset($pass_qry["password"]) && !is_null($pass_qry["password"])) {
            if($username_id && $pass_qry['password'] == $log_credentials->password){
                session_start();
                $_SESSION['cus_id'] = $cus_id;
                $_SESSION['user'] = 'customer';
                header('location: ../user_page/home.php');
            }
        }
        else{
            header('location: ../login.php');
        }
     
    }
?>