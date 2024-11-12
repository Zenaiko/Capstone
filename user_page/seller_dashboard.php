<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
    <link href="../css/dashboard.css" rel="stylesheet">
</head>
<body>

    <?php require_once("../utilities/initialize.php");
        require_once("../utilities/seller_nav.php");
        require_once("../db_api/db_get.php");
    ?>

    <!-- Sales Statistics Header -->
    <section class="dashboard-header">
        <h4>Sales Statistics</h4>
        <select class="form-select" id="statistics-filter" style="width: auto;">
            <option value="year">This Year</option>
            <option value="month">This Month</option>
            <option value="week">This Week</option>
        </select>
    </section>

    <!-- Dashboard: Sales Statistics Chart -->
    <section style="margin-bottom: 40px;"> <!-- Increased spacing -->
        <canvas id="salesChart" style="width: 100%;"></canvas>
    </section>

    <!-- Total Revenue and Items Sold -->
    <div id="statistics_info">
        <div class="card stats_card">
            <p id="total_rev"></p>
            <h5>Total Revenue</h5>
        </div>
        <div class="card stats_card">
            <p id="total_sold"></p>
            <h5>Total Items Sold</h5>
        </div>
    </div>

    <!-- Top Selling Products -->
    <section class="dashboard-header" style="margin-bottom: 10px;"> <!-- Increased spacing -->
        <h4 style="font-weight: bold;">Top Selling Products (All Time)</h4>
    </section>

    <!-- Product Cards -->
    <div id="topSellingProducts">

        <?php foreach($get_db->get_top_selling_items($_SESSION["seller_id"]) as $key => $item){ ?> 
            <div class="product-card">
                <span class="rank"><?=$key+1?></span>
                <img src="<?=file_exists($item["item_img"]) ? $item["item_img"] : "../assets/tmp.png";?>" alt="Product 1">
                <div class="product-info">
                    <div class="product-name"><?=$item["item_name"]?></div>
                    <div>Total Orders: <?=$item["total_sold"]?></div>
                    <div>Total Income: ₱<?=$item["total_income"]?></div>
                </div>
            </div>
            
        <?php } ?>

    </div>
    
<script src="../js/seller_dashboard.js"></script>
</body>
</html>
