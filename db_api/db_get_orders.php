<?php
    require_once("../db_api/db_root_conn.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    class class_order_info extends class_database {
        public function __construct() {
            parent::__construct('root', '');
        }

        public function get_orders_info($status){
            $get_orders_info = ("SELECT odr.order_id, item.item_name, vari.variation_name, odr.order_qty, odr.order_price,odr.date_requested, item_img.item_img, username.username, customer.customer_id, transact.customer_id
            FROM tbl_order odr 
            LEFT JOIN tbl_variation vari ON vari.variation_id = odr.variation_id 
            LEFT JOIN tbl_item item ON item.item_id = vari.item_id
            LEFT JOIN tbl_item_img item_img ON item.item_id = item_img.item_id AND item_img.is_variant = 0
            LEFT JOIN tbl_transaction transact ON transact.transaction_id = odr.transaction_id
            LEFT JOIN tbl_customer customer ON transact.customer_id = customer.customer_id
            LEFT JOIN tbl_username username ON customer.username_id = username.username_id
            WHERE odr.order_status = :odr_stat AND item.market_id = :mrkt_id
            GROUP BY odr.order_id");
            $params = [
                ":odr_stat" => $status,
                ":mrkt_id" => $_SESSION["seller_id"]
            ];
            $orders = $this->query($get_orders_info, $params);
            return $orders->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    $order_info = new class_order_info();
    
    // Gets the orders by status
    $order_requests = $order_info->get_orders_info("requesting");
    $oder_processing = $order_info->get_orders_info("accepted")
?>


