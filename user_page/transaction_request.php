<?php require_once("../db_api/db_get_orders.php");?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/transaction.css">

<div class="transaction-card">
  <?php foreach($order_requests as $req){?>
     <div class="buyer-info">
      <img src="../assets/tmp.png" alt="" class="buyer-pic">
      <span class="buyer-name"><?=$req["username"]?></span>
    </div>
    <div class="separator"></div>
    <div class="order-info">
      <div class="product-details">
        <div class="product-text">
          <p class="product-name"><?=$req["item_name"] . " (" . $req["variation_name"] .")"?></p>
          <p class="quantity">Quantity:<?=$req["order_qty"]?></p>
          <p class="price">₱ <?= $req["order_price"]?></p>
        </div>
        <img src="../assets/tmp.png" alt="" class="product-pic">
      </div>
    </div>
    <div class="order-time">
      <p><?=$req["date_requested"]?></p>
    </div>
    <div class="separator"></div>
    <div class="action-buttons">
        <input type="button" class="accept-btn" id="<?=$req["order_id"]?>" value="Accept">
      <input type="button" class="reject-btn" id="<?=$req["order_id"]?>" value="Reject">
    </div> 

  <?php } ?>

    <!-- <div class="buyer-info">
      <img src="buyer-image.jpg" alt="Buyer Profile Picture" class="buyer-pic">
      <span class="buyer-name">Mikalze</span>
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
    <div class="action-buttons">
        <input type="button" class="accept-btn" value="Accept">
      <input type="button" class="reject-btn" value="Reject">
    </div> -->
  </div>

  <script>
    

  </script>