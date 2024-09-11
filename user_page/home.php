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
        require_once('../utilities/nav.php');?>
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
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
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
            <a href="#" class="view-more" style="color: #878787;">View More</a>
        </div>
        <div class="featured-shop-contents-row d-flex overflow-auto">
            <div class="featured-shop-contents">
                <img src="https://via.placeholder.com/150" alt="Shop 1">
            <div class="featured-info">
                <p class="featured-name">Featured Shop</p>
            </div>
                
            </div>
            <div class="featured-shop-contents">
                <img src="https://via.placeholder.com/150" alt="Shop 2">
                <div class="featured-info">
                <p class="featured-name">Featured Shop</p>
            </div>    
                
            </div>
            <div class="featured-shop-contents">
                <img src="https://via.placeholder.com/150" alt="Shop 3">
                <div class="featured-info">
                <p class="featured-name">Featured Shop</p>
            </div>   
            </div>
            <div class="featured-shop-contents">
                <img src="https://via.placeholder.com/150" alt="Shop 4">
                <div class="featured-info">
                <p class="featured-name">Featured Shop</p>
            </div>   
            </div>
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
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 1"></a>
                <p>Category 1</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 2"></a>
                <p>Category 2</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 3"></a>
                <p>Category 3</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 4"></a>
                <p>Category 4</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 4"></a>
                <p>Category 4</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 4"></a>
                <p>Category 4</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 4"></a>
                <p>Category 4</p>
            </div>
            <div class="category-item">
                <a href="#"><img src="https://via.placeholder.com/100" alt="Category 4"></a>
                <p>Category 4</p>
            </div>
        </div>
    </div>
</section>

<!-- Sale Section -->
<section class="mt-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Sale</h2>
            <a href="#" class="view-more" style="color: #878787;">View More</a>
        </div>
        <div class="item_loop"><?php require_once(' ') ?></div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="text-white">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">Shop</a></li>
                    <li><a href="#" class="footer-link">Contact</a></li>
                    <li><a href="#" class="footer-link">About Us</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-3 text-center">
                <h5 class="text-white">Follow Us</h5>
                <a href="#" class="footer-icon me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="footer-icon me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="footer-icon me-3"><i class="fab fa-instagram"></i></a>
            </div>

            <div class="col-md-4 mb-3">
                <h5 class="text-white">Contact Us</h5>
                <p class="footer-contact text-white">Email: hotdogseller@gmail.com</p>
                <p class="footer-contact text-white">Phone: </p>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="text-white mb-0">&copy; 2024 Shop. All Rights Reserved.</p>
        </div>
    </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
