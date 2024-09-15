<?php 
    require_once('db_root_conn.php');
    session_start();

 class seller_sign_database extends class_database{
    private $customer_id;
    public function __construct()
    {
        parent::__construct('root' , '');
        $this->customer_id = $_SESSION['cus_id'];
    }

    public function insert_market_request($shop_name){
        $this->query('START TRANSACTION');

        $insert_market_qry = $this->pdo->prepare("INSERT INTO tbl_market (customerID, market_name) VALUES (:cus_id,:username)");
        $insert_market_qry->execute([
            ':cus_id' => $this->customer_id,
            ':username' => $shop_name]);

        $this->query('COMMIT');
        
    } 
}

class class_shop_sign_info{
    public $name;
    public $img;
    public $street;
    public $brngy;
    public $number;
    public $geoloc;
    public $tin;
    public $bir;
    public $dti;
    public $sec;
    public $mayor;
    public $fda;
}

if(isset($_POST['submit_shop_info'])){
    $sign_shop_name = $_POST['sign_shop_name'] ??NULL;
    $tmp_shop_image = $_FILES['sign_upload_shop_image']['tmp_name']??NULL;
    $sign_shop_street = $_POST['sign_shop_street']??NULL;
    $sign_shop_barngay = $_POST['sign_shop_barngay']??NULL;
    $sign_shop_number = $_POST['sign_shop_number']??NULL;
    $shop_sell_food = $_POST['shop_sell_food']??NULL;

    $_SESSION['shop_info_sign'] = [
        'shop_name' => $sign_shop_name,
        'shop_img' => $tmp_shop_image,
        'shop_street' => $sign_shop_street,
        'shop_brngy' => $sign_shop_barngay,
        'shop_number' => $sign_shop_number
    ];

    if($shop_sell_food){
        header('location: ../user_page/sign_up_seller.php?business_information&food_seller');
        exit();
    }
    header('location: ../user_page/sign_up_seller.php?business_information');
    exit();
    
}elseif($_POST['submit_seller_form']){
    $shop_info_data = $_SESSION['shop_info_sign'];
    $shop_info = new class_shop_sign_info();
    $shop_info->name = htmlspecialchars($shop_info_data['shop_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $shop_info->img = htmlspecialchars($shop_info_data['shop_img'] ?? '', ENT_QUOTES, 'UTF-8');
    $shop_info->street = htmlspecialchars($shop_info_data['shop_street']?? '', ENT_QUOTES, 'UTF-8');
    $shop_info->brngy = htmlspecialchars($shop_info_data['shop_brngy']?? '', ENT_QUOTES, 'UTF-8');
    $shop_info->number = htmlspecialchars($shop_info_data['shop_number']?? '', ENT_QUOTES, 'UTF-8');

    $shop_db = new seller_sign_database();
    $shop_db->insert_market_request($shop_info->name);

    unset( $_SESSION['shop_info_sign']);

    header('location: ../user_page/cus_acc_page.php');
}


?>