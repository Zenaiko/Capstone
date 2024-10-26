<?php require_once('db_root_conn.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class class_stats_database extends class_database {
    public function __construct() {
        parent::__construct('root', '');
    }

    public function get_sales_stats($seller_id ,$time_frame) {
            switch($time_frame) {
                case "year":
                    $start = date("Y-01-01");
                    $end = date("Y-12-31");
                    // Fetch data grouped by month
                    $query = "SELECT MONTH(odr.order_completion_date) AS month, 
                            SUM(odr.order_qty) AS stat_qty, 
                            SUM(odr.order_price) AS stat_income 
                            FROM tbl_order odr, tbl_variation variation, tbl_item item, tbl_market market
                            WHERE variation.variation_id = odr.variation_id 
                            AND variation.item_id = item.item_id
                            AND market.market_id = item.market_id
                            AND market.market_id = :market_id
                            AND odr.order_completion_date BETWEEN :start AND :end 
                            GROUP BY month 
                            ORDER BY month ASC";
                    break;
        
                case "month":
                    $start = date("Y-m-01");
                    $end = date("Y-m-t");
                    // Fetch data grouped by week
                    $query = "SELECT WEEK(odr.order_completion_date, 1) AS week, 
                            SUM(odr.order_qty) AS stat_qty, 
                            SUM(odr.order_price) AS stat_income 
                            FROM tbl_order odr, tbl_variation variation, tbl_item item, tbl_market market
                            WHERE variation.variation_id = odr.variation_id 
                            AND variation.item_id = item.item_id
                            AND market.market_id = item.market_id
                            AND market.market_id = :market_id
                            AND odr.order_completion_date BETWEEN :start AND :end 
                            GROUP BY week 
                            ORDER BY week ASC";
                    break;
        
                case "week":
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('sunday this week'));
                    // Fetch data grouped by day
                    $query = "SELECT DAYOFWEEK(odr.order_completion_date) AS day, 
                            SUM(odr.order_qty) AS stat_qty, 
                            SUM(odr.order_price) AS stat_income 
                            FROM tbl_order odr, tbl_variation variation, tbl_item item, tbl_market market
                            WHERE variation.variation_id = odr.variation_id 
                            AND variation.item_id = item.item_id
                            AND market.market_id = item.market_id
                            AND market.market_id = :market_id
                            AND odr.order_completion_date BETWEEN :start AND :end 
                            GROUP BY day 
                            ORDER BY day ASC";
                    break;
        
                default:
                    $start = date("Y-01-01");
                    $end = date("Y-12-31");
                    $query = ""; // Handle default case if needed
                    break;
            }
        
            if (!empty($query)) {
                $get_sales_stats = $this->query($query, [":market_id" => $seller_id,":start" => $start, ":end" => $end]);
                return $get_sales_stats->fetchAll(PDO::FETCH_ASSOC) ?? null;
            }
        }
        
}

$stats_db = new class_stats_database();
echo json_encode($stats_db->get_sales_stats($_SESSION["seller_id"],$_GET["frame"]));
?>
