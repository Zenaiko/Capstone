<?php 
    $visitor_pass = $_POST["password_sign_up"];
    $visitor_pass_conf = $_POST["password_conform_sign_up"];
    if($visitor_pass == $visitor_pass_conf){
        require_once('db_visitor_sign_up_conn.php');
        session_start();
        class class_visitor_info{
            public $contact;
            public $l_name;
            public $m_name;
            public $f_name;
            public $email;
            public $password;
            public $username;
        };
        $visitor = new class_visitor_info();

        $visitor->contact  = $_SESSION['visitor_sign_num'];
        $visitor->l_name = $_POST["lname_sign_up"];
        $visitor->m_name  = $_POST["mname_sign_up"];
        $visitor->f_name = $_POST["fname_sign_up"];
        $visitor->email = $_POST["email_sign_up"];
        $visitor->username = $_POST["username_sign_up"];
        $visitor->password  = hash('sha256' , ($_POST["password_sign_up"]));

        $visitor_sign_contact_qry = ("INSERT INTO tbl_contact (contact) VALUES (?)");
        $visitor_sign_person_qry = ("INSERT INTO tbl_person (l_name,f_name, m_name) VALUES (?, ? , ?)");
        $visitor_sign_email_qry = ("INSERT INTO tbl_email (email) VALUES (?)");
        $visitor_sign_pass_qry = ("INSERT INTO tbl_password (password) VALUES (?)");
        
        class class_visitor_id_assign{
            public $contact_id;
            public $person_id;
            public $email_id;
            public $pasword_id;
            public $user_id;
            public $username_id;
            public $cus_id;
            public $role_id = 1;
            public $app_id = 1;
            
        };

        $visitor_id_assign = new class_visitor_id_assign();

        $conn->query("START TRANSACTION");
        $insert_contact = $conn->execute_query($visitor_sign_contact_qry, ([$visitor->contact ]));
        $visitor_id_assign->contact_id = $conn->insert_id;

        $conn->execute_query($visitor_sign_person_qry, ([$visitor->l_name, $visitor->f_name,  $visitor->m_name ]));
        $visitor_id_assign->person_id = $conn->insert_id;

        $conn->execute_query($visitor_sign_email_qry, ([ $visitor->email]));
        $visitor_id_assign->email_id = $conn->insert_id;

        $conn->execute_query( $visitor_sign_pass_qry, ([$visitor->password ]));
        $visitor_id_assign->pasword_id = $conn->insert_id;

        $visitor_sign_user_qry = ("INSERT INTO tbl_user(personID, contactID, emailID) VALUES (?, ?, ?)");
        $conn-> execute_query($visitor_sign_user_qry, ([$visitor_id_assign->person_id, $visitor_id_assign->contact_id,  $visitor_id_assign->email_id ]));
        $visitor_id_assign->user_id = $conn->insert_id;

        $visitor_insert_username_qry = ("INSERT INTO tbl_username(userID, username, status, is_customer, date_created, terms_and_acceptance) VALUES (?, ?, ?, ?,?,?)");
        $conn->execute_query($visitor_insert_username_qry, ([$visitor_id_assign->user_id,  $visitor->username , 'active', true, date('Y-m-d H:i:s'), true ]));
        $visitor_id_assign->username_id = $conn->insert_id;

        $visitor_assign_cus_qry = ("INSERT INTO tbl_customer (usernameID) VALUES (?)");
        $conn->execute_query($visitor_assign_cus_qry, ( [$visitor_id_assign->username_id] ));
        $visitor_id_assign->cus_id = $conn->insert_id;

        $visitor_insert_login_qry = ("INSERT INTO tbl_login(usernameID, passwordID, roleID, appID) VALUES (?, ?, ?, ?)");
        $conn-> execute_query($visitor_insert_login_qry, ([$visitor_id_assign->username_id, $visitor_id_assign->pasword_id,  $visitor_id_assign->role_id, $visitor_id_assign->app_id ]));

        $cus_asset_dir = '../user_page/user_assets/';
        $cus_folder_name =$cus_asset_dir. 'c' . $visitor_id_assign->cus_id . '_assets';
        
        $ins_cus_folder = ("UPDATE tbl_customer SET cus_asset_folder = ? WHERE customerID = ?");
        $conn->execute_query($ins_cus_folder, ([$cus_folder_name, $visitor_id_assign->cus_id] ));

        mkdir($cus_folder_name);

        $conn->query("COMMIT");
        header('location ../login.php');
    }   

?>