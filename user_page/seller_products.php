<?php 
    require_once("../db_api/db_get.php");
    $type = $_POST["type"]??"popular"??null;
    $seller_items =  $get_db->get_seller_items($_GET["seller"], $type); 
?>
<link rel="stylesheet" href="../css/seller_products.css">

<section id="seller_products_section">
    <div id="seller_products_wrapper">
        <header id="seller_products_header">
            <div id="products_header_container">
                <p class="prod_tab active_prod" id="popular">Popular</p>
                <p class="prod_tab" id="latest">Latest</p>
                <p class="prod_tab" id="top_sales">Top Sales</p>
                <p class="" id="filter">Filter <i class="bi bi-filter"></i></p>
            </div>
        </header>

        <div id="products_wrapper">
            <div id="products_container">
                <?php if(!is_null($seller_items)){
                    foreach($seller_items as $item){
                        include("../utilities/item_loop.php");
                }}else{echo"No Items Found";}?>
            </div>
        </div>
    </div>
</section>
