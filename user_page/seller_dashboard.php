<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            <option value="all-time">This Year</option>
            <option value="last-week">This Week</option>
            <option value="last-month">This Month</option>
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
        <h4 style="font-weight: bold;">Top Selling Products</h4>
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
    
<script src="../js/seller_dashboard.js">

    // Chart.js configuration
    // const ctx = document.getElementById('salesChart').getContext('2d');
    // let salesChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],  // Sample labels
    //         datasets: [{
    //             label: 'Sales',
    //             data: [1000, 1500, 1200, 1800, 2200, 1900, 2100],  // Sample data
    //             borderColor: 'rgba(75, 192, 192, 1)',
    //             fill: false,
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false
    //     }
    // });

    // // Update chart based on dropdown selection
    // document.getElementById('statistics-filter').addEventListener('change', function() {
    //     let selectedOption = this.value;

    //     // Example chart updates, replace with actual logic
    //     if (selectedOption === 'last-week') {
    //         salesChart.data.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    //         salesChart.data.datasets[0].data = [200, 300, 250, 400, 350, 500, 450];
    //     } else if (selectedOption === 'last-month') {
    //         salesChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
    //         salesChart.data.datasets[0].data = [1200, 1400, 1300, 1600];
    //     } else {
    //         salesChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
    //         salesChart.data.datasets[0].data = [1000, 1500, 1200, 1800, 2200, 1900, 2100]; // Revert to original data
    //     }

    //     salesChart.update();
    // });
</script>
</body>
</html>
