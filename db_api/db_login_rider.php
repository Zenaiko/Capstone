<?php 
require_once('db_root_conn.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;
class class_rider_login_database extends class_database{
    private $rider_login_credentials;
    public function __construct(class_rider_login_credentials $rider_login_credentials)
    {
        parent::__construct('root' , '');
        $this->rider_login_credentials = $rider_login_credentials;
    }

    public function login_rider(){
        $login_rider = $this->query("SELECT employee.employee_id
        FROM tbl_employee employee, tbl_employee_registration emp_reg, tbl_rider_registration rider_reg, tbl_username username, tbl_user user, tbl_contact contact,tbl_login login, tbl_password pswd
        WHERE employee.employee_registration_id = emp_reg.employee_registration_id AND rider_reg.employee_registration_id = emp_reg.employee_registration_id AND 
        username.username_id = emp_reg.username_id AND 
        username.user_id = user.user_id AND 
        user.contact_id = contact.contact_id AND
        (username.username = :credentials OR contact.contact = :credentials) AND
        login.username_id = username.username_id AND 
        login.password_id = pswd.password_id AND 
        pswd.password = :password AND
        emp_reg.registration_status = 'accepted'", 
        [":credentials" => $this->rider_login_credentials->get_credentials(),
        ":password" => $this->rider_login_credentials->get_pswd()]);
        $this->rider_login_credentials->set_employee_num(($login_rider->fetchAll(PDO::FETCH_ASSOC)[0]["employee_id"])??null);
        if($this->rider_login_credentials->get_employee_num()){
            $_SESSION['user'] = 'rider';
            $_SESSION['rider_num'] = $this->rider_login_credentials->get_employee_num();
            header("location: ../rider_page/rider_landing.php");
        }else{
            header("location: ../rider_page/rider_login.php");
        }
    }
}

class class_rider_login_credentials{
    private $credentials;
    private $pswd;
    private $employee_num;

  // Setter for $credentials
    public function set_credentials($credentials) {
        $this->credentials = $credentials;
    }

    // Getter for $credentials
    public function get_credentials() {
        return $this->credentials;
    }

    // Setter for $pswd
    public function set_pswd($pswd) {
        $this->pswd = $pswd;
    }

    // Getter for $pswd
    public function get_pswd() {
        return $this->pswd;
    }

    // Setter for $employee_num
    public function set_employee_num($employee_num) {
        $this->employee_num = $employee_num;
    }

    // Getter for $employee_num
    public function get_employee_num() {
        return $this->employee_num;
    }
}

$rider_login_credentials = new class_rider_login_credentials();

$rider_login_credentials->set_credentials($_POST["credentials"]);
$rider_login_credentials->set_pswd(hash('sha256',$_POST["pswd"]));

$rider_login_db = new class_rider_login_database($rider_login_credentials);
$rider_login_db->login_rider();
?>