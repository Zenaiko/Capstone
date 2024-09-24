<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/seller_item_inventory.css">

    <?php require_once("../db_api/db_get.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
        $live_items = $get_db->get_item_live($_SESSION['seller_id']);
        if(!is_null($live_items[0]["item_name"])){
        foreach($live_items as $item){ ?> 

            
        <div class="items-list">
            <div class="item-card">
                <div class="product-content">
                    <div class="product-image">
                        <img src="<?=$item['']??"../assets/tmp.png" ?>">
                    </div>
                    <div class="product-details">
                        <span class="product-name"><?=$item['item_name']?></span>
                        <div class="product-info">
                            <span class="product-price"><?=$item['min_price']?></span>
                        </div>
                    <div class="product-info">
                        <span class="product-quantity">Stock: <?=$item['total_stocks']?> pcs</span>
                    </div>
                    </div>
                </div>
                <div class="card-actions">
                    <input type="button" class="action-btn delist-btn" value="Delist">
                    <input type="button" class="action-btn edit-btn" value="Edit">
                    <input type="button" class="action-btn more-options-btn" value="...">
                    <div class="more-options-dropdown">
                        <ul>
                            <li class="dropdown-item">Price & Stock</li>
                            <li class="dropdown-item">Delete</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php }} ?>
<!-- 
        <div class="items-list">
            <div class="item-card">
                <div class="product-content">
                    <div class="product-image">
                        <img src="placeholder.jpg">
                    </div>
                    <div class="product-details">
                        <span class="product-name">Product Name</span>
                        <div class="product-info">
                            <span class="product-price">₱1000</span>
                        </div>
                        <div class="product-info">
                        <span class="product-views">50 views</span>
                    </div>
                    <div class="product-info">
                        <span class="product-quantity">Stock: 10 pcs</span>
                    </div>
                    </div>
                </div>
                <div class="card-actions">
                    <input type="button" class="action-btn delist-btn" value="Delist">
                    <input type="button" class="action-btn edit-btn" value="Edit">
                    <input type="button" class="action-btn more-options-btn" value="...">
                    <div class="more-options-dropdown">
                        <ul>
                            <li class="dropdown-item">Price & Stock</li>
                            <li class="dropdown-item">Delete</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
            <!-- <div class="items-list">
                <div class="item-card">
                    <div class="product-content">
                        <div class="product-image">
                            <img src="placeholder.jpg">
                        </div>
                        <div class="product-details">
                            <span class="product-name">Product Name</span>
                            <div class="product-info">
                                <span class="product-price">₱1000</span>
                            </div>
                            <div class="product-info">
                            <span class="product-views">50 views</span>
                        </div>
                        <div class="product-info">
                            <span class="product-quantity">Stock: 10 pcs</span>
                        </div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <input type="button" class="action-btn delist-btn" value="Delist">
                        <input type="button" class="action-btn edit-btn" value="Edit">
                        <input type="button" class="action-btn more-options-btn" value="...">
                        <div class="more-options-dropdown">
                            <ul>
                                <li class="dropdown-item">Price & Stock</li>
                                <li class="dropdown-item">Delete</li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="items-list">
                    <div class="item-card">
                        <div class="product-content">
                            <div class="product-image">
                                <img src="placeholder.jpg">
                            </div>
                            <div class="product-details">
                                <span class="product-name">Product Name</span>
                                <div class="product-info">
                                    <span class="product-price">₱1000</span>
                                </div>
                                <div class="product-info">
                                <span class="product-views">50 views</span>
                            </div>
                            <div class="product-info">
                                <span class="product-quantity">Stock: 10 pcs</span>
                            </div>
                            </div>
                        </div>
                        <div class="card-actions">
                            <input type="button" class="action-btn delist-btn" value="Delist">
                            <input type="button" class="action-btn edit-btn" value="Edit">
                            <input type="button" class="action-btn more-options-btn" value="...">
                            <div class="more-options-dropdown">
                                <ul>
                                    <li class="dropdown-item">Price & Stock</li>
                                    <li class="dropdown-item">Delete</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- Add Item Button -->
        <input type="button" class="add-item-btn" value="Add Item">


