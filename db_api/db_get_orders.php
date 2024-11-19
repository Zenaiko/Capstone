<?php
require_once("../db_api/db_root_conn.php");
(session_status() === PHP_SESSION_NONE)?session_start():null;


class class_order_info extends class_database {
    public function __construct() {
        parent::__construct('root', '');
    }

    public function get_orders_info(){
        $get_orders_info = $this->pdo->prepare("SELECT odr.order_id, item.item_name, variation.variation_name, odr.order_qty, odr.order_price,odr.date_requested, item_img.item_img, username.username, customer.customer_id, transact.customer_id
        FROM tbl_order odr 
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id 
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_item_img item_img ON item.item_id = item_img.item_id AND item_img.is_variation = 0
        JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
        JOIN tbl_customer customer ON transact.customer_id = customer.customer_id
        JOIN tbl_username username ON customer.username_id = username.username_id
        WHERE odr.order_status = 'requesting' AND item.market_id = :market_id
        GROUP BY odr.order_id");

        $get_orders_info->execute([":market_id"=> $_SESSION["seller_id"]]);
        return $get_orders_info->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_transaction_info($transaction_status){
        $transaction_query = ("SELECT transact.transaction_id, username.username ,odr.order_acceptance_date, transact.total_transaction_amt, customer.customer_img, transact.transaction_status
        FROM tbl_transaction transact
        JOIN tbl_order odr ON odr.transaction_id = transact.transaction_id
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id= item.market_id
        JOIN tbl_customer customer ON customer.customer_id = transact.customer_id
        JOIN tbl_username username ON username.username_id = customer.username_id
        WHERE item.market_id = :market_id");

        // Get the order information
        $get_orders_qry = ("SELECT item.item_name, variation.variation_name, odr.order_qty, odr.order_price
        FROM tbl_order odr
        JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id = item.market_id
        WHERE transact.transaction_id = :transaction_id ");

        // Dynamic situational query
        switch($transaction_status){
            case "preparing":
                $transaction_query .= (" AND transact.transaction_status = 'preparing'");
                $get_orders_qry.= (" AND odr.order_status = 'accepted'");
                break; 
            case "completed":
                $transaction_query .= (" AND transact.transaction_status = 'delivered' OR transact.transaction_status = 'completed'");
                $get_orders_qry.= (" AND odr.order_status = 'completed'");
                break;
            case "prepared_shipping":
                $transaction_query .= (" AND (transact.transaction_status = 'prepared' OR transact.transaction_status = 'shipping')");
                $get_orders_qry .= ("AND (odr.order_status = 'shipping' OR odr.order_status = 'accepted')");
                break;
        }


        // Finalize the query
        $transaction_query .= ("GROUP BY transact.transaction_id");
        $get_transaction_info = $this->pdo->prepare($transaction_query);

        $get_transaction_info->execute([":market_id"=> $_SESSION["seller_id"],]);
        $transactions_array = $get_transaction_info->fetchAll(PDO::FETCH_ASSOC);

        // Finalizes and prepares order info
        $get_orders_qry .= " ORDER BY odr.order_id";
        $get_orders = $this->pdo->prepare($get_orders_qry);

        // Gets the rider information
        $get_rider_info = $this->pdo->prepare("SELECT username.username, contact.contact, delivery.date_time_accepted, delivery.date_time_delivered
        FROM tbl_delivery delivery
        JOIN tbl_transaction transact ON transact.transaction_id = delivery.transaction_id
        JOIN tbl_employee employee ON employee.employee_id = delivery.rider_id
        JOIN tbl_employee_registration employee_reg ON employee_reg.employee_registration_id = employee.employee_registration_id
        JOIN tbl_rider_registration rider_reg ON rider_reg.employee_registration_id = employee_reg.employee_registration_id
        JOIN tbl_username username ON username.username_id =  employee_reg.username_id
        JOIN tbl_user usr ON usr.user_id = username.user_id
        JOIN tbl_contact contact ON contact.contact_id = usr.contact_id
        WHERE transact.transaction_id = :transaction_id");

        // Assigns each transaction its order inforamtion
        foreach($transactions_array as $key => $transaction){
            $get_orders->execute([
                ":transaction_id" => $transaction["transaction_id"],
            ]);
            $order = $get_orders->fetchAll(PDO::FETCH_ASSOC);
            $transactions_array[$key]["orders"] =  $order;
            // Assigns a rider to the transaction if a rider has accepted it for shipping
            if($transaction["transaction_status"] === "shipping" or $transaction_status === "completed"){
                $get_rider_info->execute([":transaction_id" => $transaction["transaction_id"]]);
                $rider_info = $get_rider_info->fetchAll(PDO::FETCH_ASSOC);
                $transactions_array[$key]["rider"] =  $rider_info;
            }
        }
        return $transactions_array;
    }
}

$order_info_db = new class_order_info();
?>


