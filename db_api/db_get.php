<?php require_once('db_root_conn.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;
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
        $get_contact = $this->query("SELECT contact.contact FROM tbl_contact contact, tbl_user user, tbl_username username, tbl_customer customer WHERE contact.contact_id = user.contact_id AND user.user_id = username.user_id AND username.username_id = customer.username_id AND contact.contact = ?", [$contact]);
        return $get_contact->fetchAll(PDO::FETCH_ASSOC)[0]['contact']??null;
    }

     public function get_rider_contact($contact){
        $get_contact = $this->query("SELECT contact 
        FROM tbl_contact contact, tbl_user user, tbl_username username, tbl_employee_registration employee
        WHERE contact.contact_id = user.contact_id AND username.user_id = user.user_id AND username.username_id = employee.username_id AND contact = ?", [$contact]);
        return $get_contact->fetchAll(PDO::FETCH_ASSOC)[0]['contact']??null;
    }

    public function get_is_seller($cus_id){
        $get_is_seller = $this->query("SELECT market.is_verified, market.market_id
        FROM tbl_market market 
        JOIN tbl_customer customer ON market.customer_id = customer.customer_id
        WHERE customer.customer_id = ?", [$cus_id]);
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
    public function search_item($search){
        $search = "{$search}%";
        if(isset($_GET["category"])){
        $category = $_GET["category"];
        $search_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
        FROM tbl_item item
        LEFT JOIN tbl_category category ON category.category_id = item.category_id
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE item.item_name LIKE ?
        GROUP BY item.item_id", [$search]);
        return $search_item->fetchAll(PDO::FETCH_ASSOC)??null;
        }
        else{
            $search_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
            FROM tbl_item item
            LEFT JOIN tbl_category category ON category.category_id = item.category_id
            LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
            LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
            LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
            WHERE item.item_name LIKE ?
            GROUP BY item.item_id", [$search]);
            return $search_item->fetchAll(PDO::FETCH_ASSOC)??null;
            }
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

    public function get_category_item_filtered($category,$lowerprice,$higherprice,$sort){
       if($sort==='highest'&&$lowerprice===''&&$higherprice===''){
       $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
        FROM tbl_item item
        LEFT JOIN tbl_category category ON category.category_id = item.category_id
        LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
        LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
        LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
        WHERE category.category = ?
        GROUP BY item.item_id
        ORDER BY vari.variation_price DESC", [$category]);
        return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;
       }
       else if($sort==='lowest'&&$lowerprice===''&&$higherprice===''){
        $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
         FROM tbl_item item
         LEFT JOIN tbl_category category ON category.category_id = item.category_id
         LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
         LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
         LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
         WHERE category.category = ?
         GROUP BY item.item_id
         ORDER BY vari.variation_price ASC"
         , [$category]);
         return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;
        }
        else if($sort===''&&$lowerprice!=''&&$higherprice!=''){
            $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
             FROM tbl_item item
             LEFT JOIN tbl_category category ON category.category_id = item.category_id
             LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
             LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
             LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
             WHERE category.category = ? AND vari.variation_price BETWEEN ? AND ?
             GROUP BY item.item_id"
             , [$category,$lowerprice,$higherprice]);
             return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;
            }
        else if($sort==='lowest'&&$lowerprice!=''&&$higherprice!=''){
            $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
            FROM tbl_item item
            LEFT JOIN tbl_category category ON category.category_id = item.category_id
            LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
            LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
            LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
            WHERE category.category = ? AND vari.variation_price BETWEEN ? AND ?
            GROUP BY item.item_id
            ORDER BY vari.variation_price ASC"
            , [$category,$lowerprice,$higherprice]);
            return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;
            }
        else if($sort==='highest'&&$lowerprice!=''&&$higherprice!=''){
                $get_category_item = $this->query("SELECT item.item_id, item.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
                FROM tbl_item item
                LEFT JOIN tbl_category category ON category.category_id = item.category_id
                LEFT JOIN tbl_item_img img ON item.item_id = img.item_id 
                LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = item.item_id
                LEFT JOIN tbl_variation vari ON vari.item_id = item.item_id
                WHERE category.category = ? AND vari.variation_price BETWEEN ? AND ?
                GROUP BY item.item_id
                ORDER BY vari.variation_price DESC"
                , [$category,$lowerprice,$higherprice]);
                return $get_category_item->fetchAll(PDO::FETCH_ASSOC)??null;
                }
        else{
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
        JOIN tbl_market market ON item.market_id = market.market_id 
        LEFT JOIN tbl_item_img item_img ON item_img.item_id = item.item_id AND item_img.item_img = (SELECT item_img FROM tbl_item_img LIMIT 1)
        JOIN tbl_variation vari ON vari.item_id = item.item_id
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
        FROM tbl_customer_pickup pickup
        JOIN tbl_address address ON address.address_id = pickup.address_id
        JOIN tbl_contact contact ON contact.contact_id = pickup.contact_id
        JOIN tbl_customer customer ON customer.customer_id = pickup.customer_id 
        WHERE customer.customer_id = ?", [$customer_id]);
        return $get_address->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_cart($cus_id){
        $get_cart = $this->query("SELECT market.market_id, market.market_name, item.item_name, variation.variation_id, variation.variation_name, cart.item_qty, (variation.variation_price * cart.item_qty) AS cart_price, item_img.item_img
        FROM tbl_cart cart, tbl_variation variation, tbl_item item, tbl_market market, tbl_item_img item_img
        WHERE cart.variant_id = variation.variation_id 
        AND variation.item_id = item.item_id 
        AND item.market_id = market.market_id
        AND item.item_id = item_img.item_id
        AND item_img.item_img = (SELECT item_img.item_img FROM tbl_item_img item_img, tbl_item item WHERE item.item_id = item_img.item_id LIMIT 1)
        AND cart.cart_status = 'cart'
        AND  cart.customer_id = ?
        ORDER BY market.market_id" , [$cus_id]);
        return  $get_cart->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_customer_orders($cus_id){
        $get_customer_orders = $this->query("SELECT odr.order_id, item.item_name, variation.variation_name, odr.order_qty, odr.order_price
        FROM tbl_order odr
        JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id = item.market_id
        WHERE odr.order_status = 'requesting' AND transact.customer_id = :customer_id", [":customer_id" => $cus_id]);
        return  $get_customer_orders->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_customer_transaction($cus_id, $status){
        $customer_transaction_qry = ("SELECT transact.transaction_id, transact.del_fee, transact.total_transaction_amt, transact.transaction_status, pickup.recipient_name, CONCAT_WS(', ',address.city, address.street, address.brngy, address.house_unit_number) AS customer_address
        FROM tbl_transaction transact
        JOIN tbl_customer_pickup pickup ON pickup.customer_pickup_id = transact.delivery_id
        JOIN tbl_address address ON address.address_id = pickup.address_id
        WHERE transact.customer_id = :customer_id");

        $get_transaction_orders_qry = ("SELECT item.item_name, variaiton.variation_name, odr.order_qty, odr.order_price
        FROM tbl_variation variaiton
        JOIN tbl_item item ON item.item_id = variaiton.item_id
        JOIN tbl_order odr ON odr.variation_id = variaiton.variation_id
        JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id 
        WHERE transact.transaction_id = :transaction_id");

        switch ($status){
            case "accepted":
                $customer_transaction_qry.= (" AND (transact.transaction_status = 'preparing' OR transact.transaction_status = 'prepared')");
                $get_transaction_orders_qry.= (" AND odr.order_status = 'accepted'");
                break;
            case "shipping":
                $customer_transaction_qry.= (" AND transact.transaction_status = 'shipping'");
                $get_transaction_orders_qry.= (" AND odr.order_status = 'shipping'");
                break;
            case "delivered":
                $customer_transaction_qry.= (" AND transact.transaction_status = 'delivered' ");
                $get_transaction_orders_qry.= (" AND odr.order_status= 'delivered'");
                break;
            case "paid":
                $customer_transaction_qry.= (" AND transact.transaction_status = 'paid'");
                $get_transaction_orders_qry.= (" AND odr.order_status = 'paid'");
                break;
        }
        
        // Finalizes and queries the customer's transaction
        $customer_transaction_qry .= (" GROUP BY transact.transaction_id");
        $get_customer_transaction = $this->query($customer_transaction_qry,[":customer_id" => $cus_id]);
        $transaction_info = $get_customer_transaction->fetchAll(PDO::FETCH_ASSOC)??null;

        // Finalizes the transaction's order/s
        $get_transaction_orders_qry.= (" GROUP BY transact.transaction_id ");
        $get_transaction_orders = $this->pdo->prepare($get_transaction_orders_qry);

        // Queries each transaction's orders and assign them associatively
        foreach($transaction_info as $key => $transact){
            $get_transaction_orders->execute([":transaction_id" => $transact["transaction_id"]]);
            $order = $get_transaction_orders->fetchAll(PDO::FETCH_ASSOC)??null;
            $transaction_info[$key]["orders"] = $order;
        }

        return $transaction_info;
    }

    public function get_rider_request(){
        $get_rider_request = $this->query("SELECT * FROM tbl_employee_registration emp_reg
        LEFT JOIN tbl_rider_registration rider_reg ON rider_reg.employee_registration_id = emp_reg.employee_registration_id
        LEFT JOIN tbl_username username ON username.username_id = emp_reg.username_id
        WHERE rider_reg.employee_registration_id = emp_reg.employee_registration_id AND 
        emp_reg.registration_status = 'requesting'
        GROUP BY emp_reg.employee_registration_id");
        return  $get_rider_request->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_all_orders(){
        $get_all_orders = $this->query("SELECT transact.transaction_id, pickup.recipient_name, market.market_name, CONCAT_WS(', ' , market_adr.city, market_adr.street, market_adr.brngy, market_adr.house_unit_number) AS market_adr, CONCAT_WS(', ' , customer_adr.city, customer_adr.street, customer_adr.brngy, customer_adr.house_unit_number) AS customer_adr, market_contact.contact AS market_contact, customer_contact.contact as customer_contact, customer.customer_id
        -- For Market Info
        FROM tbl_transaction transact 
        JOIN tbl_order odr ON odr.transaction_id = transact.transaction_id 
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id = item.market_id
        JOIN tbl_address market_adr ON  market_adr.address_id = market.address_id
        LEFT JOIN tbl_contact market_contact ON market_contact.contact_id = market.contact_id
        -- For Customer Info
        JOIN tbl_customer customer ON customer.customer_id = transact.customer_id
        JOIN tbl_customer_pickup pickup ON transact.delivery_id = pickup.customer_pickup_id
        JOIN tbl_address customer_adr ON customer_adr.address_id = pickup.address_id
        JOIN tbl_contact customer_contact ON customer_contact.contact_id = pickup.contact_id
        WHERE transact.transaction_status = 'prepared' 
        GROUP BY transact.transaction_id");
        return  $get_all_orders->fetchAll(PDO::FETCH_ASSOC)??null;
    }

    public function get_active_delivery($rider_id){
        $get_rider_delivery = $this->query("SELECT delivery.rider_id, market.market_name, CONCAT_WS(', ', market_address.city, market_address.street, market_address.brngy, market_address.house_unit_number) AS market_address, market_contact.contact AS market_contact, pickup.recipient_name, CONCAT_WS(', ', customer_address.city, customer_address.street, customer_address.brngy, customer_address.house_unit_number) AS customer_address, customer_contact.contact AS customer_contact
        FROM tbl_delivery delivery
        JOIN tbl_transaction transact ON transact.transaction_id = delivery.transaction_id
        JOIN tbl_order odr ON odr.transaction_id = transact.transaction_id
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id = item.market_id
        LEFT JOIN tbl_contact market_contact ON market_contact.contact_id = market.contact_id
        LEFT JOIN tbl_address market_address ON market_address.address_id = market.address_id
        JOIN tbl_customer customer ON customer.customer_id = transact.customer_id
        JOIN tbl_username username ON username.username_id = customer.username_id
        JOIN tbl_user usr ON usr.user_id = username.user_id
        JOIN tbl_contact customer_contact ON customer_contact.contact_id = usr.contact_id
        JOIN tbl_customer_pickup pickup ON pickup.customer_id = customer.customer_id
        JOIN tbl_address customer_address ON customer_address.address_id = pickup.address_id
        WHERE transact.transaction_status = 'shipping' AND delivery.rider_id = :rider_id
        GROUP BY delivery.delivery_id", [":rider_id" => $rider_id]);
        return $get_rider_delivery->fetchAll(PDO::FETCH_ASSOC)[0]??null;
    }

    public function active_delivery_info($rirder_id){
        $active_delivery_info = $this->query("SELECT item.item_name, variaiton.variation_name, odr.order_qty, odr.order_price, transact.total_transaction_amt
        FROM tbl_variation variaiton
        JOIN tbl_item item ON item.item_id = variaiton.item_id
        JOIN tbl_order odr ON odr.variation_id = variaiton.variation_id
        JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
        JOIN tbl_delivery delivery ON delivery.transaction_id = transact.transaction_id
        AND delivery.rider_id = :rider_id", [":rider_id" => $rirder_id]);
        return $active_delivery_info->fetchAll(PDO::FETCH_ASSOC)??null;
    }
}

$get_db = new class_get_database();
$category_array = $get_db->get_category();

    $data = json_decode(file_get_contents("php://input"), true);

    if(isset($data['otp_number']) && $data['action'] === 'get_number'){
        if(isset($data['user']) && $data['user'] !== "rider"){
            $verify_otp = $get_db->get_contact($data['otp_number']);
        }else{
            $verify_otp = $get_db->get_rider_contact($data['otp_number']);
        }
        // Returns if contact exists or not
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
            $result = ["seller_requested" => true, 'is_verified' => $verify_seller["is_verified"]];
            ($verify_seller["is_verified"])? $_SESSION['seller_id'] = $verify_seller['market_id']:null;
        }else{
            $result = ['seller_requested' => false];
        }
        echo json_encode($result);
    }

?>

