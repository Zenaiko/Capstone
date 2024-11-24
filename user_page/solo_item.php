<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/solo_item.css">
    <title>Product</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>
<?php 
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once('../utilities/initialize.php');
require_once('../db_api/db_item_info.php');
require_once('../utilities/back_button.php');
?>
<section id="solo_item_section">
    <div id="solo_item_wrapper">
        <div id="solo_item_container">
            <header id="solo_item_head">
                <div id="item_img_container">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            <?php 
                            if(empty($item_info->get_img())){ ?>

                                <div class="carousel-item active">
                                    <img src="../assets/tmp.png" class="d-block w-100" alt="...">
                                </div>
                                        
                            <?php } else{ foreach($item_info->get_img() as $img){ ?> 
                                <div class="carousel-item">
                                    <img src="<?=file_exists($img)? $img : "../assets/tmp.png" ?>" class="d-block w-100" alt="">
                                </div>
                            <?php }} ?>

                        </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                    </div>
                </div>
            
                <div id="item_info_wrapper">
                    <div id="item_info_container">
                        <p id="item_price" class="item_price">₱ <?=number_format($item_info->get_min_price())?> <?php if($item_info->get_max_price() !== $item_info->get_min_price()){echo "-" . number_format($item_info->get_max_price());}?></p>
                        <p id="item_name"><?=$item_info->get_name()?></p>
                        <p id="item_sold"> sold</p>
                        <div id="item_star_container">
                            <i id="item_star" class="bi bi-star-fill"></i>
                            <p id="item_rate"><?=$item_info->get_rating()??0?>/5</p>
                            <span class="star_splitter"></span>
                            <p id="star_respondents">Respondents (<?=$item_info->get_respondents()??0?>)</p>
                        </div>
                        <i class="bi bi-hand-thumbs-up cus_rel" id="like_item"></i>
                    </div>
                </div>
            </header>

            <hr class="splitter">

            <div id="item_seller_info_wrapper">
                <div id="item_seller_info_container">
                    <div id="seller_info_contents">
                        <div id="seller_item_img_container"><img src="<?=file_exists($seller_info->get_img())?$seller_info->get_img():' ../assets/tmp.png' ?>" alt="" id="seller_item_img"></div>
                        <div id="seller_info">
                            <p id="seller_name"><?=$seller_info->get_name()?></p>
                            <p id="seller_location"><i class="bi bi-geo-alt"></i><?=$seller_info->get_brngy() . ' ,' . $seller_info->get_street() . ' ,' . $seller_info->get_city()?></p>
                            <p id="seller_star"><i class="bi bi-star-fill"></i> Seller Rating</p>
                        </div>
                        <p id="follow_seller" class="cus_rel" data-seller-id="<?=$seller_info->get_seller_id()?>">Follow</p>
                    </div>
                    <div id="visit_seller_container">
                        <a href="seller_page.php?seller=<?=$seller_info->get_seller_id()?>" id="visit_seller">Visit Store</a>
                    </div>
                </div>
            </div>

            <hr class="splitter">

            <div id="preview_items_wrapper">
                <div id="preview_items_container">
                    <header id="preview_item_header">
                        <div id="haeder_item_wrapper">
                            <p id="preview_seller_name"><?=$seller_info->get_name()?></p>
                            <p id="preview_categories">Same Categroy</p>
                        </div>
                    </header>
                    
                    
                    <div id="main_preview_contents">
                        <div id="main_preview_items">
                            <div id="see_all_container">
                                <p id="see_all_preview">See all <i class="bi bi-arrow-right" id="see_all_arrow"></i></p>
                            </div>
                            <div id="items_preview_container">
                                <?php foreach($get_top_items_solo as $item){
                                    include("../utilities/item_loop.php");
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="splitter">
            
            <div id="item_description_wrapper">
                <div id="item_description_container">
                    <p>Item Description</p>
                    <p id="item_description">
                    <?=$item_info->get_desc()?>
                    </p>
                </div>
            </div>

        </div>
    </div>
    <?php
     echo "<br><br><br>";
     ((isset($_SESSION["user"])&&$_SESSION["user"] === "customer"&&isset($_SESSION["cus_id"])))?include_once('../utilities/item_interaction.php'):null
    ?>
</section>

<script src="../js/solo_item.js"></script>
<script src="../js/item_loop.js"></script>
</body>
</html>