<link rel="stylesheet" href="../css/transaction.css">
<?php
require_once("../db_api/db_get_orders.php");
$order_requests = $order_info_db->get_orders_info();
?>

<?php foreach($order_requests as $req){?>
  <div class="transaction-card">

    <div class="buyer-info">
      <img src="../assets/tmp.png" alt="" class="buyer-pic">
      <span class="buyer-name"><?=$req["username"]?></span>
    </div>
    <div class="separator"></div>
      <div class="order-info">
      <div class="product-details">
        <div class="product-text">
          <p class="product-name"><?=$req["item_name"] . " (" . $req["variation_name"] .")"?></p>
          <p class="quantity">Quantity:<?=number_format($req["order_qty"])?></p>
          <p class="price">Total: ₱<?=number_format($req["order_price"])?></p>
        </div>
      <img src="../assets/tmp.png" alt="" class="product-pic">
      </div>
    </div>
    <div class="order-time">
      <p>Date Ordered: <?=$req["date_requested"]?></p>
    </div>
    <div class="separator"></div>
    <div class="action-buttons">
      <input type="button" class="order_btn accept-btn" id="<?=$req["order_id"]?>" value="Accept">
      <input type="button" class="order_btn reject-btn" id="<?=$req["order_id"]?>" value="Decline">
    </div>
  </div>
<?php } ?>

  <script>
    

  </script>