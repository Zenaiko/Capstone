<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="../css/home.css" rel="stylesheet">
</head>
<?php require_once('../utilities/initialize.php');
        require_once('../utilities/nav.php');
        require_once('../db_api/db_get.php');
        unset($_SESSION['shop_info']);
        unset($_SESSION['seller_id']);
        ?>
<body>

<!-- Carousel Section -->
<section class="mt-4">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/cab_mart_welcome.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/cabmart_slider.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/cab_mart_slider1.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!-- Top Shops Section -->
<section class="mt-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Top Shops</h2>
        </div>
        <div class="featured-shop-contents-row d-flex overflow-auto">

            <?php foreach($get_db->get_top_shop() as $shop){ ?>
                <div class="featured-shop-contents" id="<?=$shop["market_id"]?>">
                    <img class="feature_img" src="<?=file_exists($shop['market_image'])? $shop['market_image']:'../assets/tmp.png'?>" alt="">
                    <div class="featured-info">
                        <p class="featured-name"><?=$shop['market_name']?></p>
                        <div class="feature_shop_rate">
                            <div class="feature_shop_stars">
                                <i class="bi bi-star-fill feature_seller_star"></i>
                                <i class="bi bi-star-fill feature_seller_star"></i>
                                <i class="bi bi-star-fill feature_seller_star"></i>
                                <i class="bi bi-star-fill feature_seller_star"></i>
                                <i class="bi bi-star-fill feature_seller_star"></i>
                            </div>
                            <span class="star_splitter feature_star_splitter"></span>
                            <p class="feature_rate_respondents"><?=$shop["respondents"]?> Respondents</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
      
        </div>
    </div>
</section>


<!-- Categories Section -->
<section class="mt-5">
    <div class="container">
        <div class="categories-header">
            <h2>Categories</h2>
        </div>
        <div class="category-row">

            <?php foreach($get_db->get_category() as $category){ ?>
                <div class="category-item">
                    <a class="categ_link" href="search.php?category=<?=$category["category"]?>"><img src="<?=$category["category_img"]??"../assets/tmp.png"?>" alt=""></a>
                    <p class="category"><?=$category["category"]?></p>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<!-- Sale Section -->
<section class="mt-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Sale</h2>
        </div>

        <div class="item_loop_contaner">
            <div class="item_loop">
            <?php
                foreach($get_db->get_item_info_home() as $item){
                    include('../utilities/item_loop.php');
                }
            ?>
            </div>
        </div>
    </div>
</section>

<script src="../js/item_loop.js"></script>
</body>
</html>
