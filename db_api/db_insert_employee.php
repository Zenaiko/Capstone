<?php 
require_once('db_insert_username.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once("../db_api/db_insert_username.php");

class class_employee_database extends class_username_database{
    private $employee;
    public function __construct(class_username_info $employee_info, class_employee_info $employee){
        // Createas class username info
        parent::__construct($employee_info);
        $this->employee = $employee;
    }

    public function insert_employee(){
        $this->query("START TRANSACTION");
        $username_id = $this->insert_username();
        try{
            $insert_employee_registration = $this->pdo->prepare("INSERT INTO tbl_employee_registration 
            (username_id, nbi_police_clearance, brngy_clearance, valid_id, valid_id_type, registrator_selfie, registrator_e_signature,is_manager, date_registered)
            VALUES (:username_id, :nbi_police, :brngy_clearance, :valid_id, :id_type, :selfie, :signature, :is_manager, :date_registrered)");

            $insert_employee_registration->execute([
                ":username_id" => $username_id,
                ":nbi_police" => $this->employee->get_nbi_police(),
                ":brngy_clearance" => $this->employee->get_brngy_clearance(), 
                ":valid_id" => $this->employee->get_valid_id(), 
                ":id_type" => $this->employee->get_id_type(), 
                ":selfie" => $this->employee->get_selife(), 
                ":signature" => $this->employee->get_signature(), 
                ":is_manager" => $this->employee->get_is_manager(), 
                ":date_registrered" => date("Y-m-d H:i:s"),
            ]);
        $employee_id =  $this->pdo->lastInsertId();
        $this->query("COMMIT");
        return $employee_id;
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            return null;
        }
    }
}

class class_employee_info{
    private $nbi_police;
    private $brngy_clearance;
    private $valid_id;
    private $id_type;
    private $selife;
    private $signature;
    private $is_manager;

    public function set_nbi_police($nbi_police) {
        $this->nbi_police = $nbi_police;
    }
    
    public function get_nbi_police() {
        return $this->nbi_police;
    }
    
    public function set_brngy_clearance($brngy_clearance) {
        $this->brngy_clearance = $brngy_clearance;
    }
    
    public function get_brngy_clearance() {
        return $this->brngy_clearance;
    }

    public function set_valid_id($valid_id){
        $this->valid_id = $valid_id;
    }
    
    public function get_valid_id(){
        return $this->valid_id;
    }
    
    public function set_id_type ($id_type ){
        $this->id_type  = $id_type ;
    }
    
    public function get_id_type (){
        return $this->id_type ;

    }

    public function set_selife($selife) {
        $this->selife = $selife;
    }
    
    public function get_selife() {
        return $this->selife;
    }
    
    public function set_signature($signature) {
        $this->signature = $signature;
    }
    
    public function get_signature() {
        return $this->signature;
    }

    public function set_is_manager($is_manager){
        $this->is_manager = $is_manager;
    }
    
    public function get_is_manager(){
        return $this->is_manager;
    }
}
?>