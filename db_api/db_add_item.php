<?php require_once('db_root_conn.php');
require_once('db_get.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
                ':market_id' => $_SESSION['seller_id'], 
                ':name' => $this->item->get_name(), 
                ':desc' => $this->item->get_desc(), 
                ':categ_id' => $this->item->get_category_id(), 
                ':date' => date('Y-m-d H:i:s')
            ]);
            $this->item->set_item_id($this->pdo->lastInsertId());

            // Insert into tbl_item_img
                // Creates the folder for the images
            $seller_image_dir = $this->item->get_seller_dir() . 'item_images/';
            if (!is_dir($seller_image_dir)) {
                mkdir($seller_image_dir, 0755, true);
            }

            $insert_tbl_item_img = $this->pdo->prepare("INSERT INTO tbl_item_img (item_id,item_img, is_variant) 
            VALUES (:item_id ,:img, :is_vari)");

            foreach($this->item->get_img_array()['name'] as $key => $indiv_img){
                // Uploads the file
                move_uploaded_file($this->item->get_img_array()['tmp_name'][$key] ,$seller_image_dir . $indiv_img);
                $insert_tbl_item_img->execute([
                    ':item_id' => $this->item->get_item_id(),
                    ':img' => $seller_image_dir . $indiv_img,
                    ":is_vari" => false
                ]);
            }


            // Inserts into tbl_variation
            $insert_tbl_variation = $this->pdo->prepare("INSERT INTO tbl_variation (item_id, variation_name, variation_price)
            VALUES (:item_id, :vari_name, :vari_price)");
            // Inserts into tbl_stocks and records in tbl_stock_movement
            $insert_tbl_stocks = $this->pdo->prepare("INSERT INTO tbl_stock (item_id, variation_id)
            VALUES (:item_id, :vari_id)");
            $insert_tbl_stock_movement = $this->pdo->prepare("INSERT INTO tbl_stock_movement (stock_movement, stock_id, variation_id, stock_qty, stock_date) 
            VALUES (:movement, :stock_id, :vari_id, :qty, :date)");
            // Checks whether the variant is set... if not use the item information
            if(is_null($this->item->get_variant_array())){
                $insert_tbl_variation->execute([
                    ':item_id' => $this->item->get_item_id(),
                    ':vari_name' => $this->item->get_name(),
                    ':vari_price' => $this->item->get_item_price(),
                ]);
                $vari_id = $this->pdo->lastInsertId();
                $insert_tbl_stocks->execute([
                    ':item_id' => $this->item->get_item_id(),
                    ":vari_id" => $vari_id
                ]);
                $stock_id = $this->pdo->lastInsertId();
                $insert_tbl_stock_movement->execute([
                    ":movement" => 'in',
                    ":stock_id" => $stock_id,
                    ":vari_id" => $vari_id,
                    ":qty" => $this->item->get_item_price(),
                    ":date" => date('Y-m-d H:i:s')
                ]);

            }else{ 
                foreach ($this->item->get_variant_array() as $vairant_type => $type_info){
                    $insert_tbl_variation->execute([
                        ':item_id' => $this->item->get_item_id(),
                        ':vari_name' => $vairant_type,
                        ':vari_price' => $type_info['price'],
                    ]);
                    $vari_id = $this->pdo->lastInsertId();
                    $insert_tbl_stocks->execute([
                        ':item_id' => $this->item->get_item_id(),
                        ":vari_id" => $vari_id
                    ]);
                    $stock_id = $this->pdo->lastInsertId();
                    $stock_id = $this->pdo->lastInsertId();
                    $insert_tbl_stock_movement->execute([
                        ":movement" => 'in',
                        ":stock_id" => $stock_id,
                        ":vari_id" => $vari_id,
                        ":qty" => $type_info['stock'],
                        ":date" => date('Y-m-d H:i:s')
                    ]);

                    // Uploads the file
                    $img_file = $_FILES["variant_name"];
                    $tmp_dir = $img_file["tmp_name"][$vairant_type]["img"];
                    $name_dir = $img_file["name"][$vairant_type]["img"];

                    move_uploaded_file($tmp_dir, $seller_image_dir . $name_dir);
                    $insert_tbl_item_img->execute([
                        ':item_id' => $this->item->get_item_id(),
                        ':img' => $seller_image_dir . $name_dir,
                        ":is_vari" => true
                    ]);
                }

            }
            $this->query('COMMIT');
            header('location: ../user_page/seller_item_page.php');
        }
    }

    class class_item_info{
        private $item_id;
        private $name;
        private $price;
        private $stock;
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
            
        public function set_item_price($price) {
            $this->price = $price;
        }
            
        public function set_item_stock($stock) {
            $this->stock = $stock;
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
            $this->variant_array = $variant_array; 
        }
    
        public function set_date($date) {
            $this->date = $date; 
        }

        public function set_image_array($img) {
            $this->img_array = $img;
        }

        public function set_seller_dir($dir) {
            $this->seller_folder = $dir . '/market/';
        }

        // Gets the item info
        public function get_item_id() {
            return $this->item_id;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_item_price(){
            return $this->price;
        }
            
        public function get_item_stock(){
            return $this->stock;
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

        public function get_seller_dir() {
            return $this->seller_folder;
        }

    }

    $item_info = new class_item_info();
    $add_item_db = new add_item_database($item_info);

    $item_info->set_item_name(($_POST['product_name']));
    $item_info->set_item_price(($_POST['price']));
    $item_info->set_item_stock(($_POST['stock']));
    $item_info->set_item_desc(($_POST['product_desc'])??null)  ;
    $item_info->set_category((htmlspecialchars($_POST['category']??"others")));
    $item_info->set_image_array($_FILES['add_item_img']);
    $item_info->set_seller_dir($get_db->get_cus_dir_by_seller($_SESSION['cus_id']));

    $item_info->set_variant_array($_POST['variant_name']??null);



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