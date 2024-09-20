<?php require_once('db_root_conn.php');
require_once('db_get.php');


    class add_item_database extends class_database{
        private $item;
        public function __construct(class_item_info $item)
        {
            parent::__construct('root' , '');
            $this->item = $item;
        }
        

        public function add_item(){
            $this->query('START TRANSACTION');

            // Inserts into tbl_item
            $insert_tbl_item = $this->pdo->prepare("INSERT INTO tbl_item (market_id, item_name, item_desc, category_id, date_added) 
            VALUES (:market_id, :name, :desc, :categ_id, :date)");
            $insert_tbl_item->execute([
                ':market_id' => 1, 
                ':name' => $this->item->get_name(), 
                ':desc' => $this->item->get_desc(), 
                ':categ_id' => $this->item->get_category_id(), 
                ':date' => date('Y-m-d H:i:s')
            ]);
            $this->item->set_item_id($this->pdo->lastInsertId());

            // Insert into tbl_item_img
            foreach($this->item->get_img_array()['name'] as $key => $indiv_img){
                move_uploaded_file($this->item->get_img_array()['tmp_name'][$key] ,$this->item->get_cus_dir() . $indiv_img);
                $insert_tbl_item_img = $this->pdo->prepare("INSERT INTO tbl_item_img (itemID, item_img, item_img_location) 
                VALUES (:item_id, :img, :loc)");
                $insert_tbl_item_img->execute([
                    ':item_id' => $this->item->get_item_id(),
                    ':img' => $indiv_img,
                    ':loc' => $this->item->get_cus_dir() . $indiv_img
                ]);
        
            }

            // Inserts into tbl_variation
            foreach ($this->item->get_variant_array() as $vairant_type => $type_info){
                $insert_tbl_variation = $this->pdo->prepare("INSERT INTO tbl_variation (item_id, variation_name, vairation_price,vairation_stock) VALUES (:item_id, :vari_name, :vari_price, :vari_stock)");
                $insert_tbl_variation->execute([
                    ':item_id' => $this->item->get_item_id(),
                    ':vari_name' => $vairant_type,
                    ':vari_price' => $type_info['price'],
                    ':vari_stock' => $type_info['stock'],
                ]);
            }

            $this->query('COMMIT');
        }
    }

    class class_item_info{
        private $item_id;
        private $name;
        private $desc;
        private $date;
        private $category_id;
        private $category;
        private $img_array;
        private $variant_array= array();
        private $seller_folder;

        // Sets the item info
        public function set_item_id($item_id) {
            $this->item_id = $item_id;
        }
    
        public function set_item_name($name) {
            $this->name = $name;
        }
    
        public function set_item_desc($desc) {
            $this->desc = $desc;
        }

        public function set_category($category) {
            $this->category = $category;
            $this->set_category_id();
        }
    
        public function set_category_id() {
            $get_categ_id = new class_get_database();
            $this->category_id = $get_categ_id->get_category_id($this->category)[0]['category_id'];
        }
    
        public function set_variant_array($variant_array) {
            $this->variant_array= $variant_array; 
        }
    
        public function set_date($date) {
            $this->date = $date; 
        }

        public function set_image_array($img) {
            $this->img_array = $img;
        }

        public function set_cus_dir($dir) {
            $this->seller_folder = $dir . '/market_asset';
        }


        // Gets the item info
        public function get_item_id() {
            return $this->item_id;
        }

        public function get_name() {
            return $this->name;
        }
    
        public function get_desc() {
            return $this->desc;
        }
    
        public function get_category_id() {
            return $this->category_id;
        }
    
        public function get_variant_array() {
            return $this->variant_array;
        }
    
        public function get_date() {
            return $this->date;
        }

        public function get_img_array() {
            return $this->img_array;
        }

        public function get_cus_dir() {
            return $this->seller_folder;
        }

    }

    $item_info = new class_item_info();
    $add_item_db = new add_item_database($item_info);

    $item_info->set_item_name(($_POST['product_name']));
    $item_info->set_item_desc(($_POST['product_desc'])??null)  ;
    $item_info->set_category((htmlspecialchars($_POST['category'])));
    $item_info->set_image_array($_FILES['add_item_img']);
    $item_info->set_cus_dir($get_db->get_cus_dir_by_seller(18)[0]['cus_asset_folder']);

    $item_info->set_variant_array($_POST['variant_name']);


    $asset_fol = $get_db->get_cus_dir_by_seller(18)[0]['cus_asset_folder'];
    $mr = $asset_fol . '/market_asset';
    if (!is_dir($mr)) {
        mkdir($mr, 0755, true);
    }

$add_item_db->add_item();

    //  foreach($item_info->get_img_array()['name'] as $key => $indiv_img){
    //     move_uploaded_file($item_info->get_img_array()['tmp_name'][$key] , $mr . "/" . $indiv_img);
    // }

    

    

?>



<!-- 

$item = [
    $variant1 =>[
        variant_name => [
            price => 200
            qty => 600
        ]
        variant_name => [
        price => 300
        qty => 500
        ]
    ]
]

shirt = [
    color =>[
        green => [
            price => 200
            qty => 600
        ]
        red => [
        price => 300
        qty => 500
        ]
    ]

    size =>[
        medium => [
            price => 5
            qty => 7
        ]
        large => [
            price => 3
            qty => 2
            ]
        ]
    
    ]
-->