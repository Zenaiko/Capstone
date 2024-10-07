<?php 
    require_once('db_root_conn.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

 class clas_seller_sign_database extends class_database{
    private $seller_info;
    private $customer_id;

    public function __construct(class_shop_sign_up_info $seller_info)
    {
        parent::__construct('root' , '');
        $this->customer_id = $_SESSION['cus_id'];
        $this->seller_info = $seller_info;
    }

    public function get_cus_folder(){
        $cus_folder = $this->query("SELECT cus_asset_folder FROM tbl_customer WHERE customer_id = ?", [$this->customer_id]);
        return $cus_folder->fetchAll(PDO::FETCH_ASSOC)[0]["cus_asset_folder"];
    }

    public function insert_market_request(){
        $this->query('START TRANSACTION');
        try{

        $address_qry = $this->pdo->prepare("INSERT INTO tbl_address(street, brngy, house_unit_number, geolocation) VALUES (:street, :brngy, :unit, :geo)");
        $address_qry->execute([
            ':street'=> $this->seller_info->get_street(),
            ':brngy'=> $this->seller_info->get_brngy(),
            ':unit'=> $this->seller_info->get_number(), 
            ':geo'=> $this->seller_info->get_geoloc()
        ]);
        $address_id = $this->pdo->lastInsertId();

        $market_qry = $this->pdo->prepare("INSERT INTO tbl_market (customer_id, market_name, date_created, address_id,terms_and_acceptance) VALUES (:cus_id,:username, :date_create,:address ,:terms)");
        $market_qry->execute([
            ':cus_id' => $this->customer_id,
            ':username' => $this->seller_info->get_name(),
            ':date_create' => date('Y-m-d H:i:s'),
            ':address' => $address_id,
            ':terms' => $this->seller_info->get_terms()
        ]);
        $market_id = $this->pdo->lastInsertId();

        // Uploads the market profile
        $new_profile_dir =  $this->seller_info->get_seller_folder() . '/'. basename($this->seller_info->get_img());
        rename($this->seller_info->get_img(), $new_profile_dir );

        $insert_tbl_market_image = $this->pdo->prepare("INSERT INTO tbl_market_image (market_id, market_image, priority) VALUES (:market_id, :img, :prio)");
        $insert_tbl_market_image->execute([
            ':market_id' => $market_id,
            ':img' => $new_profile_dir,
            ':prio' => 1
        ]);

        // Uploads the file into the request folder
        if(!is_dir($this->seller_info->get_seller_rqst_folder())){
            mkdir($this->seller_info->get_seller_rqst_folder());
        }

        $file_rqst_arry = [$this->seller_info->get_bir(), $this->seller_info->get_dti(), $this->seller_info->get_sec(), $this->seller_info->get_mayor()];
        $file_assign_name = ['bir','dit','sec','mayor_perm','fda'];
        $file_dir = [];
        if(!is_null( $this->seller_info->get_fda())){
            array_push($file_rqst_arry, $this->seller_info->get_fda());
        }

        foreach($file_rqst_arry as $key => $rqst_file){
            $file_loc = $this->seller_info->get_seller_rqst_folder() . $file_assign_name[$key] . '_' . $rqst_file['name'];
            array_push($file_dir, $file_loc);
            move_uploaded_file($rqst_file['tmp_name'] , $file_loc);
        }

        $market_rqst_qry = $this->pdo->prepare("INSERT INTO tbl_market_request (market_id, seller_id, bir, tin, dti, sec, mayor_permit,has_food,fda, market_address_id) VALUES (:market_id, :seller_id, :bir, :tin, :dti, :sec, :mayor_perm, :has_food, :fda,:address_id)");
        $market_rqst_qry->execute([
            ':market_id' => $market_id,
            ':seller_id' => $this->customer_id,
            ':tin' => $this->seller_info->get_tin(),
            ':bir' => $file_loc[0],
            ':dti' => $file_loc[1],
            ':sec' => $file_loc[2],
            ':mayor_perm' => $file_loc[3],
            ':has_food' => $this->seller_info->get_has_food(),
            ':fda' => $file_loc[4]??null,
            ':address_id' => $address_id
        ]);

        $this->query('COMMIT');
        unset( $_SESSION['shop_info']);
        header('location: ../user_page/cus_acc_page.php');
    }catch(Exception $error){
        echo "Failed: " . $error->getMessage();
        $this->query('ROLLBACK');
    }
    } 
}

class class_shop_sign_up_info{
    private $name;
    private $img;
    private $street;
    private $brngy;
    private $number;
    private $geoloc;
    private $tin;
    private $bir;
    private $dti;
    private $sec;
    private $mayor;
    private $has_food;
    private $fda;
    private $terms;

    private $seller_folder;
    private $seller_rqst_folder;

    // Sets the shop information
    public function set_name($name){
        $this->name = $name;
    }

    public function set_img($img){
        $this->img = $img;
    }

    public function set_street($street){
        $this->street = $street;
    }

    public function set_brngy($brngy){
        $this->brngy = $brngy;
    }

    public function set_number($number){
        $this->number = $number;
    }

    public function set_geoloc($geoloc){
        $this->geoloc = $geoloc;
    }

    public function set_tin($tin){
        $this->tin = $tin;
    }

    public function set_bir($bir){
        $this->bir = $bir;
    }

    public function set_dti($dti){
        $this->dti = $dti;
    }

    public function set_sec($sec){
        $this->sec = $sec;
    }

    public function set_mayor($mayor){
        $this->mayor = $mayor;
    }

    public function set_has_food($has_food){
        $this->has_food = $has_food;
    }

    public function set_fda($fda){
        $this->fda = $fda;
    }

    public function set_terms($terms){
        $this->terms = $terms;
    }

    public function set_seller_folder($folder){
        $this->seller_folder = $folder;
    }

    public function set_seller_rqst_folder($rqst_folder){
        $this->seller_rqst_folder = $rqst_folder;
    }

    // Gets the shop information

    public function get_name(){
        return $this->name;
    }

    public function get_img(){
        return $this->img;
    }

    public function get_street(){
        return $this->street;
    }

    public function get_brngy(){
        return $this->brngy;
    }

    public function get_number(){
        return $this->number;
    }

    public function get_geoloc(){
        return $this->geoloc;
    }

    public function get_tin(){
        return $this->tin;
    }

    public function get_bir(){
        return $this->bir;
    }

    public function get_dti(){
        return $this->dti;
    }

    public function get_sec(){
        return $this->sec;
    }

    public function get_mayor(){
        return $this->mayor;
    }

    public function get_has_food(){
        return $this->has_food;
    }

    public function get_fda(){
        return $this->fda;
    }

    public function get_terms(){
        return $this->terms;
    }

    public function get_seller_folder(){
        return $this->seller_folder;
    }

    public function get_seller_rqst_folder(){
        return $this->seller_rqst_folder;
    }

}

$shop_info = new class_shop_sign_up_info();
$shop_db = new clas_seller_sign_database($shop_info);

if(isset($_POST['submit_shop_info'])){


        $cus_folder = $shop_db->get_cus_folder();
        $shop_info->set_seller_folder($cus_folder."/market");
        $seller_tmp_folder = $shop_info->get_seller_folder()."/tmp/";
        if(!is_dir($cus_folder)){
            mkdir($cus_folder);
        }
        if(!is_dir($shop_info->get_seller_folder())){
            mkdir($shop_info->get_seller_folder());
        }
        if(!is_dir($seller_tmp_folder)){
            mkdir($seller_tmp_folder);
        }
    if(isset($_FILES['sign_upload_shop_image'])){
        $tmp_file_dir = $_FILES['sign_upload_shop_image']['tmp_name'];
        $dir_file = $seller_tmp_folder . $_FILES['sign_upload_shop_image']['name'];
        move_uploaded_file($tmp_file_dir, $dir_file);
    }

    $_SESSION['shop_info']= [
        'name' => $_POST['sign_shop_name'] ?? NULL,
        'street' => $_POST['sign_shop_street'] ?? NULL,
        'brngy' => $_POST['sign_shop_barngay'] ?? NULL,
        'number' => $_POST['sign_shop_number'] ?? NULL,
        'has_food' => $_POST['shop_sell_food'] ?? NULL,
        'tmp_img_loc' => $dir_file?? NULL,
        'seller_folder' => $shop_info->get_seller_folder()
    ];
    
    if(isset($_POST['shop_sell_food'])){
        header('location: ../user_page/sign_up_seller.php?business_information&food_seller');
    }

    header('location: ../user_page/sign_up_seller.php?business_information');
    exit();

}elseif($_POST['submit_seller_form']){
    // Gets the previous form
    $shop_info->set_name($_SESSION['shop_info']['name']);
    $shop_info->set_street($_SESSION['shop_info']['street']);
    $shop_info->set_brngy($_SESSION['shop_info']['brngy']);
    $shop_info->set_number($_SESSION['shop_info']['number']);
    $shop_info->set_has_food($_SESSION['shop_info']['has_food']);
    $shop_info->set_img($_SESSION['shop_info']['tmp_img_loc']);
    $shop_info->set_seller_folder($_SESSION['shop_info']['seller_folder']);

    $shop_info->set_tin( $_POST['tin']??null);
    $shop_info->set_bir($_FILES['bir']??null);
    $shop_info->set_dti($_FILES['dti']??null);
    $shop_info->set_sec($_FILES['sec']??null);
    $shop_info->set_mayor($_FILES['mayor_perm']??null);
    $shop_info->set_fda($_FILES['fda']??null);
    $shop_info->set_terms( $_POST['terms']??0);

    $shop_info->set_seller_rqst_folder($shop_info->get_seller_folder() . '/request/');
    
    $shop_db->insert_market_request();
}





// $cus_folder = $shop_db->get_cus_folder()[0];

// public function verify_img($img, $market_folder_dir){
//     if ($img['error'] !== UPLOAD_ERR_OK) {
//         die("File upload error: " . $img['error']);
//     }
//     $tmp_file_name = $img['tmp_name'];
//     $file_name = $img['name'];

//     move_uploaded_file($tmp_file_name, $market_folder_dir.$file_name);
//     return $market_folder_dir.$file_name;
// }



// if(isset($_POST['submit_shop_info'])){
 


    // if(!is_dir($cus_tmp_folder)){
    //     mkdir($cus_tmp_folder);
    // }
    
    // move_uploaded_file($tmp_img_name, $cus_tmp_folder.$img_name);

    // $_SESSION['shop_info_sign'] = [
    //     'shop_name' => $sign_shop_name,
    //     'shop_street' => $sign_shop_street,
    //     'shop_brngy' => $sign_shop_barngay,
    //     'shop_number' => $sign_shop_number,
    //     'shop_tmp_img_loc' => $cus_tmp_folder.$img_name,
    //     'shop_tmp_img_name' => $img_name
    // ];

//     if($shop_sell_food){
//         header('location: ../user_page/sign_up_seller.php?business_information&food_seller');
//         exit();
//     }
//     header('location: ../user_page/sign_up_seller.php?business_information');
//     exit();
    
// }elseif($_POST['submit_seller_form']){
//     $shop_info_data = $_SESSION['shop_info_sign'];
//     $shop_info->name = htmlspecialchars($shop_info_data['shop_name'] ?? '', ENT_QUOTES, 'UTF-8');
//     $shop_info->street = htmlspecialchars($shop_info_data['shop_street']?? '', ENT_QUOTES, 'UTF-8');
//     $shop_info->brngy = htmlspecialchars($shop_info_data['shop_brngy']?? '', ENT_QUOTES, 'UTF-8');
//     $shop_info->number = htmlspecialchars($shop_info_data['shop_number']?? '', ENT_QUOTES, 'UTF-8');

//     $tmp_img_loc = htmlspecialchars($shop_info_data['shop_tmp_img_loc'] ?? '', ENT_QUOTES, 'UTF-8');
//     $tmp_img_name = htmlspecialchars($shop_info_data['shop_tmp_img_name'] ?? '', ENT_QUOTES, 'UTF-8');

  
//     $market_folder_dir =  $cus_folder['cus_asset_folder'].'/market_asset/';
//     $shop_info->img = $market_folder_dir.$tmp_img_name;

//     $shop_info->tin = $_POST['tin']??null;
//     $shop_info->terms = $_POST['terms']??0;

//     $bir = $_FILES['bir']??null;
//     $dti = $_FILES['dti']??null;
//     $sec = $_FILES['sec']??null;
//     $mayor_perm = $_FILES['mayor_perm']??null;
//     $fda = $_FILES['fda']??null;

//     $shop_array_img = [$bir, $dti, $sec, $mayor_perm];
//     $shop_files_names = ['bir','dit','sec','mayor_perm','fda'];
//     if(!is_null($fda)){
//         array_push($shop_array_img, $fda);
//         $shop_info->has_food = true;
//     }

//     foreach ($shop_array_img as $key => $shop_req_img){
//         $shop_req_img['name'] = $shop_files_names[$key] .'_'.$shop_req_img['name'];
//         $file_dir_array[] = $shop_info->verify_img($shop_req_img, $market_folder_dir);
//     }

//     $shop_info->bir = $file_dir_array[0];
//     $shop_info->dti = $file_dir_array[1];
//     $shop_info->sec = $file_dir_array[2];
//     $shop_info->mayor = $file_dir_array[3];
//     if(!is_null($fda)){
//         $shop_info->fda = $file_dir_array[4];
//     }

//     if (!is_dir($market_folder_dir)) {
//         mkdir($market_folder_dir);
//     }

    // rename($tmp_img_loc,$shop_info->img);
    // $shop_db->insert_market_request($shop_info->name,$shop_info->terms,$shop_info->bir,$shop_info->tin,$shop_info->sec,$shop_info->dti,$shop_info->mayor,$shop_info->has_food,$shop_info->fda,$shop_info->street,$shop_info->brngy,$shop_info->number,$shop_info->geoloc,);
    // unset( $_SESSION['shop_info_sign']);
    // header('location: ../user_page/cus_acc_page.php');
// }


?>