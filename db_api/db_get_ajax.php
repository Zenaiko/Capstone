<?php 
require_once('db_root_conn.php');
class class_ajax_database extends class_database{
            
    public function __construct(){
        parent::__construct('root' , '');
    
    }
    
    public function get_indiv_variant($variant_id){
        $get_indiv_variant = $this->query("SELECT vari.variation_name, vari.variation_price, vari.variation_stock, item_img.item_img 
        FROM tbl_variation vari 
        LEFT JOIN  tbl_item_img item_img ON vari.variation_id = item_img.item_id
        WHERE vari.variation_id = :vari_id" , [":vari_id" => $variant_id]);
        return $get_indiv_variant->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function update_market_request($req_id){
        $update_req = $this->pdo->prepare("UPDATE tbl_market_request market_req, tbl_market market SET market_req.market_req_status = 'accepted' , market.is_verified = '1' WHERE market_req.market_id = market.market_id AND market_req.market_request_id = :id");
        $update_req->execute([
            ":id" => $req_id
        ]);
    }

    public function change_item_stats($item_id, $status){
        $delist_item = $this->pdo->prepare("UPDATE tbl_item SET item_status = :status WHERE item_id = :item_id ");
        $delist_item->execute([
            ":item_id" => $item_id,
            ":status" =>$status
        ]);
    }

    public function accept_rider($rider_id){
        $accept_rider = $this->query("UPDATE tbl_employee_registration SET registration_status = 'accepted' WHERE employee_registration_id = ?" ,[$rider_id]);
        $this->query("START TRANSACTION");
        $insert_tbl_employee = $this->pdo->prepare("INSERT INTO tbl_employee(employee_registration_id, is_manager, date_hired, employee_number)
        VALUES (:emp_reg_id, :is_manager, :hire_date, :emp_num)");
        do{
            $employee_number = rand(0, 99999999999);
            $emp_number_exists_qry = $this->query("SELECT employee_number FROM tbl_employee WHERE employee_number = ?",[$employee_number]);
            $emp_number_exist = ($emp_number_exists_qry->fetchAll(PDO::FETCH_ASSOC)[0])??null;
        }while($emp_number_exist !== null);
        $insert_tbl_employee->execute([
            ":emp_reg_id" => $rider_id, 
            ":is_manager" => 0, 
            ":hire_date" => date('Y-m-d H:i:s'),
            ":emp_num" => $employee_number,
        ]);
        $this->query("COMMIT");
    }
}

    $ajax = new class_ajax_database();

    if(isset($_POST['var_id'])){
        $variant = $ajax->get_indiv_variant($_POST['var_id']);
        echo json_encode($variant);
    }elseif(isset($_POST['req_id'])){
        $ajax->update_market_request($_POST['req_id']);
    }elseif(isset($_POST['item_id']) && isset($_POST["action"])){
        $ajax->change_item_stats($_POST['item_id'], $_POST["action"]);
    }elseif(isset($_POST["rider_id"])){
        $ajax->accept_rider($_POST["rider_id"]);
    }
?>