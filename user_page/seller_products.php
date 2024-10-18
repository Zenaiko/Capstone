<?php 
    require_once("../db_api/db_get.php");
    $seller_items =  $get_db->get_seller_items($_GET["seller"]); 

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/seller_products.css">

<section id="seller_products_section">
    <div id="seller_products_wrapper">
        <header id="seller_products_header">
            <div id="products_header_container">
                <p>Popular</p>
                <p>Latest</p>
                <p>Top Sales</p>
                <p>Filter <i class="bi bi-filter"></i></p>
            </div>
        </header>

        <div id="products_wrapper">
            <div id="products_container">
                <?php foreach($seller_items as $item){
                    include("../utilities/item_loop.php");
                } ?>
            </div>
        </div>

    </div>
</section>