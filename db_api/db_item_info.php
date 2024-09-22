<?php 
    require_once("db_root_conn.php");

    class   class_item_info_database extends class_database{
        public function __construct(){
            parent::__construct('root' , '');
        }

        public function get_item_info(){
            $get_item_info = $this->pdo->prepare("");
        }
    }

//     SELECT itm.market_id, itm.market_id, itm.item_desc, itm.average_rating,
// GROUP_CONCAT(item_images SEPARATOR ', 'itm_img.item_img_location, 
// GROUP_CONCAT(variation_names SEPARATOR ', 'vari.variation_name),

// FROM tbl_item itm, tbl_item_img itm_img, tbl_variation vari

    class class_item_info{
        private $item_id;
        private $img = array();
        private $name;
        private $min_price;
        private $max_price;
        private $variant_info = array();
        private $sold ;
        private $rating;
        private $respondents;

      // Setters
    public function set_item_id($item_id) {
        $this->item_id = $item_id;
    }

    public function set_img(array $img) {
        $this->img = $img;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_min_price($min_price) {
        $this->min_price = $min_price;
    }

    public function set_max_price($max_price) {
        $this->max_price = $max_price;
    }

    public function set_variant_info(array $variant_info) {
        $this->variant_info = $variant_info;
    }

    public function set_sold($sold) {
        $this->sold = $sold;
    }

    public function set_rating($rating) {
        $this->rating = $rating;
    }

    public function set_respondents($respondents) {
        $this->respondents = $respondents;
    }

    // Getters
    public function get_item_id() {
        return $this->item_id;
    }

    public function get_img() {
        return $this->img;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_min_price() {
        return $this->min_price;
    }

    public function get_max_price() {
        return $this->max_price;
    }

    public function get_variant_info() {
        return $this->variant_info;
    }

    public function get_sold() {
        return $this->sold;
    }

    public function get_rating() {
        return $this->rating;
    }

    public function get_respondents() {
        return $this->respondents;
    }
    }

    class class_seller_info{
        private $seller_id;
        private $name;
        private $street;
        private $brngy;
        private $rating;
    }


?>