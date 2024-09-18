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

            // Inserts into tbl_variation
            foreach (){
                $insert_tbl_variation = $this->pdo->prepare("INSERT INTO tbl_variation (item_id, variation_name) VALUES (:item_id, vari_name)");
                $insert_tbl_variation->execute([
                    ':item_id' => $this->item->get_item_id();
                    ':vari_name' => 
                ]);
            }
        }
    }

    class class_item_info{
        private $name;
        private $variant_stock = array();
        private $desc;
        private $date;
        private $category_id;
        private $category;
        private $item_id;

        // Sets the item info
        public function set_item_name($name) {
            $this->name = $name;
        }
    
        public function set_item_desc($desc) {
            $this->desc = $desc;
        }

        public function set_category($category) {
            $this->category_id = $category;
            $this->set_category_id();
        }
    
        public function set_category_id() {
            $get_categ_id = new class_get_database();
            $this->category_id = $get_categ_id->get_category_id($this->category)[0]['category_id'];
        }
    
        public function set_variant_stock($stock) {
            $this->variant_stock = $stock; 
        }
    
        public function set_date($date) {
            $this->date = $date; 
        }

        public function set_item_id($item_id) {
            $this->item_id = $item_id; 
        }

        // Gets the item info
        public function get_name() {
            return $this->name;
        }
    
        public function get_desc() {
            return $this->desc;
        }
    
        public function get_category_id() {
            return $this->category_id;
        }
    
        public function get_variant_stock() {
            return $this->variant_stock;
        }
    
        public function get_date() {
            return $this->date;
        }

        public function get_item_id() {
            return $this->item_id;
        }
    }

    $item_info = new class_item_info();
    $add_item_db = new add_item_database($item_info);

    $item_info->set_item_name(($_POST['product_name']));
    $item_info->set_item_desc(($_POST['product_desc']));
    $item_info->set_category((htmlspecialchars($_POST['category'])));
    $item_info->set_category_id((htmlspecialchars($_POST['category'])));


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