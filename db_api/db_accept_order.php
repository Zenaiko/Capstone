<?php 
require_once('db_root_conn.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;

class class_accept_order_database extends class_database{
    public function __construct(){
        parent::__construct('root' , '');
    
    }

    public function accept_order($transaction_id){
        $this->query("START TRANSACTION");
        try{
            $accept_order = $this->pdo->prepare("UPDATE tbl_order odr, tbl_transaction transact 
            SET odr.order_status = 'shipping', transact.transaction_status = 'shipping'
            WHERE transact.transaction_id = odr.transaction_id AND odr.order_status = 'prepared'
            AND transact.transaction_id = :transaction_id");
            $insert_delivery = $this->pdo->prepare("INSERT INTO tbl_delivery(transaction_id, rider_id, date_time_accepted) 
            VALUES (:transact_id, :rider_id, :date_accept)");
            $accept_order->execute([
                ":transaction_id" => $transaction_id
            ]);
            $insert_delivery->execute([
                ":transact_id" => $transaction_id, 
                ":rider_id" => $_SESSION["rider_num"], 
                ":date_accept" => date('Y-m-d H:i:s'),
            ]);
            $this->query("COMMIT");
            echo "success";
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            echo "fail";
        }
        exit;
    }

    public function transaction_delivered($transaction_id){
        $this->query("START TRANSACTION");
        try{
            $update_transacton = $this->pdo->prepare("UPDATE tbl_order odr, tbl_transaction transact, tbl_delivery delivery
            SET odr.order_status = 'delivered', transact.transaction_status = 'delivered', delivery.delivery_status = 'delivered', delivery.date_time_delivered = :date_delivered 
            WHERE odr.transaction_id = transact.transaction_id AND transact.transaction_id = delivery.transaction_id
            AND odr.order_status = 'shipping' AND transact.transaction_status = 'shipping' AND delivery.delivery_status = 'in_transit'
            AND transact.transaction_id = :transaction_id");

            $update_transacton->execute([
                ":transaction_id" => $transaction_id,
                ":date_delivered" => date('Y-m-d H:i:s'),
            ]);
            echo "success";

            $this->query("COMMIT");
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            echo "fail";
        }
        exit;
    }
}
$accept_rider_db = new class_accept_order_database();
$action = $_POST["action"];
switch ($action){
    case "shipping":
        $accept_rider_db->accept_order($_POST["transaction_id"]);
        break;
    case "delivered":
        $accept_rider_db->transaction_delivered($_POST["transaction_id"]);
        break;
}
?>