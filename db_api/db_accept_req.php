<?php 
    require_once("../db_api/db_root_conn.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_order_update_database extends class_database {
        public function __construct() {
            parent::__construct('root', '');
        }

        public function update_order_stats($order_id, $stat){
            $accept_order = $this->pdo->prepare("UPDATE tbl_order SET order_status = :stat WHERE order_id = :order_id");
            $accept_order->execute([
                ":order_id" => $order_id,
                ":stat" => $stat
            ]);
        }
    }

    $order_id = $_POST["order_id"];
    $stats = $_POST["stats"];

    $order_update_db = new class_order_update_database();

    $order_update_db->update_order_stats($order_id, $stats);
    
?>