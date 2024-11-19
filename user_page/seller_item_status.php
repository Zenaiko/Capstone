<link rel="stylesheet" href="../css/seller_item_inventory.css">
    <?php 
        require_once("../db_api/db_get.php");
        $action = $_POST["action"]??"live"??null;
        $query = $get_db->get_item_status($_SESSION['seller_id'], $action)??null;

        if(!is_null($query)){
        foreach($query as $item){ ?> 

        <div class="items-list">
            <div class="item-card">
                <div class="product-content">
                    <div class="product-image">
                        <img src="<?=is_file($item['item_img']??"")?$item['item_img']:"../assets/tmp.png" ?>">
                    </div>
                    <div class="product-details">
                        <span class="product-name"><?=$item['item_name']?></span>
                        <div class="product-info">
                            <span class="product-price">₱<?=number_format($item['min_price'])??0?></span>
                        </div>
                    <div class="product-info">
                        <span class="product-quantity">Stock: <?=number_format($item['total_stocks'])??0?> pcs</span>
                    </div>
                    </div>
                </div>
                <div class="card-actions">
                    <input type="button" class="action-btn delist-btn" id="<?=$item['item_id']?>" value="<?=($action !== "delisted")?"Delist":"Publish"?>">
                    <input type="button" class="action-btn edit-btn" id="<?=$item['item_id']?>" value="Edit">
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

        <?php }} else{ ?>
        
            <p>No Items Available</p>

        <?php } ?>
