<?php 
    require_once("../db_api/db_root_conn.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_cart_database extends class_database {
        public function __construct() {
            parent::__construct('root', '');
        }

        public function insert_tbl_cart($variant_id){
            $insert_tbl_cart = $this->pdo->prepare("INSERT INTO tbl_cart (customer_id, variant_id, item_qty) 
            VALUES (:customer_id, :variant_id, :qty)");
            $insert_tbl_cart->execute([
                ":customer_id" => $_SESSION["cus_id"], 
                ":variant_id" => $variant_id,
                ":qty" => 1
            ]);
        }
    }

    $cart_db = new class_cart_database();

    if(isset($_POST["variant_id"])){
        $cart_db->insert_tbl_cart($_POST["variant_id"]);
    };
?>