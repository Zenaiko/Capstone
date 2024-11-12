<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Details</title>

</head>
<body>
<?php
(session_status() === PHP_SESSION_NONE)?session_start():null;
require_once("../utilities/initialize.php");
require_once("../db_api/db_get.php");
$active_delivery = $get_db->get_active_delivery($_SESSION["rider_num"]);
$delivery_info = $get_db->active_delivery_info($_SESSION["rider_num"]);
 ?>
<div class="container mt-4">
  <a href="rider_landing.php" class="btn btn-outline-primary mb-3">Back</a>
  <?php 
    if($active_delivery){?>
<?php require_once('../utilities/back_button.php'); ?>

  <div class="container mt-4">
    <!-- Delivery Overview -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Delivery Overview</h6>
        <p><strong>Seller Name:</strong><?=$active_delivery["market_name"]?></p>
        <p><strong>Seller Address:</strong><?=$active_delivery["market_address"]?></p>
        <p><strong>Seller Contact:</strong><?=$active_delivery["market_contact"]?></p>
        <p><strong>Customer Name:</strong><?=$active_delivery["recipient_name"]?></p>
        <p><strong>Address:</strong><?=$active_delivery["customer_address"]?></p>
        <p><strong>Contact Number:</strong><?=$active_delivery["customer_contact"]?></p>
      </div>
    </div>
    <!-- Order Summary -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order Summary</h6>
        <ul>
          <?php foreach($delivery_info as $items){ ?>
            <li><?=$items["order_qty"]."X ".$items["item_name"]."(".$items["variation_name"].")"." - ₱".$items["order_price"]?></li>
          <?php } ?>
        </ul>
        <p><strong>Total Amount:</strong> ₱<?=$delivery_info[0]["total_transaction_amt"]?></p>
      </div>
    </div>



  <?php }else{
    echo "No active deliveries";
  } ?>
  

  <!-- Delivery Overview -->
  <!-- <div class="card mb-3">
    <div class="card-body">
      <h6 class="card-title">Delivery Overview</h6>
      <p><strong>Seller Name:</strong> CJshabu</p>
      <p><strong>Seller Address:</strong> hehe</p>
      <p><strong>Customer Name:</strong> Nicoteen69</p>
      <p><strong>Address:</strong> secret</p>
      <p><strong>Contact Number:</strong> (69) 456-7890</p>
    </div>
  </div> -->

  <!-- Order Summary -->
  <!-- <div class="card mb-3">
    <div class="card-body">
      <h6 class="card-title">Order Summary</h6>
      <ul>
        <li>2x Pizza - ₱500</li>
        <li>1x Salad - ₱200</li>
      </ul>
      <p><strong>Total Amount:</strong> ₱700</p>
    </div>
  </div> -->

</div>

</body>
</html>
