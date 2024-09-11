<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/seller_page.css">
    <title>Document</title>
</head>
<body>

    <?php require_once('../utilities/initialize.php'); ?>

    <section id="seller_page_section">
        <div id="seller_page_wrapper">
            <header id="seller_page_header">
                <div id="seller_page_header_wrapper">
                    <img src="https://via.placeholder.com/45" alt="" id="seller_account_img">
                    <div id="seller_page_info">
                        <p id="seller_name"> Seller</p>
                        <div id="seller_rates">
                            <i id="seller_page_star" class="bi bi-star-fill"></i>
                            <p id="seller_average">4.0/5</p>
                        </div>
                    </div>
                    <p id="seller_page_follow">Follow</p>
                    <div id="seller_page_follower">
                        <p id="seller_follower_Count">0</p>
                        <p id="follower">Followers</p>
                    </div>
                </div>
            </header>

            <div id="seller_options_wrapper">
                <div id="seller_options_container">
                    <p id="seller_page_store">Store</p>
                    <p id="seller_page_products">Products</p>
                    <p id="seller_page_categories">Categries</p>
                </div>
            </div>

            <div id="seller_main_wrapper">
                <?php require_once('seller_landing.php') ?>
            </div>
      
            <div id="seller_page_carousel_wrapper">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/360x154" class="d-block w-100 seller_carousel_img" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/360x154" class="d-block w-100 seller_carousel_img" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/360x154" class="d-block w-100 seller_carousel_img" alt="...">
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

        </div>
    </section>
</body>
</html>