<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receiving</title>
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

    .status-received {
      color: #28a745; 
      font-weight: bold;
    }

    .btn-confirm {
      background-color: #28a745; 
      color: white;
    }

    .btn-refund {
      background-color: #dc3545; 
      color: white;
    }
  </style>
</head>
<body>
<?php
require_once('../utilities/back_button.php');
require_once('../utilities/initialize.php'); 
require_once('../db_api/db_get.php');
$completed_order = $get_db->get_customer_transaction($_SESSION["cus_id"],"recieved");

?>
<div class="container mt-4">
 <?php foreach($completed_order as $transact_info){ ?>
    <div class="card mb-3">
      <p class="status-shipping">Status: Shipping</p>
      <div class="card-body">
        <h6 class="card-title">Transaction #<?=$transact_info["transaction_id"]?></h6>
        <hr>
        <!-- Loop foreach transaction order -->
         <?php foreach($transact_info["orders"] as $order){?>
            <p><?=$order["item_name"]."(".$order["variation_name"].")"?></p>
            <p><strong>Quantity:</strong> <?=$order["order_qty"]?></p>
            <p><strong>Total Price:</strong>₱<?=$order["order_price"]?></p>
            <hr>
        <?php } ?>
        <p><strong>Delivery Fee: </strong>₱<?=$transact_info["del_fee"]?></p>
        <p><strong>Transaction Total: </strong>₱<?=$transact_info["total_transaction_amt"]?></p>
        <p><strong>Receipient: </strong><?=$transact_info["recipient_name"]?></p>
        <p><strong>Shipping Address: </strong><?=$transact_info["customer_address"]?></p>
        <!-- If order is satisfied -->
        <?php if($transact_info["transaction_status"] !== "completed"){ ?>
          <button class="btn btn-primary submit-rating" data-transaction-id="<?=$transact_info["transaction_id"]?>">Order Received</button>
          <button class="btn btn-primary submit-rating" data-transaction-id="<?=$transact_info["transaction_id"]?>">Request Refund</button>
        <?php }else{ ?>
          <button class="btn btn-primary submit-rating" data-transaction-id="<?=$transact_info["transaction_id"]?>">Rate</button>
        <?php } ?>
        </div>
    </div>
    <?php } ?> 
</div>
<script src="../js/cus_transaction.js"></script>
</body>
</html>
