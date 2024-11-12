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
        LEFT JOIN tbl_variation variation ON variation.variation_id = odr.variation_id 
        LEFT JOIN tbl_item item ON item.item_id = variation.item_id
        LEFT JOIN tbl_item_img item_img ON item.item_id = item_img.item_id AND item_img.is_variant = 0
        LEFT JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
        LEFT JOIN tbl_customer customer ON transact.customer_id = customer.customer_id
        LEFT JOIN tbl_username username ON customer.username_id = username.username_id
        WHERE odr.order_status = 'requesting' AND item.market_id = :market_id
        GROUP BY odr.order_id");

        $get_orders_info->execute([":market_id"=> $_SESSION["seller_id"]]);
        return $get_orders_info->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_preparing_transaction(){
        $get_preparing_transaction = $this->pdo->prepare("SELECT transact.transaction_id, username.username ,odr.order_acceptance_date, transact.total_transaction_amt, customer.customer_img
        FROM tbl_transaction transact
        JOIN tbl_order odr ON odr.transaction_id = transact.transaction_id
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id= item.market_id
        JOIN tbl_customer customer ON customer.customer_id = transact.customer_id
        JOIN tbl_username username ON username.username_id = customer.username_id
        WHERE transact.transaction_status = 'preparing' AND item.market_id = :market_id
        GROUP BY transact.transaction_id");

        $get_orders = $this->pdo->prepare("SELECT item.item_name, variation.variation_name, odr.order_qty, odr.order_price
        FROM tbl_order odr
        JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
        JOIN tbl_variation variation ON variation.variation_id = odr.variation_id
        JOIN tbl_item item ON item.item_id = variation.item_id
        JOIN tbl_market market ON market.market_id = item.market_id
        WHERE transact.transaction_id = :transaction_id");

        $get_preparing_transaction->execute([":market_id"=> $_SESSION["seller_id"]]);
        $transactions_array = $get_preparing_transaction->fetchAll(PDO::FETCH_ASSOC);

        foreach($transactions_array as $key => $transaction){
            $get_orders->execute([":transaction_id" => $transaction["transaction_id"]]);
            $order = $get_orders->fetchAll(PDO::FETCH_ASSOC);
            $transactions_array[$key]["orders"] =  $order;
        }
        return $transactions_array;
    }
}

$order_info_db = new class_order_info();
?>


