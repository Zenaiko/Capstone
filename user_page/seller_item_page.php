<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Inventory</title>
    <link rel="stylesheet" href="../css/seller_item_inventory.css">
    
</head>
<body>
    <?php require_once("../utilities/initialize.php");?>
    <!-- Header Selector -->
    <header class="header">
        <nav class="selector">
            <ul class="scrollable-tabs">
                <li class="tab active" data-tab="live">Live</li>
                <li class="tab" data-tab="sold-out">Sold Out</li>
                <li class="tab" data-tab="reviewing">Reviewing</li>
                <li class="tab" data-tab="violation">Violation</li>
                <li class="tab" data-tab="unpublished">Unpublished</li>
                <li class="tab" data-tab="history">History</li>
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
        </div>
    </section>

    <script src="../js/seller_item_inventory.js"></script>



</body>
</html>
