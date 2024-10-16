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
        $get_all_category = $this->query("SELECT * FROM tbl_category"); 
        return $get_all_category->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_category_id($category){
        $get_category_id = $this->query("SELECT category_id FROM tbl_category WHERE category = ?" , [$category]); 
        return $get_category_id->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cus_dir_by_seller($seller_id){
        $get_dir = $this->query("SELECT customer.cus_asset_folder FROM tbl_customer customer
        LEFT JOIN  tbl_market market ON market.customer_id = customer.customer_id 
        WHERE customer.customer_id = ?", [$seller_id]);
        return $get_dir->fetchAll(PDO::FETCH_ASSOC)[0]['cus_asset_folder'];
    } 

    public function get_item_info_home(){
        $get_item = $this->query("SELECT 
        item.item_id, 
        item.item_name, 
        img.item_img, 
        MIN(variation.variation_price) AS min_price,
        AVG(item_rel.rating) AS avg_rate,
        SUM(odr.order_qty) AS order_qty, 
        COUNT(item_rel.rating) AS rate_count
        FROM tbl_item item
        LEFT JOIN tbl_market mrkt ON mrkt.market_id = item.market_id
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id AND img.item_img = (SELECT img.item_img FROM tbl_item_img img, tbl_item item WHERE img.item_id = item.item_id LIMIT 1)
        LEFT JOIN tbl_variation variation ON variation.item_id = item.item_id
        LEFT JOIN tbl_customer_item_relationship item_rel ON item_rel.item_id = item.item_id 
        LEFT JOIN tbl_order odr ON odr.variation_id = variation.variation_id AND odr.order_status = 'completed'
        GROUP BY item.item_id");
        return $get_item->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_top_shop(){
        $get_top_shop = $this->query("SELECT *, COUNT(item_rel.rating) AS respondents FROM tbl_market market 
        LEFT JOIN tbl_market_image img ON market.market_id = img.market_id
        LEFT JOIN tbl_item item ON  item.market_id = market.market_id
        LEFT JOIN tbl_customer_item_relationship item_rel ON item_rel.item_id = item.item_id
        LEFT JOIN tbl_customer_market_relationship market_rel ON market_rel.market_id = market.market_id
        GROUP BY market.market_id LIMIT 10");
        return $get_top_shop->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_contact($contact){
        $get_contact = $this->query("SELECT contact FROM tbl_contact WHERE contact = ?", [$contact]);
        return $get_contact->fetchAll(PDO::FETCH_ASSOC)[0]['contact']??null;
    }

    public function get_is_seller($cus_id){
        $get_is_seller = $this->query("SELECT market.is_verified, market.market_id FROM tbl_market market, tbl_customer cus WHERE market.customer_id = cus.customer_id AND market.is_verified = '1' AND cus.customer_id = ?", [$cus_id]);
        $seller_id = $get_is_seller->fetchAll(PDO::FETCH_ASSOC)[0]??null;
        $_SESSION['seller_id'] = $seller_id['market_id']??null;
        return $seller_id??null;
    }

    public function get_market_requests(){
        $get_market_requests = $this->query("SELECT * FROM tbl_market_request mrkt_req 
        LEFT JOIN tbl_market mrkt ON mrkt.market_id = mrkt_req.market_id WHERE 	mrkt_req.market_req_status = 'waiting_for_approval' OR mrkt.is_verified = 0");
        return $get_market_requests->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_item_live($market_id){
        $get_item_live =  $this->query("SELECT item.item_name, MIN(vari.variation_price) as min_price, SUM(vari.variation_stock) as total_stocks FROM tbl_item item
        LEFT JOIN tbl_market market ON item.market_id = market.market_id 
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE item.item_status = 'live' AND market.market_id = ?  GROUP BY item.item_id" , [$market_id]);
        return $get_item_live->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_item_sold_out($market_id){
        $get_item_sold =  $this->query("SELECT item.item_name, MIN(vari.variation_price) as min_price, SUM(vari.variation_stock) as total_stocks FROM tbl_item item
        LEFT JOIN tbl_market market ON item.market_id = market.market_id 
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE item.item_status = 'sold out' AND market.market_id = ? GROUP BY item.item_id" , [$market_id]);
        return $get_item_sold->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_item_delisted($selelr_id){
        $get_item_delisted =  $this->query("SELECT item.item_name, MIN(vari.variation_price) as min_price, SUM(vari.variation_stock) as total_stocks FROM tbl_item item
        LEFT JOIN tbl_market market ON item.market_id = market.market_id 
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE item.item_status = 'delisted' AND market.market_id = ? GROUP BY item.item_id" , [$selelr_id]);
        return $get_item_delisted->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_shop_info($selelr_id){
        $get_shop_info = $this->query("SELECT market.market_name,  market_img.market_image, SUM(market_rel.is_followed) AS follows, AVG(item_rel.rating) AS rate
        FROM tbl_market market 
        LEFT JOIN tbl_customer_market_relationship market_rel ON market_rel.market_id = market.market_id
        LEFT JOIN tbl_market_image market_img ON market_img.market_id = market.market_id
        LEFT JOIN tbl_item item ON item.market_id = market.market_id
        LEFT JOIN tbl_customer_item_relationship item_rel ON item_rel.item_id = item.item_id
        WHERE market.market_id = ?", [$selelr_id]);
        return $get_shop_info->fetchAll(PDO::FETCH_ASSOC)[0]??null;
    }

    public function get_top_items($seller_id){
        $get_top_items = $this->query("SELECT itm.item_id, itm.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
        FROM tbl_item itm
        LEFT JOIN tbl_market mrkt ON mrkt.market_id = itm.market_id
        LEFT JOIN tbl_item_img img ON itm.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = itm.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = itm.item_id
        WHERE mrkt.market_id = ?
        GROUP BY itm.item_id
        ORDER BY AVG(cus_r.rating) LIMIT 10", [$seller_id]);
        return $get_top_items->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_seller_items($seller_id){
        $get_seller_items = $this->query("SELECT itm.item_id, itm.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
        FROM tbl_item itm
        LEFT JOIN tbl_market mrkt ON mrkt.market_id = itm.market_id
        LEFT JOIN tbl_item_img img ON itm.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = itm.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = itm.item_id
        WHERE mrkt.market_id = ?
        GROUP BY itm.item_id", [$seller_id]);
        return $get_seller_items->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_category_item($category){
        $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
        FROM tbl_item item
        LEFT JOIN tbl_category category ON category.category_id = item.category_id
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE category.category = ?", [$category]);
        return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;


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
        if(!is_null($verify_seller)){
            $result = ['is_seller' => true , 'market_id' => $verify_seller['market_id']];
            $_SESSION['seller_id'] = $verify_seller['market_id'];
        }else{
            $result = ['is_seller' => false];
        }
        echo json_encode($result);
    }


    // Get top order
    // SELECT COUNT(odr.order_id) AS odr_count FROM tbl_item item 
    // LEFT JOIN tbl_variation variation ON variation.item_id = item.item_id
    // LEFT JOIN tbl_order odr ON odr.variation_id = variation.variation_id
    // WHERE odr.order_status = "completed"
    // GROUP BY item.item_id
    // ORDER BY odr_count 

?>

