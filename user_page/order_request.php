<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requesting Phase</title>
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
<?php require_once('../utilities/initialize.php'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
      <a href="order_transaction_history.php" class="btn btn-outline-primary">Back</a>
      <div></div> 
    </div>

    <!-- Order Card 1 -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order #123456</h6>
        <p><strong>Items:</strong> 2x Pizza, 1x Salad</p>
        <p><strong>Total:</strong> ₱700.00</p>
        <button class="btn btn-primary submit-rating" onclick="confirmCancelOrder()">Cancel Order</button>
      </div>
    </div>

    <!-- Order Card 2 -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order #123457</h6>
        <p><strong>Items:</strong> 1x Burger, 3x Fries</p>
        <p><strong>Total:</strong> ₱900.00</p>
        <button class="btn btn-primary submit-rating" onclick="confirmCancelOrder()">Cancel Order</button>
      </div>
    </div>

    <!-- Order Card 3 -->
    <div class="card mb-3">
      <div class="card-body">
        <h6 class="card-title">Order #123458</h6>
        <p><strong>Items:</strong> 5x Sushi</p>
        <p><strong>Total:</strong> ₱1,500.00</p>
        <button class="btn btn-primary submit-rating" onclick="confirmCancelOrder()">Cancel Order</button>
      </div>
    </div>
  </div>

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
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
