<?php 
    require_once("db_root_conn.php");

    class class_item_info_database extends class_database{
        private $item;
        private $seller;
        
        public function __construct(class_item_info $item , class_seller_info $seller){
            parent::__construct('root' , '');
            $this->item = $item;
            $this->seller = $seller;
        }

        public function get_item_info(){
            $get_item_img =$this->query("SELECT itm_img.item_img
            FROM tbl_item_img itm_img, tbl_item itm WHERE itm_img.item_id = itm.item_id and itm.item_id = :item_id LIMIT 20" , [":item_id" =>$this->item->get_item_id()]);
            $item_image = $get_item_img->fetchAll(PDO::FETCH_ASSOC);

            foreach($item_image as $img){
                $this->item->set_img($img['item_img']);
            }

            $get_item_info = $this->query("SELECT itm.market_id, itm.item_name, itm.average_rating, itm.item_desc, categ.category, MIN(vari.variation_price) AS min_price, max(vari.variation_price) AS max_price
            FROM tbl_item itm, tbl_category categ, tbl_variation vari
            WHERE itm.category_id = categ.category_id AND vari.item_id = itm.item_id
            AND itm.item_id = :item_id" , [":item_id" => $this->item->get_item_id()]);
            $item_info = $get_item_info->fetchAll(PDO::FETCH_ASSOC)[0];
            $this->seller->set_seller_id($item_info["market_id"]);
            $this->item->set_name($item_info["item_name"]);
            $this->item->set_rating($item_info["average_rating"]);
            $this->item->set_desc($item_info["item_desc"]);
            $this->item->set_category($item_info["category"]);
            $this->item->set_min_price($item_info["min_price"]);
            $this->item->set_max_price($item_info["max_price"]);

            $get_seller_info = $this->query("SELECT market.market_name, address.city, address.street, address.brngy , market_img.market_image, market.rating
            FROM tbl_market market, tbl_address address, tbl_market_image market_img
            WHERE market.address_id = address.address_id AND market_img.market_id = market.market_id AND market.market_id = :market_id", ([":market_id" =>$this->seller->get_seller_id()]));
            $seller_info = $get_seller_info->fetchAll(PDO::FETCH_ASSOC)[0];
            $this->seller->set_name($seller_info["market_name"]);
            $this->seller->set_city($seller_info["city"]);
            $this->seller->set_street($seller_info["street"]);
            $this->seller->set_brngy($seller_info["brngy"]);
            $this->seller->set_img($seller_info["market_image"]);
            $this->seller->set_rating($seller_info["rating"]);

            $get_variants = $this->query("SELECT vari.variation_id, vari.variation_name, vari.variation_price, vari.variation_stock, itm_img.item_img 
            FROM tbl_variation vari
            LEFT JOIN tbl_item itm ON itm.item_id = vari.item_id
            LEFT JOIN tbl_item_img itm_img ON itm_img.item_id = vari.variation_id
            WHERE itm.item_id = :item_id", [":item_id" => $this->item->get_item_id()]);
            $this->item->set_variant_info($get_variants->fetchAll(PDO::FETCH_ASSOC));
        }

        
        public function get_top_items_solo(){
            $get_top_items_solo = $this->query("SELECT itm.item_id, itm.item_name, img.item_img, MIN(vari.variation_price) AS min_price, AVG(cus_r.rating) AS avg_rate 
            FROM tbl_item itm
            LEFT JOIN tbl_market mrkt ON mrkt.market_id = itm.market_id
            LEFT JOIN tbl_item_img img ON itm.item_id = img.item_id 
            LEFT JOIN tbl_customer_item_relationship cus_r ON cus_r.item_id = itm.item_id
            LEFT JOIN tbl_variation vari ON vari.item_id = itm.item_id
            WHERE mrkt.market_id = ?
            GROUP BY itm.item_id
            ORDER BY AVG(cus_r.rating) LIMIT 2", [$this->seller->get_seller_id()]);
            return $get_top_items_solo->fetchAll(PDO::FETCH_ASSOC)??null;
        }
    }
    

    class class_item_info{
        private $item_id;
        private $img = array();
        private $name;
        private $description;
        private $category;
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

    public function set_img($img) {
        array_push($this->img, $img);
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_desc($desc){
        $this->description = $desc;
    }

    public function set_category($category){
        $this->category = $category;
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

    public function get_desc(){
        return $this->description;
    }

    public function get_category(){
        return $this->category;
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
        private $img;
        private $city;
        private $street;
        private $brngy;
        private $rating;


    // Setter for seller_id
    public function set_seller_id($seller_id) {
        $this->seller_id = $seller_id;
    }

    // Getter for seller_id
    public function get_seller_id() {
        return $this->seller_id;
    }

    // Setter for name
    public function set_name($name) {
        $this->name = $name;
    }

    // Getter for name
    public function get_name() {
        return $this->name;
    }

    // Setter for street
    public function set_street($street) {
        $this->street = $street;
    }

    // Getter for street
    public function get_street() {
        return $this->street;
    }

    // Setter for brngy
    public function set_brngy($brngy) {
        $this->brngy = $brngy;
    }

    // Getter for brngy
    public function get_brngy() {
        return $this->brngy;
    }

    // Setter for rating
    public function set_rating($rating) {
        $this->rating = $rating;
    }

    // Getter for rating
    public function get_rating() {
        return $this->rating;
    }

    public function set_img($img) {
        $this->img = $img;
    }

    public function get_img() {
        return $this->img;
    }

    public function set_city($city) {
        $this->city = $city;
    }

    public function get_city() {
        return $this->city;
    }
    }

    $item_info = new class_item_info();
    $seller_info = new class_seller_info();
    $item_info_db = new class_item_info_database($item_info, $seller_info);

    $item_info->set_item_id($_GET['item']??$_POST['item_order']??null);
    $item_info_db->get_item_info();
    $get_top_items_solo = $item_info_db->get_top_items_solo();
?>