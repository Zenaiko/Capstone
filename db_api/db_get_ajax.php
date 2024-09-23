<?php 
require_once('db_root_conn.php');
    class class_ajax_database extends class_database{
              
        public function __construct(){
            parent::__construct('root' , '');
     
        }

        public function get_indiv_variant($variant_id){
            $get_indiv_variant = $this->query("SELECT vari.variation_name, vari.variation_price, vari.variation_stock, itm_img.item_img 
            FROM tbl_variation vari 
            LEFT JOIN  tbl_item_img itm_img ON vari.variation_id = itm_img.item_id
            WHERE vari.variation_id = :vari_id" , [":vari_id" => $variant_id]);
            return $get_indiv_variant->fetchAll(PDO::FETCH_ASSOC)[0];
        }
    }

    $ajax = new class_ajax_database();

    if(isset($_POST['var_id'])){
        $variant = $ajax->get_indiv_variant($_POST['var_id']);
        echo json_encode($variant);
    }
?>