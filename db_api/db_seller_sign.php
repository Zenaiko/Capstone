<?php 
//     require_once('db_root_conn.php');
//     session_start();

//  class seller_sign_database extends class_database{
//     private $customer_id;
//     private $market_id;
//     private $address_id;
//     public function __construct()
//     {
//         parent::__construct('root' , '');
//         $this->customer_id = $_SESSION['cus_id'];
//     }

//     public function get_cus_folder(){
//         $cus_folder = $this->query("SELECT cus_asset_folder FROM tbl_customer WHERE customerID = ?", [$this->customer_id]);
//         return $cus_folder->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public function insert_market_request($shop_name, $terms, $bir, $tin, $sec, $dti, $mayor_perm, $has_food, $fda ,$street, $brngy, $house_num ,$geoloc){
//         $this->query('START TRANSACTION');

//         $market_qry = $this->pdo->prepare("INSERT INTO tbl_market (customerID, market_name, date_created, terms_and_acceptance) VALUES (:cus_id,:username, :date_create, :terms)");
//         $market_qry->execute([
//             ':cus_id' => $this->customer_id,
//             ':username' => $shop_name,
//             ':date_create' => date('Y-m-d H:i:s'),
//             ':terms' => $terms
//         ]);
//         $this->market_id = $this->pdo->lastInsertId();

//         $address_qry = $this->pdo->prepare("INSERT INTO tbl_address(street, brngy, house_unit_number, geolocation) VALUES (:street, :brngy, :unit, :geo)");
//         $address_qry->execute([
//             ':street'=> $street,
//             ':brngy'=> $brngy,
//             ':unit'=> $house_num, 
//             ':geo'=> $geoloc
//         ]);
//         $this->address_id = $this->pdo->lastInsertId();

//         $market_rqst_qry = $this->pdo->prepare("INSERT INTO tbl_market_request (market_id, seller_id, bir, tin, dti, sec, mayor_permit,has_food,fda, market_address_id) VALUES (:market_id, :seller_id, :bir, :tin, :dti, :sec, :mayor_perm, :has_food, :fda,:address_id)");
//         $market_rqst_qry->execute([
//             ':market_id' => $this->market_id,
//             ':seller_id' => $this->customer_id,
//             ':bir' => $bir,
//             ':tin' => $tin,
//             ':dti' => $dti,
//             ':sec' => $sec,
//             ':mayor_perm' => $mayor_perm,
//             ':has_food' => $has_food,
//             ':fda' => $fda,
//             ':address_id' => $this->address_id
//         ]);


//         $this->query('COMMIT');
        
//     } 
// }

// class class_shop_sign_info{
//     public $name;
//     public $img;
//     public $street;
//     public $brngy;
//     public $number;
//     public $geoloc;
//     public $tin;
//     public $bir;
//     public $dti;
//     public $sec;
//     public $mayor;
//     public $has_food;
//     public $fda;
//     public $terms;

//     public function verify_img($img, $market_folder_dir){
//         if ($img['error'] !== UPLOAD_ERR_OK) {
//             die("File upload error: " . $img['error']);
//         }
//         $tmp_file_name = $img['tmp_name'];
//         $file_name = $img['name'];

//         move_uploaded_file($tmp_file_name, $market_folder_dir.$file_name);
//         return $market_folder_dir.$file_name;
//     }
// }

// $shop_db = new seller_sign_database();
// $shop_info = new class_shop_sign_info();
// $cus_folder = $shop_db->get_cus_folder()[0];

// if(isset($_POST['submit_shop_info'])){
//     $sign_shop_name = $_POST['sign_shop_name'] ??NULL;
//     $sign_shop_street = $_POST['sign_shop_street']??NULL;
//     $sign_shop_barngay = $_POST['sign_shop_barngay']??NULL;
//     $sign_shop_number = $_POST['sign_shop_number']??NULL;
//     $shop_sell_food = $_POST['shop_sell_food']??NULL;

//     $tmp_img_name = $_FILES['sign_upload_shop_image']['tmp_name']??NULL;
//     $img_name = $_FILES['sign_upload_shop_image']['name']??NULL;
//     $img_error = $_FILES['sign_upload_shop_image']['error']??NULL;
//     $cus_tmp_folder = $cus_folder['cus_asset_folder']."/tmp_img/";

//     if(!is_dir($cus_tmp_folder)){
//         mkdir($cus_tmp_folder);
//     }
    
//     move_uploaded_file($tmp_img_name, $cus_tmp_folder.$img_name);

//     $_SESSION['shop_info_sign'] = [
//         'shop_name' => $sign_shop_name,
//         'shop_street' => $sign_shop_street,
//         'shop_brngy' => $sign_shop_barngay,
//         'shop_number' => $sign_shop_number,
//         'shop_tmp_img_loc' => $cus_tmp_folder.$img_name,
//         'shop_tmp_img_name' => $img_name
//     ];

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

//     // rename($tmp_img_loc,$shop_info->img);
//     $shop_db->insert_market_request($shop_info->name,$shop_info->terms,$shop_info->bir,$shop_info->tin,$shop_info->sec,$shop_info->dti,$shop_info->mayor,$shop_info->has_food,$shop_info->fda,$shop_info->street,$shop_info->brngy,$shop_info->number,$shop_info->geoloc,);
//     // unset( $_SESSION['shop_info_sign']);
//     // header('location: ../user_page/cus_acc_page.php');
// }


?>