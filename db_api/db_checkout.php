<?php 
require_once("db_root_conn.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class class_order_database extends class_database {
    private $order_info;

    public function __construct(class_order_info $order_info) {
        parent::__construct('root', '');
        $this->order_info = $order_info;
    }

    public function get_variant_info() {
        $curr_var_info = $this->order_info->get_varaint_info();
        $updated_variants = []; // To store updated variant info

        foreach ($curr_var_info as $variant_info){
            $get_variant_info = $this->query("SELECT variation.variation_name, variation.variation_price
            FROM tbl_variation variation 
            WHERE variation.variation_id = :var_id", [":var_id" => $variant_info["id"]]);
            $indiv_variant_info = $get_variant_info->fetch(PDO::FETCH_ASSOC);
            // Check if the variant info was found
            if ($indiv_variant_info) {
                $updated_variants = [
                    "id" => $variant_info["id"],
                    "name" => $indiv_variant_info["variation_name"],
                    "price" => $indiv_variant_info["variation_price"],
                    "qty" => $variant_info["qty"],
                ];
            } else {
                // If not found, retain the original structure with null values
                $updated_variants = [
                    "id" => $variant_info["id"],
                    "name" => null,
                    "price" => null,
                    "qty" => $variant_info["qty"],
                ];
            }
        }

        // Update the order_info with the new variant details
        $this->order_info->set_order_info($updated_variants);
    }

    public function set_order_request() {
        $this->query("START TRANSACTION");
        foreach ($this->order_info->get_order_info() as $variant) {
            $insert_tbl_order = $this->pdo->prepare("INSERT INTO tbl_order (variation_id, order_qty, order_price, customer_id) 
            VALUES (:var_id, :qty, :price, :customer_id)");
            $insert_tbl_order->execute([
                ":var_id" => $variant["id"],
                ":qty" => $variant["qty"],
                ":price" => ($variant["price"] * $variant["qty"]),
                ":customer_id" => $_SESSION["cus_id"]
            ]);
        }
        $this->query("COMMIT");
        header("location: ../user_page/home.php");
        return;
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

// Initialize order info and database classes
$order_info = new class_order_info();
$order_db = new class_order_database($order_info);


// Set item info from POST data
if(isset($_POST["variant_order"])){
    foreach ($_POST["variant_order"] as $var_id => $qty) {
        $order_info->set_variant_info($var_id, $qty["qty"]);
    }
}

// Fetch and display variant info
$order_db->get_variant_info();


   // Process the order submission
   if (isset($_POST["order_submit"]) ){
    $order_db->set_order_request();
    exit;
    }

?>

