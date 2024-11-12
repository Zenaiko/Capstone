<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/transaction.css">
<?php
require_once("../db_api/db_get_orders.php");
$order_requests = $order_info_db->get_orders_info();
?>

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
        <input type="button" class="order_btn accept-btn" id="<?=$req["order_id"]?>" value="Accept">
      <input type="button" class="order_btn reject-btn" id="<?=$req["order_id"]?>" value="Decline">
    </div> 

  <?php } ?>
  </div>

  <script>
    

  </script>