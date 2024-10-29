<?php 
require_once('db_insert_username.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;

class customer_sign_up_database extends classs_username_database{
 
    public function __construct(class_username_info $customer_info){
        // Createas class username info
        parent::__construct($customer_info);
    }

    public function insert_customer(){
        $this->query("START TRANSACTION");
        $username_id = $this->insert_username();
        try{
            $insert_tbl_customer = $this->pdo->prepare("INSERT INTO tbl_customer (username_id)
            VALUES (:username_id)");
            $insert_tbl_customer->execute([":username_id" => $username_id]);
            $customer_id = $this->pdo->lastInsertId();

            // Create a folder for the customer
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
            $this->query("COMMIT");
            $_SESSION["form_success"] = "success";
            unset($_SESSION["visitor_sign_num"]);
            header('location: ../login.php');
        }
        catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            $_SESSION["form_success"] = "error";
        }
    }
}

// Creates instances for each database classes
$customer_info = new class_username_info();
$customer_sign_up_db = new customer_sign_up_database($customer_info);

// Data assign
$customer_info->set_contact($_SESSION['visitor_sign_num']);
$customer_info->set_lname($_POST["lname_sign_up"]);
$customer_info->set_mname($_POST["mname_sign_up"])??null;
$customer_info->set_fname($_POST["fname_sign_up"]);
$customer_info->set_email($_POST["email_sign_up"]);
$customer_info->set_username($_POST["username_sign_up"]);
$customer_info->set_password(hash('sha256' , ($_POST["password_sign_up"])));
$customer_info->set_condition($_POST["terms_conditions_radio"]);

// Start the transaction
$customer_sign_up_db->insert_customer();
?>