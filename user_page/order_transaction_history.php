<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction History</title>
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
      margin-bottom: 20px;
    }

    .order-status {
      font-weight: bold;
      text-transform: uppercase;
      font-size: 0.9rem;
    }

    .order-status.completed {
      color: #28a745;
    }

    .order-status.canceled {
      color: #dc3545;
    }

    .order-status.pending {
      color: #ffc107;
    }
  </style>
</head>
<body>
<?php
require_once("../utilities/initialize.php"); 
require_once("../db_api/db_get.php");
$transac_history = $get_db->get_customer_transaction($_SESSION["cus_id"], "paid");
require_once('../utilities/back_button.php'); 
?>
<div class="container mt-4">
<!-- Sample Order History Item -->
  <?php foreach($transac_history as $transaction){ ?>
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="card-title">Transaction #<?=$transaction["transaction_id"]?></h6>
            <p><strong>Transaction Completed Date:</strong> <?=$transaction["transaction_id"]?></p>
            <p><strong>Order Summary:</strong> </p>
              <ul>
                <?php foreach($transaction["orders"] as $order){ ?> 
                    <li><?=$order["order_qty"] . "x " . $order["item_name"] . "(" . $order["variation_name"] . ")"?></li>
                <?php } ?>
              </ul>
            <p><strong>Total:</strong> ₱<?=number_format($transaction["total_transaction_amt"])?></p>
            <p class="order-status completed"><strong>Status:</strong> Completed</p>
          </div>
          <div>
            <a href="order_detailed_history.php" class="btn btn-outline-primary">View Details</a>
          </div>
        </div>
        <button class="btn btn-primary rate_button" data-transaction_id="<?=$transact_info["transaction_id"]?>">Rate</button>
      </div>
    </div>
  <?php } ?>
</div>
</body>
</html>
