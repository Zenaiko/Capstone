<?php 
require_once("../db_api/db_get_orders.php");
$oder_processing = $order_info_db->get_transaction_info("preparing");
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/transaction.css">

<div class="transaction-card">
  <?php foreach($oder_processing as $transaction){ ?>
    <div class="buyer-info">
      <img src="<?=$transaction["customer_img"]??"../assets/tmp.png"?>" alt="Buyer Profile Picture" class="buyer-pic">
      <span class="buyer-name"><?=$transaction["username"]?></span>
    </div>
    <div class="separator"></div>
    <div class="order-info">
      <div class="order-details">
        <!-- loop for each order/s -->
         <?php foreach($transaction["orders"] as $order){ ?>
            <div class="product-text">
              <p class="product-name"><?=$order["item_name"] . "(" . $order["variation_name"] . ")"?></p>
              <p class="quantity">Quantity: <?=$order["order_qty"]?></p>
              <p class="price">₱<?=$order["order_price"]?></p>
            </div>
        <?php } ?>
          <p>Order Subtotal Price: ₱<?=$transaction["total_transaction_amt"]?></p>
      </div>
    </div>
    <div class="order-time">
      <p><?=$transaction["order_acceptance_date"]?></p>
    </div>
    <div class="separator"></div>
    <div class="action-buttons centered"> 
      <input type="button" class="order_btn prepare-btn" id="<?=$transaction["transaction_id"]?>" value="Prepared">
      <input type="button" class="order_btn abort-btn" id="<?=$transaction["transaction_id"]?>" value="Cancel">
    </div>
  <?php } ?>
  




  <!-- <div class="buyer-info">
    <img src="buyer-image.jpg" alt="Buyer Profile Picture" class="buyer-pic">
    <span class="buyer-name">Jemboss</span>
  </div>
  <div class="separator"></div>
  <div class="order-info">
    <h3 class="order-title">Order</h3>
    <div class="product-details">
      <div class="product-text">
        <p class="product-name">Product Name</p>
        <p class="quantity">Quantity: 2</p>
        <p class="price">₱500</p>
      </div>
      <img src="product-image.jpg" alt="Product Picture" class="product-pic">
    </div>
  </div>
  <div class="order-time">
    <p>September 30, 2024 - 12:30 PM (Mon)</p>
  </div>
  <div class="separator"></div>
  <div class="rider-info">
    <p>Rider Name: lamaw Cruz</p>
    <p>Rider Number: 1234567890</p>
  </div>
  <div class="separator"></div>
  <div class="action-buttons centered"> 
    <input type="button" class="abort-btn" value="Abort">
  </div> -->
</div>