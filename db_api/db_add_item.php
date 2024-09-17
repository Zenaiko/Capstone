<?php require_once('db_root_conn.php');
require_once('db_get.php');


    class add_item_database extends class_database{
        public function __construct()
        {
            parent::__construct('root' , '');
        }

        public function add_item($name, $desc,$categ ){
            $this->query('START TRANSACTION');
            $insert_tbl_item = $this->pdo->prepare("INSERT INTO tbl_item (market_id, item_name, item_desc, category_id, date_added) 
            VALUES (:market_id, :name, :desc, :categ_id, :date)");
            $insert_tbl_item->execute([
                ':market_id' => 1, 
                ':name' => $name, 
                ':desc' => $desc, 
                ':categ_id' => $categ, 
                ':date' => date('Y-m-d H:i:s')
            ]);
        }
    }

    $add_item_db = new add_item_database();



    class class_item_info{
        public $name;
        public $variant_stock = array();
        public $desc;
        public $date;
        public $category_id;
        public $category;
    }

    $item_info = new class_item_info();
    $item_info->name = $_POST['product_name'];
    $item_info->desc = $_POST['product_desc'];
    $item_info->desc = $_POST['product_desc'];
    $item_info->category = htmlspecialchars($_POST['category']);
    $item_info->category_id = $get_db->get_category_id($item_info->category)[0]['category_id'];

    $add_item_db->add_item($item_info->name,$item_info->desc,$item_info->category_id);
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