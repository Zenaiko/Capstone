<?php 
    require_once("db_root_conn.php");

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_address_database extends class_database{
        private $adr;
        public function __construct(class_address_info $adr)
        {
            parent::__construct('root' , '');
            $this->adr = $adr;
        }

        public function insert_tbl_address(){
            $this->query("START TRANSACTION");
            $insert_tbl_address = $this->pdo->prepare("INSERT INTO tbl_address (street,brngy,house_unit_number,geolocation) 
            VALUES (:street,:brngy,:house_num,:geo)");
            $insert_tbl_address->execute([
                ":street"=>$this->adr->get_street(),
                ":brngy"=>$this->adr->get_brngy(),
                ":house_num"=>$this->adr->get_house_num(),
                ":geo"=>$this->adr->get_geo()
            ]);
            $latest_adr_id = $this->pdo->lastInsertId();

            $insert_tbl_contact = $this->pdo->prepare("INSERT INTO tbl_contact (contact) VALUES (:contact)");
            $insert_tbl_contact ->execute([":contact"=>$this->adr->get_contact()]);
            $contact_id = $this->pdo->lastInsertId();
            
            $insert_tbl_cus_pickup = $this->pdo->prepare("INSERT INTO tbl_customer_pickup (customer_id,address_id,pickup_name,recipient_name,is_default,contact_id) 
            VALUES (:cus_id,:adr_id,:adr_name,:recepient_name,:def,:contact_id)");
            $insert_tbl_cus_pickup ->execute([
                ":cus_id" => $_SESSION["cus_id"],
                ":adr_id" => $latest_adr_id,
                ":adr_name" => $this->adr->get_adr_name(),
                ":recepient_name" => $this->adr->get_recepient_name(),
                ":def" => $this->adr->get_is_default(),
                ":contact_id" => $contact_id
            ]);
            $this->query("COMMIT");
            header("location: ../user_page/manage_address.php");
        }
    }

    class class_address_info{
        private $adr_name;
        private $contact;
        private $recepient_name;
        private $street;
        private $brngy;
        private $house_num;
        private $geo;
        private $is_default;
    
        // Getter and Setter for adr_name
        public function set_adr_name($adr_name) {
            $this->adr_name = $adr_name;
        }
    
        public function get_adr_name() {
            return $this->adr_name;
        }
    
        // Getter and Setter for recepient_name
        public function set_recepient_name($recepient_name) {
            $this->recepient_name = $recepient_name;
        }
    
        public function get_recepient_name() {
            return $this->recepient_name;
        }
    
        // Getter and Setter for street
        public function set_street($street) {
            $this->street = $street;
        }
    
        public function get_street() {
            return $this->street;
        }
    
        // Getter and Setter for brngy
        public function set_brngy($brngy) {
            $this->brngy = $brngy;
        }
    
        public function get_brngy() {
            return $this->brngy;
        }
    
        // Getter and Setter for house_num
        public function set_house_num($house_num) {
            $this->house_num = $house_num;
        }
    
        public function get_house_num() {
            return $this->house_num;
        }
    
        // Getter and Setter for geo
        public function set_geo($geo) {
            $this->geo = $geo;
        }
    
        public function get_geo() {
            return $this->geo;
        }
    
        // Getter and Setter for is_default
        public function set_is_default($is_default) {
            $this->is_default = $is_default;
        }
    
        public function get_is_default() {
            return $this->is_default;
        }

        // Getter and Setter for contact
        public function set_contact($contact) {
            $this->contact = $contact;
        }
    
        public function get_contact() {
            return $this->contact;
        }
    }

    $address_info = new class_address_info();
    $address_db = new class_address_database($address_info);

    $address_info->set_adr_name($_POST["adr_name"]);
    $address_info->set_recepient_name($_POST["recepient_name"]);
    $address_info->set_street($_POST["street"]);
    $address_info->set_brngy($_POST["brngy"]);
    $address_info->set_house_num($_POST["hosue_num"]);
    $address_info->set_is_default($_POST["default"]??0);
    $address_info->set_contact($_POST["contact"]);

    $address_db->insert_tbl_address();    
?>