<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Inventory</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
    <link rel="stylesheet" href="../css/seller_item_inventory.css">
    
</head>
<body>
    <?php 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    require_once("../utilities/initialize.php");
        require_once("../utilities/seller_nav.php");
    ?>
    <!-- Header Selector -->
    <header class="header">
        <nav class="selector">
            <ul class="scrollable-tabs">
                <li class="tab" id="live">Live</li>
                <li class="tab" id="sold_out">Sold Out</li>
                <li class="tab" id="reviewing">Reviewing</li>
                <li class="tab" id="violation">Violation</li>
                <li class="tab" id="delisted">Delisted</li>
                <li class="tab" id="history">History</li>
            </ul>
            <div class="tab-indicator"></div>
        </nav>
    </header>

    <!-- Search Bar -->
    <section class="search-bar">
        <input type="text" id="search-input" placeholder="Search items...">
    </section>

    <!-- Items Section with Dropdown -->
    <section class="items-section">
        <div class="items-header">
            <span class="items-title"><strong>Items</strong></span>
            <select class="filter-dropdown">
                <option value="all">All Items</option>
                <option value="specific">Specific Items</option>
            </select>
        </div>
        
        <!-- Product Cards Section -->
        <div id="items-section">
            <!-- Content will be loaded here via AJAX -->
             <?php include("seller_item_status.php"); ?>
        </div>
    </section>

    <div class="fixed-button-container">
            <a href="seller_product_add.php" class="add-item-btn" id="add_item" value="">Add Item</a>
    </div>

    <script src="../js/seller_item_inventory.js"></script>

</body>
</html>
