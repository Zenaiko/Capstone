<?php require_once('db_root_conn.php');


    class user_info_database extends class_database{
        private $customer_id;
        public function __construct()
        {
            parent::__construct('root' , '');
            $this->customer_id = $_SESSION['cus_id'];
        }

        public function get_cus_info(){
            $customer_info = $this->query("SELECT usname.username, cus.user_img FROM tbl_username usname ,tbl_customer cus WHERE usname.usernameID = cus.usernameID AND cus.customerID = ?" , [$this->customer_id]);
            return $customer_info->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_cus_like(){
            $cus_like = $this->query("SELECT COUNT(itm_rel.is_liked) AS item_liked FROM tbl_customer_item_relationship itm_rel, tbl_customer cus WHERE cus.customerID = itm_rel.customerID AND itm_rel.is_liked = 1 AND cus.customerID = ?", [$this->customer_id]);
            return $cus_like->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_cus_follow(){
            $cus_follow = $this->query("SELECT COUNT(mrkt_rel.is_followed) AS shop_follow FROM tbl_customer_market_relationship mrkt_rel, tbl_customer cus WHERE cus.customerID = mrkt_rel.customerID AND mrkt_rel.is_followed = 1 AND cus.customerID = ?", [$this->customer_id]);
            return $cus_follow->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    $cus_info_db = new user_info_database();
    $cus_info_array = $cus_info_db->get_cus_info()[0];
    $cus_like_array = $cus_info_db->get_cus_like()[0];
    $cus_follow_array = $cus_info_db->get_cus_follow()[0];

    class class_cus_info{
        public $username;
        public $user_img;
        public $follw;
        public $like;
    }

    $cus_info = new class_cus_info();

    $cus_info->username =  $cus_info_array['username']; 
    $cus_info->user_img =  $cus_info_array['user_img'];
    $cus_info->follw =  $cus_like_array['item_liked'];
    $cus_info->like =  $cus_follow_array['shop_follow'];


?>