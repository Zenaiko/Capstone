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
            WHERE transact.transaction_id = odr.transaction_id AND odr.order_status = 'accepted' AND transact.transaction_status = 'prepared'
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

    public function confirm_payment($transaction_id, $file){
        $this->query("START TRANSACTION");
        try{
            $employee_dir_qry = $this->query("SELECT employee_reg.employee_dir
            FROM tbl_employee_registration employee_reg
            JOIN tbl_employee employee ON employee.employee_registration_id = employee_reg.employee_registration_id 
            WHERE employee.employee_id = :rider_id", [":rider_id" => $_SESSION["rider_num"]]);
            $employee_dir = $employee_dir_qry->fetchAll(PDO::FETCH_ASSOC)[0]["employee_dir"]??null;

            if(is_dir($employee_dir)){
                $file_dir = $employee_dir."/".$file["name"];
                move_uploaded_file($file["tmp_name"], $file_dir);
                $confirm_payment = $this->pdo->prepare("UPDATE tbl_transaction SET remittance_image = :remittance_img WHERE transaction_id = :transaction_id");
                $confirm_payment->execute([
                    ":remittance_img" => $file_dir,
                    "transaction_id" => $transaction_id
                ]);
            }

            echo "success";
            $this->query("COMMIT");
        }catch(Exception $error){
            echo "Failed: " . $error->getMessage();
            $this->query('ROLLBACK');
            echo "fail";
        }
        
    }
}
$rider_db = new class_accept_order_database();
$action = $_POST["action"]??null;
switch ($action){
    case "shipping":
        $rider_db->accept_order($_POST["transaction_id"]);
        break;
    case "delivered":
        $rider_db->transaction_delivered($_POST["transaction_id"]);
        break;
    case "confirm_payment":
        $rider_db->confirm_payment($_POST["transaction_id"], $_FILES["payment"]);
        break;
}
?>