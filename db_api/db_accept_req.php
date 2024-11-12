<?php 
    require_once("../db_api/db_root_conn.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_order_update_database extends class_database {
        public function __construct() {
            parent::__construct('root', '');
        }

        public function update_order_stats($order_id, $stat){
            $this->query("START TRANSACTION");
            try{
                $accept_date = ($stat === "accepted")?date('Y-m-d H:i:s'):null;
                $accept_order = $this->pdo->prepare("UPDATE tbl_order SET order_status = :stat , order_acceptance_date = :accept_date WHERE order_id = :order_id");
                if($accept_date){      
                    // Updates the available stock
                    $get_stock = $this->query("SELECT variation.variation_id, variation.variation_stock, SUM(odr.order_qty) AS total_order
                    FROM tbl_variation variation
                    JOIN tbl_order odr ON odr.variation_id = variation.variation_id
                    WHERE odr.order_id = :order_id
                    GROUP BY odr.order_id", [':order_id' => $order_id]);
                    $curr_stock = $get_stock->fetchAll(PDO::FETCH_ASSOC)[0]??null;      
                    $new_stock =  $curr_stock["variation_stock"] - $curr_stock["total_order"];
                    $available_stock_update = $this->pdo->prepare("UPDATE tbl_variation SET variation_stock = :new_stock WHERE variation_id = :variation_id");
                    $available_stock_update->execute([
                        ":new_stock" => $new_stock, 
                        ":variation_id" => $curr_stock["variation_id"]
                    ]);

                    // Updates the transaction info 
                    $update_transaction = $this->pdo->prepare("UPDATE tbl_transaction transact, tbl_order odr
                    SET transact.transaction_status = 'preparing' WHERE odr.transaction_id = transact.transaction_id AND odr.order_id = :order_id ");
                    $update_transaction->execute([":order_id" => $order_id]);
                }

                // Updates the orer info
                $accept_order->execute([
                    ":order_id" => $order_id,
                    ":stat" => $stat,
                    ":accept_date" => $accept_date,
                ]);
                $this->query("COMMIT");
            }catch(Exception $error){
                echo "Failed: " . $error->getMessage();
                $this->query('ROLLBACK');
                return null;
            }
    
                // $insert_stocks_movement = $this->pdo->prepare("INSERT INTO tbl_stock_movement(stock_movement, stock_id, stock_qty, stock_date) 
                // VALUES (:movement, :stock_id, :stock_qty, :stock_date)");
                // $get_stock_id = $this->query("SELECT stock.stock_id, SUM(odr.order_qty) AS order_qty
                // FROM tbl_stock stock
                // JOIN tbl_variation variation ON variation.variation_id = stock.variation_id
                // JOIN tbl_order odr ON odr.variation_id = variation.variation_id
                // WHERE odr.order_id = :order_id
                // GROUP BY stock.stock_id", [":order_id" =>$order_id]);
                // $stock_info = $get_stock_id->fetchAll(PDO::FETCH_ASSOC)[0]??null;
                // $insert_stocks_movement->execute([
                //     ":movement" => "out", 
                //     ":stock_id" => $stock_info["stock_id"], 
                //     ":stock_qty" => $stock_info["order_qty"], 
                //     ":stock_date" => date('Y-m-d H:i:s')
                // ]);

        }
    }

    $order_id = $_POST["order_id"];
    $stats = $_POST["stats"];

    $order_update_db = new class_order_update_database();

    $order_update_db->update_order_stats($order_id, $stats);
    
?>