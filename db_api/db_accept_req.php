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
            $accept_date = ($stat === "accepted")?date('Y-m-d H:i:s'):null;
            if($accept_date){            }
            $accept_order = $this->pdo->prepare("UPDATE tbl_order SET order_status = :stat , order_acceptance_date = :accept_date, variation_stock :stock WHERE order_id = :order_id");
            $accept_order->execute([
                ":order_id" => $order_id,
                ":stat" => $stat,
                ":accept_date" => $accept_date,
                ":stock" => "",
            ]);
    
                // $insert_stocks_movement = $this->pdo->prepare("INSERT INTO tbl_stock_movement(stock_movement, stock_id, stock_qty, stock_date) 
                // VALUES (:movement, :stock_id, :stock_qty, :stock_date)");
                // $get_stock_id = $this->query("SELECT stock.stock_id, SUM(odr.order_qty) AS order_qty
                // FROM tbl_stock stock
                // JOIN tbl_variation variation ON variation.variation_id = stock.variation_id
                // JOIN tbl_order odr ON odr.variation_id = variation.variation_id
                // WHERE odr.order_id = :order_id
                // GROUP BY stock.stock_id", [":order_id" =>$order_id]);
                // $stock_info = $get_stock_id->fetchAll(PDO::FETCH_ASSOC)[0]??null;
                // $insert_stocks_movement->execute([
                //     ":movement" => "out", 
                //     ":stock_id" => $stock_info["stock_id"], 
                //     ":stock_qty" => $stock_info["order_qty"], 
                //     ":stock_date" => date('Y-m-d H:i:s')
                // ]);

        }
    }

    $order_id = $_POST["order_id"];
    $stats = $_POST["stats"];

    $order_update_db = new class_order_update_database();

    $order_update_db->update_order_stats($order_id, $stats);
    
?>