<?php 
    require_once("../db_api/db_root_conn.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class class_customer_rel_database extends class_database {
        public function __construct() {
            parent::__construct('root', '');
        }

        public function item_rel_action($item_id, $action){
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

            switch (strtolower($action)){
                case "like_item":
                    $if_liked_qry = $this->query("SELECT is_liked FROM tbl_customer_item_relationship WHERE item_id = ? AND customer_id = ?", [$item_id, $_SESSION["cus_id"]]);
                    $if_liked = $if_liked_qry->fetchAll(PDO::FETCH_ASSOC)[0]["is_liked"]??0;

                    $customer_like = $this->pdo->prepare("UPDATE tbl_customer_item_relationship
                    SET is_liked = :act WHERE item_id = :item_id AND customer_id = :customer_id");
                    $act = $if_liked === 0 ? 1 : 0;
                    $customer_like->execute([
                        "act" => $act,
                        ":item_id" => $item_id,
                        ":customer_id" => $_SESSION["cus_id"],
                    ]);
                break;

                case "rate_item":

                break;
            }
            
        }

        public function market_rel_action($market_id){
            $if_rel_exists = $this->query("SELECT * FROM tbl_customer_market_relationship WHERE market_id = ? AND customer_id = ?", [$market_id, $_SESSION["cus_id"]]);
            $exists = $if_rel_exists->fetchAll(PDO::FETCH_ASSOC)[0]??null;

            if($exists === null){
                $create_rel = $this->pdo->prepare("INSERT INTO tbl_customer_market_relationship 
                (market_id, customer_id) VALUES (:market_id, :customer_id)");
                $create_rel->execute([
                    ":market_id" => $market_id,
                    ":customer_id" => $_SESSION["cus_id"],
                ]);
            }

            $if_followed_qry = $this->query("SELECT is_followed FROM tbl_customer_market_relationship WHERE market_id = ? AND customer_id = ?", [$market_id, $_SESSION["cus_id"]]);
            $if_followed = $if_followed_qry->fetchAll(PDO::FETCH_ASSOC)[0]["is_followed"]??0;
            $customer_follow = $this->pdo->prepare("UPDATE tbl_customer_market_relationship
            SET is_followed = :act WHERE market_id = :market_id AND customer_id = :customer_id");
            $act = $if_followed === 0 ? 1 : 0;
            $customer_follow->execute([
                "act" => $act,
                ":market_id" => $market_id,
                ":customer_id" => $_SESSION["cus_id"],
            ]);
        }
    }

    $custome_rel_db = new class_customer_rel_database();
    $rel_id = $_POST["rel_id"]??null;
    $action = $_POST["action"]??null;
    if (in_array($action, ['like_item', 'rate_item']) && !is_null($rel_id)) {
        $custome_rel_db->item_rel_action($rel_id, $action);
    }elseif(!is_null($rel_id)){
        $custome_rel_db->market_rel_action($rel_id);
    }

?>
