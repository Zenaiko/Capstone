<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="../css/dashboard.css" rel="stylesheet">
</head>
<body>
    <!-- Sales Statistics Header -->
    <section class="dashboard-header">
        <h4>Sales Statistics</h4>
        <select class="form-select" id="statistics-filter" style="width: auto;">
            <option value="all-time">All Time</option>
            <option value="last-week">Last Week</option>
            <option value="last-month">Last Month</option>
        </select>
    </section>

    <!-- Dashboard: Sales Statistics Chart -->
    <section style="margin-bottom: 40px;"> <!-- Increased spacing -->
        <canvas id="salesChart" style="width: 100%; max-height: 300px;"></canvas>
    </section>

    <!-- Total Revenue and Items Sold -->
    <div id="statistics_info">
        <div class="card stats_card">
            <p>₱50,000.00</p>
            <h5>Total Revenue</h5>
        </div>
        <div class="card stats_card">
            <p>150</p>
            <h5>Total Items Sold</h5>
        </div>
    </div>

    <!-- Top Selling Products -->
    <section class="dashboard-header" style="margin-bottom: 10px;"> <!-- Increased spacing -->
        <h4 style="font-weight: bold;">Top Selling Products</h4>
    </section>

    <!-- Product Cards -->
    <div id="topSellingProducts">
        <div class="product-card">
            <span class="rank">1</span>
            <img src="product1.jpg" alt="Product 1">
            <div class="product-info">
                <div class="product-name">Product 1</div>
                <div>Total Orders: 100</div>
                <div>Total Income: ₱5,000.00</div>
            </div>
        </div>
        <div class="product-card">
            <span class="rank">2</span>
            <img src="product2.jpg" alt="Product 2">
            <div class="product-info">
                <div class="product-name">Product 2</div>
                <div>Total Orders: 80</div>
                <div>Total Income: ₱4,000.00</div>
            </div>
        </div>
        <div class="product-card">
            <span class="rank">3</span>
            <img src="product3.jpg" alt="Product 3">
            <div class="product-info">
                <div class="product-name">Product 3</div>
                <div>Total Orders: 50</div>
                <div>Total Income: ₱3,000.00</div>
            </div>
        </div>
    </div>
<script>
    // Chart.js configuration
    const ctx = document.getElementById('salesChart').getContext('2d');
    let salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],  // Sample labels
            datasets: [{
                label: 'Sales',
                data: [1000, 1500, 1200, 1800, 2200, 1900, 2100],  // Sample data
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Update chart based on dropdown selection
    document.getElementById('statistics-filter').addEventListener('change', function() {
        let selectedOption = this.value;

        // Example chart updates, replace with actual logic
        if (selectedOption === 'last-week') {
            salesChart.data.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            salesChart.data.datasets[0].data = [200, 300, 250, 400, 350, 500, 450];
        } else if (selectedOption === 'last-month') {
            salesChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            salesChart.data.datasets[0].data = [1200, 1400, 1300, 1600];
        } else {
            salesChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
            salesChart.data.datasets[0].data = [1000, 1500, 1200, 1800, 2200, 1900, 2100]; // Revert to original data
        }

        salesChart.update();
    });
</script>
</body>
</html>
