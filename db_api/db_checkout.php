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
        $curr_var_info = $this->order_info->get_variant_info();
        $updated_variants = []; // To store updated variant info

        foreach ($curr_var_info as $variant_info) {
            $get_variant_info = $this->query("
                SELECT variation.variation_name, variation.variation_price
                FROM tbl_variation variation 
                WHERE variation.variation_id = :var_id", [":var_id" => $variant_info["id"]]);

            $indiv_variant_info = $get_variant_info->fetch(PDO::FETCH_ASSOC);

            // Check if the variant info was found
            if ($indiv_variant_info) {
                $updated_variants[] = [
                    "id" => $variant_info["id"],
                    "name" => $indiv_variant_info["variation_name"],
                    "price" => $indiv_variant_info["variation_price"],
                ];
            } else {
                // If not found, retain the original structure with null values
                $updated_variants[] = [
                    "id" => $variant_info["id"],
                    "name" => null,
                    "price" => null,
                ];
            }
        }

        // Update the order_info with the new variant details
        $this->order_info->set_variant_info($updated_variants);
    }

    public function set_order_request() {
        $qty_array = $_POST["order_qty"];
        
        var_dump($this->order_info->get_variant_info());
        $this->query("START TRANSACTION");
        foreach ($this->order_info->get_variant_info() as $variant) {
            $insert_tbl_order = $this->pdo->prepare("INSERT INTO tbl_order (variation_id, order_qty, order_price, customer_id) 
            VALUES (:var_id, :qty, :price, :customer_id)");
            $insert_tbl_order->execute([
                ":var_id" => $variant["id"],
                ":qty" => $qty_array[$variant["id"]],
                ":price" => ($variant["price"] * $qty_array[$variant["id"]]),
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
    private $item_id;
    private $cus_address_id;

    public function set_item_id($item_id) {
        $this->item_id = $item_id;
    }

    public function get_item_id() {
        return $this->item_id;
    }

    public function set_variant_id($variant_info) {
        $this->variant_info[] = [
            "id" => $variant_info,
            "name" => "",
            "price" => "",
        ];
    }

    public function set_variant_info($variant_info) {
        $this->variant_info = $variant_info;
    }

    public function get_variant_info() {
        return $this->variant_info;
    }

    public function get_order_ids() {
        return array_keys($this->variant_info);
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
$order_info->set_item_id($_POST["item_order"]);
foreach ($_POST["variant_order"] as $var_id) {
    $order_info->set_variant_id($var_id);
}

// Fetch and display variant info
$order_db->get_variant_info();

// Process the order submission
if (isset($_POST["order_submit"])){
    $order_db->set_order_request();
    exit;
}
?>
