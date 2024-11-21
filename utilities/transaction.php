<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction History</title>
  <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
  <style>
    .nav-tabs {
      margin-top: -45px; /* Adjust this value as needed */
    }
  </style>
</head>
<body>
<?php
  require_once('back_button.php'); 
  require_once("initialize.php"); 
?>
  <div class="container my-5">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="purchasesTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active transact_tab" id="completed-tab" data-tab-type="paid" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="true">Completed</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link transact_tab" id="cancelled-tab" data-tab-type="cancelled" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link transact_tab" id="failed-tab" data-tab-type="faled" data-bs-toggle="tab" data-bs-target="#failed" type="button" role="tab" aria-controls="failed" aria-selected="false">Failed</button>
      </li>
    </ul>
  </div>
  
  <div id="transaction_history_container">
    <?php include_once('../user_page/order_transaction_history.php'); ?>
  </div>

  <script src="../js/cus_transact_history.js"></script>
</body>
</html>
