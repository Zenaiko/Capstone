<?php 
    require_once('db_root_conn.php');

    class class_login_database extends class_database{
        private $login_form;
        public function __construct(class_log_credentials $creds)
        {
            parent::__construct('cab_mart_cus_login' , '');
            $this->login_form = $creds;
        }

        public function cus_login(){
            $get_login = $this->query("SELECT cus.customerID
            FROM tbl_contact con, tbl_user user, tbl_username username, tbl_login log, tbl_password pswd, tbl_customer cus
            WHERE con.contactID = user.contactID AND user.userID = username.userID 
            AND username.usernameID = log.usernameID AND log.passwordID = pswd.passwordID 
            AND cus.usernameID = username.usernameID AND (username.username = :credentials OR con.contact = :credentials 
            AND pswd.password = :pswd)" ,[
            ':credentials' => $this->login_form->get_credentials(), 
            ':pswd' => $this->login_form->get_password()
            ]);
            $this->login_form->set_cus_id($get_login->fetchAll(PDO::FETCH_ASSOC)[0]['customerID']);
            if(!empty($this->login_form->get_cus_id())){
                session_start();
                $_SESSION['cus_id'] = $this->login_form->get_cus_id();
                $_SESSION['user'] = 'customer';
                header('location: ../user_page/home.php');   
            }else{
                header('location: ../login.php');
            }
        }
    }

    class class_log_credentials{
        private $credentials;
        private $password;
        private $customer_id;

        // Sets the inputed credentials
        public function set_credentials($credentials){
            $this->credentials = $credentials;
        }

        public function set_password($pswd){
            $this->password = $pswd;
        }

        public function set_cus_id($cus_id){
            $this->customer_id = $cus_id;
        }

        // Gets the inputed credentials
        public function get_credentials(){
            return $this->credentials;
        }

        public function get_password(){
            return $this->password;
        }

        public function get_cus_id(){
            return $this->customer_id;
        }
    }

    $log_credentials = new class_log_credentials;
    $login_db = new class_login_database($log_credentials);

    $log_credentials->set_credentials( $_POST["cus_log_user"]);
    $log_credentials->set_password(hash('sha256', $_POST["cus_log_pass"]));

    $login_db->cus_login();

    // $log_credentials->user = $_POST["cus_log_user"];
    // $log_credentials->password = hash('sha256', $_POST["cus_log_pass"]);

    // $get_username = $conn->query("SELECT log.usernameID, log.passwordID ,cus.customerID FROM tbl_username usname, tbl_login log, tbl_customer cus
    // WHERE usname.usernameID = log.usernameID AND cus.usernameID = usname.usernameID AND usname.username ='$log_credentials->user'");
    // $username_validation = $get_username->fetch_assoc();

    // $get_contact = $conn->query("SELECT log.usernameID, log.passwordID, cus.customerID FROM tbl_contact con , tbl_user user, tbl_username usrnm, tbl_login log,  tbl_customer cus
    // WHERE con.contactID = user.contactID AND user.userID = usrnm.userID AND usrnm.usernameID = log.usernameID AND cus.usernameID = usrnm.usernameID AND con.contact ='$log_credentials->user'");
    // $contact_validation = $get_contact->fetch_assoc();
        
    // $credential = $username_validation??$contact_validation??null;
    // $username_id = $credential['usernameID'] ?? null;
    // $pass_id = $credential['passwordID']??null;
    // $cus_id = $credential['customerID']??null; 

    // if(isset($pass_id) && isset($username_id)){
    //     $get_pass = $conn->query("SELECT pswd.password FROM tbl_password pswd, tbl_login log WHERE log.passwordID = pswd.passwordID AND log.usernameID = '$username_id' AND pswd.password = '$log_credentials->password'");
    //     $pass_qry = $get_pass->fetch_assoc();
        

    //     if (isset($pass_qry["password"]) && !is_null($pass_qry["password"])) {
    //         if($username_id && $pass_qry['password'] == $log_credentials->password){
    //             session_start();
    //             $_SESSION['cus_id'] = $cus_id;
    //             $_SESSION['user'] = 'customer';
    //             header('location: ../user_page/home.php');
    //         }
    //     }
    //     else{
    //         header('location: ../login.php');
    //     }
     
    // }
?>