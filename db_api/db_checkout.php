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
        $get_variant_info = $this->pdo->prepare("SELECT item.item_name, variation.variation_name, variation.variation_price
        FROM tbl_variation variation, tbl_item item
        WHERE variation.item_id = item.item_id
        AND variation.variation_id = :var_id");

        foreach ($curr_var_info as $variant_info){
            $get_variant_info->execute([
                ":var_id" => $variant_info["id"],
            ]);
            $indiv_variant_info = $get_variant_info->fetch(PDO::FETCH_ASSOC);

            // Check if the variant info was found
            if ($indiv_variant_info) {
                $updated_variants = [
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
        $get_pickup_info = $this->pdo->prepare("SELECT pickup.customer_pickup_id, pickup.pickup_name, pickup.recipient_name, pickup.is_default, CONCAT(address.city, ', ', address.street, ', ',address.brngy, ', ', address.house_unit_number) AS full_address, contact.contact
        FROM tbl_customer_pickup pickup, tbl_address address, tbl_contact contact
        WHERE address.address_id = pickup.address_id AND contact.contact_id = pickup.contact_id AND pickup.customer_id = :customer_id");
        $get_pickup_info->execute([
            ":customer_id" => $_SESSION['cus_id']
        ]);
        $default_address = $get_pickup_info->fetch(PDO::FETCH_ASSOC)??null;

        $this->pickup_info->set_pickup_id($default_address["customer_pickup_id"]??null);
        $this->pickup_info->set_pickup_name($default_address["pickup_name"]??null);
        $this->pickup_info->set_recipient($default_address["recipient_name"]??null);
        $this->pickup_info->set_contact($default_address["contact"]??null);
        $this->pickup_info->set_full_address($default_address["full_address "]??null);
        return $default_address;
    }

    public function set_order_request() {
        $this->query("START TRANSACTION");
        foreach ($this->order_info->get_order_info() as $variant) {
            $insert_tbl_order = $this->pdo->prepare("INSERT INTO tbl_order (variation_id, order_qty, order_price, customer_id, pickup_id, date_requested) 
            VALUES (:var_id, :qty, :price, :customer_id, :pickup_id, :date_req)");
            $insert_tbl_order->execute([
                ":var_id" => $variant["id"],
                ":qty" => $variant["qty"],
                ":price" => ($variant["price"] * $variant["qty"]),
                ":customer_id" => $_SESSION["cus_id"],
                ":pickup_id" => $_POST["pickup_id"],
                ":date_req" =>  date('Y-m-d H:i:s'),
            ]);
        }
        $this->query("COMMIT");
        if(isset($_POST["order_submit"])){
            header("location: ../user_page/home.php");
        }
        exit;
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
    // Fetch and display variant info
    $order_db->get_pickup_info();
}

   // Process the order submission
   if (isset($_POST["order_submit"])){
    $order_db->set_order_request();
    exit;
    }

?>

