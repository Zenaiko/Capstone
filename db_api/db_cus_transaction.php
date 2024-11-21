<?php
require_once("../db_api/db_root_conn.php");
(session_status() === PHP_SESSION_NONE)?session_start():null;

class class_customer_transaction_database extends class_database {
    public function __construct() {
        parent::__construct('root', '');
    }

    public function confirm_order($transact_id){
        $this->query("START TRANSACTION");
        try{
            $update_transaction = $this->pdo->prepare("UPDATE tbl_delivery delivery, tbl_transaction transact, tbl_order odr 
            SET delivery.delivery_status = 'recieved', transact.transaction_status = 'paid', odr.order_status = 'paid'
            WHERE delivery.delivery_status = 'delivered' AND transact.transaction_status = 'delivered' AND odr.order_status = 'delivered'
            AND delivery.transaction_id = transact.transaction_id AND odr.transaction_id = transact.transaction_id AND transact.transaction_id = :transaction_id");
            $update_transaction->execute([
                ":transaction_id" => $transact_id
            ]);

            $get_order_info = $this->query("SELECT stock.stock_id, odr.order_qty
            FROM tbl_order odr 
            JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
            JOIN tbl_variation variation ON variation.variation_id = odr.variation_id 
            JOIN tbl_stock stock ON stock.variation_id = variation.variation_id
            WHERE transact.transaction_id = :transaction_id AND odr.order_status = 'paid'
            ORDER BY odr.order_id",[":transaction_id" =>$transact_id]);
            $transaction_orders = $get_order_info->fetchAll(PDO::FETCH_ASSOC);

            $insert_stock_movement = $this->pdo->prepare("INSERT INTO tbl_stock_movement (stock_movement, stock_id, stock_qty, stock_date) 
            VALUES ('out', :stock_id, :order_qty, :stock_date)");

            foreach($transaction_orders as $order){
                $insert_stock_movement->execute([
                    ":stock_id" => $order['stock_id'],
                    ":order_qty" => $order["order_qty"],
                    ":stock_date" => date('Y-m-d H:i:s')
                ]);
            }

            $this->query("COMMIT");
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query("ROLLBACK");
        }
    }
}
$customer_transaction_db = new class_customer_transaction_database();

$action = $_POST["action"]??null;
$transaction_id = $_POST["transaction_id"]??null;
switch($action){
    case "recieve":
        $customer_transaction_db->confirm_order($transaction_id);
        break;
}
