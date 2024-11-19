<?php 
require_once("../db_api/db_get_orders.php");
$transaction_processing = $order_info_db->get_transaction_info("prepared_shipping");
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/transaction.css">

<?php foreach($transaction_processing as $transaction){  ?>

<div class="transaction-card">
    <div class="buyer-info">
      <img src="<?=$transaction["customer_img"]??"../assets/tmp.png"?>" alt="Buyer Profile Picture" class="buyer-pic">
      <span class="buyer-name"><?=$transaction["username"]?></span>
    </div>
    <div class="separator"></div>
    <div class="order-info">
      <div class="order-details">
        <!-- loop for each order/s -->
        <?php foreach($transaction["orders"] as $order){  ?>
          <div class="product-text">
            <p class="product-name"><?=$order["item_name"] . "(" . $order["variation_name"] . ")"?></</p>
            <p class="quantity">Quantity: <?=number_format($order["order_qty"])?></p>
            <p class="price">Order Total: ₱<?=number_format($order["order_price"])?></p>
          </div> 
        <?php } ?>
          <p>Transaction Subtotal: ₱<?=number_format($transaction["total_transaction_amt"])?></p>
      </div>
    </div>
    <div class="order-time">
      <p><?=$transaction["order_acceptance_date"]?></p>
    </div>
    <div class="separator"></div>

    <!-- Checks if a rider is already assigned -->
     <?php if(isset($transaction["rider"]) && !empty($transaction["rider"])){?>
        <div class="rider-info">
          <p>Rider Name: <?=$transaction["rider"]["username"] ?> </p>
          <p>Rider Number: <?=$transaction["rider"]["contact"] ?> </p>
        </div>
      <?php } ?>
    <div class="separator"></div>
    <p class="status-text centered"><?=(isset($transaction["rider"]))?"Shipping in Progress":"Awaiting Rider" ?></p> 
  </div>

<?php } ?>


<!-- 
<div class="transaction-card">
    <div class="buyer-info">
      <img src="buyer-image.jpg" alt="Buyer Profile Picture" class="buyer-pic">
      <span class="buyer-name">Hihe</span>
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
      <p>Rider Name: yourchinesefoodiscooooming</p>
      <p>Rider Number: 10101010101010</p>
    </div>
    <div class="separator"></div>
    <p class="status-text centered">Shipping in Progress</p> 
  </div> -->
