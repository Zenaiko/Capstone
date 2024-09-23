<?php require_once('db_root_conn.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class class_get_database extends class_database{
    public function __construct()
    {
        parent::__construct('root' , '');
    }

    public function get_category(){
        $get_all_category = $this->query("SELECT category FROM tbl_category"); 
        return $get_all_category->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_category_id($category){
        $get_category_id = $this->query("SELECT category_id FROM tbl_category WHERE category = ?" , [$category]); 
        return $get_category_id->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cus_dir_by_seller($seller_id){
        $get_dir = $this->query("SELECT cus.cus_asset_folder FROM tbl_customer cus, tbl_market mark WHERE mark.customer_id = cus.customer_id AND mark.market_id = ?", [$seller_id]);
        return $get_dir->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function get_item_info_home(){
        $get_item = $this->query("SELECT itm.item_id, itm.item_name, img.item_img, MIN(vari.vairation_price) AS min_price, AVG(cus_r.rating) AS avg_rate FROM tbl_item itm
        LEFT JOIN tbl_market mrkt ON mrkt.market_id = itm.market_id
        LEFT JOIN tbl_item_img img ON itm.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = itm.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = itm.item_id
        GROUP BY itm.item_id");
        return $get_item->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_top_shop(){
        $get_top_shop = $this->query("SELECT * FROM tbl_market market 
        LEFT JOIN tbl_market_image img ON market.market_id = img.market_id
        GROUP BY market.market_id");
        return $get_top_shop->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_contact($contact){
        $get_contact = $this->query("SELECT contact FROM tbl_contact WHERE contact = ?", [$contact]);
        return $get_contact->fetchAll(PDO::FETCH_ASSOC)[0]['contact']??null;
    }

    public function get_is_seller($cus_id){
        $get_is_seller = $this->query("SELECT market.is_verified FROM tbl_market market, tbl_customer cus WHERE market.customer_id = cus.customer_id AND cus.customer_id = ?", [$cus_id]);
        return $get_is_seller->fetchAll(PDO::FETCH_ASSOC)[0]['is_verified']??null;
    }

}

$get_db = new class_get_database();
$category_array = $get_db->get_category();

    $data = json_decode(file_get_contents("php://input"), true);

    if(isset($data['otp_number']) && $data['action'] === 'get_number'){
        $verify_otp = $get_db->get_contact($data['otp_number']);
        if(!empty($verify_otp)){
            $exist_json = ['exists' => true];
        }elseif(empty($verify_otp)){
            $_SESSION['visitor_sign_num'] = $data['otp_number'];
            $exist_json = ['exists' => false ];
        }
        echo json_encode($exist_json);
    }

    if(isset($data) && $data['action'] === 'get_is_seller'){
        $verify_seller = $get_db->get_is_seller($_SESSION['cus_id']);
        if($verify_seller === 1){
            $result = ['is_seller' => true];
        }else{
            $result = ['is_seller' => false];
        }
        echo json_encode($result);
    }

?>