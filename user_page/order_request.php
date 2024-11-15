<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Requests</title>
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

    .status-requesting {
      color: #ffc107; 
      font-weight: bold;
    }

    .btn-cancel {
      background-color: #dc3545; 
      color: white;
    }
  </style>
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once('../utilities/back_button.php'); 
require_once('../utilities/initialize.php'); 
require_once('../db_api/db_get.php');
$order_requests = $get_db->get_customer_orders($_SESSION["cus_id"]);
?>

<div class="container mt-4">
    <?php foreach($order_requests as $requsts){  ?>
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order#<?=$requsts["order_id"]?></h6>
        <p><strong>Item:</strong> <?=$requsts["item_name"]."(". $requsts["variation_name"] .")"?></p>
        <p><strong>Quantity:</strong> <?=$requsts["order_qty"]?></p>
        <p><strong>Total:</strong> <?=$requsts["order_price"]?></p>
        <button class="btn btn-primary submit-rating" onclick="confirmCancelOrder()">Cancel Order</button>
      </div>
    </div>
    <?php } ?>

  <script>
    function confirmCancelOrder() {
      Swal.fire({
        title: 'Cancel Order',
        text: "Are you sure you want to cancel this order?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, cancel it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Cancelled!',
            'Your order has been cancelled.',
            'success'
          );
          // Logic to remove the order card can be added here
        }
      });
    }
    $("#back_btn").click(function(){
      window.history.back();
    });
  </script>
</body>
</html>
