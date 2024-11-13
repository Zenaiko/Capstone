<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/item.css">
    <link rel="stylesheet" href="../css/search.css">
    <title>User Page</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
</head>
<body>

<?php require_once("../utilities/initialize.php");
      require_once("../utilities/nav.php");
      require_once("../db_api/db_get.php"); ?>

<section id="search_section" class="container my-4">
    <div class="d-flex justify-content-end mb-3">
        <!-- Filter Button -->
        <button id="filterButton" class="btn btn-outline-secondary">
            <i class="bi bi-funnel-fill"></i>
        </button>
    </div>

    <div id="search_contents" class="row mt-4">
        <?php 
        if(isset($_GET["category"])){
            $items = $get_db->get_category_item($_GET["category"]);
        }
        foreach($items as $item){
            include("../utilities/item_loop.php");
        }
        ?>
    </div>
</section>

<div id="filterSidebar">
    <h5>Filter By:</h5>
    <form id="filterForm" method="GET" action="filter_products.php">
        <!-- Price Range Filter -->
        <div class="mb-3">
            <label for="price" class="form-label">Price Range</label>
            <input type="number" id="price" name="price" class="form-control" placeholder="₱ ">
        </div>
        <!-- Ratings Filter -->
        <div class="mb-3">
            <label for="rating" class="form-label">Ratings</label>
            <select id="rating" name="rating" class="form-select">
                <option value="">Any</option>
                <option value="4">4 stars</option>
                <option value="3">3 stars</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Apply Filters</button>
    </form>
</div>

<script src="../js/item_loop.js"></script>
<script src="../js/filter.js"></script>
</body>
</html>
