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
        <button class="btn btn-primary submit-rating" onclick="confirmReceipt(123456)">Order Received</button>
        <button class="btn btn-primary submit-rating" onclick="requestRefund(123456)">Request Refund</button>
        </div>
    </div>
    <?php } ?> 
</div>
  <script>
    function confirmReceipt(orderId) {
      Swal.fire({
        title: 'Confirm Receipt',
        text: "Are you sure you want to confirm receipt of this order?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm it!',
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Confirmed!',
            'The receipt has been confirmed.',
            'success'
          );
          // Hide the confirm button after confirming receipt
          document.querySelector(`button[onclick="confirmReceipt(${orderId})"]`).style.display = 'none';
        }
      });
    }

    function requestRefund(orderId) {
      Swal.fire({
        title: 'Request Refund',
        text: "Please provide a reason for the refund:",
        input: 'textarea',
        inputPlaceholder: 'Enter your reason here...',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Submit Refund Request',
        preConfirm: (reason) => {
          if (!reason) {
            Swal.showValidationMessage('Please enter a reason for the refund.');
          } else {
            return reason;
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Requested!',
            'Your refund request has been submitted with the reason: ' + result.value,
            'success'
          );
          document.querySelector(`button[onclick="requestRefund(${orderId})"]`).style.display = 'none';
        }
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
