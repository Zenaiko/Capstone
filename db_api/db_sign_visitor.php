<?php 
    require_once('db_root_conn.php');
 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


    class class_visitor_sign_up_database extends class_database{
        private $visitor_info;

        public function __construct(class_visitor_info $info) {
            parent::__construct('root', '');
            $this->visitor_info = $info;
        }

        private function link_tables($contact_id, $person_id, $email_id, $pswd_id){
            $insert_tbl_user = $this->pdo->prepare("INSERT INTO tbl_user (person_id, contact_id,email_id) 
            VALUES (:per_id,:con_id,:em_id)");
            $insert_tbl_user->execute([
                ":con_id" => $contact_id ,
                ":per_id" => $person_id,
                ":em_id" => $email_id,
            ]);
            $user_id = $this->pdo->lastInsertId();

            $insert_tbl_username = $this->pdo->prepare("INSERT INTO tbl_username(user_id, username, date_created, terms_and_acceptance) 
            VALUES (:u_id, :username, :date , :terms)");
            $insert_tbl_username->execute([
                ":u_id" => $user_id,
                ":username" => $this->visitor_info->get_username(),
                ":date" => date('Y-m-d H:i:s'),
                ":terms" => $this->visitor_info->get_terms(),
            ]);
            $username_id = $this->pdo->lastInsertId();

            $insert_tbl_login = $this->pdo->prepare("INSERT INTO tbl_login(username_id, password_id) 
            VALUES (:uname_id, :pass_id)");
            $insert_tbl_login->execute([
                ":uname_id" => $username_id,
                ":pass_id" => $pswd_id
            ]);

            $insert_tbl_customer = $this->pdo->prepare("INSERT INTO tbl_customer (username_id)
            VALUES (:uname_id)");
            $insert_tbl_customer->execute([":uname_id" => $username_id]);
            $customer_id = $this->pdo->lastInsertId();
            
            // Create customer folder
            $asset_dir = "../user_page/user_assets/";
            $cus_dir = $asset_dir . "c" . $customer_id . "_assets_folder";

            if(!is_dir($cus_dir)){
                mkdir($cus_dir);
                $update_cus_dir = $this->pdo->prepare("UPDATE tbl_customer
                SET cus_asset_folder = :dir WHERE customer_id = :cus_id");
                $update_cus_dir->execute([
                    ":dir" => $cus_dir,
                    ":cus_id" => $customer_id]);
            }
        }

        public function sign_up(){
            try{
            $this->query('START TRANSACTION');
            
            $insert_tbl_contact = $this->pdo->prepare("INSERT INTO tbl_contact (contact) VALUES (:contact)");
            $insert_tbl_contact->execute([ ":contact" => $this->visitor_info->get_contact()]);
            $contact_id = $this->pdo->lastInsertId();

            $insert_tbl_person = $this->pdo->prepare("INSERT INTO tbl_person (l_name,f_name, m_name) VALUES (:lname,:mname ,:fname)");
            $insert_tbl_person->execute([ 
                ":lname" => $this->visitor_info->get_lname(),
                ":mname" => $this->visitor_info->get_mname(),
                ":fname" => $this->visitor_info->get_fname()
            ]);
            $person_id = $this->pdo->lastInsertId();

            $insert_tbl_email = $this->pdo->prepare("INSERT INTO tbl_email (email) VALUES (:email)");
            $insert_tbl_email->execute([":email" => $this->visitor_info->get_email()]);
            $email_id = $this->pdo->lastInsertId();

            $insert_tbl_password= $this->pdo->prepare("INSERT INTO tbl_password (password) VALUES (:pass)");
            $insert_tbl_password->execute([":pass" => $this->visitor_info->get_password()]);
            $pswd_id = $this->pdo->lastInsertId();

            $this->link_tables($contact_id, $person_id, $email_id, $pswd_id);
            
            $this->query('COMMIT');

            unset($_SESSION['visitor_sign_num']);
            header('location: ../login.php');
            }
            catch(Exception $error){
                echo "Failed: " . $error->getMessage();
                $this->query('ROLLBACK');
            }
        }



    }

    class class_visitor_info{
        private $contact;
        private $l_name;
        private $m_name;
        private $f_name;
        private $email;
        private $password;
        private $username;
        private $terms_service;

        // Sets the sign up information 
        public function set_contact($contact){
            $this->contact = $contact;
        }

        public function set_lname($l_name){
            $this->l_name = $l_name;
        }

        public function set_mname($m_name){
            $this->m_name = $m_name;
        }

        public function set_fname($f_name){
            $this->f_name = $f_name;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function set_username($username){
            $this->username = $username;
        }

        public function set_terms($terms){
            if($terms !== false ){
                $this->terms_service = true;
            }
        }

        public function set_password($pswd){
            $this->password = $pswd;
        }

        // Gets the information sent
        public function get_contact(){
            return $this->contact;
        }

        public function get_lname(){
            return $this->l_name;
        }

        public function get_mname(){
            return $this->m_name;
        }

        public function get_fname(){
            return $this->f_name ;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_username(){
            return $this->username;
        }

        public function get_terms(){
            return $this->terms_service;
        }

        public function get_password(){
            return $this->password;
        }
    };

    $visitor = new class_visitor_info();
    $visitor_sign_db = new class_visitor_sign_up_database($visitor);

    $visitor->set_contact( $_SESSION['visitor_sign_num']);
    $visitor->set_lname($_POST["lname_sign_up"]);
    $visitor->set_mname($_POST["mname_sign_up"])??null;
    $visitor->set_lname($_POST["fname_sign_up"]);
    $visitor->set_email($_POST["email_sign_up"]);
    $visitor->set_username($_POST["username_sign_up"]);
    $visitor->set_password(hash('sha256' , ($_POST["password_sign_up"])));
    $visitor->set_terms($_POST["terms_conditions_radio"]);

    $visitor_sign_db->sign_up();

    // session_start();
    //     class class_visitor_info{
    //         public $contact;
    //         public $l_name;
    //         public $m_name;
    //         public $f_name;
    //         public $email;
    //         public $password;
    //         public $username;
    //     };

    //     $visitor->contact  = $_SESSION['visitor_sign_num'];
    //     $visitor->l_name = $_POST["lname_sign_up"];
    //     $visitor->m_name  = $_POST["mname_sign_up"];
    //     $visitor->f_name = $_POST["fname_sign_up"];
    //     $visitor->email = $_POST["email_sign_up"];
    //     $visitor->username = $_POST["username_sign_up"];
    //     $visitor->password  = hash('sha256' , ($_POST["password_sign_up"]));

    //     $visitor_sign_contact_qry = ("INSERT INTO tbl_contact (contact) VALUES (?)");
    //     $visitor_sign_person_qry = ("INSERT INTO tbl_person (l_name,f_name, m_name) VALUES (?, ? , ?)");
    //     $visitor_sign_email_qry = ("INSERT INTO tbl_email (email) VALUES (?)");
    //     $visitor_sign_pass_qry = ("INSERT INTO tbl_password (password) VALUES (?)");
        
    //     class class_visitor_id_assign{
    //         public $contact_id;
    //         public $person_id;
    //         public $email_id;
    //         public $pasword_id;
    //         public $user_id;
    //         public $username_id;
    //         public $cus_id;
    //         public $role_id = 1;
    //         public $app_id = 1;
            
    //     };

    //     $visitor_id_assign = new class_visitor_id_assign();

    //     $conn->query("START TRANSACTION");
    //     $insert_contact = $conn->execute_query($visitor_sign_contact_qry, ([$visitor->contact ]));
    //     $visitor_id_assign->contact_id = $conn->insert_id;

    //     $conn->execute_query($visitor_sign_person_qry, ([$visitor->l_name, $visitor->f_name,  $visitor->m_name ]));
    //     $visitor_id_assign->person_id = $conn->insert_id;

    //     $conn->execute_query($visitor_sign_email_qry, ([ $visitor->email]));
    //     $visitor_id_assign->email_id = $conn->insert_id;

    //     $conn->execute_query( $visitor_sign_pass_qry, ([$visitor->password ]));
    //     $visitor_id_assign->pasword_id = $conn->insert_id;

    //     $visitor_sign_user_qry = ("INSERT INTO tbl_user(personID, contactID, emailID) VALUES (?, ?, ?)");
    //     $conn-> execute_query($visitor_sign_user_qry, ([$visitor_id_assign->person_id, $visitor_id_assign->contact_id,  $visitor_id_assign->email_id ]));
    //     $visitor_id_assign->user_id = $conn->insert_id;

    //     $visitor_insert_username_qry = ("INSERT INTO tbl_username(userID, username, status, is_customer, date_created, terms_and_acceptance) VALUES (?, ?, ?, ?,?,?)");
    //     $conn->execute_query($visitor_insert_username_qry, ([$visitor_id_assign->user_id,  $visitor->username , 'active', true, date('Y-m-d H:i:s'), true ]));
    //     $visitor_id_assign->username_id = $conn->insert_id;

    //     $visitor_assign_cus_qry = ("INSERT INTO tbl_customer (usernameID) VALUES (?)");
    //     $conn->execute_query($visitor_assign_cus_qry, ( [$visitor_id_assign->username_id] ));
    //     $visitor_id_assign->cus_id = $conn->insert_id;

    //     $visitor_insert_login_qry = ("INSERT INTO tbl_login(usernameID, passwordID, roleID, appID) VALUES (?, ?, ?, ?)");
    //     $conn-> execute_query($visitor_insert_login_qry, ([$visitor_id_assign->username_id, $visitor_id_assign->pasword_id,  $visitor_id_assign->role_id, $visitor_id_assign->app_id ]));

    //     $cus_asset_dir = '../user_page/user_assets/';
    //     $cus_folder_name =$cus_asset_dir. 'c' . $visitor_id_assign->cus_id . '_assets';
        
    //     $ins_cus_folder = ("UPDATE tbl_customer SET cus_asset_folder = ? WHERE customerID = ?");
    //     $conn->execute_query($ins_cus_folder, ([$cus_folder_name, $visitor_id_assign->cus_id] ));

    //     mkdir($cus_folder_name);

    //     $conn->query("COMMIT");
    //     unset($_SESSION['visitor_sign_num']);
    //     header('location ../login.php');

?>