<?php 
    require_once("../db_api/db_root_conn.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_customer_rel_database extends class_database {
        public function __construct() {
            parent::__construct('root', '');
        }

        public function customer_rel_action($item_id, $action){

            $if_rel_exists = $this->query("SELECT * FROM tbl_customer_item_relationship WHERE item_id = ? AND customer_id = ?", [$item_id, $_SESSION["cus_id"]]);
            $exists = $if_rel_exists->fetchAll(PDO::FETCH_ASSOC)[0]??null;
            if($exists === null){
                $create_rel = $this->pdo->prepare("INSERT INTO tbl_customer_item_relationship 
                (item_id, customer_id) VALUES (:item_id, :customer_id)");
                $create_rel->execute([
                    ":item_id" => $item_id,
                    ":customer_id" => $_SESSION["cus_id"],
                ]);
            }

            $if_liked_qry = $this->query("SELECT is_liked FROM tbl_customer_item_relationship WHERE item_id = ? AND customer_id = ?", [$item_id, $_SESSION["cus_id"]]);
            $if_liked = $if_liked_qry->fetchAll(PDO::FETCH_ASSOC)[0]["is_liked"]??0;

            $customer_like = $this->pdo->prepare("UPDATE tbl_customer_item_relationship
            SET is_liked = :act WHERE item_id = :item_id AND customer_id = :customer_id");

            switch (strtolower($action)){
                case "like":
                    if ($if_liked === 0) {
                        $customer_like->execute([
                            "act" => 1,
                            ":item_id" => $item_id,
                            ":customer_id" => $_SESSION["cus_id"],
                        ]);
                    }else{
                        $customer_like->execute([
                            "act" => 0,
                            ":item_id" => $item_id,
                            ":customer_id" => $_SESSION["cus_id"],
                        ]);
                    }
                break;
                case "rate":
                break;
            }
            
        }
    }

    $custome_rel_db = new class_customer_rel_database();
    $item_id = $_POST["item_id"];
    $action = $_POST["action"];
    $custome_rel_db->customer_rel_action($item_id, $action);
?>
