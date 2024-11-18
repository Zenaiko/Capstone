<?php 
require_once("db_root_conn.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class class_order_database extends class_database {
    private $order_info;
    private $pickup_info;

    public function __construct(class_order_info $order_info, class_user_pickup $pickup_info){
        parent::__construct('root', '');
        $this->order_info = $order_info;
        $this->pickup_info = $pickup_info;
    }

    public function get_order() {
        $curr_var_info = $this->order_info->get_varaint_info();
        $updated_variants = []; // To store updated variant info
        $get_variant_info = $this->pdo->prepare("SELECT market.market_id, item.item_name, variation.variation_name, variation.variation_price
        FROM tbl_variation variation, tbl_item item, tbl_market market
        WHERE variation.item_id = item.item_id AND market.market_id = item.market_id
        AND variation.variation_id = :var_id");

        foreach ($curr_var_info as $variant_info){
            $get_variant_info->execute([
                ":var_id" => $variant_info["id"],
            ]);
            $indiv_variant_info = $get_variant_info->fetch(PDO::FETCH_ASSOC);

            // Check if the variant info was found
            if ($indiv_variant_info) {
                $updated_variants = [
                    "market_id" => $indiv_variant_info["market_id"],
                    "id" => $variant_info["id"],
                    "item_name" => $indiv_variant_info["item_name"],
                    "name" => $indiv_variant_info["variation_name"],
                    "price" => $indiv_variant_info["variation_price"],
                    "qty" => $variant_info["qty"],
                ];
            } else {
                // If not found, retain the original structure with null values
                $updated_variants = [
                    "id" => $variant_info["id"],
                    "item_name" => $indiv_variant_info["item_name"],
                    "name" => null,
                    "price" => null,
                    "qty" => $variant_info["qty"],
                ];
            }
        }
        // Update the order_info with the new variant details
        $this->order_info->set_order_info($updated_variants);
    }

    public function get_pickup_info(){
        // Gets the user pickup address info
        $get_pickup_info = $this->query("SELECT pickup.customer_pickup_id, pickup.pickup_name, pickup.recipient_name, pickup.is_default, CONCAT_WS(', ', address.city, address.street, address.brngy, address.house_unit_number) AS full_address, contact.contact
        FROM tbl_customer_pickup pickup, tbl_address address, tbl_contact contact
        WHERE address.address_id = pickup.address_id AND contact.contact_id = pickup.contact_id AND pickup.customer_id = :customer_id 
        ORDER BY pickup.is_default DESC" , [":customer_id" => $_SESSION['cus_id']]);

        $customer_address = $get_pickup_info->fetchAll(PDO::FETCH_ASSOC)??null;

        $this->pickup_info->set_pickup_list($customer_address);
        $this->pickup_info->set_pickup_id($customer_address[0]["customer_pickup_id"]??null);
        $this->pickup_info->set_pickup_name($customer_address[0]["pickup_name"]??null);
        $this->pickup_info->set_recipient($customer_address[0]["recipient_name"]??null);
        $this->pickup_info->set_contact($customer_address[0]["contact"]??null);
        $this->pickup_info->set_full_address($customer_address[0]["full_address"]??null);
    }

    public function set_order_request() {
        $this->query("START TRANSACTION");
        try{
            $market_ids =[];
            $insert_tbl_transaction = $this->pdo->prepare("INSERT INTO tbl_transaction(customer_id, delivery_id) VALUES (:customer_id, :delivery_id)");
            $insert_tbl_order = $this->pdo->prepare("INSERT INTO tbl_order(transaction_id, variation_id, order_qty, order_price, date_requested) 
            VALUES (:transaction_id, :var_id, :qty, :price, :date_req)");
            foreach ($this->order_info->get_order_info() as $variant){
                if(!in_array($variant["market_id"], $market_ids)){        
                    $insert_tbl_transaction->execute([
                        ":customer_id" => $_SESSION["cus_id"],
                        ":delivery_id" => $this->order_info->get_cus_address_id(),
                    ]);
                    $transaction_id = $this->pdo->lastInsertId();
                }else{
                    array_push($market_ids, $variant["market_id"]);
                }
                $insert_tbl_order->execute([
                    "transaction_id" => $transaction_id,
                    ":var_id" => $variant["id"],
                    ":qty" => $variant["qty"],
                    ":price" => ($variant["price"] * $variant["qty"]),
                    ":date_req" =>  date('Y-m-d H:i:s'),
                ]);
            }
            $this->query("COMMIT");
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query("ROLLBACK");
        }
        header("location: ../user_page/home.php");  
    }
}

class class_order_info {
    private $variant_info = [];
    private $order_info = [];
    private $cus_address_id;

    public function set_variant_info($variant_info, $qty) {
        $this->variant_info[] = [
            "id" => $variant_info,
            "name" => "",
            "price" => "",
            "qty" => $qty,
        ];
    }

    public function set_order_info($order_info) {
        array_push($this->order_info , $order_info);
    }

    public function get_order_info() {
        return $this->order_info;
    }

    public function get_varaint_info() {
        return $this->variant_info;
    }

    public function set_cus_address_id($cus_address_id) {
        $this->cus_address_id = $cus_address_id;
    }

    public function get_cus_address_id() {
        return $this->cus_address_id;
    }
}


class class_user_pickup{
    private $pickup_id;
    private $pickup_name;
    private $recipient;
    private $contact;
    private $full_address;
    private $pickup_list;

    // Setter for pickup_id
    public function set_pickup_id($pickup_id) {
        $this->pickup_id = $pickup_id;
    }

    // Getter for pickup_name
    public function get_pickup_id() {
        return $this->pickup_id;
    }

    // Setter for pickup_name
    public function set_pickup_name($pickup_name) {
        $this->pickup_name = $pickup_name;
    }

    // Getter for pickup_name
    public function get_pickup_name() {
        return $this->pickup_name;
    }

    // Setter for recipient
    public function set_recipient($recipient) {
        $this->recipient = $recipient;
    }

    // Getter for recipient
    public function get_recipient() {
        return $this->recipient;
    }

    // Setter for contact
    public function set_contact($contact) {
        $this->contact = $contact;
    }

    // Getter for contact
    public function get_contact() {
        return $this->contact;
    }

    // Setter for city
    public function set_full_address($full_address) {
        $this->full_address = $full_address;
    }

    // Getter for city
    public function get_full_address() {
        return $this->full_address;
    }

    // Setter for city
    public function set_pickup_list($pickup_list) {
        $this->pickup_list = $pickup_list;
    }

    // Getter for city
    public function get_pickup_list() {
        return $this->pickup_list;
    }

}

// Initialize order info and database classes
$order_info = new class_order_info();
$pickup_info = new class_user_pickup();
$order_db = new class_order_database($order_info,$pickup_info);


// Set item info from POST data
if(isset($_POST["variant_order"])){
    foreach ($_POST["variant_order"] as $var_id => $qty) {
        $order_info->set_variant_info($var_id, $qty["qty"]);
        $order_db->get_order();
    }
    // Fetch and display pickup info
    $order_db->get_pickup_info();
}

// Process the order submission
if (isset($_POST["order_submit"])){
$order_info->set_cus_address_id($_POST["pickup_id"]);
$order_db->set_order_request();
exit;
}

?>

