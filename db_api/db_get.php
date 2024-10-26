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
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id
        LEFT JOIN tbl_variation variation ON variation.item_id = item.item_id
        LEFT JOIN tbl_customer_item_relationship item_rel ON item_rel.item_id = item.item_id 
        LEFT JOIN tbl_order odr ON odr.variation_id = variation.variation_id AND odr.order_status = 'completed'
        GROUP BY item.item_id");
        return $get_item->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_top_shop(){
        $get_top_shop = $this->query("SELECT market.market_id, market.market_name, img.market_image, COUNT(item_rel.rating) AS respondents 
        FROM tbl_market market 
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

    public function get_shop_info($selelr_id){
        $get_shop_info = $this->query("WITH market_follows AS (SELECT market_id, SUM(is_followed) AS follows FROM tbl_customer_market_relationship),
        item_ratings AS (SELECT market_id, AVG(rating) AS rate FROM tbl_item JOIN tbl_customer_item_relationship ON tbl_item.item_id = tbl_customer_item_relationship.item_id)
        SELECT 
        market.market_id, 
        market.market_name, 
        market_img.market_image, 
        COALESCE(follow.follows, 0) AS follows, 
        COALESCE(rating.rate, 0) AS rate
        FROM tbl_market market 
        LEFT JOIN market_follows follow ON follow.market_id = market.market_id
        LEFT JOIN tbl_market_image market_img ON market_img.market_id = market.market_id
        LEFT JOIN item_ratings rating ON rating.market_id = market.market_id
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

    public function get_seller_items($seller_id, $type){
        $get_seller_items = $this->pdo->prepare("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_rel.rating) AS avg_rate, SUM(odr.order_qty) AS total_orders
        FROM tbl_item item
        LEFT JOIN tbl_market market ON market.market_id = item.market_id
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_rel ON cus_rel.item_id = item.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        LEFT JOIN tbl_order odr ON odr.variation_id AND odr.order_status = 'completed'
        WHERE market.market_id = :seller_id
        GROUP BY item.item_id
        ORDER BY :order");
        switch($type){
            case "popular":
                $order = "total_orders"; 
                break;
            case "latest":
                $order = "item.date_added"; 
                break;
            case "top_sales":
                $order = "avg_rate"; 
                break;
            default:
                $order = "total_orders";
        }
        $get_seller_items->execute([
            ":seller_id" => $seller_id,
            ":order" => $order
        ]);
        return $get_seller_items->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_category_item($category){
        $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
        FROM tbl_item item
        LEFT JOIN tbl_category category ON category.category_id = item.category_id
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE category.category = ?
        GROUP BY item.item_id", [$category]);
        return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_top_selling_items($seller_id){
        $get_top_selling_items = $this->query("SELECT item.item_name, img.item_img, SUM(odr.order_qty) AS total_sold, SUM(odr.order_price) AS total_income FROM tbl_item item 
        LEFT JOIN tbl_market market ON market.market_id = item.market_id
        LEFT JOIN tbl_variation variation ON variation.item_id = item.item_id
        LEFT JOIN tbl_order odr ON odr.variation_id = variation.variation_id
        LEFT JOIN tbl_item_img img ON img.item_id = item.item_id
        WHERE market.market_id = ? 
        GROUP BY item.item_id
        ORDER BY total_income DESC
        LIMIT 10", [$seller_id]);
        return $get_top_selling_items->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_item_status($seller_id, $status){
        $get_item_status =  $this->query("SELECT item.item_id, item.item_name, MIN(vari.variation_price) as min_price, SUM(vari.variation_stock) as total_stocks, item_img.item_img
        FROM tbl_item item
        LEFT JOIN tbl_market market ON item.market_id = market.market_id 
        LEFT JOIN tbl_item_img item_img ON item_img.item_id = item.item_id AND item_img.item_img = (SELECT item_img FROM tbl_item_img, tbl_item item WHERE item.item_id = item_img.item_id LIMIT 1)
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE item.item_status = :status AND market.market_id = :market_id
        GROUP BY item.item_id
        ORDER BY item.item_id" , 
        [
            ":status" => $status, 
            ":market_id" => $seller_id
        ]);
        return $get_item_status->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_address($customer_id){
        $get_address = $this->query("SELECT pickup.customer_pickup_id, pickup.pickup_name, pickup.recipient_name, contact.contact, pickup.is_default, CONCAT_WS(',' , address.city, address.street, address.brngy, address.house_unit_number) AS 'full_addres'  
        FROM tbl_address address, tbl_contact contact, tbl_customer_pickup pickup, tbl_customer customer
        WHERE address.address_id = pickup.address_id AND pickup.customer_id = customer.customer_id AND contact.contact_id = pickup.contact_id AND customer.customer_id = ?", [$customer_id]);
        return $get_address->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_cart($cus_id){
        $get_cart = $this->query("SELECT market.market_id, market.market_name, item.item_name, variation.variation_id, variation.variation_name, cart.item_qty, (variation.variation_price * cart.item_qty) AS cart_price FROM
        tbl_cart cart, tbl_variation variation, tbl_item item, tbl_market market 
        WHERE cart.variant_id = variation.variation_id 
        AND variation.item_id = item.item_id 
        AND item.market_id = market.market_id
        AND  cart.customer_id = ?
        ORDER BY market.market_id" , [$cus_id]);
        return  $get_cart->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_customer_orders($cus_id, $order_type){
        $get_customer_orders = $this->query("SELECT odr.order_id, odr.order_qty , odr.order_price, variation.variation_name
        FROM tbl_order odr, tbl_variation variation, tbl_item item
        WHERE variation.variation_id = odr.variation_id AND item.item_id = variation.variation_id AND odr.order_status = :status AND odr.customer_id = :customer_id
        GROUP BY odr.order_id ORDER BY odr.date_requested", [":customer_id" => $cus_id, ":status" => $order_type]);

        return  $get_customer_orders->fetchAll(PDO::FETCH_ASSOC)??null;
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

?>

