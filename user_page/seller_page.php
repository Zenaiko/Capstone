<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/seller_page.css">
    <title>Seller Page</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>
    <?php require_once('../utilities/initialize.php'); 
            require_once("../db_api/db_get.php");
            $seller_info = $get_db->get_shop_info($_GET["seller"]);
            ob_start();
    ?>

    <section id="seller_page_section">
        <div id="seller_page_wrapper">
            <header id="seller_page_header">
                <div id="seller_page_header_wrapper">
                    <img src="<?=$seller_info["market_image"]??"../assets/tmp.png"?>" alt="" id="seller_account_img">
                    <div id="seller_page_info">
                        <p id="seller_name"><?=$seller_info["market_name"]?></p>
                        <div id="seller_rates">
                            <i id="seller_page_star" class="bi bi-star-fill"></i>
                            <p id="seller_average"><?=$seller_info["rate"]??0?>/5</p>
                        </div>
                    </div>
                    <p id="follow_seller" class="cus_rel" data-seller-id="<?=$seller_info["market_id"]?>">Follow</p>
                    <div id="seller_page_follower">
                        <p id="seller_follower_Count"><?=$seller_info["follows"]??0?></p>
                        <p id="follower">Followers</p>
                    </div>
                </div>
            </header>

            <div id="seller_options_wrapper">
                <div id="seller_options_container">
                    <p class="seller_tabs" id="seller_store">Store</p>
                    <p class="seller_tabs" id="seller_products">Products</p>
                    <p class="seller_tabs" id="seller_categories">Categries</p>
                </div>
            </div>

            <div id="seller_main_wrapper">
                <div id="seller_loader">
                    <?php include_once("seller_landing.php"); ?>
                </div>
            </div>
      
        </div>
    </section>

    <script src="../js/seller_page.js"></script>
    <script src="../js/solo_item.js"></script>
    <script src="../js/item_loop.js"></script>
</body>
</html>