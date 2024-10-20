<?php require_once('db_root_conn.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class class_stats_database extends class_database{
    public function __construct()
    {
        parent::__construct('root' , '');
    }
    public function get_sales_stats(){
        $get_sales_stats = $this->query("SELECT DATE(odr.order_completion_date) AS stat_date, SUM(odr.order_qty) AS stat_qty, SUM(odr.order_price) stat_income FROM tbl_order odr 
        LEFT JOIN tbl_variation variation ON odr.variation_id = variation.variation_id
        LEFT JOIN tbl_item item ON variation.item_id = item.item_id
        GROUP BY stat_date
        ORDER BY stat_date ASC");
        return $get_sales_stats->fetchAll(PDO::FETCH_ASSOC)??null;
    }
}

    $stats_db = new class_stats_database();
    echo json_encode($stats_db->get_sales_stats());
?>