<?php 
require_once('db_root_conn.php');
// Centralized username insert
class class_username_database extends class_database{
    private $username_info;

    public function __construct(class_username_info $username_info) {
        parent::__construct('root', '');
        $this->username_info = $username_info;
    }

    public function insert_username($role_id){
        $this->query("START TRANSACTION");
        try{
        // Insert into its assigned tables and gets the last inserted id
        $insert_tbl_person =  $this->pdo->prepare("INSERT INTO tbl_person (l_name,m_name,f_name,gender,birthdate) VALUES (:last,:middle,:first,:gender,:bday)");
        $insert_tbl_person->execute([
            ":last" => $this->username_info->get_lname(),
            ":middle" => $this->username_info->get_mname(),
            ":first" => $this->username_info->get_fname(),
            ":gender" => $this->username_info->get_gender(),
            ":bday" => $this->username_info->get_bday(),
        ]);
        $person_id = $this->pdo->lastInsertId();

        $insert_tbl_contact = $this->pdo->prepare("INSERT INTO tbl_contact (contact) VALUES (:contact)");
        $insert_tbl_contact->execute([ ":contact" => $this->username_info->get_contact()]);
        $contact_id = $this->pdo->lastInsertId();

        $insert_tbl_email = $this->pdo->prepare("INSERT INTO tbl_email (email) VALUES (:email)");
        $insert_tbl_email->execute([":email" => $this->username_info->get_email()]);
        $email_id = $this->pdo->lastInsertId();

        $insert_tbl_password= $this->pdo->prepare("INSERT INTO tbl_password (password) VALUES (:pass)");
        $insert_tbl_password->execute([":pass" => $this->username_info->get_password()]);
        $pswd_id = $this->pdo->lastInsertId();

        $insert_tbl_user = $this->pdo->prepare("INSERT INTO tbl_user (person_id, contact_id,email_id) 
        VALUES (:person_id,:contact_id,:email_id)");
        $insert_tbl_user->execute([
            ":contact_id" => $contact_id ,
            ":person_id" => $person_id,
            ":email_id" => $email_id,
        ]);
        $user_id = $this->pdo->lastInsertId();

        $insert_tbl_username = $this->pdo->prepare("INSERT INTO tbl_username(user_id, username, date_created, terms_and_acceptance) 
        VALUES (:user_id, :username, :date, :terms)");
        $insert_tbl_username->execute([
            ":user_id" => $user_id,
            ":username" => $this->username_info->get_username(),
            ":date" => date('Y-m-d H:i:s'),
            ":terms" => $this->username_info->get_condition(),
        ]);
        $username_id = $this->pdo->lastInsertId();
        
        $insert_tbl_login = $this->pdo->prepare("INSERT INTO tbl_login(username_id, password_id, role_id, app_id) 
        VALUES (:username_id, :pswd_id, :role_id, :app_id)");
        $insert_tbl_login->execute([
            ":username_id" => $username_id, 
            ":pswd_id" => $pswd_id,
            ":role_id" => $role_id, 
            ":app_id" => 1
        ]);


        $this->query("COMMIT");
        return $username_id;
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            return null;
        }
    }
}

class class_username_info{
    private $l_name;
    private $f_name;
    private $m_name;
    private $gender;
    private $bday;
    private $contact;
    private $email;
    private $street;
    private $brngy;
    private $house_unit;
    private $geolocation;
    private $username;
    private $pswd;
    private $condition;

    // Sets the username information 
    public function set_lname($l_name){
        $this->l_name = $l_name;
    }

    public function set_fname($f_name){
        $this->f_name = $f_name;
    }

    public function set_mname($m_name){
        $this->m_name = $m_name;
    }

    public function set_gender($gender){
        $this->gender = $gender;
    }

    public function set_bday($bday){
        $this->bday = $bday;
    }

    public function set_contact($contact){
        $this->contact = $contact;
    }

    public function set_email($email){
        $this->email = $email;
    }
    
    public function set_street($street){
        $this->street = $street;
    }
    
    public function set_brngy($brngy){
        $this->brngy = $brngy;
    }

    public function set_house_unit($house_unit){
        $this->house_unit = $house_unit;
    }

    public function set_geolocation($geolocation){
        $this->geolocation = $geolocation;
    }

    public function set_username($username){
        $this->username = $username;
    }

    public function set_password($pswd){
        $this->pswd = $pswd;
    }

    public function set_condition($terms){
        $this->condition = ($terms===true);
    }

    // Gets the userinformation
    public function get_lname(){
        return $this->l_name;
    }

    public function get_fname(){
        return $this->f_name;
    }

    public function get_mname(){
        return $this->m_name;
    }

    public function get_gender(){
        return $this->gender;
    }

    public function get_bday(){
        return $this->bday;
    }

    public function get_contact(){
        return $this->contact;
    }

    public function get_email(){
        return $this->email;
    }
    
    public function get_street(){
        return $this->street;
    }
    
    public function get_brngy(){
        return $this->brngy;
    }

    public function get_house_unit(){
        return $this->house_unit;
    }

    public function get_geolocation(){
        return $this->geolocation;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->pswd;
    }

    public function get_condition(){
        return $this->condition;
    }
}