<?php 
require_once("../db_api/db_insert_username.php");

class class_rider_database extends classs_username_database{
    public function __construct(class_username_info $customer_info){
        // Createas class username info
        parent::__construct($customer_info);
    }

    public function sign_up_rider(){
        $this->query("START TRANSACTION");
        try{
            $insert_employee_registration = $this->pdo->prepare("INSERT INTO tbl_employee_registration ");
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            return null;
        }
    }
}

class rider_registration_info{
    // Rider relevant requirements
    private $nbi_police;
    private $brngy_clearance;
    private $selife;
    private $signature;
    private $drug_test;
    private $licesce_number;
    private $licesce_photo;

    // Other informations that can be sepearated by class if needed
    // Vehicle information
    // private $=;
    // private $=;
    // private $=;
    // private $=;

}


?>