<?php 
require_once("../db_api/db_get_orders.php");
$completed_transaction = $order_info_db->get_transaction_info("completed");
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/transaction.css">

<?php foreach($completed_transaction as $transaction){ ?>
<div class="transaction-card">
    <div class="buyer-info">
      <img src="../assets/tmp.png" alt="Buyer Profile Picture" class="buyer-pic">
      <span class="buyer-name"><?=$transaction["username"]?></span>
    </div>
    <div class="separator"></div>

    <!-- Loop -->
    <?php foreach($transaction["orders"] as $order){ ?>
     <div class="order-info">
       <div class="product-details">
         <div class="product-text">
           <p class="product-name"><?=$order["item_name"]."(".$order["variation_name"].")" ?></p>
           <p class="quantity">Quantity: <?=$order["order_qty"]?></p>
           <p class="price">₱<?=$order["order_price"]?></p>
          </div>
        </div>
      </div>
    <?php } ?>

    <p>Order Subtotal: ₱<?=$transaction["total_transaction_amt"]?></p>
    <div class="order-time">
      <p><?=$transaction["rider"]["date_time_accepted"]??null?></p>
    </div>
    <div class="completed-time">
      <p><?=$transaction["rider"]["date_time_delivered"]??null?></p>
    </div>
    <div class="separator"></div>
    <p class="status-text centered"><?=($transaction["transaction_status"] === "delivered")?"Order Completed Awaiting Payement":"Payement Received" ?></p> 
  </div>
<?php } ?>

<!-- 
<div class="transaction-card">
    <div class="buyer-info">
      <img src="buyer-image.jpg" alt="Buyer Profile Picture" class="buyer-pic">
      <span class="buyer-name">DHOTDOGSELLER</span>
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
      <p>Order Time: September 30, 2024 - 12:30 PM (Mon)</p>
    </div>
    <div class="completed-time">
      <p>Completed Time: September 30, 2024 - 2:45 PM (Mon)</p>
    </div>
    <div class="separator"></div>
    <p class="status-text centered">Order Completed</p> 
  </div> -->