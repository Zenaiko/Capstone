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

        // Gets the customers information
        public function get_cus_info(){
            $get_cus_info =  $this->query("SELECT customer.customer_img, customer.cus_asset_folder,username.username, contact.contact, email.email, person.l_name, person.m_name, person.f_name, person.birthdate, person.gender
            FROM tbl_customer customer
            JOIN tbl_username username ON username.username_id = customer.username_id
            JOIN tbl_user user ON user.user_id = username.user_id
            JOIN tbl_person person ON person.person_id = user.person_id
            JOIN tbl_contact contact ON user.contact_id = contact.contact_id
            JOIN tbl_email email ON user.email_id = email.email_id
            WHERE customer.customer_id = ? " ,[$this->cus_id]);
            return $get_cus_info->fetchAll(PDO::FETCH_ASSOC)[0];
        }

        // Updates the customers information
        public function update_customer_info(){
            $this->query("START TRANSACTION");
            try{
                if(!is_null($this->cus_info->get_img())){
                    $new_profile_dir = $this->cus_info->get_cus_folder() . "/" .basename($this->cus_info->get_img()['name']);
                    if(is_null($this->cus_info->get_orig_img())){
                        move_uploaded_file($this->cus_info->get_img()['tmp_name'] , $new_profile_dir);
                    }else{
                        $new_profile_dir = $this->cus_info->get_cus_folder() . "/" .basename($this->cus_info->get_img());
                        rename($this->cus_info->get_orig_img(), $new_profile_dir);
                    }
                }
            
                $edit_customer_info = $this->pdo->prepare("UPDATE tbl_customer customer, tbl_username username, tbl_user user, tbl_person person, tbl_contact contact, tbl_email email 
                SET customer.customer_img = :img, username.username = :username, contact.contact = :contact, email.email = :email, person.l_name = :l_name, person.m_name = :m_name, person.f_name = :f_name, person.birthdate = :bday
                WHERE username.username_id = customer.username_id 
                AND user.user_id = username.user_id
                AND person.person_id = user.person_id
                AND user.contact_id = contact.contact_id
                AND user.email_id = email.emailID 
                AND customer.customer_id = :cus_id ");
                $edit_customer_info->execute([
                    ':img' => $new_profile_dir??null,
                    ':username' => $this->cus_info->get_username(),
                    ':contact' => $this->cus_info->get_contact(),
                    ':email' => $this->cus_info->get_email(),
                    ':l_name' => $this->cus_info->get_l_name(),
                    ':m_name' => $this->cus_info->get_m_name(),
                    ':f_name' => $this->cus_info->get_f_name(),
                    ':bday' => $this->cus_info->get_bday(),
                    ':cus_id' => $this->cus_id
                ]);
                $this->query('COMMIT');
                header('location: ../user_page/cus_acc_edit_page.php');
            }catch(Exception $error){
                echo "Failed: " . $error->getMessage();
                $this->query("ROLLBACK");
            }
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
        private $cus_folder;
        private $original_img;

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

        public function set_cus_folder($dir){
            $this->cus_folder =$dir;
        }

        public function set_orig_img($og_img){
            $this->original_img =$og_img;
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

        public function get_cus_folder(){
            return $this->cus_folder;
        }

        public function get_orig_img(){
            return $this->original_img;
        }
    }

    $cus_info = new class_cus_info();
    $cus_edit_db = new class_cus_edit_database($cus_info);

    // Sends the data for updating
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_save'])) {
        $cus_info->set_img($_FILES['cus_img']??null);
        $cus_info->set_username($_POST['cus_username_edit']);
        $cus_info->set_contact($_POST['cus_contact_edit']);
        $cus_info->set_email($_POST['cus_email_edit']??null);
        $cus_info->set_l_name($_POST['cus_l_name_edit']??null);
        $cus_info->set_m_name($_POST['cus_m_name_edit']??null);
        $cus_info->set_f_name($_POST['cus_f_name_edit']??null);
        $cus_info->set_bday($_POST['cus_edit_bday']??null);
        $cus_info->set_gender($_POST['']??null);

        $cus_edit_db->update_customer_info();
    }

    // Gets the data once when the page loads
    $cus_info_start = $cus_edit_db->get_cus_info();
    $cus_info->set_img($cus_info_start["customer_img"]);
    $cus_info->set_orig_img($cus_info_start["customer_img"]);
    $cus_info->set_username($cus_info_start["username"]);
    $cus_info->set_contact($cus_info_start["contact"]);
    $cus_info->set_email($cus_info_start["email"]);
    $cus_info->set_l_name($cus_info_start["l_name"]);
    $cus_info->set_m_name($cus_info_start["m_name"]);
    $cus_info->set_f_name($cus_info_start["f_name"]);
    $cus_info->set_bday($cus_info_start["birthdate"]);
    $cus_info->set_gender($cus_info_start["gender"]);
    $cus_info->set_cus_folder($cus_info_start["cus_asset_folder"]);

?>