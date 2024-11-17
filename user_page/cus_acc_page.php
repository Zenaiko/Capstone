<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cus_acc_page.css">
    <title>Account Page</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>

<body>
<?php require_once('../utilities/initialize.php');
require_once('../utilities/nav.php');
require_once('../db_api/db_cus_info.php');
require_once('../db_api/db_get.php');
unset($_SESSION["seller_id"]);
?>

    <section id="cus_acc_section">
        <div id="cus_acc_wrapper">
            <header id="cus_acc_header">
                <div id="cus_acc_header_contents">
                    <img id="cus_acc_img"  src="<?php if(isset($cus_info->user_img)){echo $cus_info->customer_img;}else{echo '../assets/tmp.png';}?>" alt="">
                    <div id="cus_acc_info">
                        <p id="cus_username"> <?=$cus_info->username?> </p>
                        <p id="cus_liked_items" class="cus_info_relation">  <?=$cus_info->like??0 ?> Liked Items</p>
                        <p id="cus_following" class="cus_info_relation"> <?=$cus_info->follow??0 ?> Following</p>
                    </div>
                </div>
            </header>

            <div id="cus_acc_order_info">
                <div id="cus_acc_order_info_wrapper">
                    <div id="cus_acc_order_info_container">
                        <div id="cus_acc_order_head">
                            <p>Orders</p>
                            <a href="order_transaction_history.php">View Transaction History <i class="bi bi-chevron-compact-right"></i></a>
                        </div>
                        <div id="cus_order_info_wrapper">
                            <div id="cus_order_info_container">
                                <div>
                                    <i class="bi bi-clipboard"></i>
                                    <a href="order_request.php">Requested</a>
                                </div>
                                <div>
                                    <i class="bi bi-clipboard"></i>
                                    <a href="order_accepted.php">Accepted</a>
                                </div>
                                <div>
                                    <i class="bi bi-truck"></i>
                                    <a href="order_shipping.php">Shipped</a>
                                </div>
                                <div>
                                    <i class="bi bi-box"></i>
                                    <a href="order_received.php">Delivered</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="splitter"> 

            <div id="cus_acc_body">
                <div id="cus_acc_body_wrapeper">
                    <figure id="account" class="cus_acc_body_content">
                        <i class="bi bi-person-gear"></i>
                        <figcaption>Account</figcaption>
                    </figure>
                    <figure id="address" class="cus_acc_body_content">
                        <i class="bi bi-compass"></i>
                        <figcaption>Address</figcaption>
                    </figure>
                    <figure id="liked" class="cus_acc_body_content">
                        <i class="bi bi-heart"></i>
                        <figcaption>Liked Items</figcaption>
                    </figure>
                    <figure id="store" class="cus_acc_body_content">
                        <i class="bi bi-basket"></i>
                        <figcaption>My Store</figcaption>
                    </figure>
                    <figure id="help" class="cus_acc_body_content">
                        <i class="bi bi-question-circle"></i>
                        <figcaption>Help Center</figcaption>
                    </figure>    
                    <figure id="rider" class="cus_acc_body_content">
                        <i class="bi bi-bicycle"></i>
                        <figcaption>Become a Rider</figcaption>
                    </figure>              
                    <figure id="logout" class="cus_acc_body_content">
                        <i class="bi bi-box-arrow-left"></i>
                        <figcaption>Logout</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    
    <p class="text-center text-capitalize">You may also like</p>

    <div class="item_loop_contaner">
        <div class="item_loop">
            <?php foreach($get_db->get_item_info_home() as $item){
                include('../utilities/item_loop.php');
            }?>
        </div>
    </div>

<?php
if (isset($_SESSION['seller_create'])) {
    if ($_SESSION['seller_create'] === true) {
        echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Request Sent',
            text: 'Please wait until your reuqest is approved',
        });
        </script>";
    } elseif ($_SESSION['seller_create'] === false) {
        echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'An error has occured',
            text: 'Please try again',
        </script>";
    }
    // Unset the session variable after displaying it
    unset($_SESSION['seller_create']);
}
?>
<script src="../js/cus_acc.js"></script>
<script src="../js/item_loop.js"></script>
</body>
</html>