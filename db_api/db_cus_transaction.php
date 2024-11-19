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
