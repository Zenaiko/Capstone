<?php 
require_once("../db_api/db_insert_employee.php");
class class_rider_database extends class_employee_database{
    private $rider_info; 
    public function __construct(class_username_info $username_info, class_employee_info $employee_info, class_rider_registration_info $rider_info){
        // Createas class username info
        parent::__construct($username_info,$employee_info);
        $this->rider_info = $rider_info;
    }

    public function sign_up_rider(){
        $this->query("START TRANSACTION");
        $employee_id = $this->insert_employee();
        try{
            $has_disability = !is_null($this->rider_info->get_disability_comorbidity());
            $insert_rider_registration = $this->pdo->prepare("INSERT INTO tbl_rider_registration (employee_registration_id, drug_test_clearance, has_disability, has_motorized_vehicle, is_senior) VALUES (:employee_id, :drug_test, :has_disability, :has_motor, :is_senior)");
            $insert_rider_registration->execute([
                ":employee_id" => $employee_id, 
                ":drug_test" => $this->rider_info->get_drug_test(), 
                ":has_disability" => $has_disability, 
                ":has_motor" => 1, 
                ":is_senior" => 0,
            ]);
            $rider_registration_id =  $this->pdo->lastInsertId();

            // $insert_rider_license = $this->pdo->prepare("INSERT INTO tbl_rider_license (rider_verification_id, drivers_license_number, drivers_license_photo) VALUES (:verification_id, :license_number, :license_img)");
            // $insert_rider_license->execute([
            //     ":verification_id" => $this->rider_info,
            //     ":license_number" => $this->rider_info,
            //     ":license_img" => $this->rider_info,
            // ]);

        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            return null;
        }
    }
}

class class_rider_registration_info{
    // Rider relevant requirements
    private $drug_test;
    private $licesce_number;
    private $licesce_photo;
    private $has_motor;

    // Other informations that can be sepearated by class if needed
    // Vehicle information
    private $vehicle_registration;
    private $vehice_or_cr;
    private $vehicle_coding;
    private $dealer_certificcate;
    private $is_owner;
    private $supporting_documents;

    // Other relevant info
    private $medical_certificate;
    private $medical_certificate_id;
    private $disability_comorbidity;
    private $medical_assurance;
    
    public function set_drug_test($drug_test) {
        $this->drug_test = $drug_test;
    }
    
    public function get_drug_test() {
        return $this->drug_test;
    }

    public function set_has_motor($has_motor){
        $this->has_motor = $has_motor;
    }
    
    public function get_has_motor(){
        return $this->has_motor;
    }
    
    public function set_licesce_number($licesce_number) {
        $this->licesce_number = $licesce_number;
    }
    
    public function get_licesce_number() {
        return $this->licesce_number;
    }
    
    public function set_licesce_photo($licesce_photo) {
        $this->licesce_photo = $licesce_photo;
    }
    
    public function get_licesce_photo() {
        return $this->licesce_photo;
    }
    
    public function set_vehicle_registration($vehicle_registration) {
        $this->vehicle_registration = $vehicle_registration;
    }
    
    public function get_vehicle_registration() {
        return $this->vehicle_registration;
    }
    
    public function set_vehice_or_cr($vehice_or_cr) {
        $this->vehice_or_cr = $vehice_or_cr;
    }
    
    public function get_vehice_or_cr() {
        return $this->vehice_or_cr;
    }
    
    public function set_vehicle_coding($vehicle_coding) {
        $this->vehicle_coding = $vehicle_coding;
    }
    
    public function get_vehicle_coding() {
        return $this->vehicle_coding;
    }
    
    public function set_dealer_certificcate($dealer_certificcate) {
        $this->dealer_certificcate = $dealer_certificcate;
    }
    
    public function get_dealer_certificcate() {
        return $this->dealer_certificcate;
    }
    
    public function set_is_owner($is_owner) {
        $this->is_owner = $is_owner;
    }
    
    public function get_is_owner() {
        return $this->is_owner;
    }
    
    public function set_supporting_documents($supporting_documents) {
        $this->supporting_documents = $supporting_documents;
    }
    
    public function get_supporting_documents() {
        return $this->supporting_documents;
    }
    
    public function set_medical_certificate($medical_certificate) {
        $this->medical_certificate = $medical_certificate;
    }
    
    public function get_medical_certificate() {
        return $this->medical_certificate;
    }
    
    public function set_medical_certificate_id($medical_certificate_id) {
        $this->medical_certificate_id = $medical_certificate_id;
    }
    
    public function get_medical_certificate_id() {
        return $this->medical_certificate_id;
    }
    
    public function set_disability_comorbidity($disability_comorbidity) {
        $this->disability_comorbidity = $disability_comorbidity;
    }
    
    public function get_disability_comorbidity() {
        return $this->disability_comorbidity;
    }
    
    public function set_medical_assurance($medical_assurance) {
        $this->medical_assurance = $medical_assurance;
    }
    
    public function get_medical_assurance() {
        return $this->medical_assurance;
    }
    
}

$rider_info = [
    "username" => new class_username_info(),
    "employee" => new class_employee_info(),
    "registration" => new class_rider_registration_info(),
];

$rider_db = new class_rider_database($rider_info["username"],$rider_info["employee"], $rider_info["registration"]);

// Username info
$rider_info["username"]->set_contact($_SESSION['visitor_sign_num']);
$rider_info["username"]->set_fname($_POST["first_name"]);
$rider_info["username"]->set_mname($_POST["middle_name"])??null;
$rider_info["username"]->set_lname($_POST["last_name"]);
$rider_info["username"]->set_email($_POST["email"]);
$rider_info["username"]->set_username($_POST["username"]);
$rider_info["username"]->set_password(hash('sha256' , ($_POST["password"])));
$rider_info["username"]->set_condition($_POST["terms_conditions_radio"]);

// Employee registration
$rider_info["employee"]->set_nbi_police($_POST["nbi_police"]);
$rider_info["employee"]->set_brngy_clearance($_POST["brngy_clearance"]);
$rider_info["employee"]->set_selife($_POST["selife"]);
$rider_info["employee"]->set_signature($_POST["signature"]);
// Rider registration info
$rider_info["registration"]->set_drug_test($_POST["drug_test"]);
$rider_info["registration"]->set_licesce_number($_POST["licesce_number"]);
$rider_info["registration"]->set_licesce_photo($_POST["licesce_photo"]);

$rider_info["registration"]->set_vehicle_registration($_POST[""]);
$rider_info["registration"]->set_vehice_or_cr($_POST[""]);
$rider_info["registration"]->set_vehicle_coding($_POST[""]);
$rider_info["registration"]->set_dealer_certificcate($_POST[""]);
$rider_info["registration"]->set_is_owner($_POST[""]);
$rider_info["registration"]->set_supporting_documents($_POST[""]);
$rider_info["registration"]->set_medical_certificate($_POST[""]);
$rider_info["registration"]->set_medical_certificate_id($_POST[""]);
$rider_info["registration"]->set_disability_comorbidity($_POST[""]);
$rider_info["registration"]->set_medical_assurance($_POST[""]);

?>