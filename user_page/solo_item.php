<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/solo_item.css">
    <title>Document</title>
</head>
<body>
    <?php require_once('../utilities/initialize.php');
     require_once('../utilities/nav.php');
     require_once('../db_api/db_item_info.php'); ?>
    <section id="solo_item_section">
        <div id="solo_item_wrapper">
            <div id="solo_item_container">
                <header id="solo_item_head">
                    <div id="item_img_container">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    <?php foreach(){  ?> 
                                        <div class="carousel-item">
                                        <img src="../assets/tmp.png" class="d-block w-100" alt="...">
                                        </div>
                                    <?php } ?>
                                    <!-- <div class="carousel-item active">
                                    <img src="../assets/tmp.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="../assets/tmp.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="../assets/tmp.png" class="d-block w-100" alt="...">
                                    </div> -->
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
                            <p id="item_price" class="item_price">₱ 12</p>
                            <p id="item_name">Beef Hotdog fresh from Milkakrem per kilo</p>
                            <p id="item_sold">10k sold</p>
                            <div id="item_star_container">
                                <i id="item_star" class="bi bi-star-fill"></i>
                                <p id="item_rate">4.9/5</p>
                                <span class="star_splitter"></span>
                                <p id="star_respondents">Respondents (500)</p>
                            </div>
                            <i class="bi bi-hand-thumbs-up" id="solo_item_like"></i>
                            <p id="rate_item">Rate</p>
                        </div>
                    </div>
                </header>

                <hr class="splitter">

                <div id="item_seller_info_wrapper">
                    <div id="item_seller_info_container">
                        <div id="seller_info_contents">
                            <div id="seller_item_img_container"><img src="../assets/tmp.png" alt="" id="seller_item_img"></div>
                            <div id="seller_info">
                                <p id="seller_name">Hotdog selelr</p>
                                <p id="seller_location"><i class="bi bi-geo-alt"></i>Burgos, Sangitan, Cabanatuan CIty</p>
                                <p id="seller_star"><i class="bi bi-star-fill"></i> 4.5 Seller Rating</p>
                            </div>
                            <p id="follow_seller">Follow</p>
                        </div>
                        <div id="visit_seller_container">
                            <p id="visit_seller">Visit Store</p>
                        </div>
                    </div>
                </div>

                <hr class="splitter">

                <div id="preview_items_wrapper">
                    <div id="preview_items_container">
                        <header id="preview_item_header">
                            <div id="haeder_item_wrapper">
                                <p id="preview_seller_name">Hotdog seller</p>
                                <p id="preview_categories">Same Categroy</p>
                            </div>
                        </header>
                        
                        
                        <div id="main_preview_contents">
                            <div id="main_preview_items">
                                <div id="see_all_container">
                                    <p id="see_all_preview">See all <i class="bi bi-arrow-right" id="see_all_arrow"></i></p>
                                </div>
                                <!-- <div id="items_preview_container"><?php require_once('../utilities/item_loop.php') ?></div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="splitter">
                
                <div id="item_description_wrapper">
                    <div id="item_description_container">
                        <p>Item Description</p>
                        <p id="item_description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis tempore animi ducimus assumenda voluptate ab veniam optio fugiat possimus odit accusantium et excepturi rerum recusandae molestias, minus deserunt ipsam quidem, placeat sequi eum temporibus necessitatibus cum doloribus. Doloribus, unde optio a reiciendis quasi debitis sint! Alias reprehenderit quas facilis nostrum!
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php require_once('../utilities/item_interaction.php') ?>

</body>
</html>