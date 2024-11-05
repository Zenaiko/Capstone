<?php 
require_once("../db_api/db_insert_employee.php");
class class_rider_database extends class_employee_database{
    private $rider_info; 
    public function __construct(class_username_info $username_info, class_employee_info $employee_info, class_rider_registration_info $rider_info){
        // assigns class username info and employee info
        parent::__construct($username_info,$employee_info, "../rider_page/rider_assets/r");
        $this->rider_info = $rider_info;
    }
    
    // Uploads the files
    private function upload_files($file, $employee_folder){
        $file_dir = $employee_folder . $file["name"];
        // move_uploaded_file($file["tmp_name"], $file_dir);
        return $file_dir;
    }

    public function sign_up_rider(){
        $this->query("START TRANSACTION");
        $employee_registration_id = $this->insert_employee();
        $get_employee_dir = $this->query("SELECT employee_dir FROM tbl_employee_registration WHERE employee_registration_id = ?", [$employee_registration_id]);
        $employee_folder =  ($get_employee_dir->fetchAll(PDO::FETCH_ASSOC)[0]["employee_dir"]) . "/";
        try{
            $has_disability = !is_null($this->rider_info->get_disability_comorbidity());
            $drug_test = $this->upload_files($this->rider_info->get_drug_test(),$employee_folder);
            $insert_rider_registration = $this->pdo->prepare("INSERT INTO tbl_rider_registration (employee_registration_id, drug_test_clearance, has_disability, has_motorized_vehicle, is_senior) VALUES (:employee_registration_id, :drug_test,:has_disability, :has_motor, :is_senior)");
            $insert_rider_registration->execute([
                ":employee_registration_id" => $employee_registration_id, 
                ":drug_test" => $drug_test, 
                ":has_disability" => $has_disability, 
                ":has_motor" => $this->rider_info->get_has_motor(), 
                ":is_senior" => 0,
            ]);
            $tbl_rider_registration_id =  $this->pdo->lastInsertId();

            $liscence_img = $this->upload_files($this->rider_info->get_license_photo(), $employee_folder);

            $insert_rider_license = $this->pdo->prepare("INSERT INTO tbl_rider_license (rider_verification_id, drivers_license_number, drivers_license_photo) VALUES (:verification_id, :license_number, :license_img)");
            $insert_rider_license->execute([
                ":verification_id" => $tbl_rider_registration_id,
                ":license_number" => $this->rider_info->get_license_number(),
                ":license_img" => $liscence_img,
            ]);
            $tbl_rider_license_id =  $this->pdo->lastInsertId();

            // Uploads all the relevant file
            $vehicle_file_array = [
                "registration" => $this->rider_info->get_vehicle_registration(),
                "or_cr" => $this->rider_info->get_vehice_or_cr(),
                "dealer_certificate" => $this->rider_info->get_dealer_certificcate(),
            ];
            $vehicle_files = [];
            array_walk($vehicle_file_array,function($file, $key) use ($employee_folder,&$vehicle_files){
                $vehicle_files[$key] = $this->upload_files($file, $employee_folder);
            });

            // Inserts into tbl vehicle registration
            $insert_vehicle_registration = $this->pdo->prepare("INSERT INTO tbl_rider_vehicle_registration (rider_license_id, vehicle_type, vehicle_registration_photo, or_cr, vehicle_coding, dealer_certificate, is_owner)
            VALUES (:license_id, :vehicle_type, :registration_photo, :or_cr, :vehicle_coding, :dealer_certificate, :is_owner)");
            $insert_vehicle_registration->execute([
                ":license_id" => $tbl_rider_license_id, 
                ":vehicle_type" => $this->rider_info->get_vehicle_type(), 
                ":registration_photo" => $vehicle_files["registration"], 
                ":or_cr" => $vehicle_files["or_cr"], 
                ":vehicle_coding" => $this->rider_info->get_vehicle_coding(), 
                ":dealer_certificate" => $vehicle_files["dealer_certificate"], 
                ":is_owner" => $this->rider_info->get_is_owner(),
            ]);


            // Insert into tbl rider medication if rider has any
            if($this->rider_info->get_disability_comorbidity()){
                $assurance_file = $this->upload_files($this->rider_info->get_medical_assurance(), $employee_folder);
                $insert_rider_medication = $this->pdo->prepare("INSERT INTO tbl_rider_medication 
                (rider_verification_id, disability_cormobidity, medical_assurance) 
                VALUES (:verification_id, :disability_comorbidity, :assurance)");
                $insert_rider_medication->execute([
                    ":verification_id" => $tbl_rider_registration_id, 
                    ":disability_comorbidity" => $this->rider_info->get_disability_comorbidity(), 
                    ":assurance" => $assurance_file,
                ]);
            }


            // $this->query("COMMIT");
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
    private $license_number;
    private $license_photo;
    private $has_motor;

    // Other informations that can be sepearated by class if needed
    // Vehicle information
    private $vehicle_registration;
    private $vehicle_type;
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
    
    public function set_license_number($license_number) {
        $this->license_number = $license_number;
    }
    
    public function get_license_number() {
        return $this->license_number;
    }
    
    public function set_license_photo($license_photo) {
        $this->license_photo = $license_photo;
    }
    
    public function get_license_photo() {
        return $this->license_photo;
    }
    
    public function set_vehicle_registration($vehicle_registration) {
        $this->vehicle_registration = $vehicle_registration;
    }
    
    public function get_vehicle_registration() {
        return $this->vehicle_registration;
    }

    public function set_vehicle_type($vehicle_type) {
        $this->vehicle_type = $vehicle_type;
    }
    
    public function get_vehicle_type() {
        return $this->vehicle_type;
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
// $rider_info["username"]->set_condition($_POST["terms_conditions_radio"]);

// Employee registration
$rider_info["employee"]->set_nbi_police($_FILES["nbi_police"]);
$rider_info["employee"]->set_brngy_clearance($_FILES["brngy_clearance"]);
$rider_info["employee"]->set_selfie($_FILES["selfie"]);
$rider_info["employee"]->set_signature($_FILES["signature"]);
$rider_info["employee"]->set_is_manager(0);
$rider_info["employee"]->set_valid_id($_FILES["license_photo"]);
// Rider registration info
$rider_info["registration"]->set_drug_test($_FILES["drug_test"]);
$rider_info["registration"]->set_license_number($_POST["license_number"]);
$rider_info["registration"]->set_license_photo($_FILES["license_photo"]);

$rider_info["registration"]->set_vehicle_registration($_FILES["vehicle_registration"]);
$rider_info["registration"]->set_vehicle_type($_POST["vehicle_type"]);
$rider_info["registration"]->set_vehice_or_cr($_FILES["or_cr"]);
$rider_info["registration"]->set_vehicle_coding($_POST["coding_number"]);
$rider_info["registration"]->set_dealer_certificcate($_FILES["dealer_certificate"]);
// Situational Documents
$rider_info["registration"]->set_is_owner($_POST["is_owner"]??null);
$rider_info["registration"]->set_supporting_documents($_FILES["supporting_documents"]??null);
$rider_info["registration"]->set_medical_certificate_id($_FILES["medical_certificate_id"]??null);
$rider_info["registration"]->set_medical_certificate($_FILES["medical_certificate"]??null);
$rider_info["registration"]->set_disability_comorbidity($_POST["disability_comorbidity"]??null);
$rider_info["registration"]->set_medical_assurance($_FILES["medical_assurance"]??null);

$rider_db->sign_up_rider();
?>