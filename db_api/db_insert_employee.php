<?php 
require_once('db_insert_username.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once("../db_api/db_insert_username.php");

class class_employee_database extends class_username_database{
    private $employee;
    private $employe_folder;
    public function __construct(class_username_info $employee_info, class_employee_info $employee, $employe_folder){
        // Createas class username info
        parent::__construct($employee_info);
        $this->employee = $employee;
        $this->employe_folder = $employe_folder;
    }

    // Uploads the files
    private function upload_file($file, $employee_folder){
        $employee_files_dir = $employee_folder . "/" . $file["name"];
        echo "<pre>";
        echo $employee_files_dir;
        // move_uploaded_file($file["tmp_name"],$employee_files_dir);
        return $employee_files_dir;
    }

    public function insert_employee(){
        $this->query("START TRANSACTION");
        $username_id = $this->insert_username();
        try{
            $insert_employee_registration = $this->pdo->prepare("INSERT INTO tbl_employee_registration 
            (username_id, is_manager, date_registered)
            VALUES (:username_id, :is_manager, :date_registrered)");

            $insert_employee_registration->execute([
                ":username_id" => $username_id,
                ":is_manager" => $this->employee->get_is_manager(), 
                ":date_registrered" => date("Y-m-d H:i:s"),
            ]);

        $employee_id =  $this->pdo->lastInsertId();
        // Moves and saves the dir of each file
        // Creates the employees folder
        $employee_folder = $this->employe_folder . $employee_id . "_assets_folder";
        // (!is_dir($employee_folder))?mkdir($employee_folder):null;
        
        $nbi_dir = $this->upload_file($this->employee->get_nbi_police(), $employee_folder);
        $brngy_clearance_dir = $this->upload_file($this->employee->get_brngy_clearance(), $employee_folder);
        $valid_id_dir = $this->upload_file($this->employee->get_valid_id(), $employee_folder);
        $selfie_dir = $this->upload_file($this->employee->get_selfie(), $employee_folder);
        $signature_dir = $this->upload_file($this->employee->get_signature(), $employee_folder);
        
        $employee_files = $this->pdo->prepare("UPDATE tbl_employee_registration SET 
        nbi_police_clearance = :nbi_police, 
        brngy_clearance = :brngy_clearance, 
        valid_id = :valid_id, 
        valid_id_type = :id_type, 
        registrator_selfie = :selfie, 
        registrator_e_signature = :signature WHERE employee_id = :employee_id)");
        $employee_files->execute([
            ":nbi_police" => $nbi_dir,
            ":brngy_clearance" => $brngy_clearance_dir, 
            ":valid_id" => $valid_id_dir, 
            ":id_type" => $this->employee->get_id_type(), 
            ":selfie" => $selfie_dir, 
            ":signature" => $signature_dir, 
        ]);
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
    private $selfie;
    private $signature;
    private $is_manager;
    private $employee_dir;

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

    public function set_selfie($selfie) {
        $this->selfie = $selfie;
    }
    
    public function get_selfie() {
        return $this->selfie;
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

     public function set_employee_dir($employee_dir){
        $this->employee_dir = $employee_dir;
    }
    
    public function get_employee_dir(){
        return $this->employee_dir;
    }
}
?>