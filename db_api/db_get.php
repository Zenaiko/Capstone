<?php require_once('db_root_conn.php');

class class_get_database extends class_database{
    public function __construct()
    {
        parent::__construct('root' , '');
    }

    public function get_category(){
        $get_all_category = $this->query("SELECT category FROM tbl_category"); 
        return $get_all_category->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_category_id($category){
        $get_category_id = $this->query("SELECT category_id FROM tbl_category WHERE category = ?" , [$category]); 
        return $get_category_id->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cus_dir_by_seller($seller_id){
        $get_dir = $this->query("SELECT cus.cus_asset_folder FROM tbl_customer cus, tbl_market mark WHERE mark.customerID = cus.customerID AND mark.marketID = ?", [$seller_id]);
        return $get_dir->fetchAll(PDO::FETCH_ASSOC);
    } 
}

$get_db = new class_get_database();
$category_array = $get_db->get_category();

?>