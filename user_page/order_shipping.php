<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping</title>
  <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    h4, h6 {
      color: #20263e;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .status-shipping {
      color: #17a2b8; 
      font-weight: bold;
    }

    .btn-track {
      background-color: #007bff; 
      color: white;
    }
  </style>
</head>
<body>
<?php
require_once('../utilities/initialize.php'); 
require_once('../db_api/db_get.php');
$transaction_info = $get_db->get_customer_transaction($_SESSION["cus_id"], "shipping");
require_once('../utilities/back_button.php');
?>
 <div class="container mt-4">
    <?php foreach($transaction_info as $transact_info){ ?>
      <div class="card mb-3">
        <div class="card-body">
          <p class="status-shipping">Status: Shipping</p>
          <h6 class="card-title">Transaction #<?=$transact_info["transaction_id"]?></h6>
          <hr>
          <!-- Loop foreach transaction order -->
          <?php foreach($transact_info["orders"] as $order){?>
              <p><?=$order["item_name"]."(".$order["variation_name"].")"?></p>
              <p><strong>Quantity:</strong> <?=number_format($order["order_qty"])?></p>
              <p><strong>Total Price:</strong>₱<?=number_format($order["order_price"])?></p>
              <hr>
          <?php } ?>
          <p><strong>Delivery Fee: </strong>₱<?=number_format($transact_info["del_fee"])?></p>
          <p><strong>Transaction Total: </strong>₱<?=number_format($transact_info["total_transaction_amt"])?></p>
          <p><strong>Reciepient: </strong><?=$transact_info["recipient_name"]?></p>
          <p><strong>Shipping Address: </strong><?=$transact_info["customer_address"]?></p>
          </div>
      </div>
    <?php } ?>    
 </div>
</body>
</html>
