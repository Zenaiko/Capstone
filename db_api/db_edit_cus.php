<?php 
    require_once('db_root_conn.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_cus_edit_database extends class_database{
        private $cus_id;
        private $cus_info;
        public function __construct(class_cus_info $cus_info)
        {
            parent::__construct('root' , '');
            $this->cus_info = $cus_info;
            $this->cus_id = $_SESSION['cus_id'];
        }

        public function get_cus_info(){
            $get_cus_info =  $this->query("SELECT cus.user_img, username.username, con.contact, email.email, person.l_name, person.m_name, person.f_name, person.birthdate, person.gender
            FROM tbl_customer cus, tbl_username username, tbl_user user ,  tbl_person person, tbl_contact con, tbl_email email
            WHERE username.username_id = cus.username_id 
            AND user.user_id = username.user_id
            AND person.personID = user.person_id
            AND user.contact_id = con.contact_id
            AND user.email_id = email.emailID 
            AND cus.customer_id = ? " ,[$this->cus_id]);
            return $get_cus_info->fetchAll(PDO::FETCH_ASSOC)[0];
        }
    }

    class class_cus_info{
        private $img;
        private $username;
        private $contact;
        private $email;
        private $l_name;
        private $m_name;
        private $f_name;
        private $bday;
        private $gender;

        // Set customer info
        public function set_img($img){
            $this->img =$img;
        }

        public function set_username($username){
            $this->username =$username;
        }

        public function set_contact($contact){
            $this->contact =$contact;
        }

        public function set_email($email){
            $this->email =$email;
        }

        public function set_l_name($l_name){
            $this->l_name =$l_name;
        }

        public function set_m_name($m_name){
            $this->m_name =$m_name;
        }

        public function set_f_name($f_name){
            $this->f_name =$f_name;
        }

        public function set_bday($bday){
            $this->bday =$bday;
        }

        public function set_gender($gender){
            $this->gender =$gender;
        }

        // Gets the customer info
        public function get_img(){
            return $this->img;
        }

        public function get_username(){
            return $this->username;
        }

        public function get_contact(){
            return $this->contact;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_l_name(){
            return $this->l_name;
        }

        public function get_m_name(){
            return $this->m_name;
        }

        public function get_f_name(){
            return $this->f_name;
        }

        public function get_bday(){
            return $this->bday;
        }

        public function get_gender(){
            return $this->gender;
        }
    }

    $cus_info = new class_cus_info();
    $cus_edit_db = new class_cus_edit_database($cus_info);

    $cus_info_start = $cus_edit_db->get_cus_info();
    $cus_info->set_img($cus_info_start["user_img"]);
    $cus_info->set_username($cus_info_start["username"]);
    $cus_info->set_contact($cus_info_start["contact"]);
    $cus_info->set_email($cus_info_start["email"]);
    $cus_info->set_l_name($cus_info_start["l_name"]);
    $cus_info->set_m_name($cus_info_start["m_name"]);
    $cus_info->set_f_name($cus_info_start["f_name"]);
    $cus_info->set_bday($cus_info_start["birthdate"]);
    $cus_info->set_gender($cus_info_start["gender"]);

?>