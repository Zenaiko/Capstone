<?php 
require_once('db_root_conn.php');
(session_status() === PHP_SESSION_NONE)?session_start():null;

class class_accept_order_database extends class_database{
    public function __construct(){
        parent::__construct('root' , '');
    
    }

    public function accept_order($transaction_id){
        try{
            $accept_order = $this->pdo->prepare("UPDATE tbl_order odr, tbl_transaction transact 
            SET odr.order_status = 'shipping', transact.transaction_status = 'shipping'
            WHERE transact.transaction_id = odr.transaction_id
            AND transact.transaction_id = :transaction_id");
            $insert_delivery = $this->pdo->prepare("INSERT INTO tbl_delivery(transaction_id, rider_id, date_time_accepted) 
            VALUES (:transact_id, :rider_id, :date_accept)");
            $accept_order->execute([
                ":transaction_id" => $transaction_id
            ]);
            $insert_delivery->execute([
                ":transact_id" => $transaction_id, 
                ":rider_id" => $_SESSION["rider_num"], 
                ":date_accept" => date('Y-m-d H:i:s')
            ]);
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
        }
    }
}
$accept_rider_db = new class_accept_order_database();
$accept_rider_db->accept_order($_POST["transaction_id"]);
?>