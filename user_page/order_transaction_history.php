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
<?php
require_once("../db_api/db_get.php");
$transac_history = $get_db->get_customer_transaction($_SESSION["cus_id"], $_POST["history_status"]??'paid')??null;
?>
<div class="container mt-4">
<!-- Sample Order History Item -->
  <?php 
  if($transac_history){
  foreach($transac_history as $transaction){
    foreach($transaction["orders"] as $order){ ?>
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="card-title">Order #<?=$order["order_id"]?></h6>
                <?=$order["order_qty"] . "x " . $order["item_name"] . "(" . $order["variation_name"] . ")"?></>
              <p class="order-status completed"><strong>Status:</strong> Completed</p>
              <p><strong>Order Completed Date:</strong> <?=$transaction["transaction_id"]?></p>
          </div>
          <div>
          </div>
        </div>
        <?php if($transaction["transaction_status"] === "paid" && $transaction["relation"] !== 1){ ?>
          <button class="btn btn-primary rate_button" data-order_id="<?=$order["order_id"]?>">Rate</button>
        <?php } ?>
      </div>
    </div>
  <?php }}}else{
    echo "No data found";
  } ?>
</div>

